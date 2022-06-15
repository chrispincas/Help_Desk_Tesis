<?php

require_once 'models/groupmodel.php';

class Groups extends SessionController{

  private $user;
  private $group;
  private $role;

  function __construct(){
    parent::__construct();
    $this->user = $this->getUserSessionData();
    $this->group = new GroupModel();
    $this->role = new RoleModel();
  }

  function render(){
    $this->view->render('groups/index', [
      'user' => $this->user,
      'groups' => $this->group->getAll(),
      'role' => $this->role->get($this->user->getRoleId()),
    ]);
  }

  function add(){
    $this->view->render('groups/add', [
      'user' => $this->user,
      'role' => $this->role->get($this->user->getRoleId())
    ]);
  }

  function showGroup(){
    if ($this->existGET(["id"])) {
      $id = $this->getGet('id');
      if (!$this->group->get($id)) {
        $this->redirect('groups', ['error' => ErrorMessages::ERROR_USERS_GET]);
      } else {
        if ($this->user->getRoleId() <= 2) {
          $this->view->render('groups/show', [
            'user' => $this->user,
            'group_edit' => $this->group->get($id),
            'role' => $this->role->get($this->user->getRoleId()),
          ]);
        } else {
          $this->redirect('tickets', ['error' => ErrorMessages::ERROR_TICKETS_SHOWTICKET_PERMISSION]);
        }
      }
    }
  }

  function newGroup(){
    if ($this->existPOST(['groupName'])) {

      $groupName = $this->getPost('groupName');

      if ($groupName == '') {
        $this->redirect('groups/add', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER_EMPTY]);
      } else {
        $group = new GroupModel();
        $group->setGroup($groupName);

        if ($group->save()) {
          $this->redirect('groups', ['success' => SuccessMessages::SUCCESS_GROUP_NEWGROUP]);
        } else {
          $this->redirect('groups/add', ['error' => ErrorMessages::ERROR_GROUP_NEWGROUP]);
        }
      }
    } else {
      $this->redirect('groups/add', ['error' => ErrorMessages::ERROR_SIGNUP_POST]);
    }
  }

  function updateGroup(){
    if ($this->existPOST(['id', 'groupName'])) {
      $id = $this->getPost('id');
      $groupName = $this->getPost('groupName');

      $group = new GroupModel();
      $group->setId($id);
      $group->setGroup($groupName);

      if ($group->update()) {
        $this->redirect('groups', ['success' => SuccessMessages::SUCCESS_USERS_UPDATE]);
      } else {
        $this->redirect('groups', ['error' => ErrorMessages::ERROR_SIGNUP_POST]);
      }
    } else {
      $this->redirect('groups', ['error' => ErrorMessages::ERROR_SIGNUP_POST]);
    }
  }

  function removeGroup(){
    if ($this->existGET(['id'])) {
      $id = $this->getGet('id');

      if ($this->users->delete($id)) {
        $this->redirect('users', ['success' => SuccessMessages::SUCCESS_USERS_REMOVE]);
      } else {
        $this->redirect('users', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER]);
      }
    } else {
      $this->redirect('users', ['error' => ErrorMessages::ERROR_SIGNUP_POST]);
    }

  }


}

?>