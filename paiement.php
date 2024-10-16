<?php
include 'BD/connexion.php'; // Inclusion du fichier de connexion à la base de données
session_start(); // Démarre la session pour pouvoir vérifier la variable de session

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['connexionOk']) || $_SESSION['connexionOk'] !== true) {
    // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
    header('Location: login.php');
    exit; // Stoppe l'exécution du script pour s'assurer que la redirection se fait bien
}
?>
<?php if (isset($_GET['add']) && $_GET['add'] == 'errorValCarte'): ?>
            <div class="alert alert-danger text-center">
                Le numéro de carte n'est pas valide.
            </div>
            <?php elseif (isset($_GET['add']) && $_GET['add'] == 'errorLenCarte'): ?>
            <div class="alert alert-danger text-center">
                Le numéro de carte n'est pas assez long.
            </div>
            <?php elseif (isset($_GET['add']) && $_GET['add'] == 'errorDate'): ?>
            <div class="alert alert-danger text-center">
                La date d'expiration doit être supérieur à la date d'aujourd'hui + 3 mois.
            </div>
        <?php endif; ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <title>Stup</title>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <!-- Logo ou titre -->
            <a class="navbar-brand" href="#">Stup.net</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Liens de navigation -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Produits</a>
                    </li>
                </ul>

                <!-- Bouton du panier -->
                <a href="#" class="btn btn-primary">
                    <i class="bi bi-cart-fill"></i> Panier
                </a>

                <a href="backoffice.php" class="btn btn-primary ms-2">
                    <i class="bi bi-cart-fill"></i> Back Office
                </a>

                <a href="logout.php" class="btn btn-danger ms-2">
                    <i class="bi bi-cart-fill"></i> Déconnexion
                </a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form method="POST" action="validationPaiement.php">
                            <div class="mb-3">
                                <label for="numeroCarte" class="form-label">Numéro de carte (16 chiffres) :</label>
                                <input type="text" id="numeroCarte" name="numeroCarte" maxlength="16" class="form-control" required>
                                <?php if (!empty($erreurCarte)) { ?>
                                    <div class="text-danger"><?php echo $erreurCarte; ?></div>
                                <?php } ?>
                            </div>
                            <div class="mb-3">
                                <label for="dateExpiration" class="form-label">Date de validité (format YYYY-MM) :</label>
                                <input type="month" id="dateExpiration" name="dateExpiration" class="form-control" required>
                                <?php if (!empty($erreurDate)) { ?>
                                    <div class="text-danger"><?php echo $erreurDate; ?></div>
                                <?php } ?>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-dark">Valider le paiement</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
