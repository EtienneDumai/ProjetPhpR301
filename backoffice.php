<?php
include 'BD/connexion.php';
include 'BD/admin.php';
include 'vignette.php';
$sql = "SELECT p_id, nom, prix, chemin_image FROM produits";
$resultat = $conn->query($sql);
session_start(); // Démarre la session pour pouvoir vérifier la variable de session

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['connexionOk']) || $_SESSION['connexionOk'] !== true || $_SESSION['role'] !== 'admin') {
    // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
    if ($_SESSION['role'] == 'user'){
        header('Location: index.php');
        exit;
    }
    header('Location: login.php');
    exit; // Stoppe l'exécution du script pour s'assurer que la redirection se fait bien
}

if (isset($_GET['delete']) && $_GET['delete'] == 'success'): ?>
    <div class="alert alert-success text-center">
        Produit supprimé avec succès.
    </div>
<?php elseif (isset($_GET['delete']) && $_GET['delete'] == 'error'): ?>
    <div class="alert alert-danger text-center">
        Erreur lors de la suppression du produit.
    </div>
<?php endif; ?>

<?php if (isset($_GET['update']) && $_GET['update'] == 'success'): ?>
    <div class="alert alert-success text-center">
        Modifications enregistrés !
    </div>
<?php endif; ?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <title>Stup - Back office</title>
</head>

<body>

    <!-- Navbar -->
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



    <div class="container py-5">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4 justify-content-center align-items-center"
            style="min-height: 100vh;">
            <?php while ($drogue = $resultat->fetch_assoc()): ?>
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
                        <img src="<?php echo $dest; ?>" class="card-img-top"
                            alt="<?php echo htmlspecialchars($drogue['nom']); ?>">

                        <!-- Corps de la carte avec nom et prix -->
                        <div class="card-body text-center">
                            <h5 class="card-title"><?php echo htmlspecialchars($drogue['nom']); ?></h5>
                        </div>

                        <!-- Footer de la carte avec un bouton -->

                        <div class="card-footer bg-transparent border-0 text-center">
                            <!-- Bouton pour modifier le produit -->
                            <a href="modification.php?p_id=<?php echo $drogue['p_id']; ?>"
                                class="btn btn-warning w-100 mb-2">Modifier</a>
                        
                        <!-- Bouton pour supprimer le produit -->
                        <form action="suppression.php" method="POST"
                            onsubmit="return confirm('Voulez-vous vraiment supprimer ce produit ?');">
                            <input type="hidden" name="p_id" value="<?php echo $drogue['p_id']; ?>">
                            <button type="submit" class="btn btn-danger w-100 ">Supprimer</button>
                        </form>
                    </div>





                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <footer class=" bg-light">
        <div class="container py-5">
            <!-- Bouton pour ajouter un produit -->
            <div class="text-center mb-4">
                <a href="ajout.php" class="btn btn-success">Ajouter un produit</a>
            </div>
    </footer>
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>