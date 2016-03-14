<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TransferWallets Controller
 *
 * @property \App\Model\Table\TransferWalletsTable $TransferWallets
 */
class TransferWalletsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['SentWallets', 'ReceiveWallets']
        ];
        $transferWallets = $this->paginate($this->TransferWallets);

        $this->set(compact('transferWallets'));
        $this->set('_serialize', ['transferWallets']);
    }

    /**
     * View method
     *
     * @param string|null $id Transfer Wallet id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $transferWallet = $this->TransferWallets->get($id, [
            'contain' => ['SentWallets', 'ReceiveWallets']
        ]);

        $this->set('transferWallet', $transferWallet);
        $this->set('_serialize', ['transferWallet']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $transferWallet = $this->TransferWallets->newEntity();
        if ($this->request->is('post')) {
            $transferWallet = $this->TransferWallets->patchEntity($transferWallet, $this->request->data);
            if ($this->TransferWallets->save($transferWallet)) {
                $this->Flash->success(__('The transfer wallet has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The transfer wallet could not be saved. Please, try again.'));
            }
        }
        $sentWallets = $this->TransferWallets->SentWallets->find('list', ['limit' => 200]);
        $receiveWallets = $this->TransferWallets->ReceiveWallets->find('list', ['limit' => 200]);
        $this->set(compact('transferWallet', 'sentWallets', 'receiveWallets'));
        $this->set('_serialize', ['transferWallet']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Transfer Wallet id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $transferWallet = $this->TransferWallets->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $transferWallet = $this->TransferWallets->patchEntity($transferWallet, $this->request->data);
            if ($this->TransferWallets->save($transferWallet)) {
                $this->Flash->success(__('The transfer wallet has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The transfer wallet could not be saved. Please, try again.'));
            }
        }
        $sentWallets = $this->TransferWallets->SentWallets->find('list', ['limit' => 200]);
        $receiveWallets = $this->TransferWallets->ReceiveWallets->find('list', ['limit' => 200]);
        $this->set(compact('transferWallet', 'sentWallets', 'receiveWallets'));
        $this->set('_serialize', ['transferWallet']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Transfer Wallet id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $transferWallet = $this->TransferWallets->get($id);
        if ($this->TransferWallets->delete($transferWallet)) {
            $this->Flash->success(__('The transfer wallet has been deleted.'));
        } else {
            $this->Flash->error(__('The transfer wallet could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
