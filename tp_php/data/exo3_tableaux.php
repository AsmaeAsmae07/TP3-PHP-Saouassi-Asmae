<?php
// Inclusion du header et du menu
include 'includes/entete_inc.php';
include 'includes/menu_inc.php';
?>

<?php
// Inclusion obligatoire du fichier de configuration pour récupérer SEUIL et la fonction mention()
require_once 'config.php';

function afficher($tab) {
    echo "<ul>";
    foreach ($tab as $nom => $note) {
        echo "<li><strong>$nom</strong> : $note/20</li>";
    }
    echo "</ul>";
}


// Exercice 3.1 : Création

// 1. Déclaration du tableau associatif des notes
$notes = [
    "Mohamed" => 16, "Ahmed" => 14, "Hind" => 13, "Aicha" => 15,
    "Samir" => 13, "Zakaria" => 13, "Rafik" => 10, "Ilham" => 9,
    "Hamza" => 7, "Sami" => 7, "Noura" => 14
];

// 2. Déclaration du tableau indexé
$modules = ["Algorithmique", "Bases de Données", "Développement Web"];

// Affichage avec foreach
foreach ($modules as $mod) {
    echo "- $mod<br>";
}

// Affichage par accès indiciel
echo "<br><strong>Modules via leurs indices :</strong><br>";
echo "Indice 0 : " . $modules[0] . "<br>";
echo "Indice 1 : " . $modules[1] . "<br>";
echo "Indice 2 : " . $modules[2] . "<br>";
echo "<hr>";


// Exercice 3.2 : Affichage HTML
?>

<table border="1" cellpadding="5" style="border-collapse: collapse; text-align: left;">
    <thead>
        <tr style="background-color: #f2f2f2;">
            <th>Nom</th>
            <th>Note</th>
            <th>Mention</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($notes as $nom => $note) {
            // Style rouge si la note est inférieure au SEUIL défini dans config.php
            $style = ($note < SEUIL) ? 'style="color: red; font-weight: bold;"' : '';
            
            echo "<tr $style>";
            echo "<td>" . htmlspecialchars($nom) . "</td>";
            echo "<td>" . $note . "</td>";
            echo "<td>" . mention($note) . "</td>"; // Utilise la fonction de l'exercice 2.1
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<?php
echo "<hr>";


// Exercice 3.3 : Statistiques
// 1. Calculs manuels avec boucle
$somme = 0;
$nb_elements = 0;
$meilleure = -1; // Initialisation basse pour trouver le max
$faible = 21;    // Initialisation haute pour trouver le min

foreach ($notes as $nom => $note) {
    $somme += $note;
    $nb_elements++;
    
    if ($note > $meilleure) {
        $meilleure = $note;
    }
    if ($note < $faible) {
        $faible = $note;
    }
}
$moyenne = $somme / $nb_elements;

echo "- Somme : $somme<br>";
echo "- Moyenne : " . round($moyenne, 2) . "<br>";
echo "- Plus haute note : $meilleure<br>";
echo "- Plus faible note : $faible<br><br>";

// 2. Vérification avec les fonctions natives PHP
echo "- Somme (array_sum) : " . array_sum($notes) . "<br>";
echo "- Nombre (count) : " . count($notes) . "<br>";
echo "- Max (max) : " . max($notes) . "<br>";
echo "- Min (min) : " . min($notes) . "<br><br>";

// 3. Tableau associatif des effectifs par mention
$effectifs = [
    "Très bien" => 0,
    "Bien" => 0,
    "Assez bien" => 0,
    "Passable" => 0,
    "Ajourné" => 0
];

foreach ($notes as $nom => $note) {
    $m = mention($note);
    if (isset($effectifs[$m])) {
        $effectifs[$m]++;
    }
}

foreach ($effectifs as $ment => $eff) {
    echo "- $ment : $eff apprenant(s)<br>";
}
echo "<hr>";


// Exercice 3.4 : Tri
// 1. Tri par noms croissants (ksort)
$t1 = $notes;
ksort($t1);
echo "<strong>1. Tableau trié par noms croissants (ksort) :</strong>";
afficher($t1);

// 2. Tri par notes décroissantes (arsort)
$t2 = $notes;
arsort($t2);
echo "<strong>2. Tableau trié par notes décroissantes (arsort) :</strong>";
afficher($t2);

// 3. Tri par noms décroissants (krsort)
$t3 = $notes;
krsort($t3);
echo "<strong>3. Tableau trié par noms décroissants (krsort) :</strong>";
afficher($t3);

// 4. Tri par notes croissantes (asort)
$t4 = $notes;
asort($t4);
echo "<strong>4. Tableau trié par notes croissantes (asort) :</strong>";
afficher($t4);

/*
- Question : Quelle fonction de tri utiliser sur un tableau indexé comme '$modules' ?
Réponse : Pour un tableau indexé, on utilise la fonction 'sort()' pour trier par valeurs 
dans l'ordre alphabétique / croissant (en réindexant numériquement les clés de 0 à N), 
ou 'rsort()' pour l'ordre inverse.
*/
echo "<hr>";


// Exercice 3.5 : Opérateurs de tableaux

$a = ["x" => 1, "y" => 2];
$b = ["y" => 2, "x" => 11];

echo "<strong>Résultats réels des vérifications :</strong><br>";

// Union : $a + $b
echo "- \$a + \$b : ";
var_dump($a + $b); 
// Résultat : array(2) { ["x"]=> int(1), ["y"]=> int(2) }
echo "<br>";

// Égalité : $a == $b
echo "- \$a == \$b : ";
var_dump($a == $b); 
// Résultat : bool(true)
echo "<br>";

// Identité : $a === $b
echo "- \$a === \$b : ";
var_dump($a === $b); 
// Résultat : bool(false)
echo "<br><br>";

/*
---- EXPLICATIONS DES DIFFÉRENCES ----

1. L'opérateur + (Union) prend les éléments du tableau de gauche ($a) et y ajoute 
les éléments du tableau de droite ($b) dont la clé n'existe pas déjà dans $a. 
Comme 'x' et 'y' existent déjà dans $a, les valeurs de $b sont ignorées.
 
2. L'opérateur == (Égalité) renvoie true si les deux tableaux possèdent les mêmes 
paires clé/valeur, peu importe leur ordre ou leurs types. Ici, $a et $b possèdent 
les mêmes clés avec les mêmes valeurs (si l'on compare bien les paires identiques 
renvoyées par le script).

3. L'opérateur === (Identité) renvoie true SI ET SEULEMENT SI les deux tableaux 
possèdent les mêmes paires clé/valeur, dans le MÊME ORDRE et avec les mêmes types. 
Ici, l'ordre des clés diffère ('x' puis 'y' vs 'y' puis 'x'), ce qui produit false.
*/


/*
---- EXPÉRIENCE 1 : Fichier inexistant (include vs require) ----
- Avec 'include' : PHP génère un avertissement (Warning). Le script continue 
son exécution malgré l'absence du fichier.
- Avec 'require' : PHP génère une erreur fatale (Fatal Error). L'exécution 
du script s'arrête immédiatement à la ligne concernée.
 
---- EXPÉRIENCE 2 : Inclusion double (include vs include_once) ----
- Avec deux 'include' successifs du même fichier menu : le menu s'affiche deux fois à l'écran.
- Avec deux 'include_once' : PHP vérifie si le fichier a déjà été inclus. 
Le menu ne s'affiche qu'une seule et unique fois.
*/

?>


<?php
// Inclusion du footer
include 'includes/pied_inc.php';
?>

