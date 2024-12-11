<?php
require 'database.php';
$id = null;
if ( !empty($_GET['id'])) {
  $id = $_REQUEST['id'];
}
if ( null==$id ) {
  header("Location: index.php");
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
  // on initialise nos erreurs
  $countryError = null;
  $pplError=null;
  $arrivalsError=null;
  $leavingError =null;
  $msgError =null;

  // On assigne nos valeurs
  $country= $_POST['country'];
  $ppl= $_POST['ppl'];
  $arrivals= $_POST['arrivals'];
  $leaving= $_POST['leaving'];
  $msg= $_POST['msg'];

  // On verifie que les champs sont remplis
  $valid = true;
  
  if (empty($country)) {
    $countryError = 'Please select a country ';
    $valid = false;
  }

  if(empty($ppl)){
    $pplError ='Please enter how many ppl going ';
    $valid= false;
  }

  if (empty($arrivals)) {
     $arrivalsError = 'Please enter arrivals date';
     $valid = false;
  }

  if (empty($leaving)) {
    $leavingError = 'Please enter leaving date';
    $valid = false;
  }

  if (empty($msg)) {
    $msgError = 'Please enter a msg';
    $valid = false;
  }

    // mise à jour des donnés
    if ($valid) {
      $pdo = Database::connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "UPDATE book SET country= ?,ppl= ?, arrivals= ?, leaving= ?, msg= ? WHERE id = ?";
                $q = $pdo->prepare($sql);
                $q->execute(array($country, $ppl, $arrivals, $leaving, $msg, $id));
                Database::disconnect();
                header("Location: admin.php");
            }
           }else {

                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM book where id = ?";
                $q = $pdo->prepare($sql);
                $q->execute(array($id));
                $data = $q->fetch(PDO::FETCH_ASSOC);
                $country = $data['country'];
                $ppl = $data['ppl'];
                $arrivals = $data['arrivals'];
                $leaving = $data['leaving'];
                $msg = $data['msg'];
                Database::disconnect();
            }

        ?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Update Team</title>
        	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
          <style>
        /* Custom CSS for additional styling */
        body {
            padding-top: 20px;
            background-color: #f8f9fa;
        }
        .container {
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
            padding: 30px;
            margin-top: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-actions {
            margin-top: 20px;
        }
    </style>
    </head>
    <body>

<div class="container">
<div class="row">
<h3>Modify a Team</h3>
</div>
<form method="post" action="update_book.php?id=<?php echo $id ;?>">

  <span style="margin: 5px">
  <div class="form-group <?php echo !empty($countryError)?'error':'';?>">
  <label class="control-label col-sm-2">country :</label>
  <div class="col-sm-10">
    <input type="text" name="country"  placeholder="country name" class="form-control" value="<?php echo !empty($country)?$country:'';?>">
    <?php if (!empty($countryError)): ?>
    <span class="help-inline"><?php echo $countryError;?></span>
    <?php endif; ?>
  </div>
  </div>
  </span>

  <span style="margin: 5px">
  <div class="form-group<?php echo !empty($pplError)?'error':'';?>">
  <label class="control-label col-sm-2">How Many:</label>
  <div class="col-sm-10">
    <input type="text" name="ppl" class="form-control" value="<?php echo !empty($ppl)?$ppl:''; ?>">
    <?php if(!empty($pplError)):?>
    <span class="help-inline"><?php echo $pplError ;?></span>
    <?php endif;?>
  </div>
  </div>
  </span>

  <span style="margin: 5px">
  <div class="form-group <?php echo !empty($arrivalsError)?'error':'';?>">
  <label class="control-label col-sm-2">arrivals Date:</label>
  <div class="col-sm-10">
    <input type="date" name="arrivals" placeholder="YYYY-MM-DD" class="form-control" value="<?php echo !empty($arrivals)?$arrivals:'';?>">
    <?php if (!empty($arrivalsError)): ?>
    <span class="help-inline"><?php echo $arrivalsError;?></span>
    <?php endif;?>
  </div>
  </div>
  </span>

  <span style="margin: 5px">
  <div class="form-group <?php echo !empty($leavingError)?'error':'';?>">
  <label class="control-label col-sm-2">leaving Date:</label>
  <div class="col-sm-10">
    <input type="date" name="leaving" placeholder="YYYY-MM-DD" class="form-control" value="<?php echo !empty($leaving)?$leaving:'';?>">
    <?php if (!empty($leavingError)): ?>
    <span class="help-inline"><?php echo $leavingError;?></span>
    <?php endif;?>
  </div>
  </div>
  </span>

  <span style="margin: 5px">
  <div class="form-group  <?php echo !empty($msgError)?'error':'';?>">
  <label class="control-label col-sm-2">Book Details:</label>
  <div class="col-sm-10">
  <input type="text" name="msg" class="form-control" value="<?php echo !empty($msg)? $msg:'' ; ?>">
  <?php if(!empty($msgError)):?>
  <span class="help-inline"><?php echo $msgError ;?></span>
  <?php endif;?>
  </div>
  </div>
  </span>


<div class="form-actions">
<input type="submit" class="btn btn-success" name="submit" value="submit">
<a class="btn btn-info" href="admin.php">Retour</a>
</div>

</form>
</div>
</body>
</html>
