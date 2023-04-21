<?php


$file = fopen("result.csv", "r");

$response = [];
$errors = [];
$allowSource = ["google forms", "facebook leads", "email response", "manual registration"];
// $titles = [];

$pos = 0; 

while (($data = fgetcsv($file, 1000, ",")) !== FALSE) 
{
    $flag = true;

    if($pos == 0){

        $titles = $data;
        $response[] = $titles;

    }else{

        // name
        if($data[0] ){
            $name = explode(" ",$data[0]);
    
            if(!in_array(count($name), [2, 3])){
                $flag = false;
                $columnName = $titles[0];
                $errors[$pos] = [ $columnName => 'Nombre invalido'];
            }
        }
    
        // age
        if($data[1]){
    
            if( $data[1] < 1 || $data[1] > 125 ){
                $flag = false;
                $columnName = $titles[1];
                $errors[$pos] = [ $columnName => 'El rango de edad esta excedido'];
            }
        }
    
        // DNI
        if($data[2]){
    
            if( strlen($data[2]) != 11 ){
                $flag = false;
                $columnName = $titles[2];
                $errors[$pos] = [ $columnName => 'El dni es invalido'];
            }
        }
    
        // source
        if($data[3]){
    
            if( !in_array(strtolower($data[3]), $allowSource) ){
                $flag = false;
                $columnName = $titles[3];
                $errors[$pos] = [ $columnName => 'La fuente del dato es invalida'];
            }
        }

        // tags
        if($data[4]){
            /**
             * Tags: un conjunto de strings separados por “|” y que solo pueden contener caracteres alfanuméricos y barras bajas ( _ ).
             */
        }

        // telefono
        if($data[5]){

            $phone = str_replace(" ", "", $data[5]);
            $phone = str_replace("-", "", $phone);
            $phone = str_replace("+", "", $phone);
            if( substr($phone, 0, 2) == '54'){
                $phone = substr($phone, 2, strlen($phone));
            }
    
            if( strlen($phone) != 11 ){
                $flag = false;
                $columnName = $titles[5];
                $errors[$pos] = [ $columnName => 'El telefono es invalido'];
            }
        }
       
        // ID
        if($data[6]){

            if( $data[6] < 10000 || $data[6] > 99999 ){
                $flag = false;
                $columnName = $titles[6];
                $errors[$pos] = [ $columnName => 'El ID es invalido'];
            }
        }

        if($flag == true){
            $response[] = $data;
        }

    }

    $pos++;

}


// response csv

$filename = 'response.csv';

$f = fopen($filename, 'wb');

foreach ($response as $res) {
    fputcsv($f, $res);
}

fclose($f);


// file errors

$filenameErrors = 'errors.json';

$f = fopen($filenameErrors, 'wb');

file_put_contents($filenameErrors, json_encode($errors));

fclose($f);

