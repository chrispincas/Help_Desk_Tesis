<?php

require_once 'models/rolemodel.php';
require_once 'models/reportmodel.php';

class Dashboard extends SessionController{

  private $user; 
  private $role;
  private $report;

  function __construct(){
    parent::__construct();
    $this->user = $this->getUserSessionData();
    $this->role = new RoleModel();
    $this->report = new ReportModel();
  }

  function render(){
    $this->view->render('dashboard/index',[
      'user'=>$this->user,
      'role'=>$this->role->get($this->user->getRoleId()),
      'total_users'=>$this->report->countUsers(),
      'total_tickets'=>$this->report->countTickets(),
      'total_tickets_status'=>$this->report->countTicketsGroupByStatus(),
      'total_tickets_category'=>$this->report->countTicketsGroupByCategory(),
    ]);
  }

}
?>