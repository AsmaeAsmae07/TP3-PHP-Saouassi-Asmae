<?php
// 1. Construction du tableau associatif des résultats
$resultats = [
    "classe" => "Développement Web",
    "date_export" => date('Y-m-d'),
    "apprenants" => [
        [
            "nom" => "Mohamed",
            "notes" => ["info" => 16, "math" => 14],
            "moyenne" => 15
        ],
        [
            "nom" => "Ilham",
            "notes" => ["info" => 9, "math" => 9],
            "moyenne" => 9
        ]
    ]
];

// 2. Écriture au format JSON avec json_encode et file_put_contents
$json_data = json_encode($resultats, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
file_put_contents('data/notes.json', $json_data);


// 3. Relecture avec file_get_contents et json_decode
$json_lu = file_get_contents('data/notes.json');
$tableau_restaure = json_decode($json_lu, true); // true pour récupérer un tableau associatif

echo "<h2>Résultat du json_decode (via print_r) :</h2>";
echo "<pre>";
print_r($tableau_restaure);
echo "</pre>";
echo "<hr>";


// 4. Comparaison avec serialize()
$serialize_data = serialize($resultats);

echo "<h2>Comparaison des chaînes brutes générées :</h2>";
echo "<strong>Format json_encode() :</strong><br><textarea style='width:100%;height:60px;'>" . $json_data . "</textarea><br><br>";
echo "<strong>Format serialize() :</strong><br><textarea style='width:100%;height:60px;'>" . $serialize_data . "</textarea>";


/*
---- RÉPONSE À LA QUESTION ----

-Lequel de ces formats est directement exploitable par une application JavaScript ?
C'est le format JSON (généré par json_encode()). JSON signifie "JavaScript Object Notation". 
Il fait partie intégrante du langage JavaScript. Une application JS peut le lire nativement via une simple ligne : 
`JSON.parse(maChaine)`.À l'inverse, 
'serialize()' produit un format textuel propriétaire propre à PHP, qui n'est pas lisible nativement par JavaScript.
*/
?>
