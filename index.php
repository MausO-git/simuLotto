<?php
session_start();

// Initialisation si première visite
if(!isset($_SESSION['mise'])) {
    $_SESSION['mise'] = 0;   // en centimes
    $_SESSION['gain'] = 0;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <meta name="title" content="SimuLotto">
    <meta name="description" content="Site permettant de simuler un jeu de lotterie sans risquer d'y perdre toutes ses économies. Le site permet aussi d'observer l'évolution des dépenses et des gains au fil des parties.">
    <title>SimuLotto</title>
    <link rel="icon" type="image/png" sizes="16x16" href="images/icons/icon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/icons/icon-32x32.png">
    <link rel="icon" type="image/png" sizes="48x48" href="images/icons/icon-48x48.png">
    <link rel="icon" type="image/png" sizes="64x64" href="images/icons/icon-64x64.png">
    <link rel="apple-touch-icon" sizes="180x180" href="images/icons/icon-192x192.png">
    <meta name="apple-mobile-web-app-title" content="SimuLotto" />
    <link rel="manifest" href="/manifest.webmanifest">
</head>
<body>
    <div class="grille">
        <div class="num">
            
        </div>
        <div class="star">
            
        </div>
    </div>
    <div class="result">
        <h2>Tirage :</h2>
        <div class="nb">
            <div class="nn"></div>
            <div class="nn"></div>
            <div class="nn"></div>
            <div class="nn"></div>
            <div class="nn"></div>
            <div class="ns"></div>
            <div class="ns"></div>
        </div>
    </div>
    <div class="tirage">PLAY</div>

    <div class="money">
        <div class="mise">
            <h3>Mise :</h3>
            <div class="n"></div>
        </div>
        <div class="gain">
            <h3>Gain :</h3>
            <div class="n"></div>
        </div>
        <div class="diff">
            <h3>Différence :</h3>
            <div class="n"></div>
        </div>
    </div>

    <script>
        // On injecte les valeurs de session au chargement
        window.sessionData = {
            mise: <?= $_SESSION['mise'] ?>,
            gain: <?= $_SESSION['gain'] ?>
        };
    </script>
    <script src="script.js"></script>
</body>
</html>