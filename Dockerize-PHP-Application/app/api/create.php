<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/employees.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Cars($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->Vin = $data->Vin;
    $item->Model = $data->Model;
    $item->Price = $data->Price;
    $item->Color = $data->Color;

    
    if($item->createCars()){
        echo 'Car created successfully.';
    } else{
        echo 'Car could not be created.';
    }
?>