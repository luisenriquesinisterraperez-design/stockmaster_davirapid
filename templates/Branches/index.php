<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Branch> $branches
 */
?>
<header class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-3xl font-black text-slate-800 tracking-tight uppercase">Sucursales / Locales</h1>
        <p class="text-blue-600 font-bold uppercase text-xs tracking-widest">Gestión de sedes de tu negocio</p>
    </div>
    <?= $this->Html->link('<i class="fa-solid fa-plus mr-2"></i> Nueva Sucursal', ['action' => 'add'], ['escape' => false, 'class' => 'bg-blue-600 text-white px-6 py-3 rounded-2xl font-black text-xs uppercase hover:bg-blue-700 transition-all shadow-lg shadow-blue-500/20']) ?>
</header>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php foreach ($branches as $branch): ?>
    <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all relative overflow-hidden group">
        <div class="relative z-10">
            <h3 class="text-xl font-black text-slate-800 uppercase mb-2"><?= h($branch->name) ?></h3>
            <div class="space-y-2 mb-6">
                <p class="text-xs text-slate-500 font-bold"><i class="fa-solid fa-map-marker-alt mr-2 text-blue-500"></i> <?= h($branch->address) ?></p>
                <p class="text-xs text-slate-500 font-bold"><i class="fa-solid fa-phone mr-2 text-blue-500"></i> <?= h($branch->phone) ?></p>
            </div>
            
            <div class="flex gap-2 border-t border-slate-50 pt-6">
                <?= $this->Html->link('<i class="fa-solid fa-pen mr-2"></i> Editar', ['action' => 'edit', $branch->id], ['escape' => false, 'class' => 'flex-1 text-center py-2 bg-slate-50 text-slate-600 rounded-xl font-black text-[10px] uppercase hover:bg-blue-50 hover:text-blue-600 transition-all']) ?>
                <?= $this->Form->postLink('<i class="fa-solid fa-trash"></i>', ['action' => 'delete', $branch->id], ['confirm' => __('¿Eliminar esta sucursal?'), 'escape' => false, 'class' => 'p-2 bg-red-50 text-red-400 rounded-xl hover:bg-red-100 transition-all']) ?>
            </div>
        </div>
        <i class="fa-solid fa-store absolute -bottom-4 -right-4 text-7xl text-slate-50 group-hover:text-blue-50 transition-colors"></i>
    </div>
    <?php endforeach; ?>
</div>
