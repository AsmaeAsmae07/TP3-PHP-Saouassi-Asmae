<?php
// Récupération sécurisée des données GET
$nom = isset($_GET['nom']) ? htmlspecialchars($_GET['nom']) : '';
$prenom = isset($_GET['prenom']) ? htmlspecialchars($_GET['prenom']) : '';
$sexe = isset($_GET['sexe']) ? $_GET['sexe'] : '';

// Salutation selon le sexe choisi
if ($sexe === 'M') {
    echo "Bonjour Monsieur " . $prenom . " " . $nom . ".";
} elseif ($sexe === 'F') {
    echo "Bonjour Madame " . $prenom . " " . $nom . ".";
} else {
    echo "Bonjour " . $prenom . " " . $nom . ".";
}
?>
