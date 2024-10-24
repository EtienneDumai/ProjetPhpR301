<?php
include 'BD/connexion.php'; // Inclusion du fichier de connexion à la base de données
session_start(); // Démarre la session pour pouvoir vérifier la variable de session

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['connexionOk']) || $_SESSION['connexionOk'] !== true) {
    // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
    header('Location: login.php');
    exit; // Stoppe l'exécution du script pour s'assurer que la redirection se fait bien
}

// Récupérer l'ID du produit depuis l'URL
if (isset($_GET['id'])) {
    $p_id = intval($_GET['id']); // Conversion en entier pour éviter les injections SQL

    // Requête pour obtenir les détails du produit
    $sql = "SELECT * FROM Produits WHERE p_id = $p_id";
    $resultat = $conn->query($sql);

    if ($resultat->num_rows > 0) {
        $produit = $resultat->fetch_assoc();
    } else {
        echo '<div class="alert alert-danger text-center">Produit non trouvé</div>';
        exit;
    }
} else {
    echo '<div class="alert alert-danger text-center">Aucun produit sélectionné</div>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($produit['nom']);?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <!-- Logo ou titre -->
        <a class="navbar-brand" href="#">Stup.net</a>

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
            <a href="#" class="btn btn-success">
                <i class="bi bi-cart-fill"></i> Panier     
            </a>

            <a href="logout.php" class="btn btn-danger ms-2">
                <i class="bi bi-cart-fill"></i> Déconnexion
            </a>
            

        </div>
        

    </div>
</nav>


<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card h-100 shadow-sm">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="<?php echo $produit['chemin_image']; ?>" class="img-fluid rounded-start" alt="<?php echo htmlspecialchars($produit['nom']); ?>">
                    </div>

                    <div class="col-md-8 d-flex flex-column justify-content-center">
                        <h1 class="card-title text-center"><?php echo htmlspecialchars($produit['nom']); ?></h1>
                        <div class="card-body d-flex flex-column justify-content-center ">
                            
                            <p class="card-text">
                                <strong>Description:</strong> <?php echo htmlspecialchars($produit['description']); ?>
                            </p>
                            <p class="card-text">
                                <strong>Catégorie:</strong> <?php echo htmlspecialchars($produit['categorie']); ?>
                            </p>
                            <p class="card-text">
                                <strong>Prix:</strong> <?php echo htmlspecialchars($produit['prix']); ?> €
                            </p>
                            <p class="card-text">
                                <strong>Quantité disponible:</strong> <?php echo htmlspecialchars($produit['quantite']); ?>
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-0 text-center">
                            <a href="panier.php?id=<?php echo $produit['p_id']; ?>" class="btn btn-success w-100">Ajouter au panier</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
