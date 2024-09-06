<?php 

function craft_prompt($return_types, $number_of_data_to_generate): string {
    $base_prompt = "From now on, I will ask you to generate mock data, and you will respond with a string of data in sequence separated by a comma. Nothing else. ";
    $return_types_string = json_encode($return_types);

    $prompt = $base_prompt . "Generate " . $number_of_data_to_generate . " with this structure " . $return_types_string ;
    return $prompt;
}