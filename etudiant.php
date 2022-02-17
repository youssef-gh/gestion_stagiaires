<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin']) == 0)
	{	
// header('location:index.php');
}
else{ 

if(isset($_POST['submit']))
  {

$my_cne = $_SESSION['alogin'];
$sql1  =  "SELECT * from  etudiant where cne = '$my_cne' ";
$query1  =  $pdo -> prepare($sql1);
$query1->execute();
$results = $query1->fetchAll(PDO::FETCH_OBJ);
if($query1->rowCount() > 0)
{
foreach($results as $result)
{


echo htmlentities($result->nom);
$nom = $result->nom;
$prenom = $result->prenom;
$filliere = $result->filliere;
$annee = $result->annee;

}}
$ville = $_POST['ville'];
$domaine = $_POST['domaine'];
$duree = $_POST['duree'];
$detail = $_POST['detail'];
// $cne = $_POST['cne'];
$sql  =  "insert into demandeliste(domaine, duree, ville, detail, cne, nom, prenom, filliere, annee) values(:domaine, :duree, :ville, :detail, '$my_cne', :nom, :prenom, :filliere, :annee)";
$query  =  $pdo->prepare($sql);
$query->bindParam(':ville',$ville,PDO::PARAM_STR);
$query->bindParam(':domaine',$domaine,PDO::PARAM_STR);
$query->bindParam(':duree',$duree,PDO::PARAM_STR);
$query->bindParam(':detail',$detail,PDO::PARAM_STR);
// $query->bindParam(':cne',$cne,PDO::PARAM_STR);
$query->bindParam(':nom',$nom,PDO::PARAM_STR);
$query->bindParam(':prenom',$prenom,PDO::PARAM_STR);
$query->bindParam(':filliere',$filliere,PDO::PARAM_STR);
$query->bindParam(':annee',$annee,PDO::PARAM_STR);

$query1->execute();



$query->execute();


}


	?>
<!doctype html>
<html lang = "en" class = "no-js">

<head>
	<meta charset = "UTF-8">
	<meta http-equiv = "X-UA-Compatible" content = "IE = edge">
	<meta name = "viewport" content = "width = device-width, initial-scale = 1, minimum-scale = 1, maximum-scale = 1">
	<meta name = "description" content = "">
	<meta name = "author" content = "">
	<meta name = "theme-color" content = "#3e454c">
	
	<title>Admin platforme</title>

	<!-- Font awesome -->
	<link rel = "stylesheet" href = "css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel = "stylesheet" href = "css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel = "stylesheet" href = "css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel = "stylesheet" href = "css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel = "stylesheet" href = "css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel = "stylesheet" href = "css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel = "stylesheet" href = "css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel = "stylesheet" href = "css/style.css">
	<style> 
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
h2{
	padding-top : 50px
}
.form-control{
	width: 400px;
	/* padding-left : 100px */
	
}
.control-panel{
	/* padding-right: 60px; */
}
</style>
    </head>

<body>
	<?php include('includes/header_etd.php');?>
	<div class = "ts-main-content">
	<?php include('includes/leftbar.php');?>
	<!-- <div> <h2> psdfgsdgsdgsd </h2> </div> -->
		<div class = "content-" style = "padding-left:30px;">
			<div class = "container-">

				<div class = "row">
					<div class = "col-md-16">
					
						<h2 class = "page-title">Demande</h2>

						<div class = "row">
							<div class = "col-md-12">
								<div class = "panel panel-default">


<form method = "post" class = "form-horizontal" enctype = "multipart/form-data">
<div class = "form-group">
<label class = "col-sm-2 control-label" style  =  "padding-right: 60px;"> domaine de stage: <span style = "color:red">*</span></label>
<div class = "col-sm-4">
<input type = "text" name = "domaine" class = "form-control"  style  =  "margin-left:-20px" required>
</div>
<div class = "form-group">
<label class = "col-sm-2 control-label"> durée <span style = "color:red">*</span></label>
<div class = "col-sm-4">
<input type = "text" name = "duree" class = "form-control" style  =  "margin-left:20px" required>
</div>
<div class = "form-group">
<label class = "col-sm-2 control-label" style  =  "padding-right: 40px;"> ville <span style = "color:red">*</span></label>
<div class = "col-sm-4">
<input type = "text" name = "ville" class = "form-control" required>
</div>
<!-- <div class = "form-group">
<label class = "col-sm-2 control-label"> CNE <span style = "color:red; padding-right : 10px;">*</span></label>
<div class = "col-sm-4">
<input type = "text" name = "cne" class = "form-control" style  =  "margin-left:10px" required>
</div> -->
<!-- <div class = "form-group" >
<label class = "col-sm-2 control-label"style  =  "padding-right:25px;"> ville <span style = "color:red">*</span></label>
<div class = "col-sm-4">
<input type = "text" name = "ville" class = "form-control" style  =  "margin-left:10px" required>
</div> -->
<!-- <div class = "form-group">
<label class = "col-sm-2 control-label" style  =  "padding-right: 20px;">durée<span style = "color:red">*</span></label>
<div class = "col-sm-4">
<input type = "text" name = "duree" class = "form-control" style  =  "margin-left:20px; " required>
</div>
<div class = "form-group" >
<label class = "col-sm-2 control-label"style  =  "padding-right:35px;"> type <span style = "color:red">*</span></label>
<div class = "col-sm-4">
<input type = "text" name = "type" class = "form-control"  required>
</div> -->

<!-- <div class = "form-group"> -->
<!-- <label class = "col-sm-2 control-label"style  =  "padding-right: 30px;">detail<span style = "color:red">*</span></label>
<div class = "col-sm-4">
<input type = "text" name = "detail" class = "form-control" required>  -->
</div>


</div>
											
<!-- <div class = "hr-dashed"></div>


<div class = "form-group">
<label class = "col-sm-2 control-label">Frais de Livraison<span style = "color:red">*</span></label>
<div class = "col-sm-4">
<input type = "text" name = "Fl" class = "form-control" style  =  "margin-left:30px" required>
</div>
</div>
<div class = "form-group">
	<label class = "col-sm-2 control-label">Autres Frais<span style = "color:red">*</span></label>
<div class = "col-sm-4">
<input type = "text" name = "Frais" class = "form-control" style  =  "margin-left:30px" required>
</div>                
</div>		
</div> -->
<!-- <div class = "hr-dashed"></div>									 -->
</div>
</div>
</div>
</div>

<label class = "col-sm-2 control-label" style  =  "padding-left: 50px;margin : 70px 0px 0px 0px"> Détails sur votre demande <span style = "color:red">*</span></label>
<textarea rows = "10" cols = "50" type = "text" name = "detail" style  =  "margin : 0px 0px 50px 20px  "class = "form-control" 
required >  </textarea>

							
	<div class = "form-group">
		<div class = "col-sm-8 col-sm-offset-2">
			<button class = "btn btn-default" type = "reset">Cancel</button>
			<button class = "btn btn-primary" name = "submit" type = "submit">Save changes</button>
		</div>
	</div>

    <!-- Loading Scripts -->
	<script src = "js/jquery.min.js"></script>
	<script src = "js/bootstrap-select.min.js"></script>
	<script src = "js/bootstrap.min.js"></script>
	<script src = "js/jquery.dataTables.min.js"></script>
	<script src = "js/dataTables.bootstrap.min.js"></script>
	<script src = "js/Chart.min.js"></script>
	<script src = "js/fileinput.js"></script>
	<script src = "js/chartData.js"></script>
	<script src = "js/main.js"></script>
</body>
</html>
<?php } ?>