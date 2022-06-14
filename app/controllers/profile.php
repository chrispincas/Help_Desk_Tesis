<?php

require_once 'models/usermodel.php';
require_once 'models/rolmodel.php';
require_once 'models/rolemodel.php';

class Profile extends SessionController{

	function __construct(){
    parent::__construct();
    $this->user = $this->getUserSessionData();
    $this->role = new RoleModel();
    $this->users = new UserModel();
    $this->rol = new RolModel();
  }

	function render(){
    $this->view->render('profile/index',[
      'user'=>$this->user,
			'user_edit'=>$this->users->get($this->user->getId()),
			'role'=>$this->role->get($this->user->getRoleId()),
			'roles'=>$this->rol->getAll()
    ]);
  }

}

?>