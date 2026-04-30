<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Company $company
 */
?>
<header class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-3xl font-black text-slate-800 tracking-tight uppercase">Nuevo Cliente / Empresa</h1>
        <p class="text-blue-600 font-bold uppercase text-xs tracking-widest">Crear contenedor de información limpia</p>
    </div>
    <?= $this->Html->link('<i class="fa-solid fa-arrow-left mr-2"></i> Volver al Listado', ['action' => 'index'], ['escape' => false, 'class' => 'bg-slate-200 text-slate-600 px-4 py-2 rounded-xl font-bold text-xs hover:bg-slate-300 transition-all']) ?>
</header>

<div class="bg-white p-10 rounded-[3rem] border border-blue-50 shadow-2xl max-w-2xl">
    <?= $this->Form->create($company) ?>
        <div class="space-y-8">
            <h3 class="font-black text-slate-900 uppercase text-sm tracking-widest flex items-center gap-2">
                <i class="fa-solid fa-file-circle-plus text-blue-500"></i> Registro de Nuevo Negocio
            </h3>
            
            <div>
                <label class="text-[10px] font-black text-slate-400 ml-2 uppercase tracking-widest">Nombre Comercial</label>
                <?= $this->Form->control('name', [
                    'label' => false, 
                    'placeholder' => 'Ej: Restaurante El Sabor',
                    'class' => 'w-full p-5 bg-slate-50 border border-slate-200 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 transition-all font-black text-lg text-slate-700'
                ]) ?>
            </div>

            <div class="flex items-center justify-between p-8 bg-blue-50 rounded-[2.5rem] border border-blue-100">
                <div>
                    <p class="text-xs font-black text-blue-900 uppercase tracking-widest">¿Habilitar Sucursales?</p>
                    <p class="text-[10px] text-blue-600 font-bold leading-tight mt-1 max-w-[200px]">Define si este cliente podrá subdividir su información por sedes.</p>
                </div>
                <label class="switch">
                    <?= $this->Form->checkbox('has_branches', ['class' => 'sr-only']) ?>
                    <span class="slider"></span>
                </label>
            </div>

            <div class="p-6 bg-blue-600 rounded-[2rem] text-white shadow-xl shadow-blue-500/20">
                <p class="text-[10px] font-black uppercase opacity-70 mb-2 tracking-widest leading-none">Aislamiento Total</p>
                <p class="text-[10px] font-medium leading-relaxed italic opacity-90">
                    Al crear esta empresa, se generará una base de datos lógica vacía. El administrador que asignes a este cliente solo verá lo que él mismo cargue.
                </p>
            </div>

            <div class="pt-4">
                <?= $this->Form->button(__('Crear Contenedor de Cliente'), [
                    'class' => 'w-full bg-slate-950 text-white font-black rounded-2xl py-6 uppercase shadow-xl hover:bg-blue-600 transition-all text-lg tracking-widest'
                ]) ?>
            </div>
        </div>
    <?= $this->Form->end() ?>
</div>
