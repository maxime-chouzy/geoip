<?php

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
    }
}

IpToInt();
?>