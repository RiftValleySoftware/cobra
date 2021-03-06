<?php
/***************************************************************************************************************************/
/**
    COBRA Security Administration Layer
    
    © Copyright 2018, The Great Rift Valley Software Company
    
    LICENSE:
    
    MIT License
    
    Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation
    files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy,
    modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the
    Software is furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
    OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
    IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF
    CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

    The Great Rift Valley Software Company: https://riftvalleysoftware.com
*/
require_once(dirname(dirname(__FILE__)).'/functions.php');
    
// -------------------------------- TEST DISPATCHER ---------------------------------------------

function instance_run_tests() {
    instance_run_test(1, 'FAIL -Valid Big Lizard, but Invalid Direct Instantiation Test', 'We have a valid, manager-user-logged-in CHAMELEON, but try to directly instantiate a COBRA instance, which should fail.', 'king-cobra', NULL, 'CoreysGoryStory');
    instance_run_test(2, 'FAIL -Bad Lizard Test', 'We just create a COBRA instance, give it an invalid CHAMELEON, and make sure it is NOT valid.', NULL, NULL, NULL);
    instance_run_test(3, 'FAIL -Lizard Test', 'We just create a COBRA instance, give it a valid, not-even-attempted-logged-in CHAMELEON, and make sure it is NOT valid.', NULL, NULL, NULL);
    instance_run_test(4, 'FAIL -Errored Lizard Test', 'We just create a COBRA instance, give it a valid, mistake-so-not-logged-in CHAMELEON, and make sure it is NOT valid.', 'norm', NULL, 'OOPSIE');
    instance_run_test(5, 'FAIL -Weed Lizard Test', 'We just create a COBRA instance, give it a valid, non-cobra-level-user-logged-in CHAMELEON, and make sure it is NOT valid.', 'norm', NULL, 'CoreysGoryStory');
    instance_run_test(6, 'FAIL -Garden-Variety Lizard Test', 'We just create a COBRA instance, give it a valid, standard-user-logged-in CHAMELEON, and make sure it is NOT valid.', 'krait', NULL, 'CoreysGoryStory');
    instance_run_test(7, 'PASS -Big Lizard Test', 'We just create a COBRA instance, give it a valid, manager-user-logged-in CHAMELEON, and make sure it is valid.', 'king-cobra', NULL, 'CoreysGoryStory');
    instance_run_test(8, 'PASS -God Lizard Test', 'We just create a COBRA instance, give it a valid, God-logged-in CHAMELEON, and make sure it is valid.', 'admin', NULL, CO_Config::god_mode_password());
}

// -------------------------------- TESTS ---------------------------------------------

function instance_test_01($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    try {
        $cobra_instance = new CO_Cobra($chameleon_instance);
    } catch (Error $e) {
        echo("<h2 style=\"color:red;font-weight:bold\">The COBRA instance is not valid!</h2>");
        echo('ERROR:<pre>'.htmlspecialchars(print_r($e, true)).'</pre>');
    }
}

function instance_test_02($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $cobra_instance = make_cobra('BUBBA');
}

function instance_test_03($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon();
    $cobra_instance = make_cobra($chameleon_instance);
}

function instance_test_04($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
}

function instance_test_05($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
}

function instance_test_06($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
}

function instance_test_07($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
}

function instance_test_08($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
}

// -------------------------------- STRUCTURE ---------------------------------------------

function instance_run_test($in_num, $in_title, $in_explain, $in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $test_num_string = sprintf("%03d", $in_num);
    echo('<div id="test-'.$test_num_string.'" class="inner_closed">');
        echo('<h3 class="inner_header"><a href="javascript:toggle_inner_state(\'test-'.$test_num_string.'\')">TEST '.$in_num.': '.$in_title.'</a></h3>');
        echo('<div class="main_div inner_container">');
            echo('<div class="main_div" style="margin-right:2em">');
                echo('<p class="explain">'.$in_explain.'</p>');
            echo('</div>');
            $st1 = microtime(true);
            $function_name = sprintf('instance_test_%02d', $in_num);
            $function_name($in_login, $in_hashed_password, $in_password);
            $fetchTime = sprintf('%01.3f', microtime(true) - $st1);
            echo("<h4>The test took $fetchTime seconds to complete.</h4>");
        echo('</div>');
    echo('</div>');
}

ob_start();
    prepare_databases('instance_tests');
    
    echo('<div class="test-wrapper" style="display:table;margin-left:auto;margin-right:auto;text-align:left">');
        echo('<h1 class="header">INSTANCE TESTS</h1>');
        echo('<div id="instance-tests" class="closed">');
            echo('<h2 class="header"><a href="javascript:toggle_main_state(\'instance-tests\')">BASIC COBRA INSTANTIATION TESTS</a></h2>');
            echo('<div class="container">');
                echo('<p class="explain"></p>');
            
                $start = microtime(true);
                
                instance_run_tests();
                
                echo('<h5>The entire set of tests took '. sprintf('%01.3f', microtime(true) - $start) . ' seconds to complete.</h5>');
                
            echo('</div>');
        echo('</div>');
    echo('</div>');
$buffer = ob_get_clean();
die($buffer);
?>
