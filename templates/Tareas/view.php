<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tarea $tarea
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Tarea'), ['action' => 'edit', $tarea->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Tarea'), ['action' => 'delete', $tarea->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tarea->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Tareas'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Tarea'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="tareas view content">
            <h3><?= h($tarea->titulo) ?></h3>
            <table>
                <tr>
                    <th><?= __('Titulo') ?></th>
                    <td><?= h($tarea->titulo) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($tarea->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Creada') ?></th>
                    <td><?= h($tarea->creada) ?></td>
                </tr>
                <tr>
                    <th><?= __('Terminada') ?></th>
                    <td><?= $tarea->terminada ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Descripcion') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($tarea->descripcion)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>