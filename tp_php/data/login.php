<?php
// Initialisation de la session (toujours au tout début, avant tout affichage)
session_start();

// Traitement du formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $login_saisi = trim($_POST['login']);
    
    if ($login_saisi !== '') {
        // 1. Enregistrement dans la session
        $_SESSION['login'] = $login_saisi;
        
        // Ex 6.2 (Variante) : Stockage du login et de la date dans un cookie (valable 24h)
        $infos_cookie = [
            'login' => $login_saisi,
            'date_connexion' => date('d/m/Y H:i')
        ];
        setcookie("dernier_login", json_encode($infos_cookie), time() + 86400, "/");
        
        // Redirection vers profil.php
        header("Location: profil.php");
        exit;
    }
}

// Récupération des informations du cookie si existant
$login_pre_rempli = '';
if (isset($_COOKIE['dernier_login'])) {
    $donnees_cookie = json_decode($_COOKIE['dernier_login'], true);
    $login_pre_rempli = htmlspecialchars($donnees_cookie['login'] ?? '');
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>
<body>
    <h2>Formulaire de connexion</h2>
    
    <?php if (isset($_COOKIE['dernier_login'])) : ?>
        <p><em>Votre dernière connexion remonte au : <?php echo htmlspecialchars($donnees_cookie['date_connexion']); ?></em></p>
    <?php endif; ?>

    <form action="login.php" method="POST">
        <label for="login">Identifiant (Login) :</label>
        <input type="text" name="login" id="login" value="<?php echo $login_pre_rempli; ?>" required>
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>
