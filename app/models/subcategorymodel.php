<?php

class SubcategoryModel extends Model implements IModel{

	private $id;
	private $subcategory;
	private $categoryId;

	public function __construct(){
		parent::__construct();
		$subcategory = "";
		$categoryId = 0;
	}

	public function save(){
		try{
			$query=$this->prepare('INSERT INTO subcategory(subcategory, category_id) values(?, ?)');
			$query->bindParam(1, $this->subcategory);
			$query->bindParam(2, $this->categoryId);
			$query->execute();
			return true;
		}catch(PDOException $e){
			error_log('subcategoryModel::save->PDOException '.$e);
			return false;
		}
	}

	public function get($id){
		try{
			$query=$this->prepare('SELECT * FROM subcategory WHERE id=?');
			$query->bindParam(1, $id);
			$query->execute();
			$subcategory=$query->fetch(PDO::FETCH_ASSOC);
			$this->from($subcategory);
			return $this;
		}catch(PDOException $e){
			error_log('subcategoryModel::get->PDOException '.$e);
			return false;
		}
	}

	public function getAll(){
		try{
			$items = [];
			$query=$this->query('SELECT * FROM subcategory');
			while($subcategory=$query->fetch(PDO::FETCH_ASSOC)){
				$item = new SubcategoryModel();
				$item->from($subcategory);
				array_push($items,$item);
			}
			return $items;
		}catch(PDOException $e){
			error_log('subcategoryModel::getAll->PDOException '.$e);
			return false;
		}
	}

	public function getAllByCategory($id){
		$id = $_POST['categoryId'];
		try{
			$items = [];
			$query=$this->prepare('SELECT * FROM subcategory WHERE category_id=:categoryId');
			$query->bindParam(':categoryId', $id);
			$query->execute();
			while($subcategory=$query->fetch(PDO::FETCH_ASSOC)){
				$item = new SubcategoryModel();
				$item->from($subcategory);
				array_push($items,$item);
			}
			return $items;
		}catch(PDOException $e){
			error_log('subcategoryModel::getAll->PDOException '.$e);
			return false;
		}
	}

	public function update(){
		try{
			$query=$this->prepare('UPDATE subcategory SET subcategory=?, category_id=? WHERE id=?');
			$query->bindParam(1, $this->subcategory);
			$query->bindParam(2, $this->categoryId);
			$query->bindParam(3, $this->id);
			$query->execute();
			return true;
		}catch(PDOException $e){
			error_log('subcategoryModel::update->PDOException '.$e);
			return false;
		}
	}

	public function from($array){
		$this->setId($array['id']);
		$this->setSubcategory($array['subcategory']);
		$this->setCategoryId($array['category_id']);
	}

	public function delete($id){
		try{
			$query=$this->prepare('DELETE FROM subcategory WHERE id=?');
			$query->bindParam(1, $id);
			$query->execute();
			return true;
		}catch(PDOException $e){
			error_log('subcategoryModel::delete->PDOException '.$e);
			return false;
		}
	}

	public function setId($id){
		$this->id=$id;
	}
	
	public function getId(){
		return $this->id;
	}

	public function setSubcategory($subcategory){
		$this->subcategory=$subcategory;
	}
	
	public function getSubcategory(){
		return $this->subcategory;
	}

	public function setCategoryId($categoryId){
		$this->categoryId=$categoryId;
	}
	
	public function getCategoryId(){
		return $this->categoryId;
	}

}

?>