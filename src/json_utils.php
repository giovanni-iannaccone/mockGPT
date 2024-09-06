<?php

function extract_data_types($data, string $INVALID_DATA_TYPE = "", string $VALID_DATA_TYPE = ""): array {
    $data_valid = [];

    foreach ($data as $key => $value) {
        if ($value != $INVALID_DATA_TYPE || $value == $VALID_DATA_TYPE) {
            $data_valid[$key] = $value;
        }
    }

    return array(
        'return_types' => $data_valid
    );
}

function merge_json($first_json, $second_json): array {
    return array_merge($first_json, $second_json);
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