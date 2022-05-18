<?php

require_once 'models/rolemodel.php';

class Dashboard extends SessionController{

  private $user; 
  private $role; 
  
  function __construct(){
    parent::__construct();
    $this->user = $this->getUserSessionData();
    $this->role = new RoleModel();
  }

  function render(){
    $this->view->render('dashboard/index',[
      'user'=>$this->user,
      'role'=>$this->role->get($this->user->getRoleId())
    ]);
  }

  function search(){
    if($this->existGet(['term'])){
      $term = $this->getGet('term');
      if($term=='' || empty($term)){
        $this->view->render('dashboard/index',[
          'user'=>$this->user
        ]);
      }else{
        $this->view->render('dashboard/index',[
          'user'=>$this->user,
          'client'=>$this->client->search($term)
        ]);
      }
    }
  }
}
?>