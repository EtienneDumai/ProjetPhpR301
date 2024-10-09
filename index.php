<?php 
include 'BD/connexion.php';

$sql = "SELECT p_id, nom, prix, chemin_image FROM produits";
$resultat = $conn->query($sql);
var_dump($resultat)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container">
            <?php while($drogue = $resultat->fetch_assoc()): ?>
                <div class="card">
                    <!-- Image de la drogue -->
                    <img src="<?php echo $drogue['chemin_image']; ?>" alt="<?php echo htmlspecialchars($drogue['nom']); ?>">
                    
                    <!-- Corps de la carte avec nom et prix -->
                    <div class="card-body">
                        <h3 class="card-title"><?php echo htmlspecialchars($drogue['nom']); ?></h3>
                        <p class="card-text">
                            <strong>Prix:</strong> <?php echo htmlspecialchars($drogue['prix']); ?> €
                        </p>
                    </div>
                </div>
            <?php endwhile; ?>
            </div>

</body>
</html>