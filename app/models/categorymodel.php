<?php

class CategoryModel extends Model implements IModel{

	private $id;
	private $category;

	public function __construct(){
		parent::__construct();
		$this->category = "";
	}

	public function save(){
		try{
			$query=$this->prepare('INSERT INTO category(category) values(?)');
			$query->bindParam(1, $this->category);
			$query->execute();
			return true;
		}catch(PDOException $e){
			error_log('categoryModel::save->PDOException '.$e);
			return false;
		}
	}

	public function get($id){
		try{
			$query=$this->prepare('SELECT * FROM category WHERE id=?');
			$query->bindParam(1, $id);
			$query->execute();
			$p=$query->fetch(PDO::FETCH_ASSOC);
			$this->setId($p['id']);
			$this->setCategory($p['category']);
			return $this;
		}catch(PDOException $e){
			error_log('categoryModel::get->PDOException '.$e);
			return false;
		}
	}

	public function getAll(){
		try{
			$items = [];
			$query=$this->query('SELECT * FROM category');
			while($p=$query->fetch(PDO::FETCH_ASSOC)){
				$item = new categoryModel();
				$item->setId($p['id']);
				$item->setCategory($p['category']);
				array_push($items,$item);
			}
			return $items;
		}catch(PDOException $e){
			error_log('categoryModel::getAll->PDOException '.$e);
			return false;
		}
	}

	public function update(){
		try{
			$query=$this->prepare('UPDATE category SET category=? WHERE id=?');
			$query->bindParam(1, $this->category);
			$query->bindParam(2, $this->id);
			$query->execute();
			return true;
		}catch(PDOException $e){
			error_log('categoryModel::update->PDOException '.$e);
			return false;
		}
	}

	public function delete($id){
		try{
			$query=$this->prepare('DELETE FROM category WHERE id=?');
			$query->bindParam(1, $id);
			$query->execute();
			return true;
		}catch(PDOException $e){
			error_log('categoryModel::delete->PDOException '.$e);
			return false;
		}
	}

	public function from($data){
		$this->setId($data['id']);
		$this->setCategory($data['category']);
	}

	public function setId($id){
		$this->id=$id;
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function setCategory($category){
		$this->category=$category;
	}
	
	public function getCategory(){
		return $this->category;
	}
}

?>