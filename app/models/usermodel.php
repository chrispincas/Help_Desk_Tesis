<?php

class UserModel extends Model implements IModel{

  private $id;
  private $name;
  private $email;
  private $password;
  private $status;
  private $groupId;
  private $groupName;
  private $roleId;
  private $roleName;
  private $createdAt;
  private $modifiedAt;

  public function __construct(){
    parent::__construct();
    $this->name='';
    $this->email='';
    $this->password='';
    $this->status=false;
    $this->groupId=0;
    $this->roleId=0;
    $this->createdAt='';
    $this->modifiedAt='';
  }
  
  public function save(){
    try{
      $query=$this->prepare('INSERT INTO user(name, email, password, status, group_id, role_id, created_at, modified_at) values(?,?,?,?,?,?,?,?)');
      $query->bindParam(1, $this->name);
      $query->bindParam(2, $this->email);
      $query->bindParam(3, $this->password);
      $query->bindParam(4, $this->status);
      $query->bindParam(5, $this->groupId);
      $query->bindParam(6, $this->roleId);
      $query->bindParam(7, $this->createdAt);
      $query->bindParam(8, $this->modifiedAt);
      $query->execute();
      return true;
    }catch(PDOException $e){
      error_log('userModel::save->PDOException '.$e);
      return false;
    }
  }

  public function getAll(){
    try{
      $items = [];
      $query=$this->query('SELECT u.id, u.name, u.email, u.status, u.created_at, u.modified_at, gu.group_name, r.role FROM user u 
      LEFT JOIN group_user gu ON(u.group_id = gu.id)
      LEFT JOIN rol r ON(u.role_id = r.id)');
      while($p=$query->fetch(PDO::FETCH_ASSOC)){
        $item = new userModel();
        $item->setId($p['id']);
        $item->setName($p['name']);
        $item->setEmail($p['email']);
        $item->setStatus($p['status']);
        $item->setCreatedAt($p['created_at']);
        $item->setModifiedAt($p['modified_at']);
        $item->setGroupName($p['group_name']);
        $item->setRoleName($p['role']);
        array_push($items,$item);
      }
      
      return $items;

    }catch(PDOException $e){
      error_log('userModel::getAll->PDOException '.$e);
      return false;
    }
  }

  public function getAllByGroupId($id){
    try{
      $items = [];
      $query=$this->prepare('SELECT * FROM user WHERE group_id = ?');
      $query->bindParam(1, $id);
      $query->execute();
      while($p=$query->fetch(PDO::FETCH_ASSOC)){
        $item = new userModel();
        $item->from($p);
        array_push($items,$item);
      }
      
      return $items;

    }catch(PDOException $e){
      error_log('userModel::getAll->PDOException '.$e);
      return false;
    }
  }

  public function get($id){
    try{
      $query=$this->prepare('SELECT * FROM user WHERE id=:id');
      $query->execute([
        'id'=>$id
      ]);
      
      $user=$query->fetch(PDO::FETCH_ASSOC);
      $this->from($user);
      return $this;

    }catch(PDOException $e){
      error_log('userModel::getId->PDOException '.$e);
      return false;
    }
  }

  public function delete($id){
    try{
      $query=$this->prepare('DELETE FROM usuario WHERE id=:id');
      $query->execute([
        'id'=>$id
      ]);

      return true;
    }catch(PDOException $e){
      error_log('userModel::delete->PDOException '.$e);
      return false;
    }
  }

  public function update(){
    try{
      $query=$this->prepare('UPDATE user SET name=?, email=?, password=?, status=?, group_id=?, role_id=?, modified_at=? WHERE id=:id');
      $query->bindParam(1, $this->name);
      $query->bindParam(2, $this->email);
      $query->bindParam(3, $this->password);
      $query->bindParam(4, $this->status);
      $query->bindParam(5, $this->groupId);
      $query->bindParam(6, $this->roleId);
      $query->bindParam(7, $this->modifiedAt);
      $query->bindParam(8, $this->id);
      $query->execute();
      return true;

    }catch(PDOException $e){
      error_log('userModel::udpate->PDOException '.$e);
      return false;
    }
  }

  public function updatePassword(){
    try{
      $query=$this->prepare('UPDATE usuario SET password=:password WHERE id=:id');
      $query->execute([
        'id'=>$this->id,
        'password'=>$this->password
      ]);
      return true;
    }catch(PDOException $e){
      error_log('userModel::udpatePassword->PDOException '.$e);
      return false;
    }
  }

  public function from($array){
    $this->id = $array['id'];
    $this->name = $array['name'];
    $this->email = $array['email'];
    $this->password = $array['password'];
    $this->status = $array['status'];
    $this->groupId = $array['group_id'];
    $this->roleId = $array['role_id'];
    $this->createdAt = $array['created_at'];
    $this->modifiedAt = $array['modified_at'];
  }

  public function exists($email){
    try{
      $query=$this->prepare('SELECT email FROM user WHERE email=:email');
      $query->execute([
        'email'=>$email
      ]);
      if($query->rowCount()>0){
        return true;
      }else{
        return false;
      }
    }catch(PDOException $e){
      error_log('userModel::exists->PDOException '.$e);
      return false;
    }
  }

  public function verifyPassword($password, $id){
    try{
      $user =$this->get($id);
      return password_verify($password, $user->getPassword());
    }catch(PDOException $e){
      error_log('userModel::verifyPassword->PDOException '.$e);
      return false;
    }
  }

  function comparePasswords($current, $userid){
    try{
      $query = $this->db->connect()->prepare('SELECT id, password FROM usuario WHERE id = :id');
      $query->execute(['id' => $userid]);
      
      if($row = $query->fetch(PDO::FETCH_ASSOC)){
        return password_verify($current, $row['password']);
      }else{
        return NULL;
      }
    }catch(PDOException $e){
      return NULL;
    }
  }

  public function generatePassword($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }

  private function getHashPassword($password){
    return password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]);
  }

  private function getUpperCase($string){
    return strtoupper($string);
  }

  private function getLowerCase($string){
    return strtolower($string);
  }
  
  public function getId(){
    return $this->id;
  }

  public function setId($id){
    $this->id=$id;
  }

  public function getEmail(){
    return $this->email;
  }
  
  public function setEmail($email){
    $this->email=$this->getLowerCase($email);
  }

  public function getName(){
    return $this->name;
  }

  public function setName($name){
    $this->name=$this->getUpperCase($name);
  }

  public function getPassword(){
    return $this->password;
  }

  public function setPassword($password){
    $this->password=$this->getHashPassword($password);
  }

  public function getStatus(){
    return $this->status;
  }
  
  public function setStatus($status){
    $this->status=$status;
  }

  public function getGroupId(){
    return $this->groupId;
  }

  public function setGroupId($groupId){
    $this->groupId=$groupId;
  }

  public function getGroupName(){
    return $this->groupName;
  }

  public function setGroupName($groupName){
    $this->groupName=$groupName;
  }

  public function getRoleId(){
    return $this->roleId;
  }
  
  public function setRoleId($roleId){
    $this->roleId=$roleId;
  }

  public function getRoleName(){
    return $this->roleName;
  }

  public function setRoleName($roleName){
    $this->roleName=$roleName;
  }

  public function getCreatedAt(){
    return $this->createdAt;
  }
  
  public function setCreatedAt($createdAt){
    $this->createdAt=$createdAt;
  }

  public function getModifiedAt(){
    return $this->modifiedAt;
  }
  
  public function setModifiedAt($modifiedAt){
    $this->modifiedAt=$modifiedAt;
  }

 
}

?>