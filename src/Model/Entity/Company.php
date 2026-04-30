<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Company Entity
 *
 * @property int $id
 * @property string $name
 * @property string $nit
 * @property string|null $address
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $logo
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\AccountPayment[] $account_payments
 * @property \App\Model\Entity\AccountsReceivable[] $accounts_receivable
 * @property \App\Model\Entity\Branch[] $branches
 * @property \App\Model\Entity\Client[] $clients
 * @property \App\Model\Entity\DailyClosure[] $daily_closures
 * @property \App\Model\Entity\DeliveryDriver[] $delivery_drivers
 * @property \App\Model\Entity\Expense[] $expenses
 * @property \App\Model\Entity\Ingredient[] $ingredients
 * @property \App\Model\Entity\InventoryAdjustment[] $inventory_adjustments
 * @property \App\Model\Entity\OrderLog[] $order_logs
 * @property \App\Model\Entity\Order[] $orders
 * @property \App\Model\Entity\Product[] $products
 * @property \App\Model\Entity\User[] $users
 */
class Company extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'name' => true,
        'has_branches' => true,
        'nit' => true,
        'address' => true,
        'phone' => true,
        'email' => true,
        'logo' => true,
        'created' => true,
        'modified' => true,
        'account_payments' => true,
        'accounts_receivable' => true,
        'branches' => true,
        'clients' => true,
        'daily_closures' => true,
        'delivery_drivers' => true,
        'expenses' => true,
        'ingredients' => true,
        'inventory_adjustments' => true,
        'order_logs' => true,
        'orders' => true,
        'products' => true,
        'users' => true,
    ];
}
