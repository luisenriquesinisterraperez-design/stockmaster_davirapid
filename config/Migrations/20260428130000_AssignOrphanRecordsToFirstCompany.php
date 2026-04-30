<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class AssignOrphanRecordsToFirstCompany extends BaseMigration
{
    public function up()
    {
        $tables = [
            'users', 'products', 'ingredients', 'delivery_drivers', 'clients',
            'orders', 'expenses', 'daily_closures', 'inventory_adjustments',
            'accounts_receivable', 'account_payments', 'order_logs', 'product_ingredients'
        ];

        // Obtener el ID de la primera empresa creada
        $row = $this->fetchRow('SELECT id FROM companies LIMIT 1');
        if (!$row) return;
        $companyId = $row['id'];

        foreach ($tables as $t) {
            $this->execute("UPDATE $t SET company_id = $companyId WHERE company_id IS NULL OR company_id = 0");
        }
    }

    public function down()
    {
        // No necesario
    }
}
