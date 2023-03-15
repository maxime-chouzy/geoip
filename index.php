<?php

// Connexion à la base de données
$dsn = "mysql:host=localhost;dbname=geoip;port=3310";
$username = "";
$password = "";

// Lecture des identifiants de connexion à partir du fichier bd.json
if (file_exists('bd.json')) {
    $file = file_get_contents('bd.json');
    $data = json_decode($file, true);
    if (isset($data['dsn'])) {
        $dsn = $data['dsn'];
    }
    if (isset($data['username'])) {
        $username = $data['username'];
    }
    if (isset($data['password'])) {
        $password = $data['password'];
    }
}

// Connexion à la base de données avec PDO
try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    die();
}

// Fonction pour convertir une adresse IP en format long
function ipToLong() {
    if( isset( $_GET['submit'])){

        $ipRequest = $_GET['ip'];
        $iplong = ip2long($ipRequest);

        // echo " IP : ".$ipRequest;
        // echo "<br>";
        // echo "Resultat IP TO INT : ".$iplong;
        LocalisationIP($iplong);
    }
}


// Localiser l'ip
function LocalisationIP($pIP){
    global $pdo;
    // Requête prepare, permet de récupérer les informations de localisation de l'ip entre valeur1 et valeur2.
    $req = $pdo->prepare("SELECT * FROM GEOIP WHERE C1 <= :ip AND C2 >= :ip");
    $req->execute(array('ip' => $pIP));
    $donnees = $req->fetch();
    $req->closeCursor();

    $arr = $donnees;

    // Afficher toute les données des colones récupéré dans la requête.
    echo "  <p>ip From : $arr[0]</p> 
            <p>ip To : $arr[1]</p> 
            <p>country Code : $arr[2]</p> 
            <p>country Name : $arr[3]</p> 
            <p>region Name : $arr[4]</p> 
            <p>city Name : $arr[5]</p> 
            <p>Latitude : $arr[6]</p>
            <p>Longitude : $arr[7]</p>";
    echo "<br>";
    echo "<br>";
}

// Vérification du formulaire
$ip = '';
$error = '';
if (isset($_POST['submit'])) {
    $ip = $_POST['ip'];
    if (!preg_match('/^(?:[0-9]{1,3}\.){3}[0-9]{1,3}$/', $ip)) {
        $error = 'L\'adresse IP n\'est pas au format valide.';
    }
}

ipToLong();


// Affichage du résultat
echo <<<END
<!DOCTYPE html>
<html>
<head>
    <title>GEOIP</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <div class="global">
        <div class="block">
            <h1>GEOIP</h1>
            <form method="get" name="t">
                <label for="ip">Adresse IP :</label>
                <input type="text" name="ip" id="ip" value="$ip">
                <input type="submit" name="submit" value="Valider">
            </form>
        </div>
    </div>
</body>
</html>
END;
?>