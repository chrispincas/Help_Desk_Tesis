<?php

class ErrorMessages{
  // ERROR_CONTROLLER_METHOD_ACTION
  const ERROR_SIGNUP_POST = "e_s_p_2021_400";
  const ERROR_SIGNUP_GET = "e_s_g_2021_400";
  const ERROR_SIGNUP_NEWUSER = "e_s_nu_2021_400";
  const ERROR_SIGNUP_NEWUSER_EMPTY = "e_s_nu_e_2021_400";
  const ERROR_SIGNUP_NEWUSER_EXISTS = "e_u_ne_2021_400";
  const ERROR_LOGIN_AUTHENTICATE_POST = "e_l_a_p_2021_400";
  const ERROR_LOGIN_AUTHENTICATE_EMPTY = "e_l_a_e_2021_400";
  const ERROR_LOGIN_AUTHENTICATE_DATA = "e_l_a_d_2021_400";
  const ERROR_LOGIN_AUTHENTICATE_STATUS = "e_l_a_S_2021_400";
  //
  const ERROR_USER_NEWUSER_EXIST = "e_u_ne_2021_400";
  const ERROR_USER_NEW_PASSWORD = "e_u_np_2021_400";
  const ERROR_USER_CURRENT_PASSWORD = "e_u_cp_2021_400";
  const ERROR_TRANSFER_VALOR = "e_t_v_2021_400";
  //
  const ERROR_TICKETS_NEWTICKET_EMPTY = "e_t_nt_e_2021_400";
  const ERROR_TICKETS_NEWTICKET_SAVE = "e_t_nt_s_2021_400";
  const ERROR_TICKETS_REMOVE = "e_t_r_2021_400";
  const ERROR_TICKETS_REMOVE_PERMISSION = "e_t_r_p_2021_400";
  const ERROR_TICKETS_SHOWTICKET_PERMISSION = "e_t_st_p_2021_400";
  const ERROR_TICKETS_UPDATETICKET_EMPTY = "e_t_ut_e_2021_400";
  const ERROR_TICKETS_UPDATETICKET_UPDATE = "e_t_ut_s_2021_400";
  const ERROR_FILE_UPLOAD = "e_f_u_2021_400";
  const ERROR_TICKETS_NEWTICKET_SENDMAIL = "e_t_nt_sm_2021_400";
  const ERROR_TICKETS_GET = "e_t_g_2021_400";
  const ERROR_USERS_GET = "e_u_g_2021_400";
  //
  CONST ERROR_GROUP_NEWGROUP = "e_g_ng_2021_400";
  CONST ERROR_USERS_UPDATEPASSWORD_MATCH = "e_u_up_m_2021_400";
  CONST ERROR_USERS_RECOVERYPASSWORD = "e_u_rp_2021_400";
  CONST ERROR_USER_NOT_EXISTS = "e_u_ne_2021_400";
  private $errorList = [];

  public function __construct(){
    $this->errorList=[
      ErrorMessages::ERROR_SIGNUP_POST=>'No se recibieron datos post',
      ErrorMessages::ERROR_SIGNUP_GET=>'No se recibieron datos get',
      ErrorMessages::ERROR_SIGNUP_NEWUSER=>'Hubo un error al intentar procesar la solicitud',
      ErrorMessages::ERROR_SIGNUP_NEWUSER_EMPTY=>'Llene los campos solicitados',
      ErrorMessages::ERROR_SIGNUP_NEWUSER_EXISTS=>'La identificacion del usuario ya esta en sistema',
      ErrorMessages::ERROR_LOGIN_AUTHENTICATE_POST=>'No se recibieron datos post',
      ErrorMessages::ERROR_LOGIN_AUTHENTICATE_EMPTY=>'Llene los campos de usuario y password',
      ErrorMessages::ERROR_LOGIN_AUTHENTICATE_DATA=>'Usuario y/o password incorrecto',
      ErrorMessages::ERROR_LOGIN_AUTHENTICATE_STATUS=>'Usuario inactivo, por favor contacte con el administrador',
      ErrorMessages::ERROR_USER_NEWUSER_EXIST=>'La identificacion del usuario ya esta en sistema',
      ErrorMessages::ERROR_USER_NEW_PASSWORD=>'La contraseña no es igual',
      ErrorMessages::ERROR_USER_CURRENT_PASSWORD=>'La contraseña actual es incorrecta',
      ErrorMessages::ERROR_TRANSFER_VALOR=>'El valor debe ser diferente a $ 0',
      ErrorMessages::ERROR_FILE_UPLOAD=>'Hubo un error al intentar subir el archivo',
      ErrorMessages::ERROR_TICKETS_NEWTICKET_EMPTY=>'Llene los campos solicitados',
      ErrorMessages::ERROR_TICKETS_NEWTICKET_SAVE=>'Hubo un error al intentar procesar la solicitud',
      ErrorMessages::ERROR_TICKETS_REMOVE=>'Hubo un error al intentar procesar la solicitud',
      ErrorMessages::ERROR_TICKETS_REMOVE_PERMISSION=>'No tiene permisos para eliminar este ticket',
      ErrorMessages::ERROR_TICKETS_SHOWTICKET_PERMISSION=>'No tiene permisos para ver este ticket',
      ErrorMessages::ERROR_TICKETS_UPDATETICKET_EMPTY=>'Llene los campos solicitados',
      ErrorMessages::ERROR_TICKETS_UPDATETICKET_UPDATE=>'Hubo un error al intentar procesar la solicitud',
      ErrorMessages::ERROR_TICKETS_NEWTICKET_SENDMAIL=>'Hubo un error al intentar enviar el correo',
      ErrorMessages::ERROR_TICKETS_GET=>'Ticket no encontrado',
      ErrorMessages::ERROR_USERS_GET=>'Usuario no encontrado',
      ErrorMessages::ERROR_GROUP_NEWGROUP=>'Hubo un error al intentar procesar la solicitud',
      ErrorMessages::ERROR_USERS_UPDATEPASSWORD_MATCH=>'La contraseña no es igual',
      ErrorMessages::ERROR_USERS_RECOVERYPASSWORD=>'Hubo un error al intentar procesar la solicitud',
      ErrorMessages::ERROR_USER_NOT_EXISTS=>'Usuario no encontrado'
    ];
  }

  public function get($hash){
    return $this->errorList[$hash];
  }

  public function existsKey($key){
    if(array_key_exists($key, $this->errorList)){
      return true;
    }else{
      return false;
    }
  }

}

?>