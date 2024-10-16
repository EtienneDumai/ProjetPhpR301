<?php
include 'BD/connexion.php'; 
include 'BD/admin.php';
session_start(); // Démarre la session pour vérifier si l'utilisateur est connecté

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['connexionOk']) || $_SESSION['connexionOk'] !== true) {
    header('Location: login.php');
    exit;
}

// Gestion de l'ajout d'un produit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    var_dump($_POST);
    $nom = $conn->real_escape_string($_POST['nom']);
    $description = $conn->real_escape_string($_POST['description']);
    $categorie = $conn->real_escape_string($_POST['categorie']);
    $prix = floatval($_POST['prix']);
    $quantite = intval($_POST['quantite']);

    // Vérification du fichier image
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $tmpPath = $_FILES['image']['tmp_name'];
        $imageType = mime_content_type($tmpPath); // Récupère le type MIME

        // Vérifie si le fichier est bien une image JPEG
        if ($imageType === 'image/jpeg' || $imageType === 'image/jpg') {
            // Définir le chemin de l'image
            $imageFileName = $nom . '.jpg'; // Nom de l'image
            $imagePath = "img/$imageFileName"; 

            // Déplacer l'image téléchargée dans le dossier /img
            if (move_uploaded_file($tmpPath, $imagePath)) {
                // L'image a été déplacée avec succès
            } else {
                die('Erreur lors du téléchargement de l\'image.');
            }

            // Insérer le produit avec le chemin de l'image
            ajout($nom, $description, $categorie, $prix, $quantite, $imagePath, $conn);

            // Redirige avec un message de succès
            header('Location: ajout.php?add=success');
            exit();
        } else {
            header('Location: ajout.php?add=errorFormat');            
        }
    } else {
        header('Location: ajout.php?add=error');
    }
}
?>
