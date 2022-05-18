<?php

class View{

  function __construct(){

  }

  function render($nombre,$data = []){
    $this->d = $data;
    $this->handleMessages();

    require 'views/' . $nombre . '.php';
  }

  private function handleMessages(){
    if(isset($_GET['success']) && isset($_GET['error'])){
      //Error
    }else if(isset($_GET['success'])){
      $this->handleSuccess();
    }else if(isset($_GET['error'])){
      $this->handleError();
    }
  }

  private function handleError(){
    $hash = $_GET['error'];
    $error = new ErrorMessages();

    if($error->existsKey($hash)){
      $this->d['error'] = $error->get($hash);
    }
  }

  private function handleSuccess(){
    $hash = $_GET['success'];
    $success = new successMessages();

    if($success->existsKey($hash)){
      $this->d['success'] = $success->get($hash);
    }
  }

  public function showMessages(){
    $this->showErrors();
    $this->showSuccess();
  }

  public function showErrors(){
    if(array_key_exists('error',$this->d)){
      $body = '
      <div class="alert alert-danger fade show text-center" role="alert">
        <strong>'.$this->d['error'].'</strong>
      </div>';
      echo $body;
    }
  }

  public function showSuccess(){
    if(array_key_exists('success',$this->d)){
      $body = '
      <div class="alert alert-success fade show text-center" role="alert">
        <strong>'.$this->d['success'].'</strong>
      </div>';
      echo $body;
    }
  }

}

?>