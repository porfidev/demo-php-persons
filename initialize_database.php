<?php

require_once('conexion.php');

/**
 * @var mysqli $connection
 */

$persons_table = <<<'EOF'
create table Persons
(
    id         int auto_increment,
    name       varchar(64) not null,
    lastName   varchar(64) not null,
    maidenName varchar(64) not null,
    birthDate  date        null,
    constraint Persons_pk
        primary key (id)
);
EOF;


try {
  $stmt = $connection->prepare($persons_table);
  $result = $stmt->execute();
} catch (Exception $e){
  echo "no se puede instalar la base de datos: " . $e->getMessage();
}

$stmt->close();
