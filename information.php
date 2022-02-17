<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{ 

	$cne = $_SESSION['alogin'];
	// echo "<script type='text/javascript'>alert('$cne');</script>";


// if(isset($_POST['submit']))
//   {
// $vehicletitle=$_POST['vehicletitle'];
// $dispo=$_POST['dispo'];


// $priceperday=$_POST['priceperday'];
// $Depart=$_POST['Depart'];
// $Retour=$_POST['Retour'];
// $Coleur=$_POST['Coleur'];
// $fueltype=$_POST['fueltype'];
// $seatingcapacity=$_POST['seatingcapacity'];

// $num=intval($_GET['num']);

// $sql="update vehicles set depart=:Depart,retour=:Retour,coleur=:Coleur,VehiclesTitle=:vehicletitle,PricePerDay=:priceperday,FuelType=:fueltype,SeatingCapacity=:seatingcapacity, Disponible=:dispo where id=:id ";
// $query = $pdo->prepare($sql);
// $query->bindParam(':vehicletitle',$vehicletitle,PDO::PARAM_STR);
// $query->bindParam(':dispo',$dispo,PDO::PARAM_STR);

// $query->bindParam(':Depart',$Depart,PDO::PARAM_STR);
// $query->bindParam(':Retour',$Retour,PDO::PARAM_STR);
// $query->bindParam(':Coleur',$Coleur,PDO::PARAM_STR);
// $query->bindParam(':priceperday',$priceperday,PDO::PARAM_STR);
// $query->bindParam(':fueltype',$fueltype,PDO::PARAM_STR);
// $query->bindParam(':seatingcapacity',$seatingcapacity,PDO::PARAM_STR);

// $query->bindParam(':id',$id,PDO::PARAM_STR);
// $query->execute();

// $msg="= updated successfully";


// }


	?>
<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>Admin platforme</title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">
	<style>
		.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
body{
	background-image: url("bg.jpg") ;
	color : white
}
.panel-body {
	background-image: url("bg.jpg") ;

}
form{
	background-image: url("bg.jpg") ;

}
.panel{
	background-image: url("bg.jpg") ;
}
.succWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: black;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgb(0 0 0 / 10%);
    box-shadow: 0 1px 1px 0 rgb(0 0 0 / 10%);
}

		</style>
</head>

<body>

	<?php 
	if($cne[0] == 'L' || $cne[0] == 'l'){
	
		include('includes/header_etd.php');}
	if($cne == 'admin'){
		include('includes/header.php');}

	
	
	?>
	<!-- <div class="ts-main-content"> -->
	<!-- <div > <p style = "margin : 100px">fsdfsfsdfsdf </p> </div> -->
	

	<div > <h1 style = "margin : 100px 20px" >INFORMATIONS SUR CE STAGE: </h1> </div>

	<?php 
	// $num=intval($_GET['num']);
	$num = isset($_GET['num']) ? $_GET['num'] : '';

	$sql ="SELECT stage.* from stage  where stage.num=:num";
	$query = $pdo -> prepare($sql);
	$query-> bindParam(':num', $num, PDO::PARAM_STR);
	$query->execute();
	$results=$query->fetchAll(PDO::FETCH_OBJ);
	$cnt=1;
	if($query->rowCount() > 0)
	{
	foreach($results as $result)
	{	?>

	<div > <p style = "margin : 100px 40px;font-size: 30px" ><?php echo htmlentities($result->info)?> </p> </div>




<?php }} ?>


				<!-- <div class="form-group">
					<div class="col-sm-8 col-sm-offset-2" >
					<button class="btn btn-primary" name="submit" type="submit" style="margin-top:4%">Save changes</button>
					</div>
				</div> -->

			</form>
		</div>
		</div>
	</div>
</div>
		
	

	</div>
</div>
				
			

			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
</body>
</html>
<?php } ?>