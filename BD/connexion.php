<?php
// Informations de connexion
$servername = "localhost";  // ou l'adresse IP de votre serveur de base de données
$username = "root";  // Remplacez par votre nom d'utilisateur MySQL
$password = "";  // Remplacez par votre mot de passe MySQL
$dbname = "drogue";  // Remplacez par le nom de la base de données

// Créer une connexion à MySQL
$conn = new mysqli($servername, $username, $password, $dbname);
?>