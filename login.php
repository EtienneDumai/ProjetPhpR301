<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <title>Stup !</title>

    <style>
        /* CSS pour définir l'image d'arrière-plan */
        body {
            background-image: url('img/background.jpg');
            background-size: cover; /* Ajuste l'image pour couvrir tout l'écran */
            background-position: center; /* Centre l'image */
            background-repeat: no-repeat; /* Empêche la répétition de l'image */
            height: 100vh; /* Définit la hauteur à 100% de la fenêtre */
        }

        .card {
            background-color: rgba(255, 255, 255, 0.85); /* Transparence sur le fond de la carte */
        }
    </style>
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
                            <input type="text" class="form-control" id="login" name="login" placeholder="Entrez votre identifiant" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Entrez votre mot de passe" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" name="Connecter" class="btn btn-dark">Connexion</button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <a href="creerCompte.php" class="btn btn-link">Rejoignez nous !</a>
                    </div>

                    <?php
                    // Inclure le fichier utilisateurs.php pour accéder aux fonctions
                    include 'BD/connexion.php';
                    include 'BD/utilisateurs.php';

                    // Vérifier si le formulaire a été soumis
                    if (isset($_POST['Connecter'])) {
                        $pseudo = $_POST['login'];
                        $motDePasse = $_POST['password'];

                        // Appeler la fonction de connexion
                        if (seConnecter($pseudo, $motDePasse, $conn)) {
                            echo "<div class='alert alert-success mt-3' role='alert'>Connexion réussie.</div>";
                            header('Location: ' . ($_SESSION['role'] == 'admin' ? 'backoffice.php' : 'index.php'));

                            exit();
                        } else {
                            echo "<div class='alert alert-danger mt-3' role='alert'>Connexion échouée. Login ou mot de passe incorrect</div>";
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
