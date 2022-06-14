<?php

class RoleModel extends Model implements IModel{

	private $id;
	private $role;

	public function __construct(){
		parent::__construct();
		$this->role='';
	}

	public function save(){
		try{
			$query=$this->prepare('INSERT INTO rol(role) values(?)');
			$query->bindParam(1, $this->role);
			$query->execute();
			return true;
		}catch(PDOException $e){
			error_log('roleModel::save->PDOException '.$e);
			return false;
		}
	}

	public function get($id){
		try{
			$query=$this->prepare('SELECT * FROM rol WHERE id=?');
			$query->bindParam(1, $id);
			$query->execute();
			$p=$query->fetch(PDO::FETCH_ASSOC);
			$this->setId($p['id']);
			$this->setRole($p['role']);
			return $this;
		}catch(PDOException $e){
			error_log('roleModel::get->PDOException '.$e);
			return false;
		}
	}

	public function getAll(){
		try{
			$items = [];
			$query=$this->query('SELECT * FROM rol');
			while($p=$query->fetch(PDO::FETCH_ASSOC)){
				$item = new roleModel();
				$item->setId($p['id']);
				$item->setRole($p['role']);
				array_push($items,$item);
			}
			return $items;
		}catch(PDOException $e){
			error_log('roleModel::getAll->PDOException '.$e);
			return false;
		}
	}

	public function update(){
		try{
			$query=$this->prepare('UPDATE rol SET role=? WHERE id=?');
			$query->bindParam(1, $this->role);
			$query->bindParam(2, $this->role);
			$query->execute();
			return true;
		}catch(PDOException $e){
			error_log('roleModel::update->PDOException '.$e);
			return false;
		}
	}

	public function delete($id){
		try{
			$query=$this->prepare('DELETE FROM rol WHERE id=?');
			$query->bindParam(1, $id);
			$query->execute();
			return true;
		}catch(PDOException $e){
			error_log('roleModel::delete->PDOException '.$e);
			return false;
		}
	}

	public function from($data){
		$this->id=$data['id'];
		$this->role=$data['role'];
	}

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id=$id;
	}

	public function getRole(){
		return $this->role;
	}

	public function setRole($role){
		$this->role=$role;
	}

}

?>