<?php

class apiModel{

    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_vuelos;charset=utf8', 'root', '');
    }

    function flightsByNumber($nro_flight){

        $query = $this->db->prepare('SELECT * FROM vuelos WHERE nro_vuelo=?');
        $query->execute([$nro_flight]);

        $flight= $query->fetchAll(PDO::FETCH_OBJ);

        return $flight;
    }

    function availableCities(){

        $query = $this->db->prepare('SELECT * FROM ciudad');
        $query->execute();

        $cities = $query->fetchAll(PDO::FETCH_OBJ);

        return $cities;
    }

    function insertFlight($nro_flight,$date,$city_of_origen,$destination_city,$state){

        $query= $this->db->prepare('INSERT INTO vuelos (nro_vuelo, fecha_salida, ciudad_origen_id_fk, ciudad_destino_id_fk, estado) VALUES (?, ?, ?, ?, ?)');
        $query->execute([$nro_flight,$date,$city_of_origen,$destination_city,$state]);

        return $this->db->lastInsertId();
    }

    Function allFlights(){
        
            $query=$this->db->prepare('SELECT * FROM vuelos');
            $query->execute();
    
            $flights=$query->fetchAll(PDO::FETCH_OBJ);
    
            return $flights;
        
    }
}