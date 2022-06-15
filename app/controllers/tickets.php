<?php

require_once 'models/rolemodel.php';
require_once 'models/ticketmodel.php';
require_once 'models/categorymodel.php';
require_once 'models/subcategorymodel.php';
require_once 'models/ticketstatusmodel.php';
require_once 'models/ticketrelationmodel.php';
require_once 'models/commentrelationmodel.php';
require_once 'models/commentmodel.php';
require_once 'controllers/MailController.php';

class Tickets extends SessionController{

	private $user; 
  private $role;
  
  function __construct(){
    parent::__construct();
    $this->user = $this->getUserSessionData();
    $this->role = new RoleModel();
    $this->ticket = new TicketModel();
    $this->ticketRelation = new TicketRelationModel();
    $this->category = new CategoryModel();
    $this->subcategory = new SubcategoryModel();
    $this->commentRelation = new CommentRelationModel();
    $this->ticketStatus = new TicketStatusModel();
    $this->comment = new CommentModel();
    $this->mail = new MailController();
    $this->users = new UserModel();
  }

  function render(){
    if($this->user->getRoleId() == 1){
      $this->view->render('tickets/index',[
        'user'=>$this->user,
        'role'=>$this->role->get($this->user->getRoleId()),
        'tickets'=>$this->ticketRelation->getAllRelation()
      ]);
    }else{
      $this->view->render('tickets/index',[
        'user'=>$this->user,
        'role'=>$this->role->get($this->user->getRoleId()),
        'tickets'=>$this->ticketRelation->getAllRelationByUserId($this->user->getId())
      ]);
    }
  }

  function add(){
    if($this->user->getRoleId() == 1){
      $this->view->render('tickets/add',[
        'user'=>$this->user,
        'role'=>$this->role->get($this->user->getRoleId()),
        'categories'=>$this->category->getAll(),
        'users'=>$this->users->getAll()
      ]);
    }else if($this->user->getRoleId() == 2){
      $this->view->render('tickets/add',[
        'user'=>$this->user,
        'role'=>$this->role->get($this->user->getRoleId()),
        'categories'=>$this->category->getAll(),
        'users'=>$this->users->getAllByGroupId($this->user->getGroupId())
      ]);
    }else{
      $this->view->render('tickets/add',[
        'user'=>$this->user,
        'role'=>$this->role->get($this->user->getRoleId()),
        'categories'=>$this->category->getAll(),
        'users'=>$this->users->getAllByGroupId($this->user->getGroupId())
      ]);
    }
    
  }

  function showTicket(){
    if($this->existGET(["id"])){
      $id = $this->getGet('id');
      if(!$this->ticket->get($id)){
        $this->redirect('tickets', ['error' => ErrorMessages::ERROR_TICKETS_GET]);
      }else{
        if($this->user->getRoleId() == 1){
          $this->view->render('tickets/show',[
            'user'=>$this->user,
            'role'=>$this->role->get($this->user->getRoleId()),
            'categories'=>$this->category->getAll(),
            'subcategories'=>$this->subcategory->getAll(),
            'ticketStatus'=>$this->ticketStatus->getAll(),
            'tickets'=>$this->ticketRelation->get($id),
            'comments'=>$this->commentRelation->getCommentsByTicketId($id)
          ]);
        }else{
          if($this->ticketRelation->compareUserTicketPermission($id, $this->user->getId())){
            $this->view->render('tickets/show',[
              'user'=>$this->user,
              'role'=>$this->role->get($this->user->getRoleId()),
              'categories'=>$this->category->getAll(),
              'subcategories'=>$this->subcategory->getAll(),
              'ticketStatus'=>$this->ticketStatus->getAll(),
              'tickets'=>$this->ticketRelation->get($id),
              'comments'=>$this->commentRelation->getCommentsByTicketId($id)
            ]);
          }else{
            $this->redirect('tickets', ['error' => ErrorMessages::ERROR_TICKETS_SHOWTICKET_PERMISSION]);
          }
        }
      } 
    }
    
    if($this->existGET(["crypt_id"])){
      $id = $this->getGet('crypt_id');
      $id = base64_decode(base64_decode($id));
      if($this->ticket->get($id)){
        $this->view->render('tickets/show',[
          'user'=>$this->user,
          'role'=>$this->role->get($this->user->getRoleId()),
          'categories'=>$this->category->getAll(),
          'subcategories'=>$this->subcategory->getAll(),
          'ticketStatus'=>$this->ticketStatus->getAll(),
          'tickets'=>$this->ticketRelation->get($id),
          'comments'=>$this->commentRelation->getCommentsByTicketId($id)
        ]);
      }else{
        $this->redirect('tickets', ['error' => ErrorMessages::ERROR_TICKETS_GET]);
      }
    }
  }

  function newTicket(){
    if($this->existPOST(["userId","subject", "priority", "category", "subcategory", "phone", "email","description"])){
      
      $isFile = false;
      if($this->existFile(['attachments'])){
        $isFile = true;
      }
      
      $subject = $this->getPost('subject');
      $priority = $this->getPost('priority');
      $category = $this->getPost('category');
      $subcategory = $this->getPost('subcategory');
      $phone = $this->getPost('phone');
      $email = $this->getPost('email');
      $description = $this->getPost('description');
      $userId = $this->getPost('userId');
      $createdAt = date('Y-m-d H:i:s');
      $modifiedAt = date('Y-m-d H:i:s');

      if(empty($userId) || $userId == '' || empty($subject) || $subject == '' || $priority == '' || empty($priority) || $category == '' || empty($category) || $subcategory == '' || empty($subcategory) || $phone == '' || empty($phone) || $email == '' || empty($email) || $description == '' || empty($description)){
        $this->redirect('tickets/add', ['error' => ErrorMessages::ERROR_TICKETS_NEWTICKET_EMPTY]);
      }else{
        $ticket = new TicketModel();
        $ticket->setSubject($subject);
        $ticket->setPriority($priority);
        $ticket->setCategoryId($category);
        $ticket->setSubcategoryId($subcategory);
        $ticket->setPhone($phone);
        $ticket->setEmail($email);
        $ticket->setDescription($description);
        if($category == 2){
          $ticket->setUserId(1);
        }else{
          $ticket->setUserId($userId);
        }
        $ticket->setTicketStatusId(1);
        $ticket->setCreatedAt($createdAt);
        $ticket->setModifiedAt($modifiedAt);
        if($ticket->save()){
          if($isFile){
            $ticket->setFiles($this->uploadFile($ticket->getId(),'attachments'));
            $ticket->updateFileUrl();
          }
          $html = file_get_contents("templates/ticket.html");
          $html = str_replace("{code}", $ticket->getId(), $html);
          $html = str_replace("{encryptCode}", base64_encode(base64_encode($ticket->getId())), $html);
          $sendMail = $this->mail->sendMail($email, "Generado Ticket: ".$ticket->getId(), $html);
          if($sendMail){
            $this->redirect('tickets', ['success' => SuccessMessages::SUCCESS_TICKETS_NEWTICKET]);
          }else{
            $this->redirect('tickets', ['error' => ErrorMessages::ERROR_TICKETS_NEWTICKET_SENDMAIL]);
          }  
        }else{
          $this->redirect('tickets/add', ['error' => ErrorMessages::ERROR_TICKETS_NEWTICKET_SAVE]);
        }
      }
    }else{
      $this->redirect('tickets/add', ['error' => ErrorMessages::ERROR_SIGNUP_POST]);
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
    $allowed = array('jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx');
    if (in_array($fileActualExt, $allowed)) {
      if ($fileError === 0) {
        if ($fileSize < 5000000) {
          if(!file_exists('docs/'.$folder)) {
            mkdir('docs/'.$folder, 0777, true);
          }
          $fileNameNew =  date('Ymdhis')."." . $fileActualExt;
          $fileDestination = 'docs/'.$folder."/".$fileNameNew;
          $fileUrl = URL.'/docs/'.$folder."/".$fileNameNew;
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

  function updateTicket(){
    if($this->existPOST(['id', 'ticketStatus', 'priority', 'category', 'subcategory', 'description', 'closeTicket'])){
      
      $id = $this->getPost('id');
      $ticketStatus = $this->getPost('ticketStatus');
      $priority = $this->getPost('priority');
      $category = $this->getPost('category');
      $subcategory = $this->getPost('subcategory');
      $description = $this->getPost('description');
      $closeTicket = $this->getPost('closeTicket');

      if($id == '' || empty($id) || $ticketStatus == '' || empty($ticketStatus) || $priority == '' || empty($priority) || $category == '' || empty($category) || $subcategory == '' || empty($subcategory) || $description == '' || empty($description)){
        $this->redirect('tickets/showTicket', ['error' => ErrorMessages::ERROR_TICKETS_UPDATETICKET_EMPTY. '&id='.$id]);
      }else{
        $ticket = new TicketModel();
        $ticket->setId($id);
        $ticket->setTicketStatusId($ticketStatus);
        $ticket->setPriority($priority);
        $ticket->setCategoryId($category);
        $ticket->setSubcategoryId($subcategory);
        $ticket->setModifiedAt(date('Y-m-d H:i:s'));
        if($closeTicket == 'yes'){
          $ticket->setTicketStatusId(4);
        }
        if($ticket->update()){
          $comment = new CommentModel();
          $comment->setTicketId($id);
          $comment->setUserId($this->user->getId());
          $comment->setComment($description);
          $comment->setCreatedAt(date('Y-m-d H:i:s'));
          if($comment->save()){
            $this->redirect('tickets', ['success' => SuccessMessages::SUCCESS_TICKETS_UPDATETICKET]);
          }else{
            $this->redirect('tickets/showTicket?id='.$id, ['error' => ErrorMessages::ERROR_TICKETS_UPDATETICKET_UPDATE]);
          }
        }else{
          $this->redirect('tickets/showTicket?id='.$id, ['error' => ErrorMessages::ERROR_TICKETS_UPDATETICKET_UPDATE]);
        }
      }      
    }else{
      $this->redirect('tickets', ['error' => ErrorMessages::ERROR_SIGNUP_POST]);
    }
  }

  function removeTicket(){
    if($this->existGET(['id'])){
      if($this->user->getRoleId() == 1){
        $id = $this->getGet('id');
        if($this->ticket->delete($id)){
          $this->redirect('tickets', ['success' => SuccessMessages::SUCCESS_TICKETS_REMOVE]);
        }else{
          $this->redirect('tickets', ['error' => ErrorMessages::ERROR_TICKETS_REMOVE]);
        }
      }else{
        $this->redirect('tickets', ['error' => ErrorMessages::ERROR_TICKETS_REMOVE_PERMISSION]);
      }
    }else{
      $this->redirect('tickets', ['error' => ErrorMessages::ERROR_SIGNUP_GET]);
    }
  }

  function getSubcategories(){
    $id = $_POST['categoryId'];
    $subcategoriesModel = new SubcategoryModel();
    $sc = $subcategoriesModel->getAllByCategory($id);
    $res = [];
    foreach ($sc as $s) {
      $arraySubcategories = [];
      $arraySubcategories['id'] = $s->getId();
      $arraySubcategories['subcategory'] = $s->getSubcategory();
      array_push($res, $arraySubcategories);
    }
    echo json_encode($res);
  }

}

?>