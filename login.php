<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <title>Connexion</title>
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title text-center mb-4">Connexion</h4>
                    <!-- Formulaire de connexion -->
                    <form method="post">
                        <div class="mb-3">
                            <label for="login" class="form-label">Login</label>
                            <input type="text" class="form-control" id="login" name="login" placeholder="Entrez votre login" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Entrez votre mot de passe" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" name="Connect" class="btn btn-dark">Connexion</button>
                        </div>
                    </form>
                    <?php
                    session_start();
                    $_SESSION['connexionOk'] = false;
                    
                    if (isset($_POST['Connect'])) {
                        if ($_POST['login'] == 'admin' && $_POST['password'] == 'admin') {
                            echo "<div class='alert alert-success mt-3' role='alert'>Connexion réussie</div>";
                            $_SESSION['connexionOk'] = true;
                            header('Location: index.php');
                        } else {
                            echo "<div class='alert alert-danger mt-3' role='alert'>Connexion échouée</div>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
