<?php

class SuccessMessages{
  // SUCCESS_CONTROLLER_METHOD_ACTION
  const SUCCESS_USER_NEWUSER_EXIST = "s_u_ne_2021_400";
  const SUCCESS_SIGNUP_NEWUSER = "s_s_nu_2021_200";
  const SUCCESS_CLIENTS_REMOVE = 's_c_r_2021_200';
  const SUCCESS_CLIENTS_UPDATE = 's_c_u_2021_200';
  const SUCCESS_PIN_LOADPIN = 's_c_u_2021_200';
  const SUCCESS_USERS_REMOVE = 's_u_r_2021_200';
  const SUCCESS_USERS_UPDATE = 's_u_u_2021_200';
  const SUCCESS_USERS_PASSWORD_UPDATE = 's_u_pu_2021_200';
  const SUCCESS_TRANSFER_NEWTRANSFER = 's_t_nw_2021_200';
  const SUCCESS_TICKETS_NEWTICKET = 's_t_nt_2021_200';
  const SUCCESS_TICKETS_REMOVE = 's_t_r_2021_200';
  const SUCCESS_TICKETS_UPDATETICKET = 's_t_ut_2021_200';
  const SUCCESS_GROUP_NEWGROUP = 's_g_ng_2021_200';
  const SUCCESS_USERS_RECOVERYPASSWORD = 's_u_rp_2021_200';
  CONST SUCCESS_HANDBOOK_CREATE = 's_h_c_2021_200';

  private $successList = [];
  public function __construct(){
    $this->successList=[
      SuccessMessages::SUCCESS_USER_NEWUSER_EXIST=>'Usuario creado correctamente',
      SuccessMessages::SUCCESS_SIGNUP_NEWUSER=>'Nuevo usuario creado',
      SuccessMessages::SUCCESS_CLIENTS_REMOVE=>'Cliente Eliminado',
      SuccessMessages::SUCCESS_CLIENTS_UPDATE=>'Cliente Actualizado',
      SuccessMessages::SUCCESS_PIN_LOADPIN=>'Pin Cargado',
      SuccessMessages::SUCCESS_USERS_REMOVE=>'Usuario eliminado',
      SuccessMessages::SUCCESS_USERS_UPDATE=>'Usuario actualizado',
      SuccessMessages::SUCCESS_USERS_PASSWORD_UPDATE=>'Contraseña Actualizada',
      SuccessMessages::SUCCESS_TRANSFER_NEWTRANSFER=>'Transferencia realizada',
      SuccessMessages::SUCCESS_TICKETS_NEWTICKET=>'Ticket creado',
      SuccessMessages::SUCCESS_TICKETS_REMOVE=>'Ticket eliminado',
      SuccessMessages::SUCCESS_TICKETS_UPDATETICKET=>'Ticket actualizado',
      SuccessMessages::SUCCESS_GROUP_NEWGROUP=>'Grupo creado',
      SuccessMessages::SUCCESS_USERS_RECOVERYPASSWORD=>'Se ha enviado un correo con la contraseña',
      SuccessMessages::SUCCESS_HANDBOOK_CREATE=>'Se ha creado el manual'
    ];
  }

  public function get($hash){
    return $this->successList[$hash];
  }

  public function existsKey($key){
    if(array_key_exists($key, $this->successList)){
      return true;
    }else{
      return false;
    }
  }
}

?>