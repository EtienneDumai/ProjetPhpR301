<?php
include 'BD/connexion.php';
include 'BD/admin.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['p_id'])) {
    $p_id = intval($_POST['p_id']); // Assurer que p_id est un entier

    // Appel à la fonction suppression() définie dans admin.php
    suppression($p_id, $conn);

    // Rediriger vers la page backoffice avec un message de succès
    header('Location: backoffice.php?delete=success');
    exit();
} else {
    // Rediriger vers la page backoffice si aucune suppression n'est faite
    header('Location: backoffice.php?delete=error');
    exit();
}
