<?php

App::uses('AppController', 'Controller');
App::uses('Category', 'Model');

/**
 * Categories Controller
 *
 * @property Category $Category
 * @property PaginatorComponent $Paginator
 */
class CategoriesController extends AppController {

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

        $this->Category->recursive = 0;

        $type = $this->request->query('type');
        $conditions = array();
        if ($type == 'expense') {
            $conditions['Category.type'] = Category::TYPE_EXPENSE;
        } elseif ($type == 'income') {
            $conditions['Category.type'] = Category::TYPE_INCOME;
        } else {
            $conditions[] = 'Category.type is not null';
        }

        $this->Paginator->settings = array(
            'conditions' => $conditions,
            'limit' => 20);
        $countCategories = count($this->Category->find('all', array('conditions' => $conditions)));

        $this->set('countCategories', $countCategories);
        $this->set('categories', $this->Paginator->paginate());
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        $this->loadModel('User');
        if ($this->request->is('post')) {
            $this->Category->create();
            if($this->Auth->user('role') === '1') {
                $this->request->data['Category']['user_id'] = $this->Auth->user('id');
            }
            if ($this->Category->save($this->request->data)) {
                $this->Flash->success(__('The category has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The category could not be saved. Please, try again.'));
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
        if (!$this->Category->exists($id)) {
            throw new NotFoundException(__('Invalid category'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Category->save($this->request->data)) {
                $this->Flash->success(__('The category has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The category could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
            $this->request->data = $this->Category->find('first', $options);
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
        $this->Category->id = $id;
        if (!$this->Category->exists()) {
            throw new NotFoundException(__('Invalid category'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Category->delete()) {
            $this->Flash->success(__('The category has been deleted.'));
        } else {
            $this->Flash->error(__('The category could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function deleteAll() {
        $this->request->allowMethod('post');

        $ids = $this->request->data['ids'];
        if ($this->Category->deleteAll(array('id' => $ids), false)) {
            echo json_encode(['status' => 0, 'message' => 'OK']);
            exit;
        }

        echo json_encode(['status' => 1, 'message' => 'Save not success']);
        exit;
    }
    
    public function isAuthorized($user) {
        // Admin can access every action
        if (isset($user['role']) && $user['role'] === '1' && $user['active'] === '1') {
            return true;
        }
        // Default deny
       return false;
    }

    public function isAuthorizedC($user) {
        // All registered users can add posts
        if ($this->action === 'add') {
            return false;
        }

        // The owner of a post can edit and delete it
        if (in_array($this->action, array('edit', 'delete'))) {
            $postId = (int) $this->request->params['pass'][0];
            if ($this->Category->isOwnedBy($postId, $user['id'])) {
                return false;
            }
        }

        return isAuthorized($user);
    }
}
