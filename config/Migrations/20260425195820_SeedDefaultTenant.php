<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class SeedDefaultTenant extends BaseMigration
{
    public function up()
    {
        // 1. Crear Empresa Default
        $this->execute("INSERT INTO companies (name, nit, created, modified) VALUES ('MI NEGOCIO PRINCIPAL', '000000000', NOW(), NOW())");
        
        // Obtener ID (usando query pura para asegurar compatibilidad)
        $res = $this->fetchRow("SELECT id FROM companies WHERE name = 'MI NEGOCIO PRINCIPAL' LIMIT 1");
        $companyId = $res['id'];

        // 2. Crear Sucursal Default
        $this->execute("INSERT INTO branches (company_id, name, created, modified) VALUES ($companyId, 'SEDE PRINCIPAL', NOW(), NOW())");
        $resB = $this->fetchRow("SELECT id FROM branches WHERE company_id = $companyId LIMIT 1");
        $branchId = $resB['id'];

        // 3. Asociar TODO lo existente
        $tables = [
            'users', 'products', 'ingredients', 'delivery_drivers', 'clients',
            'orders', 'expenses', 'daily_closures', 'inventory_adjustments',
            'accounts_receivable', 'account_payments', 'order_logs'
        ];

        foreach ($tables as $t) {
            $this->execute("UPDATE $t SET company_id = $companyId, branch_id = $branchId WHERE company_id IS NULL");
        }
    }

    public function down() { }
}
