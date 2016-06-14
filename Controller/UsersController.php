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
    public function index() {


        $type = $this->request->query('type');
        if ($type == 'active' || $type == null) {

            $this->Paginator->settings = array(
                'conditions' => array('User.active' => 1),
                'limit' => 20
            );

            $countAccountActive = count($this->User->find('all', array('conditions' => array('User.active' => 1))));

            $this->User->recursive = 0;

            $this->set('users', $this->Paginator->paginate());
            $this->set('countAccountActive', $countAccountActive);
            $this->set('typeLabel', 'Active');
        } else {
            $this->Paginator->settings = array(
                'conditions' => array('User.active' => 0)
            );
            $countAccountRequest = count($this->User->find('all', array('conditions' => array('User.active' => 0))));

            $this->User->recursive = 0;

            $this->set('users', $this->Paginator->paginate());
            $this->set('countAccountRequest', $countAccountRequest);
            $this->set('typeLabel', 'Request');
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
            $this->User->create();
            $aaas = $this->User->find('all');

            if ($this->Auth->user('role') === '1') {
                $this->request->data['User']['user_id'] = $this->Auth->user('id');
            }

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
                    $this->User->save(['password' => $passwordRandom, 'role' => User::ROLE_ADMIN]);

                    $Email = new CakeEmail('gmail');
                    $Email->emailFormat('html')
                            ->to($this->request->data['User']['email'])
                            ->subject('Confirm Account')
                            ->send("Your password is: {$passwordRandom}. You need to change your password on the first login!");
                    return $this->redirect(array('controller' => 'users', 'action' => 'index'));
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
//        debug("ádfsdf");
//        die;
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $emailRequest = $this->User->getEmailById($this->User->id);
        $this->request->allowMethod('post', 'delete');
        if ($this->User->delete()) {
            $Email = new CakeEmail('gmail');
            $Email->emailFormat('html')
                    ->to($emailRequest[0]['users']['email'])
                    ->subject('Destroy Account')
                    ->send("Your account is deleted because some reason...! <br> Sign up to have a new account.");
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

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    public function main() {
        if ($this->request->data('signup') === 'Sign-up') {
            if ($this->request->is('post')) {

                $this->User->create();
                $aaas = $this->User->find('all');
                if (!empty($aaas)) {
                    $count_diff_email = 0;
                    foreach ($aaas as $user) {
                        if ($this->request->data['email'] === $user['User']['email']) {
                            $count_diff_email = 1;
                            $diff_email = 0;
                        } else {
                            $diff_email = 1;
                        }
                    }
                    $count_diff_user = 0;
                    foreach ($aaas as $user) {
                        if ($this->request->data['username'] === $user['User']['username']) {
                            $count_diff_user = 1;
                            $diff_user = 0;
                        } else {
                            $diff_user = 1;
                        }
                    }
                    if ($count_diff_user == 0 && $count_diff_email == 0) {
                        if ($this->User->save($this->request->data)) {
                            $passwordRandom = User::createRandomString(10);
                            $this->User->save(['password' => $passwordRandom]);
                            $Email = new CakeEmail('gmail');
                            $Email->emailFormat('html')
                                    ->to($this->request->data['email'])
                                    ->subject('Confirm Account')
                                    ->send("Your password is: {$passwordRandom}. Comeback home to login!");
                            $this->Flash->success(__('Check your mail to active account, please!'));
                        } else {
                            $this->Flash->error(__('Cant save account. '
                                            . '       Try again, Please'));
                        }
                    } else {
                        $this->Flash->error(__('Username or email existed.'
                                        . '      Try again, Please'));
                    }
                } else {
                    if ($this->User->save($this->request->data)) {
                        $passwordRandom = User::createRandomString(10);
                        $this->User->save(['password' => $passwordRandom]);
                        $Email = new CakeEmail('gmail');
                        $Email->emailFormat('html')
                                ->to($this->request->data['email'])
                                ->subject('Confirm Account')
                                ->send("Your password is: {$passwordRandom}. Comeback home to login!");
                        $this->Flash->success(__('Check your mail to active account, please!'));
                    } else {
                        $this->Flash->error(__('Cant save account. Please, try again.'));
                    }
                }
            }
        } elseif ($this->request->data('signin') === 'Sign-in') {
            if ($this->request->is('post')) {
                if ($this->Auth->login()) {
                    $count = $this->User->find('first', array(
                        'conditions' => array('User.id' => AuthComponent::user('id'))
                    ));
                    
                    if ($count['User']['role'] == User::ROLE_USER) {
                        if ($count['User']['active'] == User::USER_REQUEST) {
                            $this->User->updateAll(array('User.active' => User::USER_ACTIVE), array(
                                'User.id' => AuthComponent::user('id')));
                        }
                        return $this->redirect($this->Auth->redirectUrl());
                    } else {
                        if ($count['User']['active'] == User::USER_REQUEST) {
                            $this->User->updateAll(array('User.active' => User::USER_ACTIVE), array(
                                'User.id' => AuthComponent::user('id')));
                        }
                        return $this->redirect(array('controller' => 'users', 'action' => 'index'));
                    }
                }
                $this->Flash->error(__('Invalid username or password, try again'));
            }
        }
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
            $this->request->data['User']['id'] = $id;

            $this->User->id = $id;
            $changable = $this->request->data['User'];
            $result = $this->User->find('first', array('conditions' => array('User.id' => $id)));
            $this->User->set($this->request->data);
            $this->set('passOldDB', $result['User']['password']);
            $this->User->setValidateOldPassword($result['User']['password']);
            if (!$this->User->validates()) {
                $this->Flash->error(__('The password could not be saved'));
            } else {
                if ($this->User->save(['password' => $changable['new_password']])) {
                    $this->Session->write('Auth.User.password', $changable['new_password']);
                    $this->Flash->success(__('Change password success!'));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Flash->error(__('The password could not be saved'));
                }
            }
        }
    }

    public function forgotPassword() {
        $this->request->allowMethod('post');
        $allUsers = $this->User->find('all', array('fields' => array('email', 'password', 'username')));

        $emailRequest = $this->request->data['User']['email'];
        $usernameRequest = $this->request->data['User']['username'];

        $authCheck = $this->User->find('all', array('conditions' => array('email' => $emailRequest,
                'username' => $usernameRequest)));
        $checkActive = 0;

        if (!empty($authCheck)) {
            $checkActive = $authCheck[0]['User']['active'];
            if ($checkActive == 1) {

                $passwordRandom = User::createRandomString(10);
                $passwordhash = AuthComponent::password($passwordRandom);

                $this->User->updateAll(array(
                    'password' => "'" . $passwordhash . "'"), array(
                    'email' => $emailRequest));

                $Email = new CakeEmail('gmail');
                $Email->emailFormat('html')
                        ->to($emailRequest)
                        ->subject('Reset Password')
                        ->send("Your new password is: {$passwordRandom}");
                $this->Flash->success(__('Check your mail, please!'));
                return $this->redirect(array('action' => 'main'));
            } else {
                $this->Flash->error(__("your account don't exist. Please, try again."));
                return $this->redirect(array('action' => 'main'));
            }
        } else {
            $this->Flash->error(__("your account don't exist. Please, try again."));
            return $this->redirect(array('action' => 'main'));
        }
    }

    public function checkOldPass() {
        $this->request->allowMethod('post');

        $userAuth = $this->User->find('all', array('conditions' => array('User.id' => $this->Auth->user('id'))));
        $passwordOldDB = $userAuth[0]['User']['password'];

        $OldpasswordForm = AuthComponent::password($this->request->data['title']);
        if ($OldpasswordForm === $passwordOldDB) {
            echo json_encode(['status' => 0, 'message' => '*Password correct*']);
            exit;
        }

        echo json_encode(['status' => 1, 'message' => '*Password wrong*']);
        exit;
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
                    $this->Flash->error(__('File is not an image.'));
                    $uploadOk = 0;
                }
            }
            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 500000) {
                $uploadOk = 0;
                $this->Flash->error(__('Sorry, your file is too large.'));
            }
            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                $this->Flash->error(__('Sorry, only JPG, JPEG, PNG & GIF files are allowed.'));
                $uploadOk = 0;
            }
            $this->set('uploadOk', 'errorUpload');
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {

                $this->Flash->error(__(" Your avatar don't change!"));
                $this->redirect(array('action' => 'index'));
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
                    $this->User->save(['avatar' => basename($_FILES["fileToUpload"]["name"])]);
                    $this->Session->write('Auth.User.avatar', basename($_FILES["fileToUpload"]["name"]));
                    $this->Flash->success(__('Upload avatar success!'));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Flash->error(__('Sorry, there was an error uploading your file.'));
                }
            }
        }
    }
    
    public function dashboard_admin() { 
        $this->loadModel('Category');
        
        $categories = $this->Category->countCategory();
        $userActives = $this->User->countUserActive();
        $userRequests = $this->User->countUserRequest();
        $admin = $this->User->countAdmin();

        $this->set('userActive',$userActives[0][0]['count(*)']);
        $this->set('userRequest',$userRequests[0][0]['count(*)']);
        $this->set('categories',$categories[0][0]['count(*)']);
        $this->set('admin',$admin[0][0]['count(*)']);

    }
    
    

    public function isAuthorized($user) {

        switch ($this->action) {

            case "logout":
            case "checkOldPass":
            case "forgotPassword":
                return true;
                break;

            case "add":
            case "index":
            case "delete":
            case "deleteAll":
            case "dashboard_admin":
                if ($user['role'] == '1' && $user['active'] == '1') {
                    return true;
                }
                break;
            case "dashboard_user":
                 if ($user['role'] == '0' && $user['active'] == '1') {
                    return true;
                }
                break;
            case "UploadImage":
                if ($user['active'] == '1') {
                    $postId = (int) $this->request->params['pass'][0];
                    if ($this->User->isOwnedBy($postId)) {
                        return true;
                    }
                }
                break;
            case "change_password":
                $postId = (int) $this->request->params['pass'][0];
                if ($this->User->isOwnedBy($postId)) {
                    return true;
                }
                break;
        }
        return false;
    }

}
