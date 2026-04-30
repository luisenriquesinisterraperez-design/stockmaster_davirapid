<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Tareas Controller
 *
 * @property \App\Model\Table\TareasTable $Tareas
 */
class TareasController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Tareas->find();
        $tareas = $this->paginate($query);

        $this->set(compact('tareas'));
    }

    /**
     * View method
     *
     * @param string|null $id Tarea id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tarea = $this->Tareas->get($id, contain: []);
        $this->set(compact('tarea'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tarea = $this->Tareas->newEmptyEntity();
        if ($this->request->is('post')) {
            $tarea = $this->Tareas->patchEntity($tarea, $this->request->getData());
            if ($this->Tareas->save($tarea)) {
                $this->Flash->success(__('The tarea has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tarea could not be saved. Please, try again.'));
        }
        $this->set(compact('tarea'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tarea id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tarea = $this->Tareas->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tarea = $this->Tareas->patchEntity($tarea, $this->request->getData());
            if ($this->Tareas->save($tarea)) {
                $this->Flash->success(__('The tarea has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tarea could not be saved. Please, try again.'));
        }
        $this->set(compact('tarea'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tarea id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tarea = $this->Tareas->get($id);
        if ($this->Tareas->delete($tarea)) {
            $this->Flash->success(__('The tarea has been deleted.'));
        } else {
            $this->Flash->error(__('The tarea could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
