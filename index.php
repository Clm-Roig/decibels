<?php
    include('back/models/Band.php');

    ini_set('display_errors', 1);
    $obj = new Band();

    echo $obj->deleteBand(4);
    echo file_get_contents('views/index.html');
