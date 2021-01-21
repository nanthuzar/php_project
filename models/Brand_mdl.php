<?php 

	class Brand_mdl
	{
		protected $pdo;

		function __construct()
		{
			require $GLOBALS['database_path'];

			$this->pdo =$pdo;
		}

		function getall(){

			$sql = "SELECT * FROM brands ORDER BY name ASC";

			$stmt = $this->pdo->prepare($sql);

			$stmt->execute();

			$rows = $stmt->fetchAll();

			return $rows;
		}

		function insert_data($data){

			$sql = "INSERT INTO brands (name,logo) VALUES (:v1, :v2)";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindParam(':v1', $data['name']);
			$stmt->bindParam(':v2', $data['photo']);
			$stmt->execute();

			$rows = $stmt->rowCount();

			return $rows;
		}

		function edit_data($id){
			$sql = "SELECT * FROM brands WHERE id=:v1";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindParam(':v1', $id);
			$stmt->execute();

			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			return $row;
		}

		function update_data($id,$data){
			$sql = "UPDATE brands SET name=:v1, logo=:v2 WHERE id=:v3";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindParam(':v1', $data['name']);
			$stmt->bindParam(':v2', $data['photo']);
			$stmt->bindParam(':v3', $id);
			$stmt->execute();

			$row = $stmt->rowCount();

			return $row;
		}

		function delete_data($id){
			$sql = "DELETE FROM brands WHERE id=:v1";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindParam(':v1', $id);
			$stmt->execute();

			$row = $stmt->rowCount();

			return $row;
		}
	}

 ?>