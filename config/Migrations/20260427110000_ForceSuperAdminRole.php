<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class ForceSuperAdminRole extends BaseMigration
{
    public function up()
    {
        // Aseguramos que el usuario 'admin' o cualquier usuario que deba ser global 
        // tenga los permisos correctos.
        // Si conoces tu username, podrías ponerlo aquí, por ahora lo aplicamos al que tenga el id más bajo o sea admin.
        $this->execute("UPDATE users SET is_superadmin = 1, company_id = NULL, branch_id = NULL WHERE username = 'admin' OR id = 1");
    }

    public function down() {}
}
