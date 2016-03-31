<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 */
App::uses('Controller', 'Controller');
App::uses('CakeTime', 'Utility');
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $components = array(
        'Flash',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'wallets',
                'action' => 'index'
            ),
            'logoutRedirect' => array(
                'controller' => 'users',
                'action' => 'main'
            ),
            'loginAction' => array(
                'controller' => 'users',
                'action' => 'main'
            )
            ,'authorize' => array('Controller') // Added this line
        ),
        'DebugKit.Toolbar'
    );
    public $helpers = array('Common');

    public function beforeFilter() {
        $this->Auth->allow('main','confirmEmail');
    }
    
//     public function isAuthorized($user) {
//         // Admin can access every action
//         if (isset($user['role']) && $user['role'] === '1') {
//             $author = 'admin';
//             return $author;
//         } elseif (isset($user['role']) && $user['role'] === '0') {
//             if($user['active'] === '1') {
//                 $author = 'active';
//                 return $author;
//             } else {
//                 $author = 'request';
//                 return $author;
//             }
//         }

//         // Default deny
// //        return false;
//     }
}
