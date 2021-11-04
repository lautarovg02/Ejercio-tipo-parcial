<?php

require_once 'apiModel.php';
require_once 'apiView.php';

class apiController{

    private $model;
    private $data;
    private $view;

    function __construct()
    {
        $this->model= new apiModel();
        $this->view= new apiView();
        $this->data = file_get_contents("php://input"); 
    }

    function getFlight($params=null){
        $nro_vuelo= $this->model->flightsByNumber($params[":NRO_VUELO"]);

        if(!empty($nro_vuelo)){
            $this->view->response($nro_vuelo,200);
        }else{
            $this->view->response('vuelo no encontrado',404);
        }

    }

    function getCities($params=null){
        
        if(empty($params)){
            $city=$this->model->availableCities();

            return $this->view->response($city,200);
        }
    }

    function sendFlight($params=null){
        $data=$this->getBody();

        $nro_flight= $data->nro_vuelo;
        $date= $data->fecha_salida;
        $city_of_origen= $data->ciudad_origen_id_fk;
        $destination_city= $data->ciudad_destino_id_fk;
        $state= $data->estado;

        $flight=$this->model->insertFlight($nro_flight,$date,$city_of_origen,$destination_city,$state);

        if($flight){
            $this->view->response('El vuelo fue agregado con exito',200);
        }else{
            $this->view->response('Algo fallo, no se pudo agregar el vuelo',500);
        }


    }
    function flights(){
        $flights=$this->model->allFlights();
        return $this->view->response($flights,200);
    }
    function getBody(){
        $data=file_get_contents("php://input");
        return json_decode($data);
    }

    function getData(){ 
        return json_decode($this->data); 
    }  


}