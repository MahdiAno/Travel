<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true && $_SESSION["username"] == 'admin') {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font: 14px sans-serif;
            text-align: center;
        }
    </style>
</head>

<body>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to the Dashboard .</h1>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>

    <div class="table-responsive">
        <h1>BOOK LIST : </h1>
        <table class="table table-hover table-bordered">
            <thead>
                <th>Book ID</th>
                
                <p>



                    <th>Country</th>
                <p>



                    <th>How Many</th>
                <p>



                    <th>Arrivals</th>
                <p>



                    <th>Leaving</th>
                <p>



                    <th>Book Details</th>
                <p>



                    <th>Book Name</th>
                    <p>

            </thead>
            <p>


                <br />
                <tbody>
                    <?php include 'database.php'; //on inclut notre fichier de connection
                    $pdo = Database::connect();  //on se connecte à la base
                    $sql = 'SELECT * FROM book ORDER BY id DESC'; //on formule notre requete
                    foreach ($pdo->query($sql) as $row) { //on cree les lignes du tableau avec chaque valeur retournée

                        echo '<td>' . $row['id'] . '</td><p>';
                        echo '<td>' . $row['country'] . '</td><p>';
                        echo '<td>' . $row['ppl'] . '</td><p>';
                        echo '<td>' . $row['arrivals'] . '</td><p>';
                        echo '<td>' . $row['leaving'] . '</td><p>';
                        echo '<td>' . $row['msg'] . '</td><p>';
                        echo '<td>' . $row['username'] . '</td><p>';

                        echo '<td>';
                        echo '<a class="btn btn-info" href="read_book.php?id=' . $row['id'] . '">Read</a>'; // un autre td pour le bouton d'edition
                        echo '</td><p>';
                        echo '<td>';
                        echo '<a class="btn btn-success" href="update_book.php?id=' . $row['id'] . '">Update</a>'; // un autre td pour le bouton d'update
                        echo '</td><p>';
                        echo '<td>';
                        echo '<a class="btn btn-danger" href="delete_book.php?id=' . $row['id'] . ' ">Delete</a>'; // un autre td pour le bouton de suppression
                        echo '</td><p>';
                        echo '</tr><p>';
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