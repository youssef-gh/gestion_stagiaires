<?php
session_start();
// error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
// if(isset($_POST['$result->num']))
//   {
// 	  echo "<script type='text/javascript'> alert('$result->num'); </script>";


// 	// echo "<script type='text/javascript'> document.location = 'information.php?num=$result->num'; </script>";


//   }

else{

    //prompt function
    function prompt($prompt_msg){
        echo("<script type='text/javascript'> var answer = prompt('".$prompt_msg."'); </script>");

        $answer = "<script type='text/javascript'> document.write(answer); </script>";
        return($answer);
    }


	if(isset($_REQUEST['del']))
	{
		$delid=intval($_GET['del']);
		$sql = "delete from stage  where num=:delid";
		$query = $pdo->prepare($sql);
		$query -> bindParam(':delid',$delid, PDO::PARAM_STR);
		$query -> execute();
		$msg="Stage supprimé !!";
		}


	if(isset($_REQUEST['stage_id']))
	{
		$stageid=$_GET['stage_id'];
		$var_cne = $_COOKIE["second"];
		$not_found = "select * from demandeliste where cne = '$var_cne' ";
		$not_found_query = $pdo->prepare($not_found);

		$sql = "UPDATE demandeliste SET stage_id = :stageid,afficher = 1 where cne = '$var_cne' ";
		$query = $pdo->prepare($sql);
		$query -> bindParam(':stageid',$stageid, PDO::PARAM_STR);
		$query -> execute();
		$not_found_query -> execute();
		if($not_found_query->rowCount() == 0){
			echo "<script type='text/javascript'>alert('Invalide CNE !!');</script>";
		}

		$msg="Stage supprimé !!";
		}

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
	background-color:#65718
}
.panel-body {
	background-image: url("bg.jpg") ;

}
table{
	background-image: url("bg.jpg") ;
	color : white

}
.table-striped>tbody>tr:nth-of-type(odd) {
	background-image: url("bg.jpg") ;


}
th{
	color : #37a6c4;
}
h2 {
	color : white;
	padding-top : 50px

}
.row{
	color : white
}
.pagination>.disabled>span, .pagination>.disabled>span:hover, .pagination>.disabled>span:focus, .pagination>.disabled>a, .pagination>.disabled>a:hover, .pagination>.disabled>a:focus {
    color: #1d1c1b;
    background-color: #f8f5f0;
    border-color: #dfd7ca;
    cursor: not-allowed;
}

		</style>

</head>

<body>
	<?php include('includes/header.php');?>

	<div class="ts-main-content">
		<?php include('includes/leftbar.php');?>
		<div class="content-">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">Liste de stage</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-body">
							
							
								<table id="zctb" class=" table table-striped table-bordered " cellspacing="0" width="100%">
									<thead>
									<tr>
										<th> Disponibilité</th>
										<th> Domaine</th>
										<th> Entreprise</th>
										<th> ville</th>
										<th> Durée</th>
										<th> Encadrant</th>
										<th> Etudiant stagé </th>
										<th> infos </th>
										<th> Envoyer au Etudiant </th>
										<th> Modifier </th>
										<th> Supprimer </th>




										</tr>
										</tr>
									</thead>
									<tfoot>
										<tr>
										<th> Disponibilité</th>
										<th> Domaine</th>
										<th> Entreprise</th>
										<th> Ville</th>
										<th> Durée</th>
										<th> Encadrant</th>
										<th> Etudiant stagé </th>
										<th> infos </th>
										<th> Envoyer au Etudiant </th>
										<th> Modifier </th>
										<th> Supprimer </th>







										</tr>
										</tr>
									</tfoot>
									<tbody>

									<?php $sql = "SELECT * from  stage ";
										$query = $pdo -> prepare($sql);
										$query->execute();
										$results=$query->fetchAll(PDO::FETCH_OBJ);
										$cnt=1;
										if($query->rowCount() > 0)
										{
										foreach($results as $result)
										{				?>	
										<tr>
										<script>
											function createCookie(name, value, days) {
												var expires;
												if (days) {
													var date = new Date();
													date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
													expires = "; expires=" + date.toGMTString();
												}
												else {
													expires = "";
												}
												document.cookie = escape(name) + "=" + escape(value) + expires + "; path=/";
												}
											
											function clicked(){
												var second = prompt("Entre Le CNE:");
												createCookie('second', second);
											}

										</script>






											
											<td style = "color : yellow;"><b><?php echo htmlentities($result->dispo);?></td>
											<td><?php echo htmlentities($result->domaine);?></td>
											<td><?php echo htmlentities($result->entreprise);?></td>
											<td><?php echo htmlentities($result->ville .' '.$result->ville);?></td>
											<td><?php echo htmlentities($result->duree);?></td>
											<td><?php echo htmlentities($result->encadrant);?></td>
											<?php if($result->dispo == 'disponible') { ?>
											<td><?php echo 'Aucun !'; }?></td> 
											<?php if($result->dispo != 'disponible') { ?>
											<td><?php echo htmlentities($result->cne_etudiant); }?></td>
											<td><a href="information.php?num=<?php echo $result->num;?>">Informations sur stage</a>
											<td><a  href="reg-users.php?stage_id=<?php echo $result->num;?>" onclick="clicked()">Envoyer au</a></td>

											<td><a href="edit.php?num=<?php echo $result->num;?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;</td>
											<td><a href="reg-users.php?del=<?php echo $result->num;?>" onclick="return confirm('Do you want to delete');"><i class="fa fa-close"></i></a></td>
									
											
										</tr>
										<?php  }} ?>
										
									</tbody>
								</table>		

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
