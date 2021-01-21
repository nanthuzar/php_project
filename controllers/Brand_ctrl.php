<?php 

	class Brand_ctrl
	{
		
		function __construct()
		{
			require $GLOBALS['model_file_path']."Brand_mdl.php";
		}

		function read(){

			$brand_mdl = new Brand_mdl();
			$getallresults = $brand_mdl->getall();

			return $getallresults;
		}

		function insert(){

			$name = $_POST['name'];
			$photo = $_FILES['photo'];

			$source_dir = $GLOBALS['file_path'].'storage/brand/';

			$fullpath = $source_dir.$photo['name'];
			move_uploaded_file($photo['tmp_name'], $fullpath);

			$uploadpath = 'storage/brand/'.$photo['name'];

			$data = array(
				'name' => $name,
				'photo' => $uploadpath
			);

			/*var_dump($data);
			die();*/

			$brand_mdl = new Brand_mdl();

			$addresult = $brand_mdl->insert_data($data);

			$url = $GLOBALS['view_path'].'brand_list';

			header('location:'.$url);
		}

		function edit($id){
			$brand_mdl = new Brand_mdl();
			$getresult = $brand_mdl->edit_data($id);
			
			return $getresult;
		}

		function update(){
			$id = $_POST['id'];
			$name = $_POST['name'];

			$oldphoto = $_POST['oldphoto'];
			$newphoto = $_FILES['photo'];

			if ($newphoto['size'] > 0) {
			
			$source_dir = $GLOBALS['file_path'].'storage/brand/';

			$fullpath = $source_dir.$newphoto['name'];
			move_uploaded_file($newphoto['tmp_name'], $fullpath);

			$uploadpath = 'storage/brand/'.$newphoto['name'];
			}else{
				$uploadpath = $oldphoto;
			}

			$data = array(
				'name' => $name,
				'photo' => $uploadpath
			);

			$brand_mdl = new Brand_mdl();

			$update_result = $brand_mdl->update_data($id, $data);

			$url = $GLOBALS['view_path'].'brand_list';
			header('location:'.$url);
		}

		function delete($id){
			$brand_mdl = new Brand_mdl();
			$brand_mdl->delete_data($id);
			$url = $GLOBALS['view_path'].'brand_list';
			header('location:'.$url);
		}
	}





 ?>