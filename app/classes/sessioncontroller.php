<?php

require_once 'classes/session.php';
require_once 'models/usermodel.php';
require_once 'models/rolemodel.php';

class SessionController extends Controller{
  
  private $userSession;
  private $identificacion;
  private $userId;
  private $session;
  private $sites;
  private $user;
  private $roleModel;

  function __construct(){
    parent::__construct();
    $this->init();
  }

  public function getUserSession(){
      return $this->userSession;
  }

  public function getIdentificacion(){
      return $this->identificacion;
  }

  public function getUserId(){
      return $this->userid;
  }

  /**
   * Inicializa el parser para leer el .json
   */
  private function init(){
      //se crea nueva sesión
      $this->session = new Session();
      //se carga el archivo json con la configuración de acceso
      $json = $this->getJSONFileConfig();
      // se asignan los sitios
      $this->sites = $json['sites'];
      // se asignan los sitios por default, los que cualquier rol tiene acceso
      $this->defaultSites = $json['default-sites'];
      // inicia el flujo de validación para determinar
      // el tipo de rol y permismos
      $this->validateSession();
  }
  /**
   * Abre el archivo JSON y regresa el resultado decodificado
   */
  private function getJSONFileConfig(){
      $string = file_get_contents("config/access.json");
      $json = json_decode($string, true);

      return $json;
  }

  /**
   * Implementa el flujo de autorización
   * para entrar a las páginas
   */
  function validateSession(){
      //Si existe la sesión
      if($this->existsSession()){
          $role_id = $this->getUserSessionData()->getRoleId();
          $roleModel = new RoleModel();
          $role = $roleModel->get($role_id)->getRole();
          if($this->isPublic()){
              $this->redirectDefaultSiteByRole($role);
          }else{
              if($this->isAuthorized($role)){
                  //si el usuario está en una página de acuerdo
                  // a sus permisos termina el flujo
              }else{
                  // si el usuario no tiene permiso para estar en
                  // esa página lo redirije a la página de inicio
                  $this->redirectDefaultSiteByRole($role);
              }
          }
      }else{
          //No existe ninguna sesión
          //se valida si el acceso es público o no
          if($this->isPublic()){
              //la pagina es publica
              //no pasa nada
          }else{
              //la página no es pública
              //redirect al login
              header('location: '. constant('URL') . '');
          }
      }
  }
  /**
   * Valida si existe sesión, 
   * si es verdadero regresa el usuario actual
   */
  function existsSession(){
      if(!$this->session->exists()) return false;
      if($this->session->getCurrentUser() == NULL) return false;

      $userid = $this->session->getCurrentUser();

      if($userid) return true;

      return false;
  }

  function getUserSessionData(){
      $id = $this->session->getCurrentUser();
      $this->user = new UserModel();
      $this->user->get($id);
      return $this->user;
  }

  public function initialize($user){
      $this->session->setCurrentUser($user->getId());
      $this->authorizeAccess($user->getRoleId());
  }

  private function isPublic(){
      $currentURL = $this->getCurrentPage();
      $currentURL = preg_replace( "/\?.*/", "", $currentURL); //omitir get info
      for($i = 0; $i < sizeof($this->sites); $i++){
          if($currentURL === $this->sites[$i]['site'] && $this->sites[$i]['access'] === 'public'){
              return true;
          }
      }
      return false;
  }

  private function redirectDefaultSiteByRole($role){
      $url = '';
      for($i = 0; $i < sizeof($this->sites); $i++){
          if($this->sites[$i]['role'] === $role){
              $url = '/'.$this->sites[$i]['site'];
          break;
          }
      }
      header('location: ' . constant('URL') . $url);
      
  }

  private function isAuthorized($role){
      $currentURL = $this->getCurrentPage();
      $currentURL = preg_replace( "/\?.*/", "", $currentURL); //omitir get info
      
      for($i = 0; $i < sizeof($this->sites); $i++){
          if($currentURL === $this->sites[$i]['site'] && $this->sites[$i]['role'] === $role){
              return true;
          }
      }
      return false;
  }

  private function getCurrentPage(){
      
      $actual_link = trim("$_SERVER[REQUEST_URI]");
      $url = explode('/', $actual_link);
      return $url[2];
  }

  function authorizeAccess($role){
      switch($role){
          case 'Usuario Externo':
            $this->redirect($this->defaultSites['Usuario Externo'],[]);
          break;
          case 'Usuario Interno':
            $this->redirect($this->defaultSites['Usuario Interno'],[]);
          break;
          case 'Soporte':
              $this->redirect($this->defaultSites['Soporte'],[]);
          break;
          case 'Administrador':
              $this->redirect($this->defaultSites['Administrador'],[]);
          break;
          default:
      }
  }

  function logout(){
      $this->session->closeSession();
  }
}
?>