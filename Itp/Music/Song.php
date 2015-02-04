<?php

namespace Itp\Music;

use \Itp\Base\Database;

class Song extends Database {

	private $title, $artist_id, $genre_id, $price, $id;

	public function __construct(){
		parent::__construct();
	}

	public function setTitle($title){
		$this->title = $title;
	}

	public function setArtistId($id){
		$this->artist_id = $id;
	}

	public function setGenreId($genre_id){
		$this->genre_id = $genre_id;
	}
	
	public function setPrice($price){
		$this->price = $price;
	}

	public function save(){
		
		$sql = "
			INSERT INTO songs (title, artist_id, genre_id, price)
			VALUES (?,?,?,?)
		";
		$statement = static::$pdo->prepare($sql);
		$statement->bindParam(1, $this->title);
		$statement->bindParam(2, $this->artist_id);
		$statement->bindParam(3, $this->genre_id);
		$statement->bindParam(4, $this->price);
		$statement->execute();
		$this->id = static::$pdo->lastInsertId("id");

	}

	public function getTitle(){
		return $this->title;
	}

	public function getId(){

		return $this->id;
	}

}

?>