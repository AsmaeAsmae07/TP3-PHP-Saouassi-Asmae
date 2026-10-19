<?php
require_once 'config.php'; // Contient NOTE_MIN (0) et NOTE_MAX (20)

// 1. Vérification de l'existence et du remplissage des champs
if (!isset($_POST['nom'], $_POST['note_info'], $_POST['note_math']) || 
    empty($_POST['nom']) || $_POST['note_info'] === '' || $_POST['note_math'] === '') {
    die("Erreur : Tous les champs du formulaire sont obligatoires.");
}

// 2. Protection contre les failles XSS (htmlspecialchars)
$nom = htmlspecialchars($_POST['nom']);
$note_info = $_POST['note_info'];
$note_math = $_POST['note_math'];

// 3. Vérification du format numérique et des bornes (NOTE_MIN et NOTE_MAX)
if (!is_numeric($note_info) || !is_numeric($note_math)) {
    die("Erreur : Les notes doivent être des nombres.");
}

$note_info = (float)$note_info;
$note_math = (float)$note_math;

if ($note_info < NOTE_MIN || $note_info > NOTE_MAX || $note_math < NOTE_MIN || $note_math > NOTE_MAX) {
    die("Erreur : Les notes doivent être comprises entre " . NOTE_MIN . " et " . NOTE_MAX . ".");
}

// 4. Affichage du récapitulatif si tout est valide
echo "Étudiant : " . $nom . "<br>";
echo "Note Informatique : " . $note_info . " / " . NOTE_MAX . "<br>";
echo "Note Mathématiques : " . $note_math . " / " . NOTE_MAX . "<br>";
echo "Moyenne : " . (($note_info + $note_math) / 2) . " / " . NOTE_MAX . "<br>";
?>


<?php

// Chemin vers le fichier CSV
$chemin_fichier = 'data/notes.csv';

// 1. Ouvrir le fichier en mode "a" (Append : écriture seule, pointeur à la fin)
$fichier = fopen($chemin_fichier, 'a');

if ($fichier === false) {
    die("Erreur : Impossible d'ouvrir le fichier en écriture.");
}

// Données à insérer sous forme de tableau indexé
$ligne_donnees = [$nom, $note_info, $note_math];

// 2. Écrire l'enregistrement avec le séparateur ";"
fputcsv($fichier, $ligne_donnees, ';');

// 3. Fermer le fichier
fclose($fichier);

echo "Données enregistrées avec succès dans le fichier CSV !<br>";


/*
---- RÉPONSE À LA QUESTION ----

- Que se passerait-il avec le mode "w" au lieu de "a" ?
- Le mode "a" (Append) ajoute les données à la fin du fichier sans écraser le contenu existant.
- Le mode "w" (Write) écrase complètement le fichier à chaque fois qu'on l'ouvre. 
Si on utilise "w", on perdrai tous les apprenants précédents et
le fichier ne contiendra que le tout dernier apprenant saisi.
*/
?>

