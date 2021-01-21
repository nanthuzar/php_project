<?php 

	/**
	 * 
	 */
	class Item_ctrl
	{
		
		function __construct()
		{
			require $GLOBALS['model_file_path']."Item_mdl.php";
		}

		function read(){
			$item_mdl = new Item_mdl();
			$getallresults = $item_mdl->getall();

			return $getallresults;
		}

		function insert(){
			
			$name = $_POST['name'];

			$photo = $_FILES['photo'];
			// var_dump($photo);
			// die();
			
			$source_dir = $GLOBALS['file_path'].'storage/item/';

			$fullpath = $source_dir.$photo['name'];
			move_uploaded_file($photo['tmp_name'], $fullpath);

			$uploadpath = 'storage/item/'.$photo['name'];
			$brandid = $_POST['brandid'];
			$price = $_POST['price'];
			$subcategoryid = $_POST['subcategoryid'];
			$description = $_POST['description'];
			
			//$categoryid = $_POST['categoryid'];
			

			$data = array(

				'photo' => $uploadpath,
				'name'=> $name,
				'brandid' => $brandid,
				'price' => $price,
				'subcategoryid' => $subcategoryid,
				'description' => $description		
			);

			$item_mdl = new Item_mdl();

			$addresult = $item_mdl->insert_data($data);

			$url = $GLOBALS['view_path'].'item_list';
			header('location: '.$url);
		}

		function edit($id){
			$item_mdl = new Item_mdl();
			$getresult = $item_mdl->edit_data($id);
			
			return $getresult;
		}

		function update(){
			$id = $_POST['id'];
			$name = $_POST['name'];
			$price = $_POST['price'];
			$description = $_POST['description'];
			$brandid = $_POST['brandid'];
			$subcategoryid = $_POST['subcategoryid'];

			$oldphoto = $_POST['oldphoto'];
			$newphoto = $_FILES['photo'];

			if ($newphoto['size'] > 0) {
			
			$source_dir = $GLOBALS['file_path'].'storage/item/';

			$fullpath = $source_dir.$newphoto['name'];
			move_uploaded_file($newphoto['tmp_name'], $fullpath);

			$uploadpath = 'storage/item/'.$newphoto['name'];
			}else{
				$uploadpath = $oldphoto;
			}


			$data = array(
				'name' => $name,
				'photo' => $uploadpath,
				'price' => $price,
				'description' => $description,
				'brandid' => $brandid,
				'subcategoryid' => $subcategoryid

			);

			$item_mdl = new Item_mdl();

			$update_result = $item_mdl->update_data($id, $data);

			$url = $GLOBALS['view_path'].'item_list';
			header('location:'.$url);
		}

		function delete($id){
			$item_mdl = new Item_mdl();
			$item_mdl->delete_data($id);
			$url = $GLOBALS['view_path'].'item_list';
			header('location:'.$url);
		}

	}

 ?>