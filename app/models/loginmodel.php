<?php

require_once 'models/usermodel.php';

class LoginModel extends Model{

  function __construct(){
    parent::__construct();
  }

  function login($email, $password){
    try{
      $query = $this->prepare('SELECT * FROM user WHERE email=:email');
      $query->execute(['email'=>$email]);

      if($query->rowCount() == 1){
        $item =  $query->fetch(PDO::FETCH_ASSOC);
        $user = new UserModel();
        $user->from($item);

        if(password_verify($password, $user->getPassword())){
          //error_log('LoginModel::login->success'); // TODO:
          return $user;
        }else{
          //error_log('LoginModel::login->Password no es igual');// TODO:
          return NULL;
        }
      }

    }catch (PDOException $e){
      error_log('LoginModel::login->exception: ' . $e);// TODO:
      return NULL;
    }
  }
}

?>