<?php

    function createTable($con){
        $sql = "CREATE TABLE IF NOT EXISTS user(
            first_name varchar(50) NOT NULL,
            last_name varchar(50) NOT NULL,
            username varchar(50) NOT NULL,
            password varchar(50) NOT NULL,
            PRIMARY KEY (username)
            )";


        $sql_add = "INSERT IGNORE INTO user VALUES ('Reima', 'Riihimäki','repe','eper'),
            ('John','Doe', 'doejohn', 'eod'),('Lisa','Simpson','ls','qwerty')";

        $con->exec($sql);
        $con->exec($sql_add);


    }
?>