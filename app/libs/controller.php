<?php

class Controller{

  function __construct(){
    $this->view = new View();
  }

  function loadModel($model){
    $url = 'models/' . $model . 'model.php';

    if(file_exists($url)){
      require_once $url;

      $modelName = $model.'Model';
      $this->model = new $modelName();
    }
  }

  function existPOST($params){
    foreach($params as $param){
      if(!isset($_POST[$param])){
        error_log('Controller::existPOST-> No existe el parametro ' . $param);
        return false;
      }
    }
    return true;
  }

  function existGET($params){
    foreach($params as $param){
      if(!isset($_GET[$param])){
        error_log('Controller::existGET-> No existe el parametro ' . $param);
        return false;
      }
    }
    return true;
  }

  function existFile($params){
    foreach($params as $param){
      if(isset($_FILES[$param])){
        if (isset($_FILES[$param]) && $_FILES[$param]['error'] === UPLOAD_ERR_OK) {
          return true;
        }else{
          return false;
        }
      }
    }
    return true;
  }

  function getGet($name){
    return $_GET[$name];
  }

  function getPost($name){
      return $_POST[$name];
  }

  function redirect($route,$msgs){
    $data = [];
    $params = '';

    foreach($msgs as $key=>$msg){
      array_push($data, $key . '=' . $msg);
    }
    $params = join('&', $data);

    if($params != ''){
      $params = '?' . $params;
    }

    header('Location: ' . constant('URL') . '/' . $route . $params);

  }

}

?>