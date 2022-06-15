<?php

class ReportModel extends Model{

	private $count;
	private $field;

	public function __construct(){
		parent::__construct();
		$this->count = 0;
		$this->field = "";
	}

	public function countUsers(){
		try{
			$query=$this->query('SELECT count(id) total FROM user');
			$query->execute();
			$p=$query->fetch(PDO::FETCH_ASSOC);
			$users = new ReportModel();
			$users->setCount($p['total']);
			return $users;
		}catch(PDOException $e){
			error_log('ReportModel::countUsers->PDOException '.$e);
			return false;
		}
	}

	public function countTickets(){
		try{
			$query=$this->query('SELECT count(id) total FROM ticket');
			$query->execute();
			$p=$query->fetch(PDO::FETCH_ASSOC);
			$tickets = new ReportModel();
			$tickets->setCount($p['total']);
			return $tickets;
		}catch(PDOException $e){
			error_log('ReportModel::countTickets->PDOException '.$e);
			return false;
		}
	}

	public function countTicketsGroupByStatus(){
		try{
			$items = [];
			$query=$this->query('SELECT count(t.id) total, ticket_status 
			FROM ticket t
			LEFT JOIN ticket_status ts ON (ts.id=t.ticket_status_id)
			GROUP BY t.ticket_status_id');
			$query->execute();
			while($p=$query->fetch(PDO::FETCH_ASSOC)){
				$item = new ReportModel();
				$item->setCount($p['total']);
				$item->setField($p['ticket_status']);
				array_push($items,$item);
			}
			return $items;
		}catch(PDOException $e){
			error_log('ReportModel::countTicketsGroupByStatus->PDOException '.$e);
			return false;
		}
	}

	public function countTicketsGroupByCategory(){
		try{
			$items = [];
			$query=$this->query('SELECT count(t.id) total, category 
			FROM ticket t
			LEFT JOIN category c ON (c.id=t.category_id)
			GROUP BY t.category_id');
			$query->execute();
			while($p=$query->fetch(PDO::FETCH_ASSOC)){
				$item = new ReportModel();
				$item->setCount($p['total']);
				$item->setField($p['category']);
				array_push($items,$item);
			}
			return $items;
		}catch(PDOException $e){
			error_log('ReportModel::countTicketsGroupByStatus->PDOException '.$e);
			return false;
		}
	}

	public function setCount($count){
		$this->count=$count;
	}
	
	public function getCount(){
		return $this->count;
	}

	public function setField($field){
		$this->field=$field;
	}

	public function getField(){
		return $this->field;
	}
}

?>