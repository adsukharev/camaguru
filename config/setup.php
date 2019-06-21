<?php

require_once "database.php";

// Сreation of db
try {
    $conn = new PDO($DB_DSN_FIRST, $DB_USER, $DB_PASSWORD, $OPTIONS);

    $sql = "CREATE DATABASE IF NOT EXISTS $DB_NAME;";

    $conn->exec($sql);
//    echo "База данных создана успешно<br>";
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
            password VARCHAR(255) NOT NULL, 
            notification BOOLEAN DEFAULT 1,
            PRIMARY KEY (id)
        ) ;";

    $conn->exec($sql);
//    echo "user's table created<br>";
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
                REFERENCES users(id),
            PRIMARY KEY (id)
        ) ;";

    $conn->exec($sql);
//    echo "photo's table created<br>";
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
                REFERENCES photos(id),
            PRIMARY KEY (id)
        ) ;";

    $conn->exec($sql);
//    echo "comment's table created<br>";
}
catch(PDOException $e){

    echo $sql . "<br>" . $e->getMessage();
}

//insert root user
//insert into users (login, email, password) values ('root', 'root@mail.ru', '123');

$conn = null;

?>