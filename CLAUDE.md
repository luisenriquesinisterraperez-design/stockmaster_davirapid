# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project: DAVI RAPI

Sistema de gestión para negocios de comida rápida (punto físico + domicilios) construido sobre **CakePHP 5.x**. Cubre menú/productos, pedidos, repartidores, clientes, inventario (ingredientes + ajustes), gastos, cuentas por cobrar, cierres diarios y dashboard. Funcional/dominio detallado en `GEMINI.md` (en español; tratarlo como spec del negocio).

## Comandos comunes

CLI de CakePHP a través de `bin/cake` (Linux/Mac) o `bin\cake.bat` (Windows). En este entorno bash/Windows, invocar PHP directamente vía `php bin/cake.php ...` es lo más portable.

```bash
# Servidor de desarrollo
bin/cake server -p 8765

# Migraciones (la tabla phinxlog se llena con la lista en config/Migrations/)
bin/cake migrations migrate
bin/cake migrations rollback
bin/cake migrations status

# Bake (generar scaffolding de un módulo)
bin/cake bake controller <Name>
bin/cake bake model <Name>
bin/cake bake template <Name> <action>

# Limpiar caché
bin/cake cache clear_all
```

Tests, lint y análisis:

```bash
# Toda la suite (phpunit con bootstrap tests/bootstrap.php)
composer test
# o:
vendor/bin/phpunit

# Un solo archivo o test
vendor/bin/phpunit tests/TestCase/Controller/OrdersControllerTest.php
vendor/bin/phpunit --filter testCreateOrder

# Lint (CakePHP coding standard, configurado en phpcs.xml)
composer cs-check
composer cs-fix    # autofix donde se pueda

# Análisis estático (nivel 8, configurado en phpstan.neon)
vendor/bin/phpstan analyse
# o si está instalado globalmente:
phpstan
```

CI (`.github/workflows/ci.yml`) corre PHPUnit con `DATABASE_TEST_URL=sqlite://./testdb.sqlite`, luego phpcs y phpstan. Para reproducirlo localmente, exportar la misma variable antes de `phpunit`.

## Configuración local

- `config/app_local.php` (no versionado) define `Datasources` y secrets — copiarlo de `config/app_local.example.php`. La env `DATABASE_URL` puede sobrescribirlo.
- `config/bootstrap.php` carga `.env` si existe (vía `josegonzalez/dotenv`). `SECURITY_SALT` es obligatoria.
- Webroot: `webroot/` (Apache `.htaccess` en raíz redirige a `webroot/index.php`).

## Arquitectura

CakePHP estándar (Controller → Table/Entity → Template) con dos cosas no obvias en las que merece la pena pensar antes de tocar código:

### 1. Multi-tenant por `company_id` con `TenantBehavior`

`src/Model/Behavior/TenantBehavior.php` filtra automáticamente todas las queries por la `company_id` del usuario autenticado, e inyecta `company_id` en `beforeSave` para registros nuevos. Reglas:

- En `beforeFind`: si el usuario es **superadmin** (`is_superadmin == true` o `username === 'admin'`), no se aplica filtro — ve todo. Usuarios normales se restringen a su `company_id`. Sin sesión (login, CLI), no se aplica filtro.
- En `beforeSave`: nuevas entidades reciben el `company_id` del usuario actual; null si no hay request (CLI).
- Para activar el behavior en una tabla nueva: `$this->addBehavior('Tenant');` en `initialize()`. **Atención:** algunas tablas existentes tienen la línea comentada (ej. `OrdersTable`); revisar caso por caso antes de "arreglar". Toda tabla con `company_id` en su esquema asume que esta lógica está activa.
- Las migraciones `20260425195720_AddMultiTenancyToAllTables` y `20260428120000_AddMissingTenancyToRelations` añadieron `company_id` (y a veces `branch_id`) a todas las entidades del dominio. Cualquier tabla nueva en el dominio debería incluirlas.

Al escribir queries crudas, joins manuales o consolas/CLI: el behavior **no** se aplica a CLI (no hay request) — filtrar `company_id` explícitamente o desactivar con `$Table->enableTenant(false)` si la intención es global.

### 2. Autorización por roles en `AppController::beforeFilter`

`src/Controller/AppController.php` centraliza el control de acceso (sin policies/RBAC plugin). Roles detectados por `username`/`role`/`is_superadmin` del identity:

- **Admin/SuperAdmin**: acceso total. SuperAdmin = `is_superadmin || username === 'admin' || role === 'admin'`.
- **Staff**: acceso a operaciones (Dashboard, Orders, Products, Ingredients, Clients, DeliveryDrivers, DailyClosures, AccountsReceivable, ProductIngredients, InventoryAdjustments). Puede `delete` (auditado).
- **Repartidor**: solo Dashboard y Orders.
- Controllers `Companies`, `Users`, `OrderLogs` están bloqueados a no-admin.
- Acción `delete` bloqueada para no-admin/no-staff.

Si vas a añadir un controller nuevo, **decide explícitamente** en qué lista de allowed entra y actualiza `AppController` — no se delega a anotaciones ni a un sistema de permisos. Los flags `$user`, `$isAdmin`, `$isSuperAdmin`, `$isRepartidor`, `$isStaff` se exponen automáticamente a las vistas (más alias antiguos `$isAdminEmpresa`, `$authUser` por compatibilidad).

### 3. Autenticación

`src/Application.php::getAuthenticationService` usa `cakephp/authentication` (Session + Form authenticator) contra la tabla `Users`. Ruta de login: `/users/login`. Sin sesión, redirige allí con `?redirect=`. La home es `Dashboard::index`.

## Convenciones del proyecto

- PHP 8.2+. `declare(strict_types=1)` en todos los archivos `src/`.
- Coding standard: **CakePHP** (`vendor/cakephp/cakephp-codesniffer`). `phpcs.xml` excluye el chequeo de `MissingNativeTypeHint` para controllers (CakePHP dispatcher hace cosas raras con return types ahí).
- PHPStan **nivel 8** sobre `src/`.
- Mensajes de UI/validación en **español** (ver entidades como `OrdersTable`).
- Migraciones en `config/Migrations/` con timestamp `YYYYMMDDHHMMSS_NombreEnPascalCase.php`. El estado actual está congelado en `config/Migrations/schema-dump-default.lock` — regenerarlo con `bin/cake migrations dump` tras añadir migraciones.
- `FactoryLocator` está configurado con `allowFallbackClass(false)` (en `Application::bootstrap`): toda tabla usada vía `fetchTable('X')` debe tener su clase `XTable` real. No confiar en fallback genérico.

## Tests

- Bootstrap: `tests/bootstrap.php`. Schema base: `tests/schema.sql`.
- Fixtures en `tests/Fixture/`. Test cases en `tests/TestCase/`.
- DB de tests: SQLite por defecto en CI; localmente respeta `DATABASE_TEST_URL` o `Datasources.test` de `app_local.php`.
