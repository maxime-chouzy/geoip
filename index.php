<?php

// PAS TOUCHER "select * from geoip where 624603930 BETWEEN C1 AND C2"


function connexionDB(){
    // connexion bd
    try { $db = new PDO('mysql:host=localhost:3306;dbname=ip;charset=utf8', 'root', 'root'); }
    catch (Exception $e) { die('Erreur : ' . $e->getMessage()); }
}

function NbrColone(){

    if(isset ($_GET['submit_nbrcolone'])){
        // connexion bd
        try { $db = new PDO('mysql:host=localhost:3306;dbname=ip;charset=utf8', 'root', 'root'); }
        catch (Exception $e) { die('Erreur : ' . $e->getMessage()); }


        $req = $db->query("SELECT  COUNT(*) as NbColone FROM geoip");
        $donnees = $req->fetch();
        $req->closeCursor();

        // affi nbr colones
        echo ("Nombre de colones : ".$donnees['NbColone']);
    }
}

function LocalisationIP($pIp){
    // connexion BD
    try { $db = new PDO('mysql:host=localhost:3306;dbname=ip;charset=utf8', 'root', 'root'); }
    catch (Exception $e) { die('Erreur : ' . $e->getMessage()); }


    $req = $db->query("SELECT * FROM GEOIP WHERE $pIp BETWEEN ip_from AND ip_to");
    $donnees = $req->fetch();
    $req->closeCursor();
    echo "<br>";
    echo "<br>";

    // affi nbr colones
    // var_dump($donnees);

    echo " IP From : ".$donnees['ip_from']."<br>"." IP To : ".$donnees['ip_to']."<br>"." Country Code : ".$donnees['country_code']."<br>"." Country Name : ".$donnees['country_name']."<br>"." Region Name : ".$donnees['region_name']."<br>"." City Name : ".$donnees['city_name']."<br>"." Latitude : ".$donnees['latitude']."<br>"." Longitude : ".$donnees['longitude']."<br>";
}

function IpToInt(){
    // $ipRequest = "37.58.179.26";
    if( isset( $_GET['submit'])){

        $ipRequest = $_GET['ip_search'];
        $ipSlice = explode(".", $ipRequest);

        // ip = ip3 + ip2 * 256 + ip1 * 256 * 256 + ip0 * 256 * 256 * 256
        $ip = $ipSlice[3] + $ipSlice[2] * 256 + $ipSlice[1] * 256 * 256 + $ipSlice[0] * 256 * 256 * 256;
        echo " IP : ".$ipRequest;
        echo "<br>";
        echo "Resultat IP TO INT : ".$ip;
        LocalisationIP($ip);
    }
}

IpToInt();
NbrColone();
// var_dump($_GET);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GEOIP</title>
    <link rel="icon" href="./img/ico.ico" type="image/x-icon" />
    <link rel="stylesheet" href="./styles/index.css">
</head>
<body>

    

<div class="global">

    <div class="block">
        <h1>GEOIP</h1>
        <form action="" method="get">
            <label for="ip_search">Localiser IP : </label>
            <input type="text" placeholder="" name="ip_search"></input>
            <button type="submit" name="submit">Valider</button>
            <meta name="viewport" content="width=device-width, user-scalable=no">
        </form>
        <br>

        <form action="" method="get">
            <button type="submit" name="submit_nbrcolone"> NBR Colones </button>
        </form>
        <br>

        <button>
            <a href="http://localhost/geoip/">
                Clear Interface    
            <a>
        </button>
    </div>
</div>




</body>
</html>