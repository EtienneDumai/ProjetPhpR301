<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    
</body>
<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</html>
<?php
session_start();
$_SESSION['connexionOk'] = false;
echo "<div class ='container' ><form method = 'post'>
    <input type='text' name='login' placeholder='login' required='required'>
    <input type='password' name='password' placeholder='password' required='required'>
    <button type='submit' name='Connect' class = 'btn btn-dark'>Connexion</button>
    </form></div>";
if (isset($_POST['Connect'])) {
    if ($_POST['login'] == 'admin' && $_POST['password'] == 'admin') {
        echo "Connexion réussie";
        $_SESSION['connexionOk'] = true;
        header('Location: index.php');
    } else {
        echo "Connexion échouée";
    }
}
?>