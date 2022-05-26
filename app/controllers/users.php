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

  function edit(){
    if($this->existGET(['id'])){
      $id = $this->getGet('id');
      $this->view->render('users/edit',[
        'user'=>$this->user,
        'reseller'=>$this->users->get($id),
        'list_users'=>$this->users->getAll()
      ]);
    }else{
      $this->redirect('users/add', ['error' => ErrorMessages::ERROR_SIGNUP_POST]);
    }
  }

  function newUser(){
    if($this->existPOST(['name' , 'email', 'groupId', 'roleId'])){
      
      $name = $this->getPost('name');
      $email = $this->getPost('email');
      $status = 1;
      $groupId = $this->getPost('groupId');
      $roleId = $this->getPost('roleId');
      $createdAt = date('Y-m-d H:i:s');
      $modifiedAt = date('Y-m-d H:i:s');
      
      //validate data
      if($name == '' || $email == '' || $groupId == '' || $roleId == ''){
          $this->redirect('users/add', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER_EMPTY]);
      }else{
        $password = $this->users->generatePassword(8);

        $user = new UserModel();
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
    if($this->existPOST(['id', 'identificacion', 'correo', 'telefono','ubicacion', 'padre_id', 'role', 'estado'])){
      $id = $this->getPost('id');
      $identificacion = $this->getPost('identificacion');
      $nombre = $this->getPost('nombre');
      $correo = $this->getPost('correo');
      $telefono = $this->getPost('telefono');
      $ubicacion = $this->getPost('ubicacion');
      $padre_id = $this->getPost('padre_id');
      $role = $this->getPost('role');
      $estado = $this->getPost('estado');
      
      $this->users->setId($id);
      $this->users->setIdentificacion($identificacion);
      $this->users->setNombre($nombre);
      $this->users->setCorreo($correo);
      $this->users->setTelefono($telefono);
      $this->users->setUbicacion($ubicacion);
      $this->users->setPadre_id($padre_id);
      $this->users->setRole($role);
      $this->users->setEstado($estado);

      if($this->users->update()){
        $this->redirect('users',['success' => SuccessMessages::SUCCESS_USERS_UPDATE]);
      }else{
        $this->redirect('users', ['error' => ErrorMessages::ERROR_SIGNUP_POST]);
      }
    }else{
      $this->redirect('users', ['error' => ErrorMessages::ERROR_SIGNUP_POST]);
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