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
    $chemin_image = $_POST['chemin_image']; // Par exemple si tu veux aussi modifier l'image

    // Mettre à jour le produit dans la base de données
    $sql = "UPDATE produits SET nom='$nom', prix='$prix', chemin_image='$chemin_image' WHERE p_id=$p_id";

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
    <title>Modifier le produit</title>
</head>
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
            <button type="submit" class="btn btn-primary  mb-3">Enregistrer les modifications</button>
        </form>
        <a href="backoffice.php" class="btn btn-primary"> Annuler</a>
    </div>
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
