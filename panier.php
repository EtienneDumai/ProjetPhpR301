<?php 
include 'BD/connexion.php';
include 'vignette.php';

$sql = "SELECT p_id, nom, prix, chemin_image FROM produits";
$resultat = $conn->query($sql);
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <!-- Logo ou titre -->
            <a class="navbar-brand" href="index.php">Stup.net</a>

            <!-- Bouton pour mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Liens de navigation -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Produits</a>
                    </li>
                </ul>

                <!-- Bouton du panier -->
                <a href="panier.php" class="btn btn-primary">
                    <i class="bi bi-cart-fill"></i> Panier
                </a>
                <!-- Bouton de déconnexion -->
                <a href="logout.php" class="btn btn-danger ms-2">
                    <i class="bi bi-cart-fill"></i> Déconnexion
                </a>


            </div>


        </div>
    </nav>
    <div class="container py-5">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4 justify-content-center align-items-center" style="min-height: 100vh;">
        <?php 
        // Fonction pour supprimer les doublons et additionner les quantités dans un tableau de tableaux associatifs
        function supprimerDoublonsEtAdditionnerQuantites(array $tableauAssoc) {
            $tableauSansDoublons = [];

            foreach ($tableauAssoc as $sousTableau) {
                $cleUnique = $sousTableau['id']; // Utilise l'ID comme clé unique pour identifier les doublons
        
                if (isset($tableauSansDoublons[$cleUnique])) {
                // Si l'élément existe déjà, on additionne la quantité
                    $tableauSansDoublons[$cleUnique]['quantite'] += $sousTableau['quantite'];
                } else {
                    // Si l'élément n'existe pas encore, on l'ajoute
                    $tableauSansDoublons[$cleUnique] = $sousTableau;
                }
            }

            return $tableauSansDoublons;
        }
        $panierClean= array();
        $panierClean = supprimerDoublonsEtAdditionnerQuantites($_SESSION['panier']);

        
        while ($drogue = $resultat->fetch_assoc()) {
            foreach($panierClean as $produit) {
                if ($produit['id'] == $drogue['p_id']) {
                    echo '
                    <div class="col d-flex justify-content-center align-items-center">
                    <div class="card h-100 shadow-sm">
                    <img src="'.$drogue['chemin_image'].'" class="card-img-top" alt="'.$drogue['nom'].'">
                    <div class="card-body">
                        <h5 class="card-title">'.$drogue['nom'].'</h5>
                        <p>Nombre commandés : '.$produit['quantite'].'</p>
                    </div></div></div>';
            }
        }
    }
        ?>
    </div>
</div>
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>