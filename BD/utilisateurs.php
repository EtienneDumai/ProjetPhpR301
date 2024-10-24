<?php


// Inclure la connexion à la base de données
include 'connexion.php';

session_start();

// Fonction pour se connecter
function seConnecter($pseudo, $motDePasse, $conn) {
    global $conn;

    // Préparer la requête SQL pour vérifier les identifiants dans la base de données
    $requete = $conn->prepare("SELECT * FROM login WHERE pseudo = ? AND mdp = ?");
    $requete->bind_param("ss", $pseudo, $motDePasse); 
    $requete->execute();
    $resultat = $requete->get_result();

    // Vérifier si un utilisateur correspondant a été trouvé
    if ($resultat->num_rows > 0) {
        $ligne = $resultat->fetch_assoc();
        $_SESSION['connexionOk'] = true;
        $_SESSION['role'] = ($ligne['pseudo'] == 'admin') ? 'admin' : 'user'; 
        return true; // Connexion réussie
    }
    
}

// Fonction pour créer un nouvel utilisateur
function creerUtilisateur($pseudo, $motDePasse) {
    global $conn;

    // Vérifier si l'utilisateur existe déjà
    $verifierRequete = $conn->prepare("SELECT * FROM login WHERE pseudo = ?");
    $verifierRequete->bind_param("s", $pseudo); // Lier le paramètre
    $verifierRequete->execute();
    $verifierResultat = $verifierRequete->get_result();

    if ($verifierResultat->num_rows == 0) {
        // Préparer la requête d'insertion
        $insererRequete = $conn->prepare("INSERT INTO login (pseudo, mdp) VALUES (?, ?)");
        $insererRequete->bind_param("ss", $pseudo, $motDePasse); // Lier les paramètres
        if ($insererRequete->execute()) {
            return true; // Utilisateur créé avec succès
        } else {
            return false; // Échec de la création de l'utilisateur
        }
    } else {
        return false; // L'utilisateur existe déjà
    }
}


