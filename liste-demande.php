<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{

if(isset($_REQUEST['eid']))
	{
$eid=intval($_GET['eid']);
$status="2";
$sql = "UPDATE demandeliste SET status=:status WHERE  id=:eid";
$query = $pdo->prepare($sql);
$my_sql = "DELETE from demandeliste where id=:eid";
$other_sql = "UPDATE demandeliste SET accord = 0 where id=:eid";
$otherquery = $pdo->prepare($other_sql);
$otherquery-> bindParam(':eid',$eid, PDO::PARAM_STR);

$my_query = $pdo->prepare($my_sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query-> bindParam(':eid',$eid, PDO::PARAM_STR);
$my_query-> bindParam(':eid',$eid, PDO::PARAM_STR);

$otherquery-> execute();
// $my_query -> execute();
$query -> execute();

}


if(isset($_REQUEST['aeid']))
	{
$aeid=intval($_GET['aeid']);
$status=1;

$sql = "UPDATE demandeliste SET status = :status, accord = 1 WHERE  id=:aeid";
$query = $pdo->prepare($sql);

$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
$query -> execute();

$msg="Réservation Confirmé";
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
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
		<?php include('includes/leftbar.php');?>
		<div class="content-">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">Les Demandes</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-body">
							<!-- <?php  if($msg){?>
								<div class="succWrap" style = "background-color : black"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> 
								</div><?php }?> -->
								<table id="zctb" class="display table table-striped table-bordered " cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Nom</th>
											<th>Prénom</th>
											<th>Cne</th>
											<th>Fillière</th>
											<th>Domaine</th>
											<th>Ville</th>
											<th>état de demande</th>
											<th>Accord</th>
                                            <th>Refus</th>
											
											
										</tr>
									</thead>
									<tfoot>
										<tr>
                                            <th>Nom</th>
											<th>Prénom</th>
											<th>Cne</th>
											<th>Fillière</th>
											<th>Domaine</th>
											<th>Ville</th>
											<th>état de demande</th>
											<th>Accord</th>
                                            <th>Refus</th>

											
										</tr>
									</tfoot>
									<tbody>

									<?php $sql = "SELECT * from demandeliste ";
											$query = $pdo -> prepare($sql);
											$query->execute();
											$results=$query->fetchAll(PDO::FETCH_OBJ);
											// $cnt=1;
											if($query->rowCount() > 0)
											{
											foreach($results as $result)
											{				?>	
										<tr>
											<td><?php echo htmlentities($result->nom);?></td>
											<td><?php echo htmlentities($result->prenom);?></td>
											<td><?php echo htmlentities($result->cne);?></td>
											<td><?php echo htmlentities($result->filliere);?></td>
											<td><?php echo htmlentities($result->domaine);?></td>
											<td><?php echo htmlentities($result->ville);?></td>


											
										
											<td><?php 
											if($result->status==0)
											{
											echo htmlentities('Pas encore confirmé');
											} else if ($result->status==1) {
												
											echo htmlentities('Confirmé');
											}else{
                                                echo htmlentities('Annulé !!');

                                            }
											
										?></td>
											
										<td><a href="liste-demande.php?aeid=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you really want confirm')"> Confirmer</a> </td>


										<td><a href="liste-demande.php?eid=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you really want to Cancel')"> Annuler</a>
										</td>

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
	<!-- <script src="js/bootstrap-select.min.js"></script>  -->
	<!-- <script src="js/bootstrap.min.js"></script> -->
	<!-- <script src="js/jquery.dataTables.min.js"></script> -->
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
	<script>
	function confirm_it(){
		confirm('Do you really want to Confirm this booking');
		prmopt("entrer heure de depart (dd/mm/yyyy");
		
	}
	</script>
	<script>

</script>
</body>
</html>
<?php } ?>
