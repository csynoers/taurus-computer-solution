<?php
    $originalDate = "2020-01-13T14:31:27.115Z";
    $newDate = date("d F Y & H:i:s", strtotime($originalDate));
    echo '<pre>';
    print_r($newDate);
    echo '</pre>';