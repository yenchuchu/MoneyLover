<?php
App::uses('AppController', 'Controller');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

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
	public function index($type='active') {
		if ($type=='active') {
			$this->User->recursive = 0;
			$this->set('users', $this->Paginator->paginate());
		}else {
			$this->User->recursive = 0;
			$this->set('users', []);
		}

		$this->render('index_' . $type);
	}
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
			$path = func_get_args();

		$count = count($path);
		if (!$count) {
			return $this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('user', 'subpage', 'title_for_layout'));

		try {
			$this->render(implode('/', $path));
		} catch (MissingViewException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			throw new NotFoundException();
		}
	}

/**
 * add method
 *
 * @return void
 */
	public function add($id = null) {
		if ($this->request->is('post')) {
			$this->User->create();
			$emails = $this->User->find($id);
			// $this->set('mails', $mails);
		 	foreach($emails as $email){
		    	$this->set($emails, $email);
		    	echo $mail['User']['email'];
		 	} 
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Flash->success(__('The user has been deleted.'));
		} else {
			$this->Flash->error(__('The user could not be deleted. Please, try again.'));

		}
		return $this->redirect(array('action' => 'index'));
	}

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('add', 'login');
	}

	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				return $this->redirect(array('Controller'=>'user', 'action'=>'index'));
			}
			$this->Flash->error(__('Invalid usersname or password, try again'));
		}
	}

	public function logout() {
		return $this->redirect(array('Controller'=>'users', 'action'=>'main'));
	}

	public function main()
	{
		if ($this->request->data('signup') === 'Sign-up') {
			if ($this->request->is('post')) {

				$this->User->create();
				
				if ($this->User->save($this->request->data)) {
					// $this->Flash->success(__('The user has been saved.'));
					return $this->render('/wallets/index');
					// $this->redirect(array('action' => 'index'));
				} else {
					//debug($this->User->validationErrors );
					$this->Flash->error(__('The user could not be saved. Please, try again.'));
				}
			}

		} 
		elseif ($id = 'signin') {
			if ($this->request->is('post')) {
				if ($this->Auth->login()) {
					return $this->redirect(array('Controller'=>'users', 'action'=>'index'));
				}
				$this->Flash->error(__('Invalid usersname or password, try again'));
			}
		}
		
	}
}
