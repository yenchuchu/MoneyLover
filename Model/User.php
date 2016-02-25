<?php

// $servername = "";
// $username = "root";
// $password = "";
// $connect = mysqli_connect("localhost","root","","cakephp_moneylovertest");

App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

/**
 * User Model
 *
 * @property Wallet $Wallet
 */
class User extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'email' => array(
            'email' => array(
                'rule' => array('email'),
                'message' => 'Email errors',
                //'allowEmpty' => false,
                'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        // 'password' => array(
        // 	'notBlank' => array(
        // 		'rule' => array('notBlank'),
        // 		//'message' => 'Your custom message here',
        // 		//'allowEmpty' => false,
        // 		//'required' => false,
        // 		//'last' => false, // Stop validation after this rule
        // 		//'on' => 'create', // Limit validation to 'create' or 'update' operations
        // 	),
        // ),
        // 'confirm_password' => array(
        // 	'notBlank' => array(
        // 		'rule' => array('notBlank'),
        // 		//'message' => 'Your custom message here',
        // 		//'allowEmpty' => false,
        // 		//'required' => false,
        // 		//'last' => false, // Stop validation after this rule
        // 		//'on' => 'create', // Limit validation to 'create' or 'update' operations
        // 	),
        // ) 
        'password' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A password is require'
            )
        ),
        'old_password' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A password is require'
            ),
            'match' => array(
            ),
        ),
        'new_password' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A password is require'
            ),
            'match' => array(
            ),
        ),
        'confirm_password' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A password is require'
            ),
            'match' => array(
            ),
        ),
    );

    // The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'Wallet' => array(
            'className' => 'Wallet',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }

    public function changePass($id, $pass) {
        $this->id = $id;
        return $this->save(array('password' => $pass));
//        return $this->Admin->query("UPDATE admins SET admins.password = '".$pass."' WHERE admins.id = ".$id);
    }

    /**
     * @param array $check ['old_password' => 'abc]
     * @return bool
     */
    public function validateOldPassword($check, $result) {
        $hashed = AuthComponent::password($check['old_password']);

        return $hashed == $result;
    }

    /**
     * @param array $check ['confirm_password' => 'abc]
     * @return bool
     */
    public function validateConfirmPassword($check) {
        $hashed_confirm = AuthComponent::password($check['confirm_password']);
        $hashed_new = AuthComponent::password($check['new_password']);
        return $hashed_new === $hashed_confirm;
    }

}
