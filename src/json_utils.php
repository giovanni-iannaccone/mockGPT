<?php

function parse_response($response, $return_types): array {
    $mock_datas = array_map('trim', explode(',', $response));
    $keys = array_keys($return_types);

    $group_size = count($keys);
    $result = [];

    for ($i = 0; $i < count($mock_datas); $i += $group_size) {
        $group = array_slice($mock_datas, $i, $group_size);
        $result[] = array_combine($keys, $group);
    }

    return $result;
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