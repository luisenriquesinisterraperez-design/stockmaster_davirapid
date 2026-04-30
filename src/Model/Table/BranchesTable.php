<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Branches Model
 *
 * @property \App\Model\Table\CompaniesTable&\Cake\ORM\Association\BelongsTo $Companies
 * @property \App\Model\Table\AccountPaymentsTable&\Cake\ORM\Association\HasMany $AccountPayments
 * @property \App\Model\Table\AccountsReceivableTable&\Cake\ORM\Association\HasMany $AccountsReceivable
 * @property \App\Model\Table\ClientsTable&\Cake\ORM\Association\HasMany $Clients
 * @property \App\Model\Table\DailyClosuresTable&\Cake\ORM\Association\HasMany $DailyClosures
 * @property \App\Model\Table\DeliveryDriversTable&\Cake\ORM\Association\HasMany $DeliveryDrivers
 * @property \App\Model\Table\ExpensesTable&\Cake\ORM\Association\HasMany $Expenses
 * @property \App\Model\Table\IngredientsTable&\Cake\ORM\Association\HasMany $Ingredients
 * @property \App\Model\Table\InventoryAdjustmentsTable&\Cake\ORM\Association\HasMany $InventoryAdjustments
 * @property \App\Model\Table\OrderLogsTable&\Cake\ORM\Association\HasMany $OrderLogs
 * @property \App\Model\Table\OrdersTable&\Cake\ORM\Association\HasMany $Orders
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\HasMany $Products
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\HasMany $Users
 *
 * @method \App\Model\Entity\Branch newEmptyEntity()
 * @method \App\Model\Entity\Branch newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Branch> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Branch get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Branch findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Branch patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Branch> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Branch|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Branch saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Branch>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Branch>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Branch>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Branch> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Branch>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Branch>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Branch>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Branch> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BranchesTable extends Table
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

        $this->setTable('branches');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
$this->belongsTo('Companies', [
    'foreignKey' => 'company_id',
    'joinType' => 'INNER',
]);

        // $this->addBehavior('Tenant');

        $this->hasMany('AccountPayments', [
            'foreignKey' => 'branch_id',
        ]);
        $this->hasMany('AccountsReceivable', [
            'foreignKey' => 'branch_id',
        ]);
        $this->hasMany('Clients', [
            'foreignKey' => 'branch_id',
        ]);
        $this->hasMany('DailyClosures', [
            'foreignKey' => 'branch_id',
        ]);
        $this->hasMany('DeliveryDrivers', [
            'foreignKey' => 'branch_id',
        ]);
        $this->hasMany('Expenses', [
            'foreignKey' => 'branch_id',
        ]);
        $this->hasMany('Ingredients', [
            'foreignKey' => 'branch_id',
        ]);
        $this->hasMany('InventoryAdjustments', [
            'foreignKey' => 'branch_id',
        ]);
        $this->hasMany('OrderLogs', [
            'foreignKey' => 'branch_id',
        ]);
        $this->hasMany('Orders', [
            'foreignKey' => 'branch_id',
        ]);
        $this->hasMany('Products', [
            'foreignKey' => 'branch_id',
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'branch_id',
        ]);
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
            ->integer('company_id')
            ->notEmptyString('company_id');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('address')
            ->allowEmptyString('address');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 50)
            ->allowEmptyString('phone');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['company_id'], 'Companies'), ['errorField' => 'company_id']);

        return $rules;
    }
}
