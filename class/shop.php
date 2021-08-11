<?php
 class shop{








    function Get_price(){


        include_once '../config/db.php';

        echo json_encode(mysqli_fetch_all(mysqli_query($conn,"SELECT * FROM `price`;"),MYSQLI_ASSOC),true);


    }


 }