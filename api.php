<?php
    session_start();

    header("Content-Type: application/json");

    $data = json_decode(file_get_contents("php://input"), true);

    $simpleNum = $data['numeros'];
    $starNum = $data['etoiles'];

    //incrémentation de la mise
    $_SESSION['mise'] += 250;

//tirage des nombres
    //création des grilles
    $tabTirage = range(1, 50);
    $starTirage = range(1, 12);

    //mélange par Fisher-Yates
    for($i = count($tabTirage) - 1; $i > 0; $i--){
        $j = random_int(0, $i);
        [$tabTirage[$i], $tabTirage[$j]] = [$tabTirage[$j], $tabTirage[$i]];
    }

    for($i = count($starTirage) - 1; $i > 0; $i--){
        $j = random_int(0, $i);
        [$starTirage[$i], $starTirage[$j]] = [$starTirage[$j], $starTirage[$i]];
    }

    //tirage finale
    $finTir = array_slice($tabTirage, 0, 5);
    $finStar = array_slice($starTirage, 0, 2);

    $pointsNum = count(array_intersect($simpleNum, $finTir));
    $pointsStar = count(array_intersect($starNum, $finStar));

//calcul des gains
    $gain = 0;
    if($pointsNum === 2 && $pointsStar === 0){
        $gain = 390;
    }else if($pointsNum === 2 && $pointsStar === 1){
        $gain = 550;
    }else if($pointsNum === 1 && $pointsStar === 2){
        $gain = 670;
    }else if($pointsNum === 3 && $pointsStar === 0){
        $gain = 930;
    }else if($pointsNum === 3 && $pointsStar === 1){
        $gain = 1120;
    }else if($pointsNum === 2 && $pointsStar === 2){
        $gain = 1400;
    }else if($pointsNum === 4 && $pointsStar === 0){
        $gain = 3940;
    }else if($pointsNum === 3 && $pointsStar === 2){
        $gain = 5740;
    }else if($pointsNum === 4 && $pointsStar === 1){
        $gain = 11960;
    }else if($pointsNum === 4 && $pointsStar === 2){
        $gain = 129890;
    }else if($pointsNum === 5 && $pointsStar === 0){
        $gain = 2085140;
    }else if($pointsNum === 5 && $pointsStar === 1){
        $gain = 20073760;
    }else if($pointsNum === 5 && $pointsStar === 2){
        $gain = 1700000000;
    }

    //ajout du gain à la session

    $_SESSION['gain'] += $gain;

    echo json_encode([
        "tirage" => $finTir,
        "etoiles" => $finStar,
        "pointsNum" => $pointsNum,
        "pointsStar" => $pointsStar,
        "gain" => $_SESSION['gain'],
        "mise" => $_SESSION['mise']
    ]);
