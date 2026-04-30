<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Companies Model
 *
 * @property \App\Model\Table\AccountPaymentsTable&\Cake\ORM\Association\HasMany $AccountPayments
 * @property \App\Model\Table\AccountsReceivableTable&\Cake\ORM\Association\HasMany $AccountsReceivable
 * @property \App\Model\Table\BranchesTable&\Cake\ORM\Association\HasMany $Branches
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
 * @method \App\Model\Entity\Company newEmptyEntity()
 * @method \App\Model\Entity\Company newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Company> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Company get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Company findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Company patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Company> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Company|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Company saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Company>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Company>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Company>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Company> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Company>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Company>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Company>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Company> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CompaniesTable extends Table
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

        $this->setTable('companies');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('AccountPayments', [
            'foreignKey' => 'company_id',
        ]);
        $this->hasMany('AccountsReceivable', [
            'foreignKey' => 'company_id',
        ]);
        $this->hasMany('Branches', [
            'foreignKey' => 'company_id',
        ]);
        $this->hasMany('Clients', [
            'foreignKey' => 'company_id',
        ]);
        $this->hasMany('DailyClosures', [
            'foreignKey' => 'company_id',
        ]);
        $this->hasMany('DeliveryDrivers', [
            'foreignKey' => 'company_id',
        ]);
        $this->hasMany('Expenses', [
            'foreignKey' => 'company_id',
        ]);
        $this->hasMany('Ingredients', [
            'foreignKey' => 'company_id',
        ]);
        $this->hasMany('InventoryAdjustments', [
            'foreignKey' => 'company_id',
        ]);
        $this->hasMany('OrderLogs', [
            'foreignKey' => 'company_id',
        ]);
        $this->hasMany('Orders', [
            'foreignKey' => 'company_id',
        ]);
        $this->hasMany('Products', [
            'foreignKey' => 'company_id',
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'company_id',
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('nit')
            ->maxLength('nit', 100)
            ->allowEmptyString('nit');

        $validator
            ->scalar('address')
            ->allowEmptyString('address');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 50)
            ->allowEmptyString('phone');

        $validator
            ->email('email')
            ->allowEmptyString('email');

        $validator
            ->scalar('logo')
            ->maxLength('logo', 255)
            ->allowEmptyString('logo');

        return $validator;
    }
}
