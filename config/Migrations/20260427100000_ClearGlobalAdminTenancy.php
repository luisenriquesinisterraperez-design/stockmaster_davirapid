<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class ClearGlobalAdminTenancy extends BaseMigration
{
    public function up()
    {
        // Poner en NULL la empresa y sucursal para los Súper Admins
        // para que puedan gestionar TODO el sistema sin restricciones.
        $this->execute("UPDATE users SET company_id = NULL, branch_id = NULL WHERE is_superadmin = 1");
    }

    public function down()
    {
        // No es necesario revertir esto normalmente, pero si se quisiera, 
        // habría que reasignarlos a la empresa 1.
    }
}
