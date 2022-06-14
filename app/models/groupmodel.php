<?php

class GroupModel extends Model implements IModel{
	
	private $id;
	private $group;

	public function __construct(){
		parent::__construct();
		$group = "";
	}

	public function save(){
		try{
			$query=$this->prepare('INSERT INTO group_user(group_name) values(?)');
			$query->bindParam(1, $this->group);
			$query->execute();
			return true;
		}catch(PDOException $e){
			error_log('groupModel::save->PDOException '.$e);
			return false;
		}
	}

	public function get($id){
		try{
			$query=$this->prepare('SELECT * FROM group_user WHERE id=?');
			$query->bindParam(1, $id);
			$query->execute();
			$group=$query->fetch(PDO::FETCH_ASSOC);
			$this->from($group);
			return $this;
		}catch(PDOException $e){
			error_log('groupModel::get->PDOException '.$e);
			return false;
		}
	}

	public function getAll(){
		try{
			$items = [];
			$query=$this->query('SELECT * FROM group_user');
			while($group=$query->fetch(PDO::FETCH_ASSOC)){
				$item = new GroupModel();
				$item->from($group);
				array_push($items,$item);
			}
			return $items;
		}catch(PDOException $e){
			error_log('groupModel::getAll->PDOException '.$e);
			return false;
		}
	}

	public function update(){
		try{
			$query=$this->prepare('UPDATE group_user SET group_name=? WHERE id=?');
			$query->bindParam(1, $this->group);
			$query->bindParam(2, $this->id);
			$query->execute();
			return true;
		}catch(PDOException $e){
			error_log('groupModel::update->PDOException '.$e);
			return false;
		}
	}

	public function delete($id){
		try{
			$query=$this->prepare('DELETE FROM group_user WHERE id=?');
			$query->bindParam(1, $id);
			$query->execute();
			return true;
		}catch(PDOException $e){
			error_log('groupModel::delete->PDOException '.$e);
			return false;
		}
	}

	public function from($id){
		$this->id = $id['id'];
		$this->group = $id['group_name'];
	}

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id=$id;
	}

	public function getGroup(){
		return $this->group;
	}

	public function setGroup($group){
		$this->group=$group;
	}

}

?>