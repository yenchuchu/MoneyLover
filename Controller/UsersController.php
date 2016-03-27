<?php

App::uses('AppController', 'Controller');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
App::uses('User', 'Model');
App::uses('AppHelper', 'View/Helper');
App::uses('CakeTime', 'Utility');

// App::uses('CakeEmail', 'Network/Email');
// App::uses('CakeEmail', 'object');
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
    public $components = array('Paginator', 'Email', 'Session');
    public $uses = array('User');
    public $helpers = array('Common');

    /**
     * index method
     *
     * @return void
     */
    // public function beforeRender() {
    //     parent::beforeRender();
    //     $this->helpers['CustomStuff'] = $this->_getCustomStuffSettings();
    // }


    public function index() {
        
        $type = $this->request->query('type');
        if ($type == 'active' || $type == null) { 

            $this->Paginator->settings = array(
                'conditions' => array('User.active' => 1),
            'limit'=>20
            );
            $this->User->recursive = 0;
            $this->set('users', $this->Paginator->paginate());
            $this->set('typeLabel', strtoupper('active'));
        } else {
            $this->Paginator->settings = array(
                'conditions' => array('User.active' => 0)
            );
            $this->User->recursive = 0; 
            $this->set('users', $this->Paginator->paginate());
            $this->set('typeLabel', strtoupper('request'));
        }

        $this->render('index_active');
    }

    /**
     * add method
     *
     * @return void
     */
    public function add($id = null) {
        if ($this->request->is('post')) {
            // debug($this->request->data['User']['email']);die;
            $this->User->create();
            $aaas = $this->User->find('all');
            foreach ($aaas as $user):
                if ($this->request->data['User']['email'] === $user['User']['email'] || $this->request->data['User']['username'] === $user['User']['username']):
                    $diff = 0;
                else:
                    $diff = 1;
                endif;
            endforeach;
            if ($diff == 1):
                if ($this->User->save($this->request->data)):
                    $passwordRandom = User::createRandomString(10);
                    $this->User->save(['password' => $passwordRandom, 'role' => ROLE_ADMIN]);

                    $Email = new CakeEmail('gmail');
                    $Email->emailFormat('html')
                            ->to($this->request->data['User']['email'])
                            ->subject('Confirm Account')
                            ->send("Your password is: {$passwordRandom}. You need to change your password on the first login!");
                else:
                    $this->Flash->error(__('Cant save account. Please, try again.'));
                endif;
            else:
                $this->Flash->error(__('Username or email existed. Please, try again.'));
            endif;
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

    public function deleteAll() {
        $this->request->allowMethod('post');

        $ids = $this->request->data['ids'];
        if ($this->User->deleteAll(array('id' => $ids), false)) {
            echo json_encode(['status' => 0, 'message' => 'OK']);
            exit;
        }

        echo json_encode(['status' => 1, 'message' => 'Save not success']);
        exit;
    }

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('main');
    }
//
//    public function login() {
//        if ($this->request->is('post')) {
//            if ($this->Auth->login()) {
//                $count = $this->User->find('first', array('conditions' => array('User.id' => AuthComponent::user('id'))));
//
//                if ($count['User']['role'] == 0) {
//                    if ($count['User']['active'] == User::USER_REQUEST) {
//                        $this->redirect(array('controller' => 'Users', 'action' => 'change_password', AuthComponent::user('id')));
//
//                        if (isset($this->request->data)) {
//                            $this->User->updateAll(array('User.active' => ++$count['User']['active']), array('User.id' => AuthComponent::user('id')));
//                        }
//                    } else {
//                        return $this->redirect($this->Auth->redirectUrl());
//                    }
//                } else {
//                    return $this->redirect(array('controller' => 'Users', 'action' => 'index'));
//                }
//            }
//            $this->Flash->error(__('Invalid username or password, try again'));
//        }
//    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    public function main() {
        if ($this->request->data('signup') === 'Sign-up') {

            if ($this->request->is('post')) {

                $this->User->create();
                $aaas = $this->User->find('all');
                if (!empty($aaas)):
                    foreach ($aaas as $user):
                        if ($this->request->data['email'] === $user['User']['email'] || $this->request->data['username'] === $user['User']['username']):
                            $diff = 0;
                        else:
                            $diff = 1;
                        endif;
                    endforeach;
                    if ($diff == 1):
                        if ($this->User->save($this->request->data)):
                            $passwordRandom = User::createRandomString(10);
                            $this->User->save(['password' => $passwordRandom]);
                            $Email = new CakeEmail('gmail');
                            $Email->emailFormat('html')
                                    ->to($this->request->data['email'])
                                    ->subject('Confirm Account')
                                    ->send("Your password is: {$passwordRandom}. You need to change your password on the first login!");
                             return $this->redirect(array('controller' => 'Users','action' => 'confirmEmail'));        
                        else:
                            $this->Flash->error(__('Cant save account. Please, try again.'));
                        endif;
                    else:
                        $this->Flash->error(__('Username or email existed. Please, try again.'));
                    endif;
                else:
                    if ($this->User->save($this->request->data)):
                        $passwordRandom = User::createRandomString(10);
                        $this->User->save(['password' => $passwordRandom]);
                        $Email = new CakeEmail('gmail');
                        $Email->emailFormat('html')
                                ->to($this->request->data['email'])
                                ->subject('Confirm Account')
                                ->send("Your password is: {$passwordRandom}. You need to change your password on the first login!");
                    else:
                        $this->Flash->error(__('Cant save account. Please, try again.'));
                    endif;
                endif;
            }
        }
        elseif ($this->request->data('signin') === 'Sign-in') {
            if ($this->request->is('post')) {
                if ($this->Auth->login()) {
                    $count = $this->User->find('first', array(
                        'conditions' => array('User.id' => AuthComponent::user('id'))
                    )); 
                    if ($count['User']['active'] == User::USER_REQUEST) {
                        $this->redirect(array('controller' => 'Users',
                            'action' => 'change_password', AuthComponent::user('id')));
                    } 
                    if ($count['User']['role'] == User::ROLE_USER) {
                        return $this->redirect($this->Auth->redirectUrl());
                    } else {
                        return $this->redirect(array('controller' => 'users', 'action' => 'index'));
                    }
                }
                $this->Flash->error(__('Invalid username or password, try again'));
            }
        }
    }

    public function confirmEmail($value = '') {
        $this->set('showLayoutContent', true);
    }

    public function change_password($id = null) { 

        if (!$id) {
            throw new NotFoundException(__('Invalid User'));
        }
        $User = $this->User->findById($id);
        if (!$User) {
            throw new NotFoundException(__('Invalid User'));
        }
        if ($this->request->is(array('put', 'post'))) {

            $this->User->id = $id;
            $changable = $this->request->data['User'];

            $result = $this->User->find('first', array('conditions' => array('User.id' => $id)));
            if ($this->User->validateOldPassword($changable, $result['User']['password']) == False) {
                $this->Flash->error(__('The password is not correct'));
            } elseif ($this->User->validateConfirmPassword($changable) == False) {
                $this->Flash->error(__('The confirm password not match with the new password'));
            } else {
                if ($this->User->save(['password' => $changable['new_password']])) {
                    $result['User']['active'] = User::USER_ACTIVE;
                    $this->User->updateAll(array('User.active' => $result['User']['active']), array('User.id' => AuthComponent::user('id')));
                    $this->Session->write('Auth.User.active', $result['User']['active']);
                    return $this->redirect($this->referer());
                   
                } else {
                    $this->Flash->error(__('The password could not be saved'));
                }
            }            
        }
        if(AuthComponent::user('active') == User::USER_ACTIVE) {
            $this->render('change_password');
        } else {
            $this->render();
        }
    }

    public function UploadImage($id = null) {
        
        if (!$id) {
            throw new NotFoundException(__('Invalid User'));
        }
        $User = $this->User->findById($id);
        if (!$User) {
            throw new NotFoundException(__('Invalid User'));
        }

        $this->set('id', $id);

        if ($this->request->is(array('put', 'post'))) {
            $result = $this->User->find('first', array('conditions' => array('User.id' => $id)));
            $this->User->id = $id;
            $changable = $this->request->data['User'];

            $target_dir = APP . WEBROOT_DIR . DS . 'image_avatar' . DS;
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
            // Check if image file is a actual image or fake image
            if (isset($_POST["submit"])) {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if ($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            }
            // Check if file already exists
            // if (file_exists($target_file)) {
            //     echo "Sorry, file already exists.";
            //     $uploadOk = 0;
            // }
            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 500000) {
                $uploadOk = 0;
                echo "Sorry, your file is too large.";
            }
            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
                    $this->User->save(['avatar' => basename($_FILES["fileToUpload"]["name"])]);
                    $this->Session->write('Auth.User.avatar', basename($_FILES["fileToUpload"]["name"]));
                    echo "<p>Upload avatar success!</p>";
                    $this->redirect($this->request->data['backUrl']);
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }else {
            $backUrl = $this->referer();
            $this->set('backUrl' , $backUrl);
        }
    }

}
