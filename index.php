<?php

require "src/api_data.php";
require "src/json_utils.php";
require "src/prompt_utils.php";

function retrieve_data_from_chat_gpt($data): array {
    $chat_gpt = new ChatGPTApi($data['chat_gpt_api_key']);

    $prompt = craft_prompt($data['return_types'], $data['number_of_data_to_generate']);
    $response = $chat_gpt->send_request($prompt);

    return parse_response($response, $data['return_types']);
}

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

$file_path = $_GET['configurations'];
if (empty($file_path)) {
    die('Missing param: configurations');
}

$data = read_and_decode_json_file($file_path);

$number_of_data_to_generate = $data['number_of_data_to_generate'];
if (! $number_of_data_to_generate) {
    die('Error in configurations: number_of_data_to_generate must be positive');
}

count($data['return_types'])
    ? $response_from_chat = retrieve_data_from_chat_gpt(
        $data
    )
    : $response_from_chat_gpt = array();


echo json_encode(
    $response_from_chat_gpt
);