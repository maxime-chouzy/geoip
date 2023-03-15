<?php
function affiHTML($arr){
    echo <<<END
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


            <p>ip From :$arr[0]</p> 
  <p>ip To : $arr[1]</p> 
  <p>country Code : $arr[2]</p> 
  <p>country Name : $arr[3]</p> 
  <p>region Name : $arr[4]</p> 
  <p>city Name : $arr[5]</p> 
  <p>Latitude : $arr[6]</p>
  <p>Longitude :$arr[7]</p>
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
END;
}