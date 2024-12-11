<?php
require('database.php');
//on appelle notre fichier de config
$id = null;
if (!empty($_GET['id'])) {
  $id = $_REQUEST['id'];
}
if (null == $id) {
  header("location:index.php");
}
else {
  //on lance la connection et la requete
  $pdo = Database ::connect();
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;
    $sql = "SELECT * FROM book where id =?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
}



/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
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
<div class="span10 offset1">
<div class="row">
<h3>BOOK INFO :</h3>
</div>
<div class="form-horizontal" >


<div class="form-group">
<label class="control-label">Book ID :</label>
<div class="controls">
<label class="checkbox">
<?php echo $data['id']; ?>
</label>
</div>
</div>

<div class="form-group">
<label class="control-label">Where To :</label>
<div class="controls">
<label class="checkbox">
<?php echo $data['country']; ?>
</label>
</div>
</div>

<div class="form-group">
<label class="control-label">How Many:</label>
<div class="controls">
<label class="checkbox">
<?php echo $data['ppl']; ?>
</label>
</div>
</div>

<div class="form-group">
<label class="control-label">arrivals Date:</label>
<div class="controls">
<label class="checkbox">
<?php echo $data['arrivals']; ?>
</label>
</div>
</div>

<div class="form-group">
<label class="control-label">leaving Date:</label>
<div class="controls">
<label class="checkbox">
<?php echo $data['leaving']; ?>
</label>
</div>
</div>

<div class="form-group">
<label class="control-label">Book Details:</label>
<div class="controls">
<label class="checkbox">
<?php echo $data['msg']; ?>
</label>
</div>
</div>

<div class="form-group">
<label class="control-label">Booker Name :</label>
<div class="controls">
<label class="checkbox">
<?php echo $data['username']; ?>
</label>
</div>
</div>

<div class="form-actions">
<a class="btn btn-info" href="admin.php">Back</a>
</div>
</div>
</div>
</div>
<!-- /container -->
</body>
</html>
