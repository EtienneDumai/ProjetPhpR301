<?php
include 'BD/connexion.php';

if (isset($_GET['p_id'])) {
    $p_id = intval($_GET['p_id']);

    // Récupérer les informations du produit à partir de la base de données
    $sql = "SELECT * FROM produits WHERE p_id = $p_id";
    $resultat = $conn->query($sql);

    if ($resultat->num_rows > 0) {
        $produit = $resultat->fetch_assoc();
    } else {
        echo "Produit non trouvé.";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prix = $_POST['prix'];
    $chemin_image = $_POST['chemin_image'];
    $categorie = $_POST['categorie'];
    $description = $_POST['description'];
    $quantite = intval($_POST['quantite']); // Pour éviter toute injection malveillante dans ce champ numérique

    // Mettre à jour le produit dans la base de données
    $sql = "UPDATE produits SET nom='$nom', prix='$prix', chemin_image='$chemin_image', categorie='$categorie', description='$description', quantite=$quantite WHERE p_id=$p_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: backoffice.php?update=success");
        exit;
    } else {
        echo "Erreur lors de la mise à jour du produit: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <title>Modifier <?php echo htmlspecialchars($produit['nom']); ?></title>
</head>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <!-- Logo ou titre -->
        <a class="navbar-brand" href="#">Stup.net</a>

        <!-- Bouton pour mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Liens de navigation -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="ms-auto"> <!-- Ajout d'un conteneur pour pousser à droite -->
                <a href="logout.php" class="btn btn-danger ms-2">
                    <i class="bi bi-cart-fill"></i> Déconnexion
                </a>
            </div>
        </div>
    </div>
</nav>

<body>
    <div class="container py-5">
        <h1 class="text-center mb-5">Modifier le produit</h1>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom du produit</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo htmlspecialchars($produit['nom']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="prix" class="form-label">Prix</label>
                <input type="text" class="form-control" id="prix" name="prix" value="<?php echo htmlspecialchars($produit['prix']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="chemin_image" class="form-label">Chemin de l'image</label>
                <input type="text" class="form-control" id="chemin_image" name="chemin_image" value="<?php echo htmlspecialchars($produit['chemin_image']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="categorie" class="form-label">Catégorie</label>
                <input type="text" class="form-control" id="categorie" name="categorie" value="<?php echo htmlspecialchars($produit['categorie']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required><?php echo htmlspecialchars($produit['description']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="quantite" class="form-label">Quantité disponible</label>
                <input type="number" class="form-control" id="quantite" name="quantite" value="<?php echo htmlspecialchars($produit['quantite']); ?>" required>
            </div>
            <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-success mb-3">Enregistrer les modifications</button>
            </div>
        </form>
        <div class="d-flex justify-content-center">
        <a href="backoffice.php" class="btn btn-success">Annuler</a>
        </div> 
    </div>
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
