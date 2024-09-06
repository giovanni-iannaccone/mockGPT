<?php

require "../src/json_utils.php";
require "../src/prompt_utils.php";

define("TEST_PASSED", 1);
define("TEST_FAILED", 0);

class Test {
    protected function assert($condition, $test_name): int {
        if ($condition) {
            echo '<p style=\'color: green; line-height: 5px\'>[+] ' . $test_name . ': Test Passed </p>';
            return TEST_PASSED;
        } else {
            echo '<p style=\'color: red; line-height: 5px\'>[-] ' . $test_name . ': Test Failed </p>';
            return TEST_FAILED;
        }
    }
}

class TestJsonUtils extends Test {

    private function test_extract_json_data(): bool {
        $test_array = array(
            'data' => 'DATA',
            'value' => 'INT',
            'image' => 'IMAGE',
        );

        $expected_result = array(
            'return_types' => array(
                'data' => 'DATA',
                'value' => 'INT'
            )
        );

        return $this->assert(
            extract_data_types($test_array, $INVALID_DATA_TYPE = 'IMAGE') == $expected_result,
            'Extract data types'
        );
    }

    private function test_merge_json(): int{
        $first_test_json = array(
            "data" => "data"
        );

        $second_test_json = array(
            "data_2" => "data_2"
        );

        $expected_result = array(
            "data" => "data",
            "data_2" => "data_2"
        );

        return $this->assert(
            merge_json($first_test_json, $second_test_json) == $expected_result,
            "Merge json"
        );
    }

    public function run_test(): int {
        $test_passed = $this->test_extract_json_data() + $this->test_merge_json();

        echo $test_passed . " / 2 json test passed <br/><br/>";
        return $test_passed;
    }
}

class TestPromptUtils extends Test {
    private function test_craft_prompt(): int {
        $test_array = ['a', 'b', 'c'];

        $expected_result = 'From now on, I will ask you to generate mock data, and you will respond with a string of data in sequence separated by a comma. Nothing else. Generate 1 with this structure ["a","b","c"]';
        
        return $this->assert(
            craft_prompt($test_array, 1) == $expected_result,
            'Craft prompt'
        );
    }

    public function run_test(): int {
        $test_passed = $this->test_craft_prompt();
        
        echo $test_passed . " / 1 prompt test passed <br/><br/>"; 
        return $test_passed;
    }
}

$test_json_utils = new TestJsonUtils();
$json_tests_passed = $test_json_utils->run_test();

$test_prompt_utils = new TestPromptUtils();
$prompt_tests_passed = $test_prompt_utils->run_test();

echo $json_tests_passed + $prompt_tests_passed . " tests passed ";
