<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{

	$email = $_SESSION['alogin'];
	$sql2 = "select cne from admin where username = '$email'";
	$query2  =  $pdo -> prepare($sql2);
	$query2->execute();
	$res = $query2->fetchAll(PDO::FETCH_OBJ);
	if($query2->rowCount() > 0)
	{
	foreach($res as $r)
	{
		$id_jury = $r->cne;

	}}



    // $id_jury = $_SESSION['alogin'];
	if(isset($_REQUEST['del']))
	{
		$delid=intval($_GET['del']);
		$sql = "UPDATE stage  SET dispo = 'disponible',cne_etudiant = 'aucun !!' where num  IN (SELECT stage_id from demandeliste where id=:delid)";
		$query = $pdo->prepare($sql);
		$query -> bindParam(':delid',$delid, PDO::PARAM_STR);
		$query -> execute();
		$msg="Stage supprimé !!";
		}
	
	if(isset($_REQUEST['aid'])){
		

		$aidid =intval($_GET['aid']);

		$sql = "DELETE from demandeliste  where stage_id = $aidid  ";
		$sql2 = "UPDATE stage SET dispo ='disponible' where num = $aidid ";

		$query = $pdo->prepare($sql);
		$query1 = $pdo->prepare($sql2);

		$query -> bindParam(':aidid',$aidid, PDO::PARAM_STR);
		$query1 -> bindParam(':aidid',$aidid, PDO::PARAM_STR);


		$query1 -> execute();


		$query -> execute();


	}

    if(isset($_POST['submit'])) {

        // $pdf=$_FILES["attestation"]["name"];
		$note=$_POST["note"];
        // echo "<script type='text/javascript'>alert('$note');</script>";



    

        $sql="UPDATE STAGE  set note = :note where id_jury = '$id_jury' ";
        $query = $pdo->prepare($sql);
        $query->bindParam(':note',$note,PDO::PARAM_STR);

        $query->execute();

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
	background-image: url("bc.png") ;
}
.panel-body {
	background-image: url("bc.png") ;

}
table{
	background-image: url("bc.png") ;
	color : white

}
.table-striped>tbody>tr:nth-of-type(odd) {
	background-image: url("bc.png") ;


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
	<?php include('includes/header_jury.php');?>

	<div class="ts-main-content">
		<?php include('includes/leftbar.php');?>
		<div class="content-">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">Notre stagiaire</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-body">
							

								<table id="zctb" class=" table table-striped table-bordered " cellspacing="0" width="100%">
									<thead>
									<tr>
										<th>Ecole</th>
										<th> Domaine</th>
										<th> Encadrant</th>
										<th> Nom d'étudiant</th>
										<th> Ville</th>
										<th> Durée</th>
										<th> Rapport</th>
										<th> Note</th>
										<!-- <th> Save </th>
										<th> Modifier </th> -->


										</tr>
										</tr>
									</thead>
									





										
									<tbody>

									<?php 
                                    $cne = isset($_GET['e_cne']) ? $_GET['e_cne'] : '';
                                    $sql ="SELECT stage.* from stage  where stage.cne_etudiant=:cne";
                                    $query = $pdo -> prepare($sql);
                                    $query-> bindParam(':cne', $cne, PDO::PARAM_STR);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($query->rowCount() > 0)
                                    {
                                    foreach($results as $result)
                                    {	?>
										<tr>
											
											
											
										<td> ENSA khouribga</td>

											<td> <?php echo htmlentities($result->domaine);?></td>
											<td><?php echo htmlentities($result->encadrant);?></td>
											<td>Ghoundal Youssef</td>
											<td><?php echo htmlentities($result->ville);?></td>
											<td><?php echo htmlentities($result->duree);?></td>
											<td><form method="post" class="form-horizontal" enctype="multipart/form-data">
											<?php if($result->rapport == 'n'){ ?>
											<td>Pas encore</td>
											<?php } ?>
											<?php if($result->rapport != 'n'){ ?>

											<button class=" btn-primary" name="subm" type="subm" style = "float:left">Cliquer ici pour telecharger</button>
											</form>

												<?php if(isset($_POST['subm'])) {?>
												
												<embed src="pdf/<?php echo htmlentities($result->rapport);?>" width="300px" height="10px" />

												
												<?php } ?></td>
												<?php } ?>
											<?php if($result->note == 0){ ?>		
                                            <form method="post" class="form-horizontal" enctype="multipart/form-data">


												<td><input type="text" name="note" style = "background-color : black" required></td>


												<td><button class=" btn-primary" name="submit" type="submit" style = "float:left">Save changes</button></td>
												</form><?php } ?>
												<?php if($result->note != 0){ ?>
												<td><?php echo htmlentities($result->note);?></td>
                                                <td><a href="update_note.php?cne_etd=<?php echo $result->cne_etudiant;?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;</td>
												<?php }?>

                                            

                                            
											

											
											








								
											
											

											
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
