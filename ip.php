<?php

function NbrColone($condb){

    if(isset ($_GET['submit_nbrcolone'])){
        $req = $condb->query("SELECT  COUNT(*) as NbColone FROM geoip");
        $donnees = $req->fetch();
        $req->closeCursor();

        // affi nbr colones
        echo ("Nombre de colones : ".$donnees['NbColone']);
    }
}

function Main(){

    $aContent = json_decode( file_get_contents('bd.json'), true );
    // Requête préparée
    $conn_string = "host={$aContent["host"]} port={$aContent["port"]} dbname={$aContent["dbname"]} user={$aContent["user"]} password={$aContent["password"]}";
    $dsn = pg_pconnect($conn_string);
    // Fonction de verification du nombre de colone
    NbrColone($dsn);

    $ip = $_POST['ip'] ?? '';
    
    if ($ip = 'local') {
        $ip = $_SERVER["REMOTE_ADDR"];
        ConvertIPToInt($ip);
    }
    
    if ($ip = ' ') {
        $ip = '8.8.8.8';
        ConvertIPToInt($ip);
    }

    $sql = 'SELECT * FROM geoip WHERE c1 <  $1  AND c2 > $1';
    $sqlName = 'selectIp';
    if (!pg_prepare($sqlName, $sql)) { // Permet de preparer la requete et d'afficher une erreur si ce n'est pas possible
        die("Can't prepare '$sql': " . pg_last_error());
    }
    $result = pg_execute($sqlName, array($inIP)); // Execute la requete

    $sql = sprintf(
        'DEALLOCATE "%s"', // Détruit la requete préparer
        pg_escape_string($sqlName)
    );
    if (!pg_query($sql)) {
        die("Can't query '$sql': " . pg_last_error());
    }

    $arr = pg_fetch_array($result, 0, PGSQL_NUM);

    return($arr);
}

/* function LocalisationIP($pIp, $condb){

    $req = $condb->query("SELECT * FROM GEOIP WHERE $pIp BETWEEN ip_from AND ip_to");
    $donnees = $req->fetch();
    $req->closeCursor();
    echo "<br>";
    echo "<br>";

    echo " IP From : ".$donnees['ip_from']."<br>"." IP To : ".$donnees['ip_to']."<br>"." Country Code : ".$donnees['country_code']."<br>"." Country Name : ".$donnees['country_name']."<br>"." Region Name : ".$donnees['region_name']."<br>"." City Name : ".$donnees['city_name']."<br>"." Latitude : ".$donnees['latitude']."<br>"." Longitude : ".$donnees['longitude']."<br>";
} */
