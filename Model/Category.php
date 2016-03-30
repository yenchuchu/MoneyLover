<?php

App::uses('AppModel', 'Model');

/**
 * Category Model
 *
 */
class Category extends AppModel {

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
    
    public function getCategoryByName($name) {
        $category = $this->find('all',array(
            'conditions'=>array(
                'Categories.name' => $name)));
        return $category;
    }

}
