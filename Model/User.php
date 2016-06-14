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

    const USER_ACTIVE = 1;
    const USER_REQUEST = 0;
    const ROLE_ADMIN = 1;
    const ROLE_USER = 0;

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'username' => array(
            'username' => array(
                'rule' => array('username'),
                'message' => 'username empty',
                //'allowEmpty' => false,
                'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
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
        'password' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => '* A password is require'
            )
        ),
        'old_password' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A password is require'
            ),
        ),
        'new_password' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => '* A password is require'
            ),
            'match' => array(
                'rule' => 'validateConfirmPassword',
                'message' => '* A password is require'
            )
        ),
        'confirm_password' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => '* A password is require'
            ),
            'match' => array(
                'rule' => 'validateConfirmPassword',
                'message' => '* confirm password wrong.'
            )
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
    
    public function setValidateOldPassword($oldPassword) {
        $this->validator()->add('old_password', 'matchOld', array(
            'rule' => array('validateOldPassword', $oldPassword),
            'message' => '* abc'
        ));
    }

    /**
     * @param array $check ['confirm_password' => 'abc]
     * @return bool
     */
    public function validateConfirmPassword($check) {
        $hashed_confirm = AuthComponent::password($this->data[$this->alias]['confirm_password']);
        $hashed_new = AuthComponent::password($this->data[$this->alias]['new_password']);
        return $hashed_new === $hashed_confirm;
    }

    public function createRandomString($num) {
        // Create password random
        $chars = array('a', 'A', 'b', 'B', 'c', 'C', 'd', 'D', 'e', 'E', 'f', 'F', 'g', 'G', 'h', 'H', 'i', 'I', 'j', 'J', 'k', 'K', 'l', 'L', 'm', 'M', 'n', 'N', 'o', 'p', 'P', 'q', 'Q', 'r', 'R', 's', 'S', 't', 'T', 'u', 'U', 'v', 'V', 'w', 'W', 'x', 'X', 'y', 'Y', 'z', 'Z', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        $max_chars = count($chars) - 1;
        for ($i = 0; $i < $num; $i++) {
            $code = ( $i == 0 ) ? $chars[rand(0, $max_chars)] : $code . $chars[rand(0, $max_chars)];
        }
        return $code;
    }
    
    public function getEmailById($id) {
         $emailRequest = $this->query("select email from users where id = $id ");
         return $emailRequest;
    }


    public function findWalletAuth($idAuth) {
        $walletAuth = $this->query(
                "select wallets.user_id, wallets.id from wallets 
            inner join users on users.id = wallets.user_id where users.id = '$idAuth'");
        return $walletAuth;
    }
    
    public function countUserActive(){
        $userActives = $this->query(
                " select count(*) from users where active = '1' ");
        return $userActives;
    }
    
    public function countUserRequest(){
        $userRequests = $this->query(
                " select count(*) from users where active = '0' ");
        return $userRequests;
    }
    
    public function countAdmin(){
        $admin = $this->query(
                " select count(*) from users where role = '1' ");
        return $admin;
    }

    public function isOwnedBy($post) {
        return $this->field('id', array('id' => $post)) !== false;
    }
}
