<?php
	function insert_food(){
		global $con;
		mysqli_query($con, "INSERT INTO healthyfood SET product_name = '" . addslashes($_POST['product_name']) . "',  brands = '" . addslashes($_POST['brands']) . "', countries_en = '" . addslashes($_POST['countries_en']) . "', ingredients_text = '" . addslashes($_POST['ingredients_text']) . "', serving_size = '" . addslashes($_POST['serving_size']) . "', additives = '" . addslashes($_POST['additives']) . "', fat_100g = '" . (float)$_POST['fat_100g'] . "', cholesterol_100g = '" . (float)$_POST['cholesterol_100g'] . "', carbohydrates_100g = '" . (float)$_POST['carbohydrates_100g'] . "', sodium_100g = '" . (float)$_POST['sodium_100g'] . "', vitamin_c_100g = '" . (int)$_POST['vitamin_c_100g'] . "', calcium_100g = '" . (float)$_POST['calcium_100g'] . "'");
	}

	function update_food($id){
		global $con;
		mysqli_query($con, "UPDATE healthyfood SET product_name = '" . addslashes($_POST['product_name']) . "',  brands = '" . addslashes($_POST['brands']) . "', countries_en = '" . addslashes($_POST['countries_en']) . "', ingredients_text = '" . addslashes($_POST['ingredients_text']) . "', serving_size = '" . addslashes($_POST['serving_size']) . "', additives = '" . addslashes($_POST['additives']) . "', fat_100g = '" . (float)$_POST['fat_100g'] . "', cholesterol_100g = '" . (float)$_POST['cholesterol_100g'] . "', carbohydrates_100g = '" . (float)$_POST['carbohydrates_100g'] . "', sodium_100g = '" . (float)$_POST['sodium_100g'] . "', vitamin_c_100g = '" . (float)$_POST['vitamin_c_100g'] . "', calcium_100g = '" . (float)$_POST['calcium_100g'] . "' where product_ID = '".(int)$id."'");
	}

	function get_foods_edit($id=''){
		global $con;
		$all_courses = mysqli_query($con, "SELECT * FROM healthyfood where product_ID='".(int)$id."' order by product_ID");
		$arr_csdata = array();

		if (mysqli_num_rows($all_courses) > 0){
			while($cdata = mysqli_fetch_array($all_courses, MYSQLI_ASSOC)) { 
				
				$arr_csdata[] = array('id' => $cdata['product_ID'],
						   'product_name' => stripslashes($cdata['product_name']),
						   'brands' => stripslashes($cdata['brands']),
						   'countries_en' => stripslashes($cdata['countries_en']),
						   'ingredients_text' => stripslashes($cdata['ingredients_text']),
						   'serving_size' => stripslashes($cdata['serving_size']),
						   'additives' => stripslashes($cdata['additives']),
						   'fat_100g' => $cdata['fat_100g'],
						   'cholesterol_100g' => $cdata['cholesterol_100g'],
						   'carbohydrates_100g' => $cdata['carbohydrates_100g'],
						   'sodium_100g' => $cdata['sodium_100g'],
						   'vitamin_c_100g' => $cdata['vitamin_c_100g'],
						   'calcium_100g' => $cdata['calcium_100g']);
			}
		}
		return $arr_csdata;
	}

	function delete_food($id=''){
		global $con;
		mysqli_query($con, "DELETE FROM healthyfood where product_ID='".(int)$id."'");
	}

	function redirect($url, $permanent = false){
		header('Location: ' . $url, true, $permanent ? 301 : 302);
		exit();
	}

	function get_params($exclude_array = '') {
		global $con, $_GET;

		if (!is_array($exclude_array)) $exclude_array = array();

		$get_url = '';
		if (is_array($_GET) && (sizeof($_GET) > 0)) {
			reset($_GET);
			while (list($key, $value) = each($_GET)) {
				if ( is_string($value) && (strlen($value) > 0) && ($key != 'error') && (!in_array($key, $exclude_array)) && ($key != 'x') && ($key != 'y') ) {
					$get_url .= $key . '=' . rawurlencode(stripslashes($value)) . '&';
				}
			}
		}
		return substr($get_url, 0, -1);
	}
?>