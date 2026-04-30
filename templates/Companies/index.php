<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Company> $companies
 */
?>
<header class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
    <div>
        <h1 class="text-4xl font-black text-slate-800 tracking-tight uppercase leading-none">Gestión de Clientes</h1>
        <p class="text-blue-600 font-bold uppercase text-[10px] tracking-[0.2em] mt-3">Estructura Global de Negocios Multi-Empresa</p>
    </div>
    <?= $this->Html->link('<i class="fa-solid fa-plus-circle mr-3"></i> AGREGAR NUEVO CLIENTE', ['action' => 'add'], ['escape' => false, 'class' => 'bg-blue-600 text-white px-10 py-5 rounded-2xl font-black text-xs uppercase hover:bg-blue-700 transition-all shadow-2xl shadow-blue-500/20 tracking-widest']) ?>
</header>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    <?php foreach ($companies as $company): ?>
    <div class="bg-white p-10 rounded-[3.5rem] border border-slate-100 shadow-sm hover:shadow-2xl transition-all relative overflow-hidden group">
        <div class="relative z-10">
            <div class="flex items-start justify-between mb-6">
                <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                    <i class="fa-solid fa-building text-slate-400 text-2xl group-hover:text-blue-500 transition-colors"></i>
                </div>
                <?php if ($company->has_branches): ?>
                    <span class="bg-blue-50 text-blue-600 text-[8px] font-black uppercase px-3 py-1.5 rounded-full border border-blue-100 tracking-widest">Multi-Sede</span>
                <?php else: ?>
                    <span class="bg-slate-50 text-slate-400 text-[8px] font-black uppercase px-3 py-1.5 rounded-full border border-slate-100 tracking-widest">Sede Única</span>
                <?php endif; ?>
            </div>

            <h3 class="text-2xl font-black text-slate-800 uppercase mb-8 leading-tight tracking-tighter group-hover:text-blue-600 transition-colors"><?= h($company->name) ?></h3>
            
            <div class="flex gap-3 pt-6 border-t border-slate-50">
                <?= $this->Html->link('<i class="fa-solid fa-sliders mr-2"></i> AJUSTAR', ['action' => 'edit', $company->id], ['escape' => false, 'class' => 'flex-1 text-center py-4 bg-slate-900 text-white rounded-2xl font-black text-[10px] uppercase hover:bg-blue-600 transition-all tracking-widest']) ?>
                <?= $this->Form->postLink('<i class="fa-solid fa-trash-can"></i>', ['action' => 'delete', $company->id], ['confirm' => __('¿Estás seguro de eliminar este cliente y TODA su información asociada?'), 'escape' => false, 'class' => 'px-6 bg-red-50 text-red-500 rounded-2xl hover:bg-red-100 transition-all']) ?>
            </div>
        </div>
        <!-- Decoración de fondo -->
        <div class="absolute -bottom-10 -right-10 text-[12rem] text-slate-50 font-black opacity-20 pointer-events-none group-hover:text-blue-50 group-hover:rotate-12 transition-all">
            <?= substr($company->name, 0, 1) ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php if (count($companies) === 0): ?>
<div class="bg-white p-20 rounded-[4rem] border-4 border-dashed border-slate-100 text-center">
    <div class="bg-slate-50 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6">
        <i class="fa-solid fa-building-circle-exclamation text-slate-300 text-4xl"></i>
    </div>
    <h2 class="text-2xl font-black text-slate-400 uppercase tracking-tighter">No hay clientes registrados</h2>
    <p class="text-slate-400 font-bold text-sm mt-2 uppercase tracking-widest">Comienza creando tu primera empresa cliente</p>
</div>
<?php endif; ?>
