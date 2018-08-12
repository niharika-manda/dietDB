<?php
	include("includes/config.php");
	include("includes/functions.php");

	$records = array();
	if(isset($_GET['id']) && $_GET['id'] > 0){
		$records = get_foods_edit((int)$_GET['id']);
	}

	$dataPoints = array( 
		array("label"=>"Fat", "y"=>$records[0]['fat_100g']),
		array("label"=>"Cholesterol", "y"=>$records[0]['cholesterol_100g']),
		array("label"=>"Carbohydrates", "y"=>$records[0]['carbohydrates_100g']),
		array("label"=>"Sodium", "y"=>$records[0]['sodium_100g']),
		array("label"=>"Vitamin-c", "y"=>$records[0]['vitamin_c_100g']),
		array("label"=>"Calcium", "y"=>$records[0]['calcium_100g'])
	)
?>
<?php include("includes/top.php"); ?>
<body>
		<table align="center" border="0" cellpadding="5" cellspacing="5" width="70%">
			<tr>
				<td class="textHeadingPrt" width="10%">Product Name:</td>
				<td class="textContentPrt"><b><?php if(isset($records[0]['product_name'])){ echo $records[0]['product_name']; } ?></b></td>
			</tr>
			<tr>
				<td class="textHeadingPrt">Brands:</td>
				<td class="textContent"><b><?php if(isset($records[0]['brands'])){ echo $records[0]['brands']; } ?></b></td>
			</tr>
			<tr>
				<td class="textHeadingPrt">Countries:</td>
				<td class="textContent"><b><?php if(isset($records[0]['countries_en'])){ echo $records[0]['countries_en']; } ?></b></td>
			</tr>
			<tr>
				<td class="textHeadingPrt">Ingredients:</td>
				<td class="textContent"><b><?php if(isset($records[0]['ingredients_text'])){ echo $records[0]['ingredients_text']; } ?></b></td>
			</tr>
			<tr>
				<td class="textHeadingPrt">Serving Size:</td>
				<td class="textContent"><b><?php if(isset($records[0]['serving_size'])){ echo $records[0]['serving_size']; } ?></b></td>
			</tr>
			<tr>
				<td class="textHeadingPrt">Additives:</td>
				<td class="textContent"><b><?php if(isset($records[0]['additives'])){ echo $records[0]['additives']; } ?></b></td>
			</tr>
			<tr>
				<td class="textHeadingPrt">Fat:</td>
				<td class="textContent"><b><?php if(isset($records[0]['fat_100g'])){ echo $records[0]['fat_100g']; } ?></b></td>
			</tr>
			<tr>
				<td class="textHeadingPrt">Cholesterol:</td>
				<td class="textContent"><b><?php if(isset($records[0]['cholesterol_100g'])){ echo $records[0]['cholesterol_100g']; } ?></b></td>
			</tr>
			<tr>
				<td class="textHeadingPrt">Carbohydrates:</td>
				<td class="textContent"><b><?php if(isset($records[0]['carbohydrates_100g'])){ echo $records[0]['carbohydrates_100g']; } ?></b></td>
			</tr>
			<tr>
				<td class="textHeadingPrt">Sodium:</td>
				<td class="textContent"><b><?php if(isset($records[0]['sodium_100g'])){ echo $records[0]['sodium_100g']; } ?></b></td>
			</tr>
			<tr>
				<td class="textHeadingPrt">Vitamin-c:</td>
				<td class="textContent"><b><?php if(isset($records[0]['vitamin_c_100g'])){ echo $records[0]['vitamin_c_100g']; } ?></b></td>
			</tr>
			<tr>
				<td class="textHeadingPrt">Calcium:</td>
				<td class="textContent"><b><?php if(isset($records[0]['calcium_100g'])){ echo $records[0]['calcium_100g']; } ?></b></td>
			</tr>
			<tr>
				<td colspan="2"><a href="javascript:void(0);" onclick="window.print();"><input type="button" value="Print"/></a>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="goBack();"><input type="button" value="Back"/></a></td>
	
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
			<tr>
				<td colspan="2">
					<div id="chartContainer" style="height: 570px; width: 100%;"></div>
					<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
				</td>
			</tr>
		</table>
</body>
</html>

<script type="text/javascript">
    function goBack() {
		window.history.back(); 
    }
</script>
<script>
window.onload = function() {
 
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title: {
		text: "Nutrition Breakdown"
	},
	subtitles: [{
		text: "100g"
	}],
	data: [{
		type: "pie",
		yValueFormatString: "#,##0.0000\"\"",
		indexLabel: "{label} ({y})",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>