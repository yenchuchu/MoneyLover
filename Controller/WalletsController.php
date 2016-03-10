<?php

App::uses('AppController', 'Controller');
App::uses('CakeNumber', 'Utility');
// echo CakeNumber::currency('1234.56', 'FOO');

/**
 * Wallets Controller
 *
 * @property Wallet $Wallet
 * @property PaginatorComponent $Paginator
 */
class WalletsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Paginator->settings = array(
            'conditions' => array('User.id' => $this->Auth->user('id'))
        );
        $this->Wallet->recursive = 0;
        $this->set('wallets', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Wallet->exists($id)) {
            throw new NotFoundException(__('Invalid wallet'));
        }
        $options = array('conditions' => array('Wallet.' . $this->Wallet->primaryKey => $id));
        $this->set('wallet', $this->Wallet->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {

        if ($this->request->is('post')) {
            $this->Wallet->create();
            $data = $this->request->data;
            $data['Wallet']['user_id'] = $this->Auth->user('id');
            if ($this->Wallet->save($data)) {
                // $this->Flash->success(__('The wallet has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The wallet could not be saved. Please, try again.'));
            }
        }
        $users = $this->Wallet->User->find('list');
        $this->set(compact('users'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Wallet->exists($id)) {
            throw new NotFoundException(__('Invalid wallet'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Wallet->save($this->request->data)) {
                // $this->Flash->success(__('The wallet has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The wallet could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Wallet.' . $this->Wallet->primaryKey => $id));
            $this->request->data = $this->Wallet->find('first', $options);
        }
        $users = $this->Wallet->User->find('list');
        $this->set(compact('users'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Wallet->id = $id;
        if (!$this->Wallet->exists()) {
            throw new NotFoundException(__('Invalid wallet'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Wallet->delete()) {
            // $this->Flash->success(__('The wallet has been deleted.'));
        } else {
            $this->Flash->error(__('The wallet could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
