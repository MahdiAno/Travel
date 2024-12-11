<?php
require 'database.php';
$id=null;
if(!empty($_GET['id'])){
  $id=$_REQUEST['id'];
}
if(!empty($_POST)){
  $id= $_POST['id'];
  $pdo=Database::connect();
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $sql = "DELETE FROM book  WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        Database::disconnect();
        header("Location: admin.php");

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

<br />
<div class="container">


<br />
<div class="span10 offset1">

<br />
<div class="row">

<br />
<h3>Delete a Book</h3>
<p>

</div>
<p>


<br />
<form class="form-horizontal" action="delete_book.php" method="post">
<input type="hidden" name="id" value="<?php echo $id;?>"/>

Are you sure to delete ?

<br />
<div class="form-actions">
<button type="submit" class="btn btn-danger">Yes</button>
<a class="btn btn-info" href="admin.php">No</a>
</div>
</form>
</div>
</div>
<!-- /container -->
  </body>
</html>
