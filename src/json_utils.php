<?php

function parse_response($response, $return_types): array {
    $mock_datas = explode(",", $response);

    $index = 0;
    foreach ($return_types as $key => $value) {
        if (isset($arrayDati[$index])) {
            $mock_array[$key] = $mock_datas[$index];
        }
        $index++;
    }

    return $mock_array;
}

function read_and_decode_json_file($file_path) {    
    $json = read_file($file_path);
    $json_data = json_decode($json, true);
    return $json_data;
}

function read_file(string $file_path, bool $print_errors = true) {
    $json = file_get_contents($file_path);
    if ($json === false) {
        die($print_errors ? "Error reading the file": "");
    }
    
    return $json;
}