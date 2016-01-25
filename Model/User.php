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
		'password' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'confirm_password' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
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
		// if (isset($this->data[$this->alias]['password'])) {
		// 	$passwordHasher = new BlowfishPasswordHasher();
		// 	$this->data[$this->alias]['password'] = sha1($this->data[$this->alias]['password']);
		// 	$passwordHasher->hash(
		// 		$this->data[$this->alias]['password']
		// 	);
		// }
	
	if(strcmp($this->data['User']['password'], $this->data['User']['confirm_password']) == 0){
		$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
	} else {
		return false;	
	}


	 // $this->loadmodel('User');
	 // $result = $this->User->find(array('conditions' => array('email' => $email,  
	 // 'username' => $username)));
	 // foreach($result as $row)
	 // {
	 //  echo $result['email'];

	 // }
// die();
	return true;
}
}
