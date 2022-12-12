<?php

require_once 'models/handbookmodel.php';
require_once 'models/categorymodel.php';

class Handbooks extends SessionController{

  private $user;
  private $handbook;
  private $role;
  private $category;

  function __construct(){
    parent::__construct();
    $this->user = $this->getUserSessionData();
    $this->handbook = new HandbookModel();
    $this->category = new CategoryModel();
    $this->role = new RoleModel();
  }

  function render(){
    $this->view->render('handbooks/index', [
      'user' => $this->user,
      'handbooks' => $this->handbook->getAll(),
      'role' => $this->role->get($this->user->getRoleId()),
    ]);
  }

  function add(){
    $this->view->render('handbooks/add', [
      'user' => $this->user,
      'role' => $this->role->get($this->user->getRoleId()),
      'categories' => $this->category->getAll()
    ]);
  }

  function create(){
    if($this->existPOST(['title', 'subcategoryId'])){
      if($this->existFile(['attachments'])){
        
        $title = $this->getPOST('title');
        $subcategoryId = $this->getPOST('subcategoryId');
        $attachments = $this->getPOST('attachments');
        $createdAt = date('Y-m-d H:i:s');

        if(empty($title) || empty($subcategoryId) || empty($attachments)){
          $this->redirect('handbooks/add', ['error' => ErrorMessages::ERROR_TICKETS_NEWTICKET_EMPTY]);
        }
        $handbook = new HandbookModel();
        $handbook->setTitle($title);
        $handbook->setSubcategoryId($subcategoryId);
        $handbook->setUrl("");
        $handbook->setCreatedAt($createdAt);
        if($handbook->save()){
          $handbook->setUrl($this->uploadFile($handbook->getId(),'attachments'));
          $handbook->updateFileUrl();
          $this->redirect('handbooks', ['success' => SuccessMessages::SUCCESS_HANDBOOK_CREATE]);
        }else{
          $this->redirect('handbooks/add', ['error' => ErrorMessages::ERROR_HANDBOOK_CREATE]);
        }
      }else{
        $this->redirect('handbooks/add', ['error' => ErrorMessages::ERROR_FILE_EMPTY]);
      }
    }
  }

  function uploadFile($folder, $param){
    $fileName = $_FILES[$param]['name'];
    $fileTmpName = $_FILES[$param]['tmp_name'];
    $fileSize = $_FILES[$param]['size'];
    $fileError = $_FILES[$param]['error'];
    $fileType = $_FILES[$param]['type'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('pdf', 'doc', 'docx');
    if (in_array($fileActualExt, $allowed)) {
      if ($fileError === 0) {
        if ($fileSize < 5000000) {
          if(!file_exists('guides/'.$folder)) {
            mkdir('guides/'.$folder, 0777, true);
          }
          $fileNameNew =  $fileName;
          $fileDestination = 'guides/'.$folder."/".$fileNameNew;
          $fileUrl = URL.'/guides/'.$folder."/".$fileNameNew;
          move_uploaded_file($fileTmpName, $fileDestination);
          return $fileUrl;
        }else{
          error_log("El archivo es demasiado grande.");
          return false;
        }
      }else{
        error_log("Hubo un error al subir el archivo.");
        return false;
      }
    }else{
      error_log("Solo se permiten archivos de tipo: " . implode(', ', $allowed));
      return false;
    } 
  }

  

}

?>