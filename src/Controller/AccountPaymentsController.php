<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * AccountPayments Controller
 *
 * @property \App\Model\Table\AccountPaymentsTable $AccountPayments
 */
class AccountPaymentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->AccountPayments->find();
        $accountPayments = $this->paginate($query);

        $this->set(compact('accountPayments'));
    }

    /**
     * View method
     *
     * @param string|null $id Account Payment id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $accountPayment = $this->AccountPayments->get($id, contain: []);
        $this->set(compact('accountPayment'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $accountPayment = $this->AccountPayments->newEmptyEntity();
        if ($this->request->is('post')) {
            $accountPayment = $this->AccountPayments->patchEntity($accountPayment, $this->request->getData());
            if ($this->AccountPayments->save($accountPayment)) {
                $this->Flash->success(__('The account payment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The account payment could not be saved. Please, try again.'));
        }
        $this->set(compact('accountPayment'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Account Payment id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $accountPayment = $this->AccountPayments->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $accountPayment = $this->AccountPayments->patchEntity($accountPayment, $this->request->getData());
            if ($this->AccountPayments->save($accountPayment)) {
                $this->Flash->success(__('The account payment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The account payment could not be saved. Please, try again.'));
        }
        $this->set(compact('accountPayment'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Account Payment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $accountPayment = $this->AccountPayments->get($id);
        if ($this->AccountPayments->delete($accountPayment)) {
            $this->Flash->success(__('The account payment has been deleted.'));
        } else {
            $this->Flash->error(__('The account payment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
