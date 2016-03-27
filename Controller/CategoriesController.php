<?php

App::uses('AppController', 'Controller');

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
        
//        $name = $this->request->query('name');
//        $type = $this->request->query('type');
//        debug($name);
////        debug($type);die;
//        $conditions = array();
//        
//        if(!empty($name)) {
//            $conditions['Categories.name'] = $name;
//        }
//        
//        if(!empty($type)) { 
//            $conditions['Categories.type'] = $type;
//        }
        $this->Paginator->settings = array('limit'=>20);
        
//        $categoryName = $this->Category->query("select name from categories group by name"); 
//        $name = Set::classicExtract($categoryName, '{n}.categories.name');
////          debug($name);die;
////        $categoryType = $this->Category->query("select type from categories group by type");
////        $types = Set::classicExtract($categoryType, '{n}.categories.type');
////         
////         debug($this->Paginator->paginate());
////       debug($type);
////       die;
//        
//        $this->set('name', $categoryName);
//         $this->set('type', $type);
        $this->set('categories', $this->Paginator->paginate());
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Category->create();
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

}
