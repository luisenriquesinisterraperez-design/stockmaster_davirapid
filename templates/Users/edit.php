<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 * @var mixed $companies
 * @var mixed $branches
 * @var mixed $deliveryDrivers
 */
?>
<header class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-3xl font-black text-slate-800 tracking-tight uppercase">Editar Perfil</h1>
        <p class="text-blue-600 font-bold uppercase text-xs tracking-widest">Ajustar acceso de <?= h($user->username) ?></p>
    </div>
    <?= $this->Html->link('<i class="fa-solid fa-arrow-left mr-2"></i> Volver', ['action' => 'index'], ['escape' => false, 'class' => 'bg-slate-200 text-slate-600 px-4 py-2 rounded-xl font-bold text-xs hover:bg-slate-300 transition-all']) ?>
</header>

<div class="bg-white p-10 rounded-[3rem] border border-blue-50 shadow-2xl max-w-4xl">
    <?= $this->Form->create($user) ?>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            <!-- Columna 1: Credenciales -->
            <div class="space-y-6">
                <h3 class="font-black text-slate-900 uppercase text-sm tracking-widest flex items-center gap-2">
                    <i class="fa-solid fa-user-gear text-blue-500"></i> Parámetros de Usuario
                </h3>
                
                <div>
                    <label class="text-[10px] font-black text-slate-400 ml-2 uppercase tracking-widest">Nombre de Usuario</label>
                    <?= $this->Form->control('username', ['label' => false, 'class' => 'w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 transition-all font-bold text-slate-700']) ?>
                </div>

                <div>
                    <label class="text-[10px] font-black text-slate-400 ml-2 uppercase tracking-widest">Rol del Sistema</label>
                    <?= $this->Form->select('role', [
                        'admin' => '👑 ADMINISTRADOR GLOBAL',
                        'admin_empresa' => '🏢 ADMIN DE EMPRESA',
                        'staff' => '🛠️ STAFF / OPERADOR',
                        'repartidor' => '🏍️ REPARTIDOR'
                    ], ['id' => 'role-select', 'class' => 'w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 font-black text-xs uppercase']) ?>
                </div>

                <div id="driver-link-div" class="hidden">
                    <label class="text-[10px] font-black text-slate-400 ml-2 uppercase tracking-widest italic text-blue-600">Este usuario es el repartidor:</label>
                    <?= $this->Form->control('delivery_driver_id', ['options' => $deliveryDrivers, 'empty' => 'Seleccionar Repartidor...', 'label' => false, 'class' => 'w-full p-4 bg-blue-50 border border-blue-200 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 font-bold']) ?>
                </div>

                <div class="pt-4">
                    <label class="text-[10px] font-black text-slate-400 ml-2 uppercase tracking-widest">Nueva Contraseña (Dejar vacío)</label>
                    <?= $this->Form->control('password', ['label' => false, 'value' => '', 'placeholder' => '••••••••', 'class' => 'w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 transition-all font-bold', 'type' => 'password']) ?>
                </div>
            </div>

            <!-- Columna 2: Ubicación (Multi-Tenant) -->
            <div class="space-y-6 bg-slate-50 p-8 rounded-[2rem] border border-slate-100">
                <h3 class="font-black text-slate-900 uppercase text-sm tracking-widest flex items-center gap-2">
                    <i class="fa-solid fa-map-location-dot text-blue-600"></i> Asignación de Cliente / Empresa
                </h3>

                <div>
                    <label class="text-[10px] font-black text-slate-400 ml-2 uppercase tracking-widest">Empresa Asignada</label>
                    <?= $this->Form->control('company_id', ['id' => 'company-select', 'options' => $companies, 'empty' => '-- Sin Empresa (Solo Global) --', 'label' => false, 'class' => 'w-full p-4 bg-white border border-slate-200 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 font-bold']) ?>
                </div>

                <div class="p-6 bg-blue-600 rounded-[2rem] text-white shadow-xl shadow-blue-500/20">
                    <p class="text-[10px] font-black uppercase opacity-70 mb-2 leading-none">IMPORTANTE</p>
                    <p class="text-[10px] font-bold leading-relaxed italic opacity-90">
                        Al cambiar la empresa, el usuario dejará de ver sus datos actuales y pasará a gestionar únicamente la información de la nueva empresa seleccionada.
                    </p>
                </div>
            </div>
        </div>

        <div class="pt-10 mt-10 border-t border-slate-50 flex gap-4">
            <?= $this->Form->button(__('Actualizar Perfil STOCKMASTER'), ['class' => 'flex-1 bg-slate-950 text-white font-black rounded-2xl py-6 uppercase shadow-xl hover:bg-blue-600 transition-all text-lg tracking-widest']) ?>
            <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $user->id], ['confirm' => __('¿Eliminar cuenta?'), 'class' => 'px-10 bg-red-50 text-red-500 font-bold rounded-2xl py-6 uppercase hover:bg-red-100 transition-all text-xs']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const roleSelect = document.getElementById('role-select');
        const driverDiv = document.getElementById('driver-link-div');

        function toggleDriver() {
            if (roleSelect.value === 'repartidor') {
                driverDiv.classList.remove('hidden');
            } else {
                driverDiv.classList.add('hidden');
            }
        }

        roleSelect.addEventListener('change', toggleDriver);
        toggleDriver(); 
    });
</script>
