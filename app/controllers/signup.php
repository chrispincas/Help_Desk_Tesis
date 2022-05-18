<?php

require_once 'models/usermodel.php';

class SignUp extends SessionController{
  
  function __construct(){
    parent::__construct();
  }

  function render(){
    $this->view->render('login/signup', []);

  }

  function newUser(){
    if($this->existPOST(['name', 'email', 'password', 'password2'])){
        
        $name = $this->getPost('name');
        $email = $this->getPost('email');
        $password = $this->getPost('password');
        $password2 = $this->getPost('password2');

        //validate data
        if($name == '' || empty($name) || $email == '' || empty($email) || $password == '' || empty($password)  || $password2 == '' || empty($password2)){
            $this->redirect('signup', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER_EMPTY]);
        }else{
          $user = new UserModel();
          $user->setName($name);
          $user->setEmail($email);
          $user->setPassword($password);
          $user->setStatus(0);
          $user->setRoleId(4);
          $user->setCreatedAt(date('Y-m-d H:i:s'));
          $user->setModifiedAt(date('Y-m-d H:i:s'));
         
          if($user->exists($email)){
            $this->redirect('signup', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER_EXISTS]);
          }else if($user->save()){
            $this->redirect('', ['success' => SuccessMessages::SUCCESS_SIGNUP_NEWUSER]);
          }else{
            $this->redirect('signup', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER]);
          }
        }
    }else{
        $this->redirect('signup', ['error' => ErrorMessages::ERROR_SIGNUP_POST]);
    }
  }

}

?>