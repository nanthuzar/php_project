<?php 
	/**
	 * 
	 */
	class Item_mdl
	{
		protected $pdo;
		function __construct()
		{
			
			require $GLOBALS['database_path'];
			$this->pdo = $pdo;
		}
		function getall(){
			
			$sql = "SELECT items. *,brands.id as bid, brands.name as bname,subcategories.id as sid,subcategories.name as sname from items LEFT join brands on items.brand_id = brands.id LEFT JOIN subcategories on items.subcategory_id=subcategories.id";
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute();
			$rows = $stmt->fetchAll();
			/*var_dump($rows);
			die();*/

			return $rows;
		}

		function insert_data($data){
			$sql = "INSERT INTO items (name, photo, price, description, brand_id, subcategory_id) VALUES (:v1, :v2, :v3, :v4, :v5, :v6)";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindParam(':v1', $data['name']);
			$stmt->bindParam(':v2', $data['photo']);
			$stmt->bindParam(':v3', $data['price']);
			//$stmt->bindParam(':v3', $data['discount']);
			$stmt->bindParam(':v4', $data['description']);
			$stmt->bindParam(':v5', $data['brandid']);
			$stmt->bindParam(':v6', $data['subcategoryid']);
			//$stmt->bindParam(':v2', $data['categoryid']);
			$stmt->execute();

			$row = $stmt->rowCount();

			return $row;
		}

		function edit_data($id){
			$sql = "SELECT * FROM items WHERE id=:v1";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindParam(':v1', $id);
			$stmt->execute();

			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			/*var_dump($row);
			die();*/
			return $row;
		}

		function update_data($id,$data){
			$sql = "UPDATE items SET name=:v1, photo=:v2, price=:v3, description=:v4, brand_id=:v5, subcategory_id=:v6 WHERE id=:v7";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindParam(':v1', $data['name']);
			$stmt->bindParam(':v2', $data['photo']);
			$stmt->bindParam(':v3', $data['price']);
			$stmt->bindParam(':v4', $data['description']);
			$stmt->bindParam(':v5', $data['brandid']);
			$stmt->bindParam(':v6', $data['subcategoryid']);
			//$stmt->bindParam(':v5', $data['photo']);
			$stmt->bindParam(':v7', $id);
			$stmt->execute();

			$row = $stmt->rowCount();

			return $row;
		}

		function delete_data($id){
			$sql = "DELETE FROM items WHERE id=:v1";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindParam(':v1', $id);
			$stmt->execute();

			$row = $stmt->rowCount();

			return $row;
		}
	}

 ?>