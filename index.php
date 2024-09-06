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

$file_path = $_GET['configurations'];
if (empty($file_path)) {
    die('Missing param: configurations');
}

$data = read_and_decode_json_file($file_path);

$number_of_data_to_generate = $data['number_of_data_to_generate'];
if ($number_of_data_to_generate <= 0) {
    die('Error in configurations: number_of_data_to_generate must be positive');
}

$data_for_chat_gpt = extract_data_types($data['return_types'], $INVALID = "IMAGE");
$data_for_chat_gpt += ['chat_gpt_api_key' => $data['chat_gpt_api_key']];

$data_for_unsplash = extract_data_types($data['return_types'], $VALID = "IMAGE");
$data_for_unsplash += ['unsplash_api_key' => $data['unplash_api_key']];

$response_from_chat = retrieve_data_from_chat_gpt(
    $data_for_chat_gpt, $number_of_data_to_generate
);

$response_from_unsplash = retrieve_data_from_unsplash(
    $data_for_unsplash, $number_of_data_to_generate
);

echo json_encode(
    merge_json($response_from_chat, $response_from_unsplash)
);