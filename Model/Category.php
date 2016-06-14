<?php

App::uses('AppModel', 'Model');

/**
 * Category Model
 *
 */
class Category extends AppModel {

    const TYPE_INCOME = 0;
    const TYPE_EXPENSE = 1;

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'name' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'no empty',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'type' => array(
//            'required' => array(
//                'rule' => 'notBlank',
//                'message' => 'A password is require'
//            )
            'boolean' => array(
                'rule' => array('boolean'),
                'message' => 'Your custom message here',
                'allowEmpty' => false,
                'required' => true,
//            'last' => true, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
             
        )
            )
    );
    
    public function findAllCategories() {
        $allCategories = $this->find('all');
        return $allCategories;
    }
    
    public function getCategoryByName($name) {
        $category = $this->find('all',array(
            'conditions'=>array(
                'Categories.name' => $name)));
        return $category;
    }
    
    public function isOwnedBy($post, $user) {
        return $this->field('id', array('id' => $post, 'user_id' => $user)) !== false;
    }
    
    public function countCategory(){
        $categories = $this->query(" select count(*) from categories  ");
        return $categories;
    }

}
