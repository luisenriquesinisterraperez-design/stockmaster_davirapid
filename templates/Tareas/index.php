<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Tarea> $tareas
 */
?>
<header class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-3xl font-black text-slate-800 tracking-tight uppercase">Tareas Pendientes</h1>
        <p class="text-orange-500 font-bold uppercase text-xs tracking-widest">Gestión de actividades internas</p>
    </div>
    <?= $this->Html->link('<i class="fa-solid fa-plus mr-2"></i> Nueva Tarea', ['action' => 'add'], ['escape' => false, 'class' => 'bg-orange-500 text-white px-6 py-3 rounded-2xl font-black text-xs uppercase hover:bg-orange-600 transition-all shadow-lg']) ?>
</header>

<div class="bg-white rounded-3xl border border-orange-100 overflow-hidden shadow-sm">
    <table class="w-full text-left">
        <thead class="bg-slate-900 text-white text-[10px] uppercase font-bold tracking-widest">
            <tr>
                <th class="p-5">Tarea</th>
                <th class="p-5 text-center">Estado</th>
                <th class="p-5">Creada</th>
                <th class="p-5 text-right">Acción</th>
            </tr>
        </thead>
        <tbody class="divide-y text-sm">
            <?php foreach ($tareas as $tarea): ?>
            <tr class="hover:bg-slate-50 transition-colors">
                <td class="p-5 font-bold text-slate-700 uppercase text-xs"><?= h($tarea->titulo) ?></td>
                <td class="p-5 text-center">
                    <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase <?= $tarea->terminada ? 'bg-green-100 text-green-600' : 'bg-yellow-100 text-yellow-600' ?>">
                        <?= $tarea->terminada ? 'Terminada' : 'Pendiente' ?>
                    </span>
                </td>
                <td class="p-5 text-[10px] text-slate-400 font-bold"><?= $tarea->creada ? $tarea->creada->format('d/m/Y') : '---' ?></td>
                <td class="p-5 text-right flex justify-end gap-3 mt-1">
                    <?= $this->Html->link('<i class="fa-solid fa-pen"></i>', ['action' => 'edit', $tarea->id], ['escape' => false, 'class' => 'text-blue-400 hover:text-blue-600']) ?>
                    <?= $this->Form->postLink('<i class="fa-solid fa-trash"></i>', ['action' => 'delete', $tarea->id], ['confirm' => __('¿Eliminar tarea?'), 'escape' => false, 'class' => 'text-red-200 hover:text-red-600']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
