<?php
    $con=mysqli_connect('10.10.10.24','4gc','4gc','4gd_automat');
    $q = mysqli_query($con,'SELECT * FROM automat;');
    $d = mysqli_fetch_assoc($q);

    echo $d['id'];
?>