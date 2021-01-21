<?php 

	class Category_ctrl
	{
		
		function __construct()
		{
			require $GLOBALS['model_file_path']."Category_mdl.php";
		}

		function read(){
			$category_mdl = new Category_mdl();
			$getallresults = $category_mdl->getall();

			return $getallresults;
		}

		function insert(){
			//var_dump("hello");
			$name = $_POST['name'];
			$photo = $_FILES['photo'];
			
			$source_dir = $GLOBALS['file_path'].'storage/category/';

			$fullpath = $source_dir.$photo['name'];
			move_uploaded_file($photo['tmp_name'], $fullpath);

			$uploadpath = 'storage/category/'.$photo['name'];

			$data = array(
				'name' => $name,
				'photo' => $uploadpath
			);
			//var_dump($data);

			$category_mdl = new Category_mdl();

			$addresult = $category_mdl->insert_data($data);

			$url = $GLOBALS['view_path'].'category_list';
			header('location:'.$url);
		}

		function edit($id){
			$category_mdl = new Category_mdl();
			$getresult = $category_mdl->edit_data($id);
			
			return $getresult;
		}

		function update(){
			$id = $_POST['id'];
			$name = $_POST['name'];

			$oldphoto = $_POST['oldphoto'];
			$newphoto = $_FILES['photo'];

			if ($newphoto['size'] > 0) {
			
			$source_dir = $GLOBALS['file_path'].'storage/category/';

			$fullpath = $source_dir.$newphoto['name'];
			move_uploaded_file($newphoto['tmp_name'], $fullpath);

			$uploadpath = 'storage/category/'.$newphoto['name'];
			}else{
				$uploadpath = $oldphoto;
			}

			$data = array(
				'name' => $name,
				'photo' => $uploadpath
			);

			$category_mdl = new Category_mdl();

			$update_result = $category_mdl->update_data($id, $data);

			$url = $GLOBALS['view_path'].'category_list';
			header('location:'.$url);
		}

		function delete($id){
			$category_mdl = new Category_mdl();
			$category_mdl->delete_data($id);
			$url = $GLOBALS['view_path'].'category_list';
			header('location:'.$url);
		}
	}



 ?>