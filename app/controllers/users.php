<?php

require_once 'models/usermodel.php';
require_once 'models/rolmodel.php';
require_once 'models/groupmodel.php';
require_once 'controllers/MailController.php';

class Users extends SessionController{

  private $user;

  function __construct(){
    parent::__construct();
    $this->user = $this->getUserSessionData();
    $this->role = new RoleModel();
    $this->users = new UserModel();
    $this->rol = new RolModel();
    $this->group = new GroupModel();
    $this->mail = new MailController();
  }

  

  function render(){
    $this->view->render('users/index',[
      'user'=>$this->user,
      'role'=>$this->role->get($this->user->getRoleId()),
      'users'=>$this->users->getAll()
    ]);
  }

  function add(){
    $this->view->render('users/add',[
      'user'=>$this->user,
      'role'=>$this->role->get($this->user->getRoleId()),
      'roles'=>$this->rol->getAll(),
      'groups'=>$this->group->getAll()
    ]);
  }

  function showUser(){
    if($this->existGET(["id"])){
      $id = $this->getGet('id');
      if(!$this->users->get($id)){
        $this->redirect('users', ['error' => ErrorMessages::ERROR_USERS_GET]);
      }else{
        if($this->user->getRoleId() <= 2){
          $this->view->render('users/show',[
            'user'=>$this->user,
            'user_edit'=>$this->users->get($id),
            'role'=>$this->role->get($this->user->getRoleId()),
            'roles'=>$this->rol->getAll(),
            'groups'=>$this->group->getAll()
          ]);
        }else{
          $this->redirect('tickets', ['error' => ErrorMessages::ERROR_TICKETS_SHOWTICKET_PERMISSION]);
        }
      } 
    }
  }

  function newUser(){
    if($this->existPOST(['employeeId','name' , 'email', 'groupId', 'roleId'])){
      
      $employeeId = $this->getPost('employeeId');
      $name = $this->getPost('name');
      $email = $this->getPost('email');
      $status = 1;
      $groupId = $this->getPost('groupId');
      $roleId = $this->getPost('roleId');
      $createdAt = date('Y-m-d H:i:s');
      $modifiedAt = date('Y-m-d H:i:s');
      
      //validate data
      if($employeeId == '' || $name == '' || $email == '' || $groupId == '' || $roleId == ''){
          $this->redirect('users/add', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER_EMPTY]);
      }else{
        $password = $this->users->generatePassword(8);

        $user = new UserModel();
        $user->setEmployeeId($employeeId);
        $user->setName($name);
        $user->setEmail($email);
        $user->setStatus($status);
        $user->setGroupId($groupId);
        $user->setRoleId($roleId);
        $user->setCreatedAt($createdAt);
        $user->setModifiedAt($modifiedAt);
        $user->setPassword($password);
        
        if($user->exists($email)){
          $this->redirect('users/add', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER_EXISTS]);
        }else if($user->save()){
          $html = file_get_contents("templates/newUser.html");
          $html = str_replace("{user}", $email, $html);
          $html = str_replace("{password}", $password, $html);
          $sendMail = $this->mail->sendMail($email, "Usuario ".$email." creado en sistema: ", $html);
          if($sendMail){
            $this->redirect('users', ['success' => SuccessMessages::SUCCESS_SIGNUP_NEWUSER]);
          }else{
            $this->redirect('users', ['error' => ErrorMessages::ERROR_TICKETS_NEWTICKET_SENDMAIL]);
          }  
        }else{
          $this->redirect('users/add', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER]);
        }
      }
    }else{
        $this->redirect('users/add', ['error' => ErrorMessages::ERROR_SIGNUP_POST]);
    }
  }

  function updateUser(){
    if($this->existPOST(['id', 'employeeId', 'name', 'email', 'groupId', 'roleId', 'status'])){
      $id = $this->getPost('id');
      $employeeId = $this->getPost('employeeId');
      $name = $this->getPost('name');
      $email = $this->getPost('email');
      $groupId = $this->getPost('groupId');
      $roleId = $this->getPost('roleId');
      $status = $this->getPost('status');
      
      $user = new UserModel();
      $user->setId($id);
      $user->setEmployeeId($employeeId);
      $user->setName($name);
      $user->setEmail($email);
      $user->setGroupId($groupId);
      $user->setRoleId($roleId);
      $user->setStatus($status);
      $user->setModifiedAt(date('Y-m-d H:i:s'));

      if($user->update()){
        $this->redirect('users',['success' => SuccessMessages::SUCCESS_USERS_UPDATE]);
      }else{
        $this->redirect('users', ['error' => ErrorMessages::ERROR_SIGNUP_POST]);
      }
    }else{
      $this->redirect('users', ['error' => ErrorMessages::ERROR_SIGNUP_POST]);
    }
  }

  function updateProfile(){
    if($this->existPOST(['id', 'name', 'email'])){
      $id = $this->getPost('id');
      $name = $this->getPost('name');
      $email = $this->getPost('email');
      
      $user = new UserModel();
      $user->setId($id);
      $user->setName($name);
      $user->setEmail($email);
      $user->setModifiedAt(date('Y-m-d H:i:s'));
      
      
      if($user->updateProfile()){
        $this->redirect('profile',['success' => SuccessMessages::SUCCESS_USERS_UPDATE]);
      }else{
        $this->redirect('profile', ['error' => ErrorMessages::ERROR_SIGNUP_POST]);
      }
    }else{
      $this->redirect('profile', ['error' => ErrorMessages::ERROR_SIGNUP_POST]);
    }
  }

  function updatePassword(){
    if($this->existPOST(['id', 'password', 'password2'])){
      $id = $this->getPost('id');
      $password = $this->getPost('password');
      $password2 = $this->getPost('password2');
      
      if($password!=$password2){
        $this->redirect('profile', ['error' => ErrorMessages::ERROR_USERS_UPDATEPASSWORD_MATCH]);
      }

      $user = new UserModel();
      $user->setId($id);
      $user->setPassword($password);
      $user->setModifiedAt(date('Y-m-d H:i:s'));

      if($user->updatePassword()){
        $this->redirect('profile',['success' => SuccessMessages::SUCCESS_USERS_UPDATE]);
      }else{
        $this->redirect('profile', ['error' => ErrorMessages::ERROR_SIGNUP_POST]);
      }
    }else{
      $this->redirect('profile', ['error' => ErrorMessages::ERROR_SIGNUP_POST]);
    }
  }

  function recoveryPassword(){
    if($this->existPOST(['email'])){
      $password = $this->users->generatePassword(8);

      $email = $this->getPost('email');
      $user = new UserModel();
      if($user->exists($email)){
        $user->setEmail($email);
        $user->setPassword($password);
        $user->setModifiedAt(date('Y-m-d H:i:s'));
  
        if($user->recoveryPassword()){
          $html = file_get_contents("templates/recoveryPassword.html");
          $html = str_replace("{user}", $email, $html);
          $html = str_replace("{password}", $password, $html);
          $sendMail = $this->mail->sendMail($email, "Usuario y clave restablecida en sistema: ", $html);
          if($sendMail){
            $this->redirect('',['success' => SuccessMessages::SUCCESS_USERS_RECOVERYPASSWORD]);
          }else{
            $this->redirect('', ['error' => ErrorMessages::ERROR_TICKETS_NEWTICKET_SENDMAIL]);
          }  
        }else{
          $this->redirect('', ['error' => ErrorMessages::ERROR_USERS_RECOVERYPASSWORD]);
        } 
      }else{
        $this->redirect('', ['error' => ErrorMessages::ERROR_USER_NOT_EXISTS]);
      }
    }else{
      $this->redirect('', ['error' => ErrorMessages::ERROR_SIGNUP_POST]);
    }
  }

  function removeUser(){
    if($this->existGET(['id'])){
      $id = $this->getGet('id');
      
      if($this->users->delete($id)){
        $this->redirect('users', ['success' => SuccessMessages::SUCCESS_USERS_REMOVE]);
      }else{
        $this->redirect('users', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER]);
      }
    }else{
      $this->redirect('users', ['error' => ErrorMessages::ERROR_SIGNUP_POST]);
    }

  }
  
  

}

?>