<?php
include 'BD/admin.php';
session_start(); // Démarre la session pour vérifier si l'utilisateur est connecté

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['connexionOk']) || $_SESSION['connexionOk'] !== true) {
    // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <title>Ajout d'un produit</title>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Stup.net</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Produits</a>
                    </li>
                </ul>
                <a href="backoffice.php" class="btn btn-primary ms-2">
                    <i class="bi bi-cart-fill"></i> Back Office
                </a>
                <a href="logout.php" class="btn btn-danger ms-2">Déconnexion</a>
            </div>
        </div>
    </nav>

    <!-- Container pour le formulaire -->
    <div class="container py-5">
        <h2 class="text-center mb-4">Ajouter un nouveau produit</h2>

        <!-- Affichage du message de succès ou d'erreur -->
        <?php if (isset($_GET['add']) && $_GET['add'] == 'success'): ?>
            <div class="alert alert-success text-center">
                Produit ajouté avec succès.
            </div>
        <?php elseif (isset($_GET['add']) && $_GET['add'] == 'error'): ?>
            <div class="alert alert-danger text-center">
                Erreur lors de l'ajout du produit.
            </div>
            <?php elseif (isset($_GET['add']) && $_GET['add'] == 'errorFormat'): ?>
            <div class="alert alert-danger text-center">
                Erreur lors de l'ajout du produit, l'image n'est pas au format .jpg.
            </div>
        <?php endif; ?>

        <form action="ajoutArticle.php" method="POST" class="mx-auto" style="max-width: 600px;"
            enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom du produit</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="categorie" class="form-label">Catégorie</label>
                <input type="text" class="form-control" id="categorie" name="categorie" required>
            </div>
            <div class="mb-3">
                <label for="prix" class="form-label">Prix</label>
                <input type="number" step="0.01" class="form-control" id="prix" name="prix" required>
            </div>
            <div class="mb-3">
                <label for="quantite" class="form-label">Quantité</label>
                <input type="number" class="form-control" id="quantite" name="quantite" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image du produit</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/jpeg" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Ajouter le produit</button>
        </form>
    </div>

    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>