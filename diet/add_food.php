<?php
	include("includes/config.php");
	include("includes/functions.php");

	if(isset($_POST['act']) && $_POST['act'] != ''){
		if(isset($_POST['cid']) && $_POST['cid'] != ''){
			update_food($_POST['cid']);
			redirect('index.php?msg=update', false);
		}else{
			$check_exist_qry = mysqli_query($con, "SELECT * FROM healthyfood where product_name = '" . trim(addslashes($_POST['product_name'])) . "'");
			if (mysqli_num_rows($check_exist_qry) > 0){
				$pname =  $_POST['product_name']; 
				$brands =  $_POST['brands']; 
				$countries_en =  $_POST['countries_en']; 
				$ingredients_text =  $_POST['ingredients_text']; 
				$serving_size =  $_POST['serving_size']; 
				$additives =  $_POST['additives']; 
				$fat_100g =  $_POST['fat_100g']; 
				$cholesterol_100g =  $_POST['cholesterol_100g']; 
				$carbohydrates_100g =  $_POST['carbohydrates_100g']; 
				$sodium_100g =  $_POST['sodium_100g']; 
				$vitamin_c_100g =  $_POST['vitamin_c_100g']; 
				$calcium_100g =  $_POST['calcium_100g']; 
				$msg = 'exists';
			}else{
				insert_food();
				redirect('index.php?msg=success', false);
			}
		}
		
	}
	$records = array();
	if(isset($_GET['id']) && $_GET['id'] > 0){
		$records = get_foods_edit((int)$_GET['id']);
		$pname = $records[0]['product_name'];
		$brands = $records[0]['brands'];
		$countries_en = $records[0]['countries_en'];
		$ingredients_text = $records[0]['ingredients_text'];
		$serving_size = $records[0]['serving_size'];
		$additives = $records[0]['additives'];
		$fat_100g = $records[0]['fat_100g'];
		$cholesterol_100g = $records[0]['cholesterol_100g'];
		$carbohydrates_100g = $records[0]['carbohydrates_100g'];
		$sodium_100g = $records[0]['sodium_100g'];
		$vitamin_c_100g = $records[0]['vitamin_c_100g'];
		$calcium_100g = $records[0]['calcium_100g'];
	}
?>



<?php include("includes/top.php"); ?>
<body>
	<table align="center" border="0" cellpadding="2" cellspacing="2" class="tblborder-no">
		<?php if(isset($msg) && $msg == 'exists'){ ?>
			<tr><td colspan="2">&nbsp;</td></tr>
			<tr><td class="msgSuccess" colspan="2"><?php echo 'Product already exists'; ?></td></tr>
			<tr><td colspan="2">&nbsp;</td></tr>
		<?php } ?>
		<tr>
			<td class="mainHeading">Add New Food</td>
			<td class="mainHeading" align="right"><a href="index.php">Show All Healthy Foods</a></td>
		</tr>
	</table>
	<!-- action="javascript:alert( 'success!' ); -->
	<form name="frm_food" method="POST" action="add_food.php">
		<table align="center" border="0" cellpadding="2" cellspacing="2" class="tblborder" width="90%">
			<tr>
				<td class="textHeading" width="15%">Product Name:</td>
				<td class="textContent"><input class="inputStyDt" type="text" name="product_name" value="<?php if(isset($pname)){ echo $pname; } ?>"></td>
			</tr>
			<tr>
				<td class="textHeading">Brands:</td>
				<td class="textContent"><input class="inputStyDt" type="text" name="brands" value="<?php if(isset($brands)){ echo $brands; } ?>"></td>
			</tr>
			<tr>
				<td class="textHeading">Countries:</td>
				<td class="textContent"><input class="inputStyDt" type="text" name="countries_en" value="<?php if(isset($countries_en)){ echo $countries_en; } ?>"></td>
			</tr>
			<tr>
				<td class="textHeading">Ingredients:</td>
				<td class="textContent"><input class="inputSty" type="text" name="ingredients_text" value="<?php if(isset($ingredients_text)){ echo $ingredients_text; } ?>"></td>
			</tr>
			<tr>
				<td class="textHeading">Serving Size:</td>
				<td class="textContent"><input class="inputStyDt" type="text" name="serving_size" value="<?php if(isset($serving_size)){ echo $serving_size; } ?>"></td>
			</tr>
			<tr>
				<td class="textHeading">Additives:</td>
				<td class="textContent"><input class="inputSty" type="text" name="additives" value="<?php if(isset($additives)){ echo $additives; } ?>"></td>
			</tr>
			<tr>
				<td class="textHeading">Fat:</td>
				<td class="textContent"><input class="inputStyDt" type="text" name="fat_100g" value="<?php if(isset($fat_100g)){ echo $fat_100g; } ?>"></td>
			</tr>
			<tr>
				<td class="textHeading">Cholesterol:</td>
				<td class="textContent"><input class="inputStyDt" type="text" name="cholesterol_100g" value="<?php if(isset($cholesterol_100g)){ echo $cholesterol_100g; } ?>"></td>
			</tr>
			<tr>
				<td class="textHeading">Carbohydrates:</td>
				<td class="textContent"><input class="inputStyDt" type="text" name="carbohydrates_100g" value="<?php if(isset($carbohydrates_100g)){ echo $carbohydrates_100g; } ?>"></td>
			</tr>
			<tr>
				<td class="textHeading">Sodium:</td>
				<td class="textContent"><input class="inputStyDt" type="text" name="sodium_100g" value="<?php if(isset($sodium_100g)){ echo $sodium_100g; } ?>"></td>
			</tr>
			<tr>
				<td class="textHeading">Vitamin-c:</td>
				<td class="textContent"><input class="inputStyDt" type="text" name="vitamin_c_100g" value="<?php if(isset($vitamin_c_100g)){ echo $vitamin_c_100g; } ?>"></td>
			</tr>
			<tr>
				<td class="textHeading">Calcium:</td>
				<td class="textContent"><input class="inputStyDt" type="text" name="calcium_100g" value="<?php if(isset($calcium_100g)){ echo $calcium_100g; } ?>"></td>
			</tr>
			<tr>
				<td class="textHeading">&nbsp;</td>
				<td class="textContent"><a href="javascript:void(0);" onclick="back();"><input type="button" value="Cancel"/></a>&nbsp;&nbsp;<input type="submit" value="Submit"/></td>
				
				<td colspan="2" align="right"><form action="https://www.paypal.com/cgi-bin/webscr" method="post" 

target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="NFMB4X37LM2FN">
<input type="image" 

src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" 

name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" 

width="1" height="1">
</form></td>
				
			</tr>
			<?php
			if(isset($_GET['id']) && $_GET['id'] > 0){
				echo '<input type="hidden" name="cid" value="'.$records[0]['id'].'">';
				echo '<input type="hidden" name="act" value="update">';
			}else{
				echo '<input type="hidden" name="act" value="insert">';
			}
			?>
		</table>
	</form>
</body>
</html>

<script type="text/javascript">
    function back() {
		window.location.href='index.php?'+"<?php echo get_params()?>" ; 
    }
</script>
<script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
</script>