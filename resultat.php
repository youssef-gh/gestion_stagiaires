<?php
session_start();
// error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{



	$email = $_SESSION['alogin'];
	

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
	<?php include('includes/header.php');?>

	<div class="ts-main-content">
		<?php include('includes/leftbar.php');?>
		<div class="content-">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">


                                        <?php

										$sql1 = "SELECT  * from  stage where cne_etudiant != 'aucun' "; 
										$query1 = $pdo -> prepare($sql1);
										$query1->execute();
										$rs=$query1->fetchAll(PDO::FETCH_OBJ);
										
										if($query1->rowCount() > 0)
										{
										foreach($rs as $r){?>
								

								<h2 class="page-title">Les Stage</h2>

								<!-- Zero Configuration Table -->
								<div class="panel panel-default">
									<div class="panel-body">
																
								<table id="zctb" class=" table table-striped table-bordered " cellspacing="0" width="100%">
									<thead>
									<tr>
                                        <th> domaine</th>
                                        <th> nom</th>
                                        <th> prenom</th>


										<th> Entreprise</th>
										<th> Ville </th>
										<th> Durée </th>
                                        <th> Encadrant </th>
										<th> rapport </th>
                                        <th> Attestation d'appréciation </th>
										<th> Attestation de présence </th>
                                        <th> note </th>

                                        




										</tr>
										</tr>
									</thead>
									


										<tr>
										
													
											<td><?php echo htmlentities($r->domaine);?></td>

                                            <?php 
                                            
                                            $sql1 = "SELECT  * from  etudiant where cne = '$r->cne_etudiant'"; 
                                            $query1 = $pdo -> prepare($sql1);
                                            $query1->execute();
                                            $res=$query1->fetchAll(PDO::FETCH_OBJ);
                                            
                                            if($query1->rowCount() > 0)
                                            {
                                            foreach($res as $re){?>
                                            <td><?php echo htmlentities($re->nom);?></td>
											<td><?php echo htmlentities($re->prenom);?></td>
                                            <?php }} ?>

											<td><?php echo htmlentities($r->entreprise);?></td>
											<td><?php echo htmlentities($r->ville);?></td>
											<td><?php echo htmlentities($r->duree);?></td>
											<td><?php echo htmlentities($r->encadrant);?></td>
											<!-- if stage terminer == 1 -->
											<?php if($r->rapport != 'n'){ ?>
                                                <td> 

                                                <form method="post" class="form-horizontal" enctype="multipart/form-data">  
                                                <button class=" btn-primary" name="subm" type="subm" style = "float:left">Cliquer ici pour telecharger</button>
											</form>

												<?php if(isset($_POST['subm'])) {?>
												
												<embed src="pdf/<?php echo htmlentities($r->rapport);?>" width="300px" height="10px" />

												
												<?php } ?></td>
												<?php } ?>
											<?php if($r->rapport == 'n'){ ?>
                                                <td>Pas encore</td>
                                                <?php } ?>

                                                <?php if($r->appreciation != 'n'){ ?>


                                            <td> 

                                            <form method="post" class="form-horizontal" enctype="multipart/form-data">

                                            <button class=" btn-primary" name="sub" type="submit" style = "float:left">Cliquer ici pour telecharger</button>
                                            </form>

                                                <?php if(isset($_POST['sub'])) {?>
                                                
                                                <embed src="pdf/<?php echo htmlentities($r->appreciation);?>" width="300px" height="10px" />

                                                </td>
                                                <?php } ?>
                                                <?php } ?>

                                                <?php if($r->appreciation == 'n'){ ?>
                                                <td>Pas encore</td>
                                                <?php } ?>

                                                <?php if($r->presence != 'n'){ ?>

                                                <td>
                                                <form method="post" class="form-horizontal" enctype="multipart/form-data">

                                                <button class=" btn-primary" name="subm" type="submit" style = "float:left">Cliquer ici pour telecharger</button>
                                                </form>

                                                    <?php if(isset($_POST['subm'])) {?>
                                                    
                                                    <embed src="pdf/<?php echo htmlentities($r->presence);?>" width="300px" height="10px" />

                                                    
                                                    <?php } ?>
                                                </td>
                                                <?php } ?>

                                                <?php if($r->presence == 'n'){ ?>
                                                <td>Pas encore</td>
                                                <?php } ?>

                                                <?php if($r->note != 0){ ?>
												<td><?php echo htmlentities($r->note);?></td> 
                                                <?php } ?>
                                                <?php if($r->note == 0){ ?>
												<td>pas encore</td> 
                                                <?php } ?>


											

											
									



										



										</tr>
									<tbody>
						
										<?php }} ?>
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
