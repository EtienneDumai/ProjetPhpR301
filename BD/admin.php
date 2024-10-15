<?php
include 'connexion.php';

function ajout($id,$nom,$description,$categorie,$quantite,$chemin_image, $conn)
{
    $sql = "INSERT INTO Produits (nom, description, categorie, prix, quantite, chemin_image)
VALUES ($id,$nom,$description,$categorie,$quantite,$chemin_image)";

    $resultat = $conn -> query($sql);
}

function suppression($id, $conn)
{
    $sql = "DELETE FROM Produits WHERE p_id = $id";

    $resultat = $conn -> query($sql);
}