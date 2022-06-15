<?php

class HandbookModel extends Model implements IModel{

  private $id;
  private $title;
  private $url;
  private $category;
  private $subcategory;
  private $subcategoryId;
  private $createdAt;

  public function __construct(){
    parent::__construct();
    $this->title='';
    $this->url='';
    $this->subcategoryId='';
    $this->createdAt='';
  }

  public function save(){
    try{
      $db = $this->db->connect();
      $query=$db->prepare('INSERT INTO handbook(title, url, subcategory_id, created_at) values(?,?,?,?)');
      $query->bindParam(1, $this->title);
      $query->bindParam(2, $this->url);
      $query->bindParam(3, $this->subcategoryId);
      $query->bindParam(4, $this->createdAt);
      $query->execute();
      $this->id = $db->lastInsertId();
      return true;
    }catch(PDOException $e){
      error_log('handbookModel::save->PDOException '.$e);
      return false;
    }
  }

  public function getAll(){
    try{
      $items = [];
      $query=$this->query('SELECT * FROM handbook h
      LEFT JOIN subcategory s ON h.subcategory_id = s.id
      LEFT JOIN category c ON s.category_id = c.id
      ORDER BY h.id DESC');
      while($p=$query->fetch(PDO::FETCH_ASSOC)){
        $item = new HandbookModel();
        $item->from($p);
        array_push($items,$item);
      }
      return $items;
    }catch(PDOException $e){
      error_log('handbookModel::getAll->PDOException '.$e);
      return false;
    }
  }

  public function get($id){
    try{
      $query=$this->query('SELECT * FROM handbook WHERE id='.$id);
      $p=$query->fetch(PDO::FETCH_ASSOC);
      $item = new HandbookModel();
      $item->from($p);
      return $item;
    }catch(PDOException $e){
      error_log('handbookModel::get->PDOException '.$e);
      return false;
    }
  }

  public function update(){
    try{
      $query=$this->prepare('UPDATE handbook SET title=?, url=?, subcategory=?, created_at=? WHERE id=?');
      $query->bindParam(1, $this->title);
      $query->bindParam(2, $this->url);
      $query->bindParam(3, $this->subcategoryId);
      $query->bindParam(4, $this->createdAt);
      $query->bindParam(5, $this->id);
      $query->execute();
      return true;
    }catch(PDOException $e){
      error_log('handbookModel::update->PDOException '.$e);
      return false;
    }
  }

  public function delete($id){
    try{
      $query=$this->prepare('DELETE FROM handbook WHERE id='.$id);
      $query->execute();
      return true;
    }catch(PDOException $e){
      error_log('handbookModel::delete->PDOException '.$e);
      return false;
    }
  }

  public function updateFileUrl(){
		try{
			$query=$this->prepare('UPDATE handbook SET url=? WHERE id=?');
			$query->bindParam(1, $this->url);
			$query->bindParam(2, $this->id);
			$query->execute();
			return true;
		}catch(PDOException $e){
			error_log('handbookModel::updateFileUrl->PDOException '.$e);
			return false;
		}
	}

  public function from($array){
    $this->id=$array['id'];
    $this->title=$array['title'];
    $this->url=$array['url'];
    $this->category=$array['category'];
    $this->subcategory=$array['subcategory'];
    $this->subcategoryId=$array['subcategory_id'];
    $this->createdAt=$array['created_at'];
  }

  /**
   * @return mixed
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @param mixed $id
   */
  public function setId($id): void
  {
    $this->id = $id;
  }

  /**
   * @return string
   */
  public function getTitle(): string
  {
    return $this->title;
  }

  /**
   * @param string $title
   */
  public function setTitle(string $title): void
  {
    $this->title = $title;
  }

  /**
   * @return string
   */
  public function getUrl(): string
  {
    return $this->url;
  }

  /**
   * @param string $url
   */
  public function setUrl(string $url): void
  {
    $this->url = $url;
  }

  /**
   * @return mixed
   */
  public function getCategory()
  {
    return $this->category;
  }

  /**
   * @param mixed $category
   */
  public function setCategory($category): void
  {
    $this->category = $category;
  }

  /**
   * @return mixed
   */
  public function getSubcategory()
  {
    return $this->subcategory;
  }

  /**
   * @param mixed $subcategory
   */
  public function setSubcategory($subcategory): void
  {
    $this->subcategory = $subcategory;
  }

  /**
   * @return string
   */
  public function getSubcategoryId(): string
  {
    return $this->subcategoryId;
  }

  /**
   * @param string $subcategoryId
   */
  public function setSubcategoryId(string $subcategoryId): void
  {
    $this->subcategoryId = $subcategoryId;
  }

  /**
   * @return string
   */
  public function getCreatedAt(): string
  {
    return $this->createdAt;
  }

  /**
   * @param string $createdAt
   */
  public function setCreatedAt(string $createdAt): void
  {
    $this->createdAt = $createdAt;
  }


  
}