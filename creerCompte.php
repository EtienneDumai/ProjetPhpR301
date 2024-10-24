<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <title>Créer un compte</title>

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
                    <h4 class="card-title text-center mb-4">Créer un compte</h4>
                    <!-- Formulaire de création de compte -->
                    <form method="post">
                        <div class="mb-3">
                            <label for="login" class="form-label">Login</label>
                            <input type="text" class="form-control" id="login" name="login" placeholder="Choisissez un identifiant" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Choisissez un mot de passe" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" name="CreerCompte" class="btn btn-dark">Créer mon compte</button>
                        </div>
                    </form>

                    <?php
                    // Inclure le fichier utilisateurs.php pour accéder aux fonctions
                    include 'BD/utilisateurs.php';

                    // Vérifier si le formulaire a été soumis
                    if (isset($_POST['CreerCompte'])) {
                        $pseudo = $_POST['login'];
                        $motDePasse = $_POST['password'];

                        // Appeler la fonction de création d'utilisateur
                        if (creerUtilisateur($pseudo, $motDePasse)) {
                            header('location: login.php');
                            exit;
                        } else {
                            echo "<div class='alert alert-danger mt-3' role='alert'>Erreur lors de la création du compte. L'identifiant existe peut-être déjà.</div>";
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
