<?php 
include 'BD/connexion.php';
include 'vignette.php';
$sql = "SELECT p_id, nom, prix, chemin_image FROM produits";
$resultat = $conn->query($sql);
session_start(); // Démarre la session pour pouvoir vérifier la variable de session

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['connexionOk']) || $_SESSION['connexionOk'] !== true) {
    // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
    header('Location: login.php');
    exit; // Stoppe l'exécution du script pour s'assurer que la redirection se fait bien
}

?>

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

        <!-- Bouton pour mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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


<div class="container py-5">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4 justify-content-center align-items-center" style="min-height: 100vh;">
        <?php while($drogue = $resultat->fetch_assoc()): ?>
            <?php 
            $maxLarg = 300;
            $maxLong = 300;
            $src = $drogue['chemin_image'];
            $dest = 'vignettes/' . $drogue['nom'] . '.jpg';

            if (!file_exists($dest)) {
                createVignette($src, $dest, $maxLarg, $maxLong);
            }
            ?>
            <div class="col d-flex justify-content-center align-items-center">
                <div class="card h-100 shadow-sm">
                    <!-- Image du produit -->
                    <img src="<?php echo $dest; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($drogue['nom']); ?>">
                    
                    <!-- Corps de la carte avec nom et prix -->
                    <div class="card-body text-center">
                        <h5 class="card-title"><?php echo htmlspecialchars($drogue['nom']); ?></h5>
                        <p class="card-text">
                            <strong>Prix:</strong> <?php echo htmlspecialchars($drogue['prix']); ?> €
                        </p>
                    </div>

                    <!-- Footer de la carte avec un bouton -->
                    <div class="card-footer bg-transparent border-0 text-center">
                        <a href="#" class="btn btn-primary w-100">Ajouter au panier</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
