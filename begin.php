<?php
    require 'sql_data.php';

    $link = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    $sql = "CREATE TABLE IF NOT EXISTS `admin` ( `sr_no` INT(255) NOT NULL, `station_name` VARCHAR(100) NOT NULL , `station_id` VARCHAR(50) NOT NULL, `password` VARCHAR(50) NOT NULL , `categories` INT(255) NOT NULL DEFAULT '0' , `item_types` INT(255) NOT NULL DEFAULT '0' , `items` INT(255) NOT NULL DEFAULT '0' , `active` INT(255) NOT NULL DEFAULT '0' , `inactive` INT(255) NOT NULL DEFAULT '0' , `alerts` INT(255) NOT NULL DEFAULT '0' , `location` VARCHAR(500) NOT NULL , `admin` VARCHAR(100) NOT NULL, PRIMARY KEY (`station_id`) );";
    if($result = mysqli_query($link, $sql)){
        echo 'Table Verified!';
    } else{
        exit("ERROR: Could not connect with Database. " . mysqli_error($link));
    }
    

    function add_station(){
        $sql = "INSERT INTO `admin` (`sr_no`, `station_name`, `station_id`, `password`, `categories`, `item_types`, `items`, `active`, `inactive`, `alerts`, `location`, `admin`) VALUES ('1', 'Station 1', '#S1', 'admin123', '1', '0', '0', '0', '0', '0', 'Location 1', 'admin1');";
        if($result = mysqli_query($GLOBALS['link'], $sql)){
            //create station table
            $sql = "CREATE TABLE IF NOT EXISTS `station` ( `sr_no` INT NOT NULL , `category_name` VARCHAR(100) NOT NULL , `category_id` VARCHAR(100) NOT NULL , `category_image` VARCHAR(1000) NOT NULL DEFAULT 'NA' , `item_types` INT(255) NOT NULL DEFAULT '0' , `items` INT(255) NOT NULL DEFAULT '0' , `active` INT(255) NOT NULL DEFAULT '0' , `inactive` INT(255) NOT NULL DEFAULT '0' , `alerts` INT(255) NULL DEFAULT '0' , PRIMARY KEY (`category_id`));";
            if($result = mysqli_query($GLOBALS['link'], $sql)){
                echo '<br>Station Added Successfully!';
            } else{
                exit("ERROR: Could not connect with Database. " . mysqli_error($GLOBALS['link']));
            }
        } else{
            exit("ERROR: Could not connect with Database. " . mysqli_error($GLOBALS['link']));
        }
    }

    add_station();
    
?>