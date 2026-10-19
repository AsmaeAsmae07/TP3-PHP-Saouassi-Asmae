<?php
require_once 'config.php'; // Pour récupérer la fonction mention() et SEUIL

$chemin_fichier = 'data/notes.csv';

// 1. Tester l'existence du fichier
if (!file_exists($chemin_fichier)) {
    die("Erreur : Le fichier de données n'existe pas encore. Veuillez d'abord saisir des apprenants.");
}

// 2. Ouvrir le fichier en lecture ("r") et gérer l'échec
$fichier = fopen($chemin_fichier, 'r');
if ($fichier === false) {
    die("Erreur lors de l'ouverture du fichier.");
}

echo "<h2>Liste des apprenants (Lecture via fgetcsv)</h2>";
echo '<table border="1" cellpadding="5" style="border-collapse: collapse;">';
echo '<thead>
        <tr style="background-color: #f2f2f2;">
            <th>Nom</th>
            <th>Note Info</th>
            <th>Note Math</th>
            <th>Moyenne</th>
            <th>Mention</th>
        </tr>
      </thead>
      <tbody>';

$somme_generale = 0;
$total_eleves = 0;

// 3. Lire le fichier ligne par ligne dans une boucle while
while (($ligne = fgetcsv($fichier, 0, ';')) !== false) {
    // fgetcsv retourne un tableau indexé : [0 => Nom, 1 => Note Info, 2 => Note Math]
    $nom = htmlspecialchars($ligne[0]);
    $note_info = (float)$ligne[1];
    $note_math = (float)$ligne[2];
    
    // Calcul de la moyenne de l'apprenant
    $moyenne_apprenant = ($note_info + $note_math) / 2;
    
    // Cumuls pour la moyenne générale de la classe
    $somme_generale += $moyenne_apprenant;
    $total_eleves++;
    
    // Coloration rouge si sous le seuil
    $style = ($moyenne_apprenant < SEUIL) ? 'style="color: red; font-weight: bold;"' : '';
    
    // 4. Affichage dans le tableau HTML
    echo "<tr $style>";
    echo "<td>$nom</td>";
    echo "<td>$note_info</td>";
    echo "<td>$note_math</td>";
    echo "<td>" . round($moyenne_apprenant, 2) . "</td>";
    echo "<td>" . mention($moyenne_apprenant) . "</td>";
    echo "</tr>";
}

echo '</tbody></table>';

// 5. Afficher la moyenne générale de la classe sous le tableau
if ($total_eleves > 0) {
    $moyenne_classe = $somme_generale / $total_eleves;
    echo "<br><strong>Moyenne générale de la classe :</strong> " . round($moyenne_classe, 2) . " / 20 (sur $total_eleves apprenant(s)).";
} else {
    echo "<br>Aucune donnée disponible.";
}

fclose($fichier);
?>


<?php
$chemin_fichier = 'data/notes.csv';

if (file_exists($chemin_fichier)) {
    $fichier = fopen($chemin_fichier, 'r');
    
    echo "<h2>Lecture alternative (fgets + explode)</h2>";
    
    // Utilisation combinée de feof() et fgets()
    while (!feof($fichier)) {
        $ligne = fgets($fichier);
        
        // Supprime les espaces et sauts de ligne invisibles (\n, \r)
        $ligne = trim($ligne); 
        
        if ($ligne !== '') {
            // Découpage de la chaîne brute selon le séparateur ";"
            $champs = explode(';', $ligne);
            
            echo "Nom : " . htmlspecialchars($champs[0]) . " | Info : " . $champs[1] . " | Math : " . $champs[2] . "<br>";
        }
    }
    fclose($fichier);
}

/*
---- COMPARAISON : AVANTAGES ET INCONVÉNIENTS ----

1. Approche native 'fgetcsv()' :
- Avantages : Conçu spécifiquement pour le CSV. Il gère automatiquement les cas complexes, 
comme la présence d'espaces, de guillemets imbriqués ou de sauts de ligne à l'intérieur d'un champ textuel.
- Inconvénients : Offre un peu moins de contrôle direct sur le traitement de la chaîne brute.

2. Approche bas niveau 'fgets() + explode()' :
- Avantages : Très simple à comprendre, léger et rapide pour des fichiers textes basiques.
- Inconvénients : Très fragile. Si un étudiant s'appelle "Dupont; Jean" (contenant un point-virgule), 
le explode() va casser la structure des colonnes. Il ne gère pas non plus les guillemets d'échappement CSV.
*/
?>
