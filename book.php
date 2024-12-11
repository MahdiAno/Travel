<?php
require 'database.php';
if($_SERVER["REQUEST_METHOD"]== "POST" && !empty($_POST)){
   // Initialize the session
    session_start();
  //on initialise nos messages d'erreurs;
  $countryError = '';
  $pplError='';
  $arrivalsError='';
  $leavingError ='';
  $msgError ='';
  

  // on recupère nos valeurs
  $country= htmlentities(trim($_POST['country']));
  $ppl= htmlentities(trim($_POST['ppl']));
  $arrivals= htmlentities(trim($_POST['arrivals']));
  $leaving= htmlentities(trim($_POST['leaving']));
  $msg= htmlentities(trim($_POST['msg']));
  $username= $_SESSION["username"];

  // on vérifie nos champs
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


   // si les données sont présentes et bonnes, on se connecte à la base
                  if ($valid) {
                    $pdo = Database::connect();
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO book (country, ppl, arrivals, leaving, msg, username) values(?, ?, ?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($country,$ppl, $arrivals, $leaving, $msg,$username));
            Database::disconnect();
            header("Location: index.php");
        }
    }
?>