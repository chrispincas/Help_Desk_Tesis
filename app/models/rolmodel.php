<?php

class RolModel extends Model implements IModel{

	private $id;
	private $rol;

	public function __construct(){
		parent::__construct();
		$rol = "";
	}

	public function save(){
		try{
			$query=$this->prepare('INSERT INTO rol(role) values(?)');
			$query->bindParam(1, $this->rol);
			$query->execute();
			return true;
		}catch(PDOException $e){
			error_log('rolModel::save->PDOException '.$e);
			return false;
		}
	}

	public function get($id){
		try{
			$query=$this->prepare('SELECT * FROM rol WHERE id=?');
			$query->bindParam(1, $id);
			$query->execute();
			$rol=$query->fetch(PDO::FETCH_ASSOC);
			$this->from($rol);
			return $this;
		}catch(PDOException $e){
			error_log('rolModel::get->PDOException '.$e);
			return false;
		}
	}

	public function getAll(){
		try{
			$items = [];
			$query=$this->query('SELECT * FROM rol');
			while($rol=$query->fetch(PDO::FETCH_ASSOC)){
				$item = new RolModel();
				$item->from($rol);
				array_push($items,$item);
			}
			return $items;
		}catch(PDOException $e){
			error_log('rolModel::getAll->PDOException '.$e);
			return false;
		}
	}

	public function update(){
		try{
			$query=$this->prepare('UPDATE rol SET role=? WHERE id=?');
			$query->bindParam(1, $this->rol);
			$query->bindParam(2, $this->id);
			$query->execute();
			return true;
		}catch(PDOException $e){
			error_log('rolModel::update->PDOException '.$e);
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
			error_log('rolModel::delete->PDOException '.$e);
			return false;
		}
	}

	public function from($rol){
		$this->id = $rol['id'];
		$this->rol = $rol['role'];
	}

	public function setId($id){
		$this->id=$id;
	}
	
	public function getId(){
		return $this->id;
	}

	public function setRol($rol){
		$this->rol=$rol;
	}
	
	public function getRol(){
		return $this->rol;
	}

}

?>