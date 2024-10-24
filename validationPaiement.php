<?php
include 'BD/connexion.php'; 
include 'BD/admin.php';
session_start(); // Démarre la session pour vérifier si l'utilisateur est connecté

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['connexionOk']) || $_SESSION['connexionOk'] !== true) {
    header('Location: login.php');
    exit;
}

// Initialisation des variables pour les messages d'erreur


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $numeroCarte = $_POST['numeroCarte'];
    $dateExpiration = $_POST['dateExpiration'];

    // Vérification du numéro de carte (16 chiffres et dernier chiffre identique au premier)
    if (strlen($numeroCarte) == 16 && ctype_digit($numeroCarte)) {
        if (!($numeroCarte[0] == $numeroCarte[15])) {
          header('Location:paiement.php?add=errorValCarte');
          exit();
        }
    } else {
        header('Location:paiement.php?add=errorLenCarte');
        exit();
    } 

    // Vérification de la date de validité (supérieure à la date du jour + 3 mois)
    $expiration = DateTime::createFromFormat('Y-m', $dateExpiration);
    $dateActuelle = new DateTime();
    $dateActuelle->modify('+3 months');

    if (!($expiration && $expiration > $dateActuelle)) {
        header('Location:paiement.php?add=errorDate')  ;
        exit();
    } 

    // Si aucune erreur, redirection vers la page d'accueil avec message de succès

    header('Location: index.php?add=successPayment');


}
