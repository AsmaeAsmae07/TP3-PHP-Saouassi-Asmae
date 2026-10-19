<?php
// Exercice 2.1 : `if / elseif / else`
require_once 'config.php';

function mention($note) {
    if ($note >= 16) {
        return "Très bien";
    } elseif ($note >= 14) {
        return "Bien";
    } elseif ($note >= 12) {
        return "Assez bien";
    } elseif ($note >= SEUIL) { // Utilisation de la constante SEUIL de config.php
        return "Passable";
    } else {
        return "Ajourné";
    }
}

// Tests avec plusieurs notes
$notes_de_test = [18, 15, 13, 10.5, 7];

echo "<h3>Exercice 2.1 : Résultats des mentions</h3>";
foreach ($notes_de_test as $n) {
    echo "Note : " . $n . " -> Mention : " . mention($n) . "<br>";
}
echo "<hr>";


// Exercice 2.2 : 'switch'
echo "<h3>Exercice 2.2 : Switch et Mois</h3>";

// 1. Récupération du mois courant au format numérique (01 à 12)
$mois_numerique = date("m");

// 2. Affichage du nom du mois en français avec un switch
switch ($mois_numerique) {
    case "01": 
        echo "Janvier."; break;
    case "02": 
        echo "Février."; break;
    case "03": 
        echo "Mars."; break;
    case "04": 
        echo "Avril."; break;
    case "05": 
        echo "Mai."; break;
    case "06": 
        echo "Juin."; break;
    case "07": 
        echo "Juillet."; break;
    case "08": 
        echo "Août."; break;
    case "09": 
        echo "Septembre."; break;
    case "10": 
        echo "Octobre."; break;
    case "11": 
        echo "Novembre."; break;
    case "12": 
        echo "Décembre."; break;
    default:  
    echo "Mois inconnu."; break;
}
echo "<br>";

/* RÉPONSE A LA QUESTION
3. Que se passe-t-il si vous oubliez un 'break' dans un 'case' ?
Si on oublie un 'break', PHP continue d'exécuter le code des blocs 'case' suivants sans même vérifier si leurs conditions sont vraies. 
C'est ce qu'on appelle l'effet de "fall-through" (cascade), jusqu'à rencontrer un 'break' ou la fin du bloc switch.
*/
echo "<hr>";


// Exercice 2.3 : Boucles

// 1. Triangle avec deux boucles 'for' imbriquées
for ($i = 1; $i <= 6; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo "*";
    }
    echo "<br>";
}
echo "<br>";


// 2. Boucle 'while' de 0 à 20 par pas de 2 avec le nombre 10 en gras
$compteur = 0;
while ($compteur <= 20) {
    if ($compteur == 10) {
        echo "<strong>10</strong> ";
    } else {
        echo $compteur . " ";
    }
    $compteur += 2;
}
echo "<br><br>";


// 3. Boucle 'for' et 'continue' pour afficher uniquement les nombres pairs de 0 à 10
for ($i = 0; $i <= 10; $i++) {
    if ($i % 2 !== 0) {
        continue;
    }
    echo $i . " ";
}
echo "<br><br>";


// 4. Parcourir les entiers à partir de 1 avec 'while', 'switch' et 'break 2'
$i = 1;
while (true) {
    switch ($i) {
        case 5:
            echo "At 5<br>";
            // break 1 sortirait uniquement du switch. break 2 sort du switch ET de la boucle while.
            break; 
        case 10:
            echo "At 10, quitting<br>";
            break 2; // Sort du switch et arrête définitivement la boucle while
    }
    $i++;
}
echo "<br>";


// 5. Réécriture de la question 2 avec un 'do-while'
$compteur_do = 0;
do {
    if ($compteur_do == 10) {
        echo "<strong>10</strong> ";
    } else {
        echo $compteur_do . " ";
    }
    $compteur_do += 2;
} while ($compteur_do <= 20);
echo "<br><br>";

/*
---- Quelle est la différence essentielle avec 'while' ? ----
* La boucle 'while' vérifie la condition AVANT d'exécuter le bloc d'instructions. 
Si la condition est fausse dès le départ, le code n'est jamais exécuté. 

* La boucle 'do-while' exécute le bloc d'instructions une première fois, puis vérifie la condition APRÈS. 
Le code à l'intérieur d'un 'do-while' est donc TOUJOURS exécuté au moins une fois, quelle que soit la condition.
*/
?>
