<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Company $company
 */
?>
<header class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-3xl font-black text-slate-800 tracking-tight uppercase">Configuración de Cliente</h1>
        <p class="text-blue-600 font-bold uppercase text-xs tracking-widest">Panel del Administrador Global</p>
    </div>
    <?= $this->Html->link('<i class="fa-solid fa-arrow-left mr-2"></i> Volver al Listado', ['action' => 'index'], ['escape' => false, 'class' => 'bg-slate-200 text-slate-600 px-4 py-2 rounded-xl font-bold text-xs hover:bg-slate-300 transition-all']) ?>
</header>

<div class="bg-white p-10 rounded-[3rem] border border-blue-50 shadow-2xl max-w-2xl">
    <?= $this->Form->create($company) ?>
        <div class="space-y-8">
            <h3 class="font-black text-slate-900 uppercase text-sm tracking-widest flex items-center gap-2">
                <i class="fa-solid fa-building-circle-check text-blue-500"></i> Datos del Negocio
            </h3>
            
            <div>
                <label class="text-[10px] font-black text-slate-400 ml-2 uppercase tracking-widest">Nombre del Cliente / Empresa</label>
                <?= $this->Form->control('name', [
                    'label' => false, 
                    'class' => 'w-full p-5 bg-slate-50 border border-slate-200 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 transition-all font-black text-lg text-slate-700'
                ]) ?>
            </div>

            <div class="flex items-center justify-between p-8 bg-blue-50 rounded-[2.5rem] border border-blue-100">
                <div>
                    <p class="text-xs font-black text-blue-900 uppercase tracking-widest">¿Habilitar Múltiples Sucursales?</p>
                    <p class="text-[10px] text-blue-600 font-bold leading-tight mt-1 max-w-[200px]">Permite que este cliente gestione sedes independientes.</p>
                </div>
                <label class="switch">
                    <?= $this->Form->checkbox('has_branches', ['class' => 'sr-only']) ?>
                    <span class="slider"></span>
                </label>
            </div>

            <div class="p-6 bg-slate-900 rounded-[2rem] text-white">
                <p class="text-[10px] font-black uppercase opacity-50 mb-2 tracking-widest leading-none">Privacidad de Datos</p>
                <p class="text-[10px] leading-relaxed opacity-80 italic">
                    Al guardar, este cliente mantendrá su información totalmente aislada. Como Administrador Global, tú eres el único que puede ver y gestionar este contenedor.
                </p>
            </div>

            <div class="pt-4">
                <?= $this->Form->button(__('Guardar Cambios del Cliente'), [
                    'class' => 'w-full bg-blue-600 text-white font-black rounded-2xl py-6 uppercase shadow-xl hover:bg-blue-700 transition-all text-lg tracking-widest'
                ]) ?>
            </div>
        </div>
    <?= $this->Form->end() ?>
</div>
