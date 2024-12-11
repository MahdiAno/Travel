<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>League Pro 1</title>

        	<link href="css/bootstrap.min.css" rel="stylesheet">
        	<link href="css/responsive.css" rel="stylesheet">


    </head>
    <body>


<div class="container">
<div class="row">
<h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to the Back-Office .</h1>
<p>
    <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
    <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
</p>

</div>


<br />
<div class="row">

                    <a href="add_team.php" class="btn btn-success">Add A New Team</a>
                    <a href="add_referee.php" class="btn btn-success">Add A New Referee</a>
                    <a href="add_player.php" class="btn btn-success">Add A New Player</a>
                    <a href="add_manager.php" class="btn btn-success">Add A New Manager</a>
                    <a href="add_coach.php" class="btn btn-success">Add A New Coach</a>
                    <a href="add_match.php" class="btn btn-success">Add A New Match</a>


<div class="table-responsive">
  <h1>TEAMS LIST : </h1>
<table class="table table-hover table-bordered">
<thead>
<th>Team Logo</th>
<p>



<th>Team Name</th>
<p>



<th>Abbreviation</th>
<p>



<th>creation_date</th>
<p>



<th>Team Manager</th>
<p>



<th>Team Coach</th>
<p>



<th>Team Stadium</th>
<p>


</thead>
<p>


<br />
<tbody>
                        <?php include 'database.php'; //on inclut notre fichier de connection
                        $pdo = Database::connect();  //on se connecte à la base
                        $sql = 'SELECT * FROM team ORDER BY name DESC'; //on formule notre requete
                        foreach ($pdo->query($sql) as $row) { //on cree les lignes du tableau avec chaque valeur retournée

                            echo'

<td><img src="images/logo/' . $row['logo'] . '"></td>
<p>
';
                            echo'

<td>' . $row['name'] . '</td>
<p>
';
                            echo'

<td>' . $row['abbreviation'] . '</td>
<p>
';
                            echo'

<td>' . $row['creation_date'] . '</td>
<p>
';
                            echo'

<td>' . $row['manager'] . '</td>
<p>
';
                            echo'

<td>' . $row['coach'] . '</td>
<p>
';
                            echo'

<td>' . $row['stadium'] . '</td>
<p>
';

                            echo '

<td>';
                            echo '<a class="btn btn-info" href="read_team.php?name=' . $row['name'] . '">Read</a>';// un autre td pour le bouton d'edition
                            echo '</td>
<p>
';
                            echo '

<td>';
                            echo '<a class="btn btn-success" href="update_team.php?id=' . $row['id'] . '">Update</a>';// un autre td pour le bouton d'update
                            echo '</td>
<p>
';
                            echo'

<td>';
                            echo '<a class="btn btn-danger" href="delete_team.php?name=' . $row['name'] . ' ">Delete</a>';// un autre td pour le bouton de suppression
                            echo '</td>
<p>
';
                            echo '</tr>
<p>
';
                          }
                                                Database::disconnect(); //on se deconnecte de la base
                        ;
                        ?>
</tbody>
<p>

</table>
<p>

</div>
<p>


</div>
<p>


</div>
<p>

    </body>
</html>
