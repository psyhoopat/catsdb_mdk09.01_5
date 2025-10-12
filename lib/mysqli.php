<?php

function db_connect(): mysqli {
    try {
        $mysqli = new mysqli(
            "localhost",
            "root",
            "1234",
            "catsdb"
        );
        if ($mysqli->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
            exit;
        }

        return $mysqli;
    } catch (Exception $ex) {
        printf("Connect failed: %s\n", $ex->getMessage());
        exit;
    }
}

function get_species_cat() {
    try {
        $mysqli = db_connect();

        $sql = "SELECT * FROM species_cat";
        $result = $mysqli->query($sql);

        $mysqli->close();

        return $result;
    } catch (Exception $ex) {
        printf("Mysql error: %s\n", $ex->getMessage());
        exit;
    }
}

function get_info_cat() {
    try {
        $mysql = db_connect();

        $sql = "SELECT * FROM info_cat";
        $result = $mysql->query($sql);

        $mysql->close();

        return $result;
    } catch (Exception $ex) {
        printf("Mysql error: %s\n", $ex->getMessage());
        exit;
    }
}

function create_post_cat($gender, $place, $age, $description, $contact, $coordinates, $info, $id_species) {
    try {
        $mysqli = db_connect();

        $sql = "INSERT INTO info_cat (
                      gender, 
                      place,
                      age,
                      description,
                      contact,
                      coordinates,
                      info,
                      id_species
                  ) VALUES (
                        '$gender',
                        '$place',
                        '$age',
                        '$description',
                        '$contact',
                        '$coordinates',
                        '$info',
                        '$id_species'
                  )";

        $result = $mysqli->query($sql);
        $mysqli->close();

        return $result;
    } catch (Exception $ex) {
        printf("Mysql error: %s\n", $ex->getMessage());
        exit;
    }
}