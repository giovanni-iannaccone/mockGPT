<?php

require "src/api_data.php";
require "src/json_utils.php";
require "src/prompt_utils.php";

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

function retrieve_data_from_chat_gpt($data, $number): array {
    $chat_gpt = new ChatGPTApi($data['chat_gpt_api_key']);

    $prompt = craft_prompt($data['return_types'], $number);
    $response = $chat_gpt->send_request($prompt);

    return parse_response($response, $data['return_types']);
}

function retrieve_data_from_unsplash($data, $number): array {
    return [];
}

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

$request_body = file_get_contents('php://input');
$data_received = json_decode($request_body, true);

$file_path = $data['configurations'];
if (empty($file_path)) {
    die('Missing param: configurations');
}

$data = read_and_decode_json_file();
$number_of_data_to_generate = $data['number_of_data_to_generate'];
if ($number_of_data_to_generate <= 0) {
    die('Error in configurations: number_of_data_to_generate must be positive');
}

$data_types_for_chat_gpt = extract_data_types($data['return_types'], $INVALID = "IMAGE");
$data_for_chat_gpt = merge_json($data['chat_gpt_api_key'], $data_types_for_unsplash);

$data_types_for_unsplash = extract_data_types($data['return_types'], $VALID = "IMAGE");
$data_for_unsplash = merge_json($data['unsplash_api_key'], $data_types_for_unsplash);

$response_from_chat = retrieve_data_from_chat_gpt(
    $data_for_chat_gpt, $number_of_data_to_generate
);

$response_from_unsplash = retrieve_data_from_unsplash(
    $data_for_unsplash, $number_of_data_to_generate
);

echo json_encode(
    merge_json($response_from_chat, $response_from_unsplash)
);