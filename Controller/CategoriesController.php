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
        $name = $this->request->query('name');
        $conditions = array();
        if ($type == 'expense') {
            $conditions['Category.type'] = Category::TYPE_EXPENSE;
        } elseif ($type == 'income') {
            $conditions['Category.type'] = Category::TYPE_INCOME;
        } else {
            $conditions[] = 'Category.type is not null';
        }
        
        if(!empty($name)) {
            $conditions[] = "Category.name LIKE '%".$name."%'";
        }

        $this->Paginator->settings = array(
            'conditions' => $conditions,
            'limit' => 20);
        $countCategories = count($this->Category->find('all', array('conditions' => $conditions)));

        $this->set('countCategories', $countCategories);
        $this->set('categories', $this->Paginator->paginate());
    }
    
//    public function search() {
//        
//        $this->request->allowMethod('post');
//        $conditions = array();
//        $name = $this->request->data['searchName'];
//        $type = $this->request->data['searchType'];
//
//        if(!empty($name)) {
//            $conditions[] = "name LIKE '".$name."%'";
//        }
//        
//        if($this->request->data['searchType'] === 'income') {
//            $type = 'income';
//        } elseif($this->request->data['searchType'] === 'expense') {
//            $type = 'expense';
//        }
//         
//        if(!empty($type)) {
//            if($type == 'income') {
//                 $conditions['type'] = 0;
//            } else {
//                $conditions['type'] = 1;
//            } 
//        }
//        
//        $searchs = $this->Category->find('all', array('conditions' => $conditions ));
//        $searchJsonArrays = array();
//        if(!empty($searchs)) {
//            foreach ($searchs as $search) {
//                $searchJsonArrays[] = ['status' => 0, 'message' => 'OK', 
//                    'id' => $search['Category']['id'],
//                    'name' => $search['Category']['name'],
//                    'type' => $search['Category']['type'],
//                    'created' => $search['Category']['created'],
//                    'modified' => $search['Category']['modified']
//                    ];
//                
//            }
//            echo json_encode($searchJsonArrays);
//            exit;
//        } else {
//           $searchJsonArrays[] = ['status' => 1, 'message' => 'No Category'];
//            echo json_encode($searchJsonArrays);
//            exit;
//        }
//    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        $this->loadModel('User');
        if ($this->request->is('post')) { 
            
            $this->Category->create();
            $allCategories = $this->Category->findAllCategories();

            $diff = 1;
            foreach ($allCategories as $allCategory) { 
                if ($this->request->data['Category']['name'] === $allCategory['Category']['name']) { 
                    $diff = 0; // category existed
                } 
            } 
             
            if($this->Auth->user('role') === '1') {
                $this->request->data['Category']['user_id'] = $this->Auth->user('id');
            }
            
            if($diff == 1) {
               if ($this->Category->save($this->request->data)) {
                    $this->Flash->success(__('The category has been saved.'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Flash->error(__('The category could not be saved. Please, try again.'));
                } 
            } else {
                    $this->Flash->error(__('The category existed'));
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
    
        $this->set('idRequest', $id);
        if (!$this->Category->exists($id)) {
            throw new NotFoundException(__('Invalid category'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $this->request->data['Category']['id'] = $id;
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
        $this->loadModel('Transaction');
        
        $this->Category->id = $id;
        if (!$this->Category->exists()) {
            throw new NotFoundException(__('Invalid category'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Category->delete()) {
            $this->Transaction->deleteTransactionByCategoryNotExits(array($id));
            $this->Flash->success(__('The category has been deleted.'));
        } else {
            $this->Flash->error(__('The category could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function deleteAll() {
        $this->loadModel('Transaction');
        
        $this->request->allowMethod('post');

        $ids = $this->request->data['ids'];
        if ($this->Category->deleteAll(array('id' => $ids), false)) {
            $this->Transaction->deleteTransactionByCategoryNotExits($ids);
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
    
    public function test() {
        $this->set('val', 'ok');
        $this->set('_serialize', array('val'));
        $this->response->statusCode(200);
    }
}
