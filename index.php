<?php 

	require 'config.php';

	//var_dump($GLOBALS['view_file_path']);

	$directoryURI = $_SERVER['REQUEST_URI'];
	$path = parse_url($directoryURI, PHP_URL_PATH);

	$components = explode('/', $path);

	/*var_dump($components);
	die();*/

	$router = $components[2];

	//var_dump($router);

	//Category Controller
	require $GLOBALS['controller_file_path']."Category_ctrl.php";

	$category = new Category_ctrl();


	//Brand Controller
	require $GLOBALS['controller_file_path']."Brand_ctrl.php";

	$brand = new Brand_ctrl();


	//Subcategory Controller
	require $GLOBALS['controller_file_path']."Subcategory_ctrl.php";

	$subcategory = new Subcategory_ctrl();


	//Item Controller
	require $GLOBALS['controller_file_path']."Item_ctrl.php";

	$item = new Item_ctrl();




	//Category
	if ($router == 'category_list') {
		//http://localhost/onlineshopping/category_list

		/*var_dump($category->read());
		die();*/
		$categories = $category->read();

		require $GLOBALS['view_file_path']."category_list.php";
	}
	elseif ($router == 'category_new'){
		require $GLOBALS['view_file_path']."category_new.php";
	}
	elseif ($router == 'category_add'){
		$category->insert();
	}
	elseif ($router == 'category_edit') {
		$id = $_GET['id'];

		$categoryedit = $category->edit($id);

		require $GLOBALS['view_file_path']."category_edit.php";
	}
	elseif ($router == 'category_update') {
		$category->update();
	}
	elseif ($router == 'category_delete') {
		$id = $_POST['id'];

		$category->delete($id);
	}


	//Brand
	elseif ($router == 'brand_list') {
		
		$brands = $brand->read();

		require $GLOBALS['view_file_path']."brand_list.php";

	}
	elseif ($router == 'brand_new') {
		require $GLOBALS['view_file_path']."brand_new.php";
	}
	elseif ($router == 'brand_add') {
		$brand->insert();
	}
	elseif ($router == 'brand_edit') {


		$id = $_GET['id'];

		$brandedit = $brand->edit($id);

		require $GLOBALS['view_file_path']."brand_edit.php";
	}
	elseif ($router == 'brand_update') {
		$brand->update();
	}
	elseif ($router == 'brand_delete') {
		$id = $_POST['id'];

		$brand->delete($id);
	}



	//Subcategory
	elseif ($router == 'subcategory_list') {
		$subcategories = $subcategory->read();

		require $GLOBALS['view_file_path']."subcategory_list.php";
	}
	elseif ($router == 'subcategory_new') {
		$categories = $category->read();
		require $GLOBALS['view_file_path']."subcategory_new.php";
	}
	elseif ($router == 'subcategory_add') {
		$subcategory->insert();
	}
	elseif ($router == 'subcategory_edit') {
		$categories = $category->read();

		$id = $_GET['id'];

		$subcategoryedit = $subcategory->edit($id);

		require $GLOBALS['view_file_path']."subcategory_edit.php";
	}
	elseif ($router == 'subcategory_update') {
		$subcategory->update();
	}
	elseif ($router == 'subcategory_delete') {
		$id = $_POST['id'];

		$subcategory->delete($id);
	}



	//Item
	elseif ($router == 'item_list') {
		$items = $item->read();

		require $GLOBALS['view_file_path']."item_list.php";
	}
	elseif ($router == 'item_new') {
		$brands = $brand->read();
		$subcategories = $subcategory->read();
		require $GLOBALS['view_file_path']."item_new.php";
	}
	elseif ($router == 'item_add') {
		$item->insert();
	}
	elseif ($router == 'item_edit') {
		$brands = $brand->read();
		$subcategories = $subcategory->read();
		$id = $_GET['id'];

		$itemedit = $item->edit($id);

		require $GLOBALS['view_file_path']."item_edit.php";
	}
	elseif ($router == 'item_update') {
		$item->update();
	}
	elseif ($router == 'item_delete') {
		$id = $_POST['id'];

		$item->delete($id);
	}

	elseif ($router == '') {
		//echo "frontend";
		$brands = $brand->read();
		require $GLOBALS['view_file_path']."home.php";
	}


 ?>