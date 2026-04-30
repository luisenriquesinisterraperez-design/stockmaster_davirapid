<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Branches Controller
 *
 * @property \App\Model\Table\BranchesTable $Branches
 */
class BranchesController extends AppController
{
    public function index()
    {
        $query = $this->Branches->find();
        $branches = $this->paginate($query);

        $this->set(compact('branches'));
    }

    public function add()
    {
        $branch = $this->Branches->newEmptyEntity();
        if ($this->request->is('post')) {
            $branch = $this->Branches->patchEntity($branch, $this->request->getData());
            
            // Asignar automáticamente la empresa del usuario actual
            $user = $this->request->getAttribute('identity')->getOriginalData();
            $branch->company_id = $user->company_id;

            if ($this->Branches->save($branch)) {
                $this->Flash->success(__('La sucursal ha sido creada correctamente.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo guardar la sucursal. Por favor, intente de nuevo.'));
        }
        $this->set(compact('branch'));
    }

    public function edit($id = null)
    {
        $branch = $this->Branches->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $branch = $this->Branches->patchEntity($branch, $this->request->getData());
            if ($this->Branches->save($branch)) {
                $this->Flash->success(__('Los datos de la sucursal han sido actualizados.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo actualizar la sucursal.'));
        }
        $this->set(compact('branch'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $branch = $this->Branches->get($id);
        if ($this->Branches->delete($branch)) {
            $this->Flash->success(__('Sucursal eliminada.'));
        } else {
            $this->Flash->error(__('No se pudo eliminar la sucursal.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
