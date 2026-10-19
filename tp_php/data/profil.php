<?php
session_start();

// Protection de la page : si la session n'existe pas, redirection immédiate
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Profil</title>
</head>
<body>
    <h2>Espace Personnel</h2>
    <p>Bienvenue, <strong><?php echo htmlspecialchars($_SESSION['login']); ?></strong> !</p>
    
    <p><a href="deconnexion.php">Se déconnecter</a></p>
</body>
</html>


<?php
// Date du jour (courante)
$date_actuelle = new DateTime();

// Définir une date de fin de semestre au choix (ex: 31 Janvier 2027)
$date_fin_semestre = new DateTime('2027-01-31');

// Calcul de la différence entre les deux dates
$intervalle = $date_actuelle->diff($date_fin_semestre);

// L'affichage s'adapte selon que la date soit passée ou future
if ($date_actuelle > $date_fin_semestre) {
    echo "Le semestre est déjà terminé.";
} else {
    echo "Il reste exactement <strong>" . $intervalle->days . "</strong> jours avant la fin du semestre.";
}
?>

<?php
// Exemple de valeurs reçues (ex: depuis un formulaire de saisie)
$jour = 29;
$mois = 02;
$annee = 2026; // 2026 n'est pas bissextile, le 29 février est donc invalide

echo "<h3>Validation de la date ($jour/$mois/$annee)</h3>";

// checkdate prend les arguments dans l'ordre : (mois, jour, annee)
if (checkdate($mois, $jour, $annee)) {
    echo "La date saisie est valide.";
} else {
    echo "<span style='color:red; font-weight:bold;'>Erreur : La date saisie n'existe pas !</span>";
}
?>
