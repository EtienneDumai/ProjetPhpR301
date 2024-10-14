<?php
function createVignette($src, $dest, $maxLarg, $maxLong)
{
    // Vérification de l'existence de l'image source
    if (!file_exists($src)) {
        return false;
    }

    // Chargement de l'image source
    $source = imagecreatefromjpeg($src);
    list($srcLarg, $srcLong) = getimagesize($src);

    // Calcul du ratio pour conserver les proportions
    $ratio = min($maxLarg / $srcLarg, $maxLong / $srcLong);

    // Calcul des nouvelles dimensions tout en conservant le ratio
    $largVignette = round($srcLarg * $ratio);
    $longVignette = round($srcLong * $ratio);

    // Création d'une image vide pour la vignette avec les nouvelles dimensions
    $vignette = imagecreatetruecolor($largVignette, $longVignette);

    // Redimensionnement et copie de l'image source dans la vignette
    imagecopyresampled($vignette, $source, 0, 0, 0, 0, $largVignette, $longVignette, $srcLarg, $srcLong);

    // Enregistrement de la vignette
    imagejpeg($vignette, $dest);

    // Libération de la mémoire
    imagedestroy($source);
    imagedestroy($vignette);
}
?>
