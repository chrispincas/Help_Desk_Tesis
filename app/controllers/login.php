<?php
class Login extends SessionController{

  function __construct(){
    parent::__construct();
    //error_log('Login::construct-> Inicio de Login');   
  }

  function render(){
    $this->view->render('login/index');
  }
  function authenticate(){
    if($this->existPOST(['email','password'])){
      $email = $this->getPost('email');
      $password = $this->getPost('password');

      if($email == '' || empty($email) || $password == '' || empty($password)){
        $this->redirect('', ['error' => ErrorMessages::ERROR_LOGIN_AUTHENTICATE_EMPTY]);
      }else{
        $user = $this->model->login($email, $password);

        if($user!=NULL){
          if($user->getStatus()==1){
            $this->initialize($user); 
          }else{
            $this->redirect('', ['error'=>ErrorMessages::ERROR_LOGIN_AUTHENTICATE_STATUS]);
          }
        }else{
          $this->redirect('', ['error'=>ErrorMessages::ERROR_LOGIN_AUTHENTICATE_DATA]);
        }
          
      }
    }else{
      $this->redirect('', ['error'=>ErrorMessages::ERROR_LOGIN_AUTHENTICATE_POST]);
    }
  }
}
?>