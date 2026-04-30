<?php
declare(strict_types=1);

namespace App\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\ORM\Query\SelectQuery;
use Cake\Event\EventInterface;
use Cake\Routing\Router;

class TenantBehavior extends Behavior
{
    /**
     * Variable para desactivar temporalmente el filtro si es necesario (ej: login)
     */
    protected bool $_enabled = true;

    public function enableTenant(bool $enabled = true)
    {
        $this->_enabled = $enabled;
    }

    public function beforeFind(EventInterface $event, SelectQuery $query, \ArrayObject $options, $primary)
    {
        if (!$this->_enabled) return;

        $request = Router::getRequest();
        $identity = $request ? $request->getAttribute('identity') : null;
        
        // Si no hay identidad (login) o es superadmin, NO aplicamos filtro restrictivo
        // El superadmin puede verlo todo.
        if (!$identity) {
            return;
        }

        $user = $identity->getOriginalData();
        $isSuperAdmin = !empty($user->is_superadmin) || $user->username === 'admin';

        if ($isSuperAdmin) {
            return;
        }

        // Para usuarios normales, filtramos por su empresa
        $companyId = $user->company_id ?? null;
        $alias = $this->_table->getAlias();
        
        if ($companyId !== null) {
            $query->where(["$alias.company_id" => $companyId]);
        } else {
            // Si por alguna razón un usuario no superadmin no tiene empresa, 
            // no debería ver nada o solo lo global. Por seguridad, lo global.
            $query->where(["$alias.company_id IS" => null]);
        }
    }

    public function beforeSave(EventInterface $event, \Cake\Datasource\EntityInterface $entity, \ArrayObject $options)
    {
        if ($entity->isNew()) {
            $companyId = $this->_getCompanyId();
            $entity->set('company_id', $companyId);
        }
    }

    /**
     * Obtiene el company_id del usuario actual de forma segura
     */
    protected function _getCompanyId()
    {
        $request = Router::getRequest();
        if ($request) {
            $identity = $request->getAttribute('identity');
            if ($identity) {
                $user = $identity->getOriginalData();
                return $user->company_id ?? null;
            }
        }
        
        // Si no hay request (ej: CLI), devolvemos null para no romper pero alertar
        return null;
    }
}
