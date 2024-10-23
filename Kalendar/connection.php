<?php
$kasutaja = 'd123170_buivol';
$servernimi = 'd123170.mysql.zonevs.eu';
$parool = '89015622An';
$andmebaas = 'd123170_andmebaas';
$yhendus = new mysqli($servernimi, $kasutaja, $parool, $andmebaas);
$yhendus->set_charset('UTF8');
?>
