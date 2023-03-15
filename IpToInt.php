<?php

function IpToInt(){
    if( isset( $_GET['submit'])){

        $ipRequest = $_GET['ip_search'];
        $longIp = ip2long($ipRequest);

        echo " IP : ".$ipRequest;
        echo "<br>";
        echo "Resultat IP TO INT : ".$longIp;

        if ($long == -1 || $long === FALSE) {
            echo 'IP invalide, merci d\'essayer encore';
        } else {
            echo $ip   . "\n";            
            echo $long . "\n";            
            printf("%u\n", ip2long($ipRequest));
}
    }
}

IpToInt();
?>