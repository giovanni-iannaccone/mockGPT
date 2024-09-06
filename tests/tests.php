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

    private function test_parse_response(): int {
        $test_string = '17, 04-09-2024, 1.00, mockGPT, 13, 24-10-2020, 5.05, helloWorld';
        $test_return_types = array(
            "number" => "INT",
            "data" => "DATA",
            "float" => "FLOAT",
            "text" => "TEXT"
        );

        $expected_result = array(
            array(
                'number' => '17',
                'data' => '04-09-2024',
                'float' => '1.00',
                'text' => 'mockGPT'
            ),

            array(
                'number' => '13',
                'data' => '24-10-2020',
                'float' => '5.05',
                'text' => 'helloWorld'
            )
        );

        return $this->assert(
            parse_response($test_string, $test_return_types) == $expected_result,
            "Parse response"
        );
    }

    public function run_test(): int {
        $test_passed = $this->test_parse_response();

        echo $test_passed . " / 1 json test passed <br/><br/>";
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
