<?php

class Users extends SessionController{

  private $user;

  function __construct(){
    parent::__construct();
    $this->user = $this->getUserSessionData();
    $this->users = new UserModel();
  }

  function render(){
    $this->view->render('users/index',[
      'user'=>$this->user,
      'info_user'=>$this->user->getAll()
    ]);
  }

  function add(){
    $this->view->render('users/add',[
      'user'=>$this->user,
      'users'=>$this->user->getAll()
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
    if($this->existPOST(['identificacion', 'nombre', 'correo', 'telefono', 'ubicacion', 'padre_id', 'saldo', 'role', 'estado'])){
      $identificacion = $this->getPost('identificacion');
      $nombre = $this->getPost('nombre');
      $correo = $this->getPost('correo');
      $telefono = $this->getPost('telefono');
      $ubicacion = $this->getPost('ubicacion');
      $padre_id = $this->getPost('padre_id');
      $saldo = $this->getPost('saldo');
      $role = $this->getPost('role');
      $estado = $this->getPost('estado');
      
      //validate data
      if($identificacion == '' || empty($identificacion) || $nombre == '' || empty($nombre) || $correo == '' || empty($correo)  || $telefono == '' || empty($telefono) || $ubicacion == '' || empty($ubicacion)){
          $this->redirect('users/add', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER_EMPTY]);
      }else{
        $user = new UserModel();
        $user->setName($nombre);
        
        
        if($user->exists($identificacion)){
          $this->redirect('users/add', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER_EXISTS]);
        }else if($user->save()){
          $this->redirect('users', ['success' => SuccessMessages::SUCCESS_SIGNUP_NEWUSER]);
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