<?php
App::uses('AppController', 'Controller');
/**
 * TransferWallets Controller
 *
 * @property TransferWallet $TransferWallet
 * @property PaginatorComponent $Paginator
 */
class TransferWalletsController extends AppController {

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
		$this->TransferWallet->recursive = 0;
		$this->set('transferWallets', $this->Paginator->paginate()); 

		$sentWallets = $this->TransferWallet->SentWallet->find('list');
		$receiveWallets = $this->TransferWallet->ReceiveWallet->find('list');
		$this->set(compact('sentWallets', 'receiveWallets'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->TransferWallet->exists($id)) {
			throw new NotFoundException(__('Invalid transfer wallet'));
		}
		$options = array('conditions' => array('TransferWallet.' . $this->TransferWallet->primaryKey => $id));
		$this->set('transferWallet', $this->TransferWallet->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->TransferWallet->create();
			if ($this->TransferWallet->save($this->request->data)) {
				$this->Flash->success(__('The transfer wallet has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The transfer wallet could not be saved. Please, try again.'));
			}
		}
		$sentWallets = $this->TransferWallet->SentWallet->find('list');
		$receiveWallets = $this->TransferWallet->ReceiveWallet->find('list');
		$this->set(compact('sentWallets', 'receiveWallets'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->TransferWallet->exists($id)) {
			throw new NotFoundException(__('Invalid transfer wallet'));
		} 
		debug($this->request->is(array('post', 'put')));
		die();
		if ($this->request->is(array('post', 'put'))) {
			if ($this->TransferWallet->save($this->request->data)) {
				$this->Flash->success(__('The transfer wallet has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The transfer wallet could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('TransferWallet.' . $this->TransferWallet->primaryKey => $id));
			$this->request->data = $this->TransferWallet->find('first', $options);
		}
		$sentWallets = $this->TransferWallet->SentWallet->find('list');
		$receiveWallets = $this->TransferWallet->ReceiveWallet->find('list');
		$this->set(compact('sentWallets', 'receiveWallets'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->TransferWallet->id = $id;
		if (!$this->TransferWallet->exists()) {
			throw new NotFoundException(__('Invalid transfer wallet'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->TransferWallet->delete()) {
			$this->Flash->success(__('The transfer wallet has been deleted.'));
		} else {
			$this->Flash->error(__('The transfer wallet could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function logout() {
		return $this->redirect(array('Controller'=>'users', 'action'=>'main'));
	}
}
