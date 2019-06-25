<?php

include "database.php";

// Сreation of db
try {
    $conn = new PDO($DB_DSN_FIRST, $DB_USER, $DB_PASSWORD, $OPTIONS);
    $sql = "CREATE DATABASE IF NOT EXISTS $DB_NAME;";
    $conn->exec($sql);
}
catch(PDOException $e){

    echo $sql . "<br>" . $e->getMessage();
}

// close connection
$conn = null;

//connect again to new db
try {
    $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $OPTIONS);
}
catch(PDOException $e){

    echo "<br>" . $e->getMessage();
}

//create users
try {
    $sql = "CREATE TABLE IF NOT EXISTS users (
            id INT NOT NULL AUTO_INCREMENT,
            login VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            pass VARCHAR(1024) NOT NULL, 
            notification BOOLEAN DEFAULT 1,
            PRIMARY KEY (id)
        ) ;";

    $conn->exec($sql);
}
catch(PDOException $e){

    echo $sql . "<br>" . $e->getMessage();
}

//create photos
try {
    $sql = "CREATE TABLE IF NOT EXISTS photos (
            id INT NOT NULL AUTO_INCREMENT,
            path VARCHAR(1024) NOT NULL,
            creation_date TIMESTAMP NOT NULL,
            likes INT DEFAULT 0, 
            user_id INT NOT NULL,
            FOREIGN KEY (user_id)
                REFERENCES users(id)
                ON DELETE CASCADE,
            PRIMARY KEY (id)
        ) ;";

    $conn->exec($sql);
}
catch(PDOException $e){

    echo $sql . "<br>" . $e->getMessage();
}

//create comments
try {
    $sql = "CREATE TABLE IF NOT EXISTS comments (
            id INT NOT NULL AUTO_INCREMENT,
            author VARCHAR(255) NOT NULL,
            comment TEXT NOT NULL,
            creation_date TIMESTAMP NOT NULL,
            photo_id INT NOT NULL,
            FOREIGN KEY (photo_id)
                REFERENCES photos(id)
                ON DELETE CASCADE,
            PRIMARY KEY (id)
        ) ;";

    $conn->exec($sql);
}
catch(PDOException $e){

    echo $sql . "<br>" . $e->getMessage();
}

//insert into users (login, email, pass) values ('root', 'root@mail.ru', '344907e89b981caf221d05f597eb57a6af408f15f4dd7895bbd1b96a2938ec24a7dcf23acb94ece0b6d7b0640358bc56bdb448194b9305311aff038a834a079f');
//DELETE FROM `users` WHERE `id` = 1;
//ALTER TABLE users MODIFY password VARCHAR(1024);
//tail -f /var/log/apache2/error_log
$conn = null;

?>

