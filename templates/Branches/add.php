<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Branch $branch
 */
?>
<header class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-3xl font-black text-slate-800 tracking-tight uppercase">Nueva Sucursal</h1>
        <p class="text-blue-600 font-bold uppercase text-xs tracking-widest">Añadir punto de venta al negocio</p>
    </div>
    <?= $this->Html->link('<i class="fa-solid fa-arrow-left mr-2"></i> Volver', ['action' => 'index'], ['escape' => false, 'class' => 'bg-slate-200 text-slate-600 px-4 py-2 rounded-xl font-bold text-xs hover:bg-slate-300 transition-all']) ?>
</header>

<div class="bg-white p-8 rounded-[2.5rem] border border-blue-50 shadow-2xl max-w-2xl">
    <?= $this->Form->create($branch) ?>
        <div class="space-y-6">
            <div>
                <label class="text-[10px] font-black text-slate-400 ml-2 uppercase tracking-widest">Nombre de la Sucursal</label>
                <?= $this->Form->control('name', [
                    'label' => false, 
                    'placeholder' => 'Ej: Sede Norte, Domicilios Sur...',
                    'class' => 'w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 transition-all font-bold text-slate-700'
                ]) ?>
            </div>
            
            <div>
                <label class="text-[10px] font-black text-slate-400 ml-2 uppercase tracking-widest">Dirección Física</label>
                <?= $this->Form->control('address', [
                    'label' => false, 
                    'placeholder' => 'Calle, Carrera, Ciudad...',
                    'class' => 'w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 transition-all font-bold text-slate-700'
                ]) ?>
            </div>

            <div>
                <label class="text-[10px] font-black text-slate-400 ml-2 uppercase tracking-widest">Teléfono / Celular</label>
                <?= $this->Form->control('phone', [
                    'label' => false, 
                    'placeholder' => 'Ej: 300 000 0000',
                    'class' => 'w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 transition-all font-bold text-slate-700'
                ]) ?>
            </div>

            <div class="p-6 bg-blue-50 rounded-3xl border border-blue-100 flex gap-4 items-start">
                <i class="fa-solid fa-circle-info text-blue-500 mt-1"></i>
                <p class="text-[10px] text-blue-700 font-bold leading-relaxed italic">
                    Las sucursales permiten separar el inventario y las ventas. Una vez creada, podrás asignar empleados específicos para este local.
                </p>
            </div>

            <div class="pt-6 border-t border-slate-50">
                <?= $this->Form->button(__('Registrar Sucursal'), [
                    'class' => 'w-full bg-slate-900 text-white font-black rounded-2xl py-5 uppercase shadow-lg hover:bg-blue-600 transition-all text-lg tracking-widest'
                ]) ?>
            </div>
        </div>
    <?= $this->Form->end() ?>
</div>
