<?php
session_start();
// error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
	$cne = $_SESSION['alogin'];
	// echo "<script type='text/javascript'>alert('$cne');</script>";

	if(isset($_REQUEST['aeid']))
	{
    $aeid=intval($_GET['aeid']);
    // $status=1;
    // fach t CONFIIIRMER DIR CH SET X = 1 w dir wahd if bach y t afficha
	$my_sql = "UPDATE stage SET dispo = 'non disponible',cne_etudiant ='$cne' where num  IN (SELECT stage_id from demandeliste where id=:aeid) ";

    $sql = "UPDATE demandeliste SET confirmer = 1, refuser =0  where id=:aeid";
	$my_query = $pdo->prepare($my_sql);
    $query = $pdo->prepare($sql);

    $query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
	$my_query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);

	$my_query->execute();
    $query -> execute();

    }

    if(isset($_REQUEST['eid']))
	{
    $eid=intval($_GET['eid']);

    $sql = "UPDATE demandeliste SET refuser = 1,confirmer = 0 WHERE  id=:eid";
    $query = $pdo->prepare($sql);

    $query-> bindParam(':eid',$eid, PDO::PARAM_STR);
    $query -> execute();

    }

    if(isset($_REQUEST['vid']))
	{
    $vid=intval($_GET['vid']);

    $sql = "UPDATE demandeliste SET avertir = 1, confirmer = 10 WHERE  id=:vid";
    $query = $pdo->prepare($sql);

    $query-> bindParam(':vid',$vid, PDO::PARAM_STR);
    $query -> execute();

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

		</style>

</head>

<body>
	<?php include('includes/header_etd.php');?>

	<div class="ts-main-content">
		<?php include('includes/leftbar.php');?>
		<div class="content-">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">


					<?php 
									$sql2 = "SELECT  * from  demandeliste where cne = '$cne' and afficher = 1 "; 
										$query2 = $pdo -> prepare($sql2);
										$query2->execute();
										$results=$query2->fetchAll(PDO::FETCH_OBJ);
										if($query2->rowCount() > 0)
										{
										foreach($results as $result)
										{					
											if ($result->confirmer == 0){ 
												// echo "<script type='text/javascript'>alert('sdffds');</script>";

											?>	

									<h2 class="page-title">Stage suggéré</h2>

									<!-- Zero Configuration Table -->
									<div class="panel panel-default">
										<div class="panel-body">

							



							
							
								<table id="zctb" class=" table table-striped table-bordered " cellspacing="0" width="100%">
									<thead>
									<tr>


										<th> Domaine </th>
										<th> Entreprise </th>
                                        <th> Ville </th>
										<th> Informations de stage suggére</th>
										<?php if($result->refuser == 1){ ?>
										<th> état de stage </th> <?php }?>

										<th> Accepter </th>
                                        <th> Refuser </th>




										</tr>
										</tr>
									</thead>
									

										<?php 
										if($result->stage_id){
										$sql3 = "SELECT  * from  stage where num = $result->stage_id "; 
										$query3 = $pdo -> prepare($sql3);
										$query3->execute();
										$rst=$query3->fetchAll(PDO::FETCH_OBJ);
										
										if($query3->rowCount() > 0)
										{
										foreach($rst as $rl) { ?>
										
											<td><?php echo htmlentities($rl->domaine);?></td>
											<td><?php echo htmlentities($rl->entreprise);?></td>
											<td><?php echo htmlentities($rl->ville);?></td>
											<td><?php echo htmlentities($rl->duree);?></td>
											<?php if($result->refuser == 1){ ?>
											<td style = "color : yellow"><b>VOUS AVEZ REFUSER CE STAGE</b></td> <?php }?>

											<td><a href="etat_demande.php?aeid=<?php echo htmlentities($result->id);?>" onclick="avertir">Accepter</a></td> 
											<td><a href="etat_demande.php?eid=<?php echo htmlentities($result->id);?>" onclick="avertir">Refuser</a></td> 


									
										
										
										
										


										



										</tr>
									
									
										<?php  }}}}}} ?>
										
									</tbody>
								</table>
								<?php 
										$sql = "SELECT  * from  demandeliste where cne = '$cne' and confirmer = 1 and afficher = 1 "; 
										$query = $pdo -> prepare($sql);
										$query->execute();
										$results=$query->fetchAll(PDO::FETCH_OBJ);
										
										if($query->rowCount() > 0)
										{
										foreach($results as $result){


										if ($result->confirmer == 1){

										$sql1 = "SELECT  * from  stage where num = $result->stage_id "; 
										$query1 = $pdo -> prepare($sql1);
										$query1->execute();
										$rs=$query1->fetchAll(PDO::FETCH_OBJ);
										
										if($query1->rowCount() > 0)
										{
										foreach($rs as $r){?>
								

								<h2 class="page-title">Votre Stage</h2>

								<!-- Zero Configuration Table -->
								<div class="panel panel-default">
									<div class="panel-body">
																
								<table id="zctb" class=" table table-striped table-bordered " cellspacing="0" width="100%">
									<thead>
									<tr>
                                        <th> domaine</th>
										<th> Entreprise</th>
										<th> Ville </th>
										<th> Durée </th>
                                        <th> Encadrant </th>
                                        <th> Avertir </th>




										</tr>
										</tr>
									</thead>
									


										<tr>
										
													
											<td><?php echo htmlentities($r->domaine);?></td>
											<td><?php echo htmlentities($r->entreprise);?></td>
											<td><?php echo htmlentities($r->ville);?></td>
											<td><?php echo htmlentities($r->duree);?></td>
											<td><?php echo htmlentities($r->encadrant);?></td>
											<td><a href="etat_demande.php?vid=<?php echo htmlentities($result->id);?>" onclick="avertir">avertir</a></td> 

										<?php if($result->avertir == 1)	{?>


											<h2 class="page-title">Veuillez saisir une demande SVP !</h2>

										<?php }}?>	


										



										</tr>
									<tbody>
						
										<?php }}}} ?>
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
