<?php
session_start();

// Vider les variables de session
session_unset();

// Détruire la session
session_destroy();

// Redirection immédiate
header("Location: login.php");
exit;
