<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tareas Model
 *
 * @method \App\Model\Entity\Tarea newEmptyEntity()
 * @method \App\Model\Entity\Tarea newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Tarea> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Tarea get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Tarea findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Tarea patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Tarea> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Tarea|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Tarea saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Tarea>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tarea>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Tarea>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tarea> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Tarea>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tarea>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Tarea>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tarea> deleteManyOrFail(iterable $entities, array $options = [])
 */
class TareasTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('tareas');
        $this->setDisplayField('titulo');
        $this->setPrimaryKey('id');

        // $this->addBehavior('Tenant');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('titulo')
            ->maxLength('titulo', 100)
            ->requirePresence('titulo', 'create')
            ->notEmptyString('titulo');

        $validator
            ->scalar('descripcion')
            ->allowEmptyString('descripcion');

        $validator
            ->boolean('terminada')
            ->allowEmptyString('terminada');

        $validator
            ->dateTime('creada')
            ->allowEmptyDateTime('creada');

        return $validator;
    }
}
