<?php
	ini_set('MAX_EXECUTION_TIME', -1);
	include_once 'connection.php';
	if(isset($_POST['submit'])){
		if($_FILES['csv_data']['name']){
			
			$arrFileName = explode('.',$_FILES['csv_data']['name']);
			if($arrFileName[1] == 'csv'){
				$handle = fopen($_FILES['csv_data']['tmp_name'], "r");

				while (($data = fgetcsv($handle, 1200, ";")) !== FALSE) {
					$str_name = "item1";
//					$item_val = mysqli_real_escape_string($conn,$data[0]);
					$item_val = $data[0];
					$str_val = "'".$item_val."'";

					for($i = 1; $i < 37; $i++){
//						$item_val = mysqli_real_escape_string($conn,$data[$i]);
						$item_val = $data[$i];
						$tmp_num = $i+1;
						$str_name = $str_name.",item".$tmp_num;
						$str_val = $str_val.",'".$item_val."'";
					}
					$import="INSERT into tbl_csv(".$str_name.") values(".$str_val.")";

//					echo $import."           ";

					mysqli_query($conn,$import);

				}
				fclose($handle);
				print "Import done";
			}
		}
	}
?>

<html>
	<head>
		<title> B2B CSV Saver</title>
	<head>
	<body>
		<form method='POST' enctype='multipart/form-data'>
			Upload CSV: <input type='file' name='csv_data' /> <input type='submit' name='submit' value='Upload CSV' />
		</form>
	</body>
</html>