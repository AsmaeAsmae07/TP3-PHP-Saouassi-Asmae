<?php 
echo 'Hello PHP'; 
echo "<br>";

// commentaire sur une ligne
# commentaire sur une ligne
/* 
commentaire sur plusieurs lignes
*/
?>

<?php
// Exercice 1.1 : Noms de variables
// nom des variables valides et invalides
/* 
$x       : VALIDE. Commence par une lettre.
$_x      : VALIDE. Commence par un caractère de soulignement (_).
$2x      : INVALIDE. Ne peut pas commencer par un chiffre.
$x-y     : INVALIDE. Le tiret (-) n'est pas autorisé.
$Prix_HT : VALIDE. Contient des lettres et un tiret bas (_).
$prix ht : INVALIDE. Contient un espace.
$état    : VALIDE. PHP accepte les caractères de l'ASCII étendu (les accents), mais cela est fortement déconseillé.
*/

// la différence entre les variables sensibles à la casse
$a = "minuscule";
$A = "majuscule";

echo "Variable \$a : " . $a . " <br>";
echo "Variable \$A : " . $A . " <br>";
// Cela affiche deux valeurs distinctes, prouvant que PHP est sensible à la casse.


// Exercice 1.2 : Constantes
// inclusion du fichier de configuration
require "config.php";

// Affichage de chaque constante
echo "Établissement= " . Etablissement . " <br>";
echo "Note minimale : " . NOTE_MIN . "<br>";
echo "Note maximale : " . NOTE_MAX . "<br>";
echo "Seuil : " . SEUIL . "<br><br>";

// Test de la fonction defined()
echo "Test SEUIL: ";
var_dump(defined('SEUIL')); // Affiche bool(true)
echo "<br>";

echo "Test INCONNUE: ";
var_dump(defined('INCONNUE')); // Affiche bool(false)
echo "<br>";

/* RÉPONSES AUX QUESTIONS
1. Que se passe-t-il si vous affichez une constante non définie ?
En PHP moderne, cela lève une erreur fatale de type "Fatal error: Uncaught Error: Undefined constant".
Dans les anciennes versions de PHP, cela générait un avertissement (Warning) et traitait le nom de la constante comme une simple chaîne de caractères.
 
2. Quelle différence y a-t-il entre 'const' et 'define()' ?
- 'const' est évalué au moment de la compilation. On ne peut pas l'utiliser à l'intérieur de blocs conditionnels (comme un 'if').
- 'define()' est évalué au moment de l'exécution. Elle peut donc être définie dynamiquement dans une structure conditionnelle ou avec une variable pour son nom.
*/


// Exercice 1.3 : Calcul
$prix_ht = 60;
$s_tva = 20;

// Calcul du prix TTC (Formule : HT + (HT * TVA / 100))
$prix_ttc = $prix_ht + ($prix_ht * $s_tva / 100);
$symbole_euro = "€";

// Affichage dynamique (sans écrire de valeur en dur)
echo "Le prix TTC du produit est de " . $prix_ttc . " " . $symbole_euro . ".";


// Exercice 1.4 : Types et conversions
// 1. Déclaration et Cast en string
$test = (string) 42;
var_dump($test); // Résultat : string(2) "42"
echo "<br><br>";

// 2. Prédictions et vérifications booléennes
/* 
Prédictions :
- '0'   -> false (En PHP, la chaîne "0" est convertie en faux)
- '0.0' -> true  (Une chaîne non vide différente de "" et "0" est vraie)
- "0"   -> false (Identique à '0')
- ""    -> false (Une chaîne vide est fausse)
- "abc" -> true  (Chaîne non vide)
- []    -> false (Un tableau vide est faux)
- null  -> false (La valeur null est fausse)
*/
var_dump((bool) '0');   // bool(false)
var_dump((bool) '0.0'); // bool(true)
var_dump((bool) "0");   // bool(false)
var_dump((bool) "");    // bool(false)
var_dump((bool) "abc"); // bool(true)
var_dump((bool) []);    // bool(false)
var_dump((bool) null);  // bool(false)
echo "<br>";

// 3. Prédictions et vérifications numériques
/* 
Prédictions :
- (int) 3.9       -> 3      (Troncation de la partie décimale)
- (int) "12abc"   -> 12     (Extrait le nombre au début de la chaîne)
- (float) "1.5e3" -> 1500.0 (Notation scientifique : 1.5 * 10^3)
- (int) true      -> 1      (Le booléen true vaut 1 en entier)
*/
var_dump((int) 3.9);
var_dump((int) "12abc");
var_dump((float) "1.5e3");
var_dump((int) true);
echo "<br>";

// 4. Écriture du nombre 255 dans différentes notations
$decimal     = 255;
$hexadecimal = 0xFF;
$octal       = 0377;
$binaire     = 0b11111111;

echo "Décimal : " . $decimal . "<br>";
echo "Hexadécimal : " . $hexadecimal . "<br>";
echo "Octal : " . $octal . "<br>";
echo "Binaire : " . $binaire . "<br>";


// Exercice 1.5 : Chaînes de caractères
$traitees = "égales à";
$ici = 2;

// 1. Guillemets doubles imbriqués (échappement)
echo "Ahmed a dit : \"J'ai réussi\"  <br>";

// 2. Anti-slash à afficher
echo "Voulez-vous supprimer c:\\*.*?  <br>";

// 3. Non-interprétation du saut de ligne (guillemets simples)
echo 'Ceci n\'affichera pas \n de nouvelle ligne  <br>';

// 4. Non-interprétation des variables (guillemets simples)
echo 'Les variables ne seront pas $traitees $ici  <br>';

// 5. Interprétation des variables (guillemets doubles)
echo "Les variables seront $traitees $ici  <br><br>";

// Nettoyage avec trim()
$chaine = "*Bonjour les développeurs*";
$chaine_nettoyee = trim($chaine, "*");
echo "Chaîne nettoyée : " . $chaine_nettoyee . "<br><br>";

// Affichage lettre par lettre avec une boucle for
echo "Affichage lettre par lettre :<br>";
$longueur = strlen($chaine_nettoyee);

for ($i = 0; $i < $longueur; $i++) {
    // Accès au caractère par son index de chaîne
    echo $chaine_nettoyee[$i] . "<br>";
}

?>