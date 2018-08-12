<?php
	include("includes/config.php");
	include("includes/functions.php");

	if(isset($_GET['act']) && $_GET['act'] == 'delete'){
		delete_food($_GET['id']);
		redirect('index.php?msg=del', false);
	}

	$limit = 50;
    if (isset($_GET["page"] )) {
		$page  = $_GET["page"]; 
	} else {
		$page=1; 
    }
	$record_index= ($page-1) * $limit;  

	$data = array();
	if(isset($_GET['action']) && $_GET['action'] == 'advfind'){
		if($_GET["productsname"] != '' || $_GET["brands"] != '' || $_GET["countries"] != '' || $_GET["fat"] != '' || $_GET["cholesterol"] != '' || $_GET["carbohydrates"] != '' || $_GET["sodium"] != '' || $_GET["vitamin_c"] != '' || $_GET["calcium"] != ''){
			$qry = "SELECT * FROM healthyfood where (";
			if(isset($_GET["productsname"]) && $_GET["productsname"] != ''){
				$qry .= " product_name like '%".addslashes($_GET["productsname"])."%' and ";
			}
			if(isset($_GET["brands"]) && $_GET["brands"] != ''){
				$qry .= " brands like '".addslashes($_GET["brands"])."%' and ";
			}
			if(isset($_GET["countries"]) && $_GET["countries"] != ''){
				$qry .= " countries_en like '%".addslashes($_GET["countries"])."%' and ";
			}
			if(isset($_GET["fat"]) && $_GET["fat"] != ''){
				if(isset($_GET['fat_sign']) && $_GET['fat_sign'] != 0 ){
					if($_GET['fat_sign'] == '1'){
						$qry .= " fat_100g < '".$_GET["fat"]."' and ";
					}elseif($_GET['fat_sign'] == '2'){
						$qry .= " fat_100g > '".$_GET["fat"]."' and ";
					}elseif($_GET['fat_sign'] == '3'){
						$qry .= " fat_100g = '".$_GET["fat"]."' and ";
					}
				}
			}
			if(isset($_GET["cholesterol"]) && $_GET["cholesterol"] != ''){
				if(isset($_GET['chlsterol_sign']) && $_GET['chlsterol_sign'] != 0 ){
					if($_GET['chlsterol_sign'] == '1'){
						$qry .= " cholesterol_100g < '".$_GET["cholesterol"]."' and ";
					}elseif($_GET['chlsterol_sign'] == '2'){
						$qry .= " cholesterol_100g > '".$_GET["cholesterol"]."' and ";
					}elseif($_GET['chlsterol_sign'] == '3'){
						$qry .= " cholesterol_100g = '".$_GET["cholesterol"]."' and ";
					}
				}
			}

			$carbosign = (isset($_GET['']) ? $_GET['carbohyd_sign'] : '');
					$sodsign = (isset($_GET['']) ? $_GET['sodium_sign'] : '');
					$vitcdsign = (isset($_GET['']) ? $_GET['vitamin_sign'] : '');
					$calsign = (isset($_GET['']) ? $_GET['calcium_sign'] : '');

			if(isset($_GET["carbohydrates"]) && $_GET["carbohydrates"] != ''){
				if(isset($_GET['carbohyd_sign']) && $_GET['carbohyd_sign'] != 0 ){
					if($_GET['carbohyd_sign'] == '1'){
						$qry .= " carbohydrates_100g < '".$_GET["carbohydrates"]."' and ";
					}elseif($_GET['carbohyd_sign'] == '2'){
						$qry .= " carbohydrates_100g > '".$_GET["carbohydrates"]."' and ";
					}elseif($_GET['carbohyd_sign'] == '3'){
						$qry .= " carbohydrates_100g = '".$_GET["carbohydrates"]."' and ";
					}
				}
			}
			if(isset($_GET["sodium"]) && $_GET["sodium"] != ''){
				if(isset($_GET['sodium_sign']) && $_GET['sodium_sign'] != 0 ){
					if($_GET['sodium_sign'] == '1'){
						$qry .= " sodium_100g < '".$_GET["sodium"]."' and ";
					}elseif($_GET['sodium_sign'] == '2'){
						$qry .= " sodium_100g > '".$_GET["sodium"]."' and ";
					}elseif($_GET['sodium_sign'] == '3'){
						$qry .= " sodium_100g = '".$_GET["sodium"]."' and ";
					}
				}
			}
			if(isset($_GET["vitamin_c"]) && $_GET["vitamin_c"] != ''){
				if(isset($_GET['vitamin_sign']) && $_GET['vitamin_sign'] != 0 ){
					if($_GET['vitamin_sign'] == '1'){
						$qry .= " vitamin_c_100g < '".$_GET["vitamin_c"]."' and ";
					}elseif($_GET['vitamin_sign'] == '2'){
						$qry .= " vitamin_c_100g > '".$_GET["vitamin_c"]."' and ";
					}elseif($_GET['vitamin_sign'] == '3'){
						$qry .= " vitamin_c_100g = '".$_GET["vitamin_c"]."' and ";
					}
				}
			}
			if(isset($_GET["calcium"]) && $_GET["calcium"] != ''){
				if(isset($_GET['calcium_sign']) && $_GET['calcium_sign'] != 0 ){
					if($_GET['calcium_sign'] == '1'){
						$qry .= " calcium_100g < '".$_GET["calcium"]."' and ";
					}elseif($_GET['calcium_sign'] == '2'){
						$qry .= " calcium_100g > '".$_GET["calcium"]."' and ";
					}elseif($_GET['calcium_sign'] == '3'){
						$qry .= " calcium_100g = '".$_GET["calcium"]."' and ";
					}
				}
			}
			$qry = substr($qry, 0, -4);
			$qry .= ") order by product_ID";
			$totalcourses = mysqli_query($con, $qry);
			$total_records = mysqli_num_rows($totalcourses);
			$all_foods = mysqli_query($con, $qry . " LIMIT $record_index, $limit");
		}
		//exit;
	}else{
		$qry = "SELECT * FROM healthyfood order by product_ID";
		$totalcourses = mysqli_query($con, $qry);
		$total_records = mysqli_num_rows($totalcourses);
		$all_foods = mysqli_query($con, $qry . " LIMIT $record_index, $limit");
	}

	if ($total_records > 0){
		while($cdata = mysqli_fetch_array($all_foods, MYSQLI_ASSOC)) { 
			if(isset($cdata['brands']) && ($cdata['brands']) != ''){
				$brands = stripslashes($cdata['brands']);
			}else{
				$brands = 'NULL';
			}
			if(isset($cdata['countries_en']) && ($cdata['countries_en']) != ''){
				$countries_en = stripslashes($cdata['countries_en']);
			}else{
				$countries_en = 'NULL';
			}
			if(isset($cdata['serving_size']) && ($cdata['serving_size']) != ''){
				$serving_size = stripslashes($cdata['serving_size']);
			}else{
				$serving_size = 'NULL';
			}
			$data[] = array('id' => $cdata['product_ID'],
						   'product_name' => stripslashes($cdata['product_name']),
						   'brands' => $brands,
						   'countries_en' => $countries_en,
						   'ingredients_text' => stripslashes($cdata['ingredients_text']),
						   'serving_size' => $serving_size,
						   'additives' => stripslashes($cdata['additives']),
						   'fat_100g' => $cdata['fat_100g'],
						   'cholesterol_100g' => $cdata['cholesterol_100g'],
						   'carbohydrates_100g' => $cdata['carbohydrates_100g'],
						   'sodium_100g' => $cdata['sodium_100g'],
						   'vitamin_c_100g' => $cdata['vitamin_c_100g'],
						   'calcium_100g' => $cdata['calcium_100g']);
		}
	}

	include("includes/top.php"); 
?>
	<body>
		<table align="center" border="0" cellpadding="0" cellspacing="0" class="tblborder-no">
			<?php if(isset($_GET['msg']) && $_GET['msg'] == 'success'){ ?>
			<tr>
				<td class="msgSuccess" colspan="2"><?php echo 'Food added successfully'; ?></td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<?php } ?>
			<?php if(isset($_GET['msg']) && $_GET['msg'] == 'update'){ ?>
			<tr>
				<td class="msgSuccess" colspan="2"><?php echo 'Food updated successfully'; ?></td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<?php } ?>
			<?php if(isset($_GET['msg']) && $_GET['msg'] == 'del'){ ?>
			<tr>
				<td class="msgSuccess" colspan="2"><?php echo 'Food deleted successfully'; ?></td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<?php } ?>
			<tr>
				<td colspan="2"><BR></td>
			</tr>
			<tr>
				<td class="mainHeading" width="left"><a href="index.php">All Healthy Food</a></td>
				<td class="mainHeading" align="center"><a href="add_food.php">Add New Food</a></td>
				<td class="mainHeading" align="right"><form action="https://www.paypal.com/cgi-bin/webscr" method="post" 

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
			<tr>
				<td colspan="2"><BR><BR><BR></td>
			</tr>
			<table align="center" border="0" cellpadding="5" cellspacing="5" width="90%">
				<form name="frm_search" method="GET" action="index.php">
					<tr>
						<td align="left">
							Products Name&nbsp;<input type="text" placeholder="Enter Products Name" name="productsname" value="<?php if(isset($_GET["productsname"])){ echo $_GET["productsname"]; } ?>">
						</td>
						<td align="left">
							Brands&nbsp;<input type="text" placeholder="Enter Brands" name="brands" value="<?php if(isset($_GET["brands"])){ echo $_GET["brands"]; } ?>">
						</td>
						<td align="left">
							Countries&nbsp;<input type="text" placeholder="Enter Countries" name="countries" value="<?php if(isset($_GET["countries"])){ echo $_GET["countries"]; } ?>">
						</td>
					</tr>
					<?php 
					$ffsign = (isset($_GET['fat_sign']) ? $_GET['fat_sign'] : '');
					$chlsign = (isset($_GET['chlsterol_sign']) ? $_GET['chlsterol_sign'] : '');
					$carbosign = (isset($_GET['carbohyd_sign']) ? $_GET['carbohyd_sign'] : '');
					$sodsign = (isset($_GET['sodium_sign']) ? $_GET['sodium_sign'] : '');
					$vitcdsign = (isset($_GET['vitamin_sign']) ? $_GET['vitamin_sign'] : '');
					$calsign = (isset($_GET['calcium_sign']) ? $_GET['calcium_sign'] : '');
					?>
					<tr>
						<td align="left">
							Fat&nbsp;<input type="text" placeholder="Enter Fat" name="fat" value="<?php if(isset($_GET["fat"])){ echo $_GET["fat"]; } ?>">
							<select name="fat_sign">
								<option value="0">None</option>
								<option value="1" <?php if($ffsign && $ffsign == '1'){ echo 'selected="selected"'; } ?>> < </option>
								<option value="2" <?php if($ffsign && $ffsign == '2'){ echo 'selected="selected"'; } ?>> > </option>
								<option value="3" <?php if($ffsign && $ffsign == '3'){ echo 'selected="selected"'; } ?>> = </option>
							</select>
						</td>
						<td align="left">
							Cholesterol&nbsp;<input type="text" placeholder="Enter Cholesterol" name="cholesterol" value="<?php if(isset($_GET["cholesterol"])){ echo $_GET["cholesterol"]; } ?>">
							<select name="chlsterol_sign">
								<option value="0">None</option>
								<option value="1" <?php if($chlsign && $chlsign == '1'){ echo 'selected="selected"'; } ?>> < </option>
								<option value="2" <?php if($chlsign && $chlsign == '2'){ echo 'selected="selected"'; } ?>> > </option>
								<option value="3" <?php if($chlsign && $chlsign == '3'){ echo 'selected="selected"'; } ?>> = </option>
							</select>
						</td>
						<td align="left">
							Carbohydrates&nbsp;<input type="text" placeholder="Enter Carbohydrates" name="carbohydrates" value="<?php if(isset($_GET["carbohydrates"])){ echo $_GET["carbohydrates"]; } ?>">
							<select name="carbohyd_sign">
								<option value="0">None</option>
								<option value="1" <?php if($carbosign && $carbosign == '1'){ echo 'selected="selected"'; } ?>> < </option>
								<option value="2" <?php if($carbosign && $carbosign == '2'){ echo 'selected="selected"'; } ?>> > </option>
								<option value="3" <?php if($carbosign && $carbosign == '3'){ echo 'selected="selected"'; } ?>> = </option>
							</select>
						</td>
					</tr>
					<tr>
						<td align="left">
							Sodium&nbsp;<input type="text" placeholder="Enter Sodium" name="sodium" value="<?php if(isset($_GET["sodium"])){ echo $_GET["sodium"]; } ?>">
							<select name="sodium_sign">
								<option value="0">None</option>
								<option value="1" <?php if($sodsign && $sodsign == '1'){ echo 'selected="selected"'; } ?>> < </option>
								<option value="2" <?php if($sodsign && $sodsign == '2'){ echo 'selected="selected"'; } ?>> > </option>
								<option value="3" <?php if($sodsign && $sodsign == '3'){ echo 'selected="selected"'; } ?>> = </option>
							</select>
						</td>
						<td align="left">
							Vitamin-c&nbsp;<input type="text" placeholder="Enter Vitamin-c" name="vitamin_c" value="<?php if(isset($_GET["vitamin_c"])){ echo $_GET["vitamin_c"]; } ?>">
							<select name="vitamin_sign">
								<option value="0">None</option>
								<option value="1" <?php if($vitcdsign && $vitcdsign == '1'){ echo 'selected="selected"'; } ?>> < </option>
								<option value="2" <?php if($vitcdsign && $vitcdsign == '2'){ echo 'selected="selected"'; } ?>> > </option>
								<option value="3" <?php if($vitcdsign && $vitcdsign == '3'){ echo 'selected="selected"'; } ?>> = </option>
							</select>
						</td>
						<td align="left">
							Calcium&nbsp;<input type="text" placeholder="Enter Calcium" name="calcium" value="<?php if(isset($_GET["calcium"])){ echo $_GET["calcium"]; } ?>">
							<select name="calcium_sign">
								<option value="0">None</option>
								<option value="1" <?php if($calsign && $calsign == '1'){ echo 'selected="selected"'; } ?>> < </option>
								<option value="2" <?php if($calsign && $calsign == '2'){ echo 'selected="selected"'; } ?>> > </option>
								<option value="3" <?php if($calsign && $calsign == '3'){ echo 'selected="selected"'; } ?>> = </option>
							</select>
							<input type="hidden" value="advfind" name="action" /><input type="submit" value="Advanced Search" />
						</td>
					</tr>
				</form>
			</table>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
		</table>
		<?php if(sizeof($data) > 0) { ?>
		<table align="center" border="1" cellpadding="7" cellspacing="0" class="tblborder">
			<tr>
				<td class="Heading" width="17%">&nbsp;&nbsp;Product Name</td>
				<td class="Heading" width="10%" align="center">Brands</td>
				<td class="Heading" width="10%" align="center">Countries</td>
				<td class="Heading" width="10%" align="center">Serving Size</td>
				<td class="Heading" width="5%" align="center">Fat</td>
				<td class="Heading" width="7%" align="center">Cholesterol</td>
				<td class="Heading" width="7%" align="center">Carbohydrates</td>
				<td class="Heading" width="5%" align="center">Sodium</td>
				<td class="Heading" width="7%" align="center">vitamin-c</td>
				<td class="Heading" width="7%" align="center">Calcium</td>
				<td class="Heading" colspan="2" width="15%" align="center">Action</td>
			</tr>
			<?php 
			for($i=0; $i<sizeof($data); $i++){ 
				if($data[$i]['fat_100g'] == '0.0000'){
					$fat = 0;
				}else{
					$fat = $data[$i]['fat_100g'];
				}

				if($data[$i]['cholesterol_100g'] == '0.0000'){
					$cholesterol = 0;
				}else{
					$cholesterol = $data[$i]['cholesterol_100g'];
				}

				if($data[$i]['sodium_100g'] == '0.0000'){
					$sodium = 0;
				}else{
					$sodium = $data[$i]['sodium_100g'];
				}

				if($data[$i]['vitamin_c_100g'] == '0.0000'){
					$vitamin_c = 0;
				}else{
					$vitamin_c = $data[$i]['vitamin_c_100g'];
				}

				if($data[$i]['calcium_100g'] == '0.0000'){
					$calcium = 0;
				}else{
					$calcium = $data[$i]['calcium_100g'];
				}
			?>
				<tr>
					<td class="textContent" align="left"><?php echo $data[$i]['product_name']; ?></td>
					<td class="textContent" align="center"><?php echo $data[$i]['brands']; ?></td>
					<td class="textContent" align="center"><?php echo $data[$i]['countries_en']; ?></td>
					<td class="textContent" align="center"><?php echo $data[$i]['serving_size']; ?></td>
					<td class="textContent" align="center"><?php echo $fat; ?></td>
					<td class="textContent" align="center"><?php echo $cholesterol; ?></td>
					<td class="textContent" align="center"><?php echo $data[$i]['carbohydrates_100g']; ?></td>
					<td class="textContent" align="center"><?php echo $sodium; ?></td>
					<td class="textContent" align="center"><?php echo $vitamin_c; ?></td>
					<td class="textContent" align="center"><?php echo $calcium; ?></td>
					<td class="textContent" align="center"><a href="add_food.php?id=<?php echo $data[$i]['id'].'&'.get_params();?>"><input type="button" value="Edit" /></a>&nbsp;<a href="#" onclick="return confirmation(<?php echo $data[$i]['id'];?>)"><input type="button" value="Delete" /></a><a href="print_food.php?id=<?php echo $data[$i]['id'].'&'.get_params();?>"><input type="button" value="Print" /></a></td>
				</tr>
			<?php 
				} 
			?>
					
		</table>
		<?php }else{ ?>
		<table align="center" border="0" cellpadding="7" cellspacing="0" class="tblborder">
			<tr>
				<td class="msgSuccess">No records found.
				</td>
			</tr>
		</table>
		<?php } ?>
		<table align="center" border="0" cellpadding="0" cellspacing="0" class="tblborder-no">
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2">
				<?php
				if($total_records > $limit){
					$total_pages = ceil($total_records / $limit);  
					$start_loop = $page;
					$difference = $total_pages - $page;
					
					if($difference <= 5)
					{
					 $start_loop = $total_pages - 5;
					}
					$end_loop = $start_loop + 4;
					if($page > 1)
					{
					 echo "<a class='pagination' href='index.php?page=1&".get_params(array('page'))."'>First</a>";
					 echo "<a class='pagination' href='index.php?page=".($page - 1).'&'.get_params(array('page'))."'><<</a>";
					}
					for($i=$start_loop; $i<=$end_loop; $i++)
					{     
					 echo "<a class='pagination' href='index.php?page=".$i.'&'.get_params(array('page'))."'>".$i."</a>";
					}
					if($page <= $end_loop)
					{
					 echo "<a class='pagination' href='index.php?page=".($page + 1).'&'.get_params(array('page'))."'>>></a>";
					 echo "<a class='pagination' href='index.php?page=".$total_pages.'&'.get_params(array('page'))."'>Last</a>";
					}
				}
				?>
				</td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
		</table>
	</body>
</html>

<script type="text/javascript">
    function confirmation(hfid) {
      var answer = confirm('Are you sure to delete this food?');
	  if(answer){
		  window.location.href='index.php?act=delete&id='+hfid+'<?php echo get_params()?>'; 
	  }
    }
</script>
<script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
</script>
