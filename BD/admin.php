<?php
include 'connexion.php';

function ajout($nom, $description, $categorie, $prix, $quantite, $chemin_image, $conn)
{
    $sql = "INSERT INTO Produits (nom, description, categorie, prix, quantite, chemin_image)
            VALUES ('$nom', '$description', '$categorie', $prix, $quantite, '$chemin_image')";
    
    $resultat = $conn->query($sql);
    
    if (!$resultat) {
        die('Erreur dans la requête SQL : ' . $conn->error);
    }
}


function suppression($id, $conn)
{
    $sql = "DELETE FROM Produits WHERE p_id = $id";

    $resultat = $conn -> query($sql);
}