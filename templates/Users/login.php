<?php
/**
 * @var \App\View\AppView $this
 */
$this->layout = 'default';
?>
<div class="fixed inset-0 z-[100] bg-slate-950 flex items-center justify-center p-4">
    <!-- Fondo decorativo sutil -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-[10%] -left-[10%] w-[40%] h-[40%] bg-emerald-900/20 rounded-full blur-[120px]"></div>
        <div class="absolute -bottom-[10%] -right-[10%] w-[40%] h-[40%] bg-slate-800/30 rounded-full blur-[120px]"></div>
    </div>

    <div class="relative w-full max-w-md">
        <div class="bg-white rounded-[2.5rem] shadow-2xl overflow-hidden border border-slate-200">
            <!-- Cabecera del Card -->
            <div class="bg-slate-900 p-10 text-center relative">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-emerald-600 rounded-2xl shadow-lg shadow-emerald-500/20 mb-6 transform -rotate-12">
                    <i class="fa-solid fa-layer-group text-white text-3xl"></i>
                </div>
                <h1 class="text-3xl font-black text-white tracking-tighter uppercase tracking-[0.2em]">STOCK<span class="text-emerald-500">MASTER</span></h1>
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-2 opacity-60">Control de Operaciones & Inventario</p>
            </div>

            <!-- Formulario -->
            <div class="p-10 pt-8">
                <?= $this->Flash->render() ?>

                <?= $this->Form->create() ?>
                <div class="space-y-5">
                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase ml-2 mb-2 block tracking-widest">Credenciales de Acceso</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-300">
                                <i class="fa-solid fa-user"></i>
                            </span>
                            <?= $this->Form->control('username', [
                                'label' => false,
                                'placeholder' => 'Usuario',
                                'class' => 'w-full pl-12 p-4 bg-slate-50 border border-slate-200 rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500 focus:bg-white transition-all text-slate-700 font-semibold',
                                'required' => true
                            ]) ?>
                        </div>
                    </div>

                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-300">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <?= $this->Form->control('password', [
                            'label' => false,
                            'placeholder' => 'Contraseña',
                            'class' => 'w-full pl-12 p-4 bg-slate-50 border border-slate-200 rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500 focus:bg-white transition-all text-slate-700 font-semibold',
                            'required' => true,
                            'type' => 'password'
                        ]) ?>
                    </div>

                    <div class="pt-4">
                        <?= $this->Form->button(__('Iniciar Sesión'), [
                            'class' => 'w-full bg-emerald-600 text-white py-4 rounded-2xl font-black hover:bg-emerald-700 shadow-xl shadow-emerald-500/20 active:scale-[0.98] transition-all uppercase tracking-widest text-sm'
                        ]) ?>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>

            <!-- Footer -->
            <div class="p-6 bg-slate-50 border-t border-slate-100 text-center">
                <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">© <?= date('Y') ?> STOCKMASTER Professional Edition</p>
            </div>
        </div>
    </div>
</div>
