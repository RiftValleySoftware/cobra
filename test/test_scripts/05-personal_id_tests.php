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
    
// -------------------------------------- TEST DISPATCHER ------------------------------------------

function personal_id_run_basic_tests() {
    personal_id_run_test(64, 'PASS- BASIC LOG IN AND CHECK (NO IDs)', 'Sign in as the \'King Cobra\' Admin, and check for no personal IDs.', 'king-cobra', NULL, 'CoreysGoryStory');
    personal_id_run_test(65, 'PASS- BASIC LOG IN AND CHECK', 'Sign in as the \'Asp\' Admin, and check for one personal ID.', 'asp', NULL, 'CoreysGoryStory');
    personal_id_run_test(66, 'PASS- BASIC CREATE NO INITIAL IDS', 'Sign in as the God Admin, Create A new login, and assign it no new personal IDs.', 'admin', NULL, CO_Config::god_mode_password());
    personal_id_run_test(67, 'PASS- BASIC CREATE ONE INITIAL ID', 'Sign in as the \'Asp\' Admin, Create A new login, and assign it 1 new personal ID.', 'asp', NULL, 'CoreysGoryStory');
    personal_id_run_test(68, 'PASS- BASIC CREATE FIVE INITIAL IDS', 'Sign in as the \'duke\' Admin, Create A new login, and assign it 5 new personal IDs.', 'duke', NULL, 'CoreysGoryStory');
    personal_id_run_test(69, 'PASS- BASIC CREATE ONE THOUSAND INITIAL IDS', 'Sign in as the \'Emperor\' Admin, Create A new login, and assign it 1,000 new personal IDs.', 'emperor', NULL, 'CoreysGoryStory');
}

// ------------------------------------------ TESTS ------------------------------------------------

function personal_id_test_64($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        $cobra_login_instance = $cobra_instance->get_chameleon_instance()->get_login_item();
        if (isset($cobra_login_instance) && ($cobra_login_instance instanceof CO_Cobra_Login)) {
            echo("<h2 style=\"color:green;font-weight:bold\">The Login instance is valid!</h2>");
            hierarchicalDisplayRecord($cobra_login_instance);
        } else {
            echo("<h2 style=\"color:red;font-weight:bold\">The User instance is not valid!</h2>");
            echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$cobra_instance->error->error_code.') '.$cobra_instance->error->error_name.' ('.$cobra_instance->error->error_description.')</p>');
        }
    }
}

function personal_id_test_65($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    personal_id_test_64($in_login, $in_hashed_password, $in_password);
}

function personal_id_test_66($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        $cobra_login_instance = $cobra_instance->create_new_standard_login('forrest_gump', 'CoreysGoryStory');
        if (isset($cobra_login_instance) && ($cobra_login_instance instanceof CO_Cobra_Login)) {
            echo("<h2 style=\"color:green;font-weight:bold\">The Login instance is valid!</h2>");
            $god_access_instance = new CO_Access('admin', NULL, CO_Config::god_mode_password());
            $test_record = $god_access_instance->get_single_security_record_by_id($cobra_login_instance->id());
            hierarchicalDisplayRecord($test_record);
        } else {
            echo("<h2 style=\"color:red;font-weight:bold\">The User instance is not valid!</h2>");
            echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$cobra_instance->error->error_code.') '.$cobra_instance->error->error_name.' ('.$cobra_instance->error->error_description.')</p>');
        }
    }
}

function personal_id_test_67($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        $cobra_login_instance = $cobra_instance->create_new_standard_login('bubba', 'CoreysGoryStory', 1);
        if (isset($cobra_login_instance) && ($cobra_login_instance instanceof CO_Cobra_Login)) {
            echo("<h2 style=\"color:green;font-weight:bold\">The Login instance is valid!</h2>");
            $god_access_instance = new CO_Access('admin', NULL, CO_Config::god_mode_password());
            $test_record = $god_access_instance->get_single_security_record_by_id($cobra_login_instance->id());
            hierarchicalDisplayRecord($test_record);
        } else {
            echo("<h2 style=\"color:red;font-weight:bold\">The User instance is not valid!</h2>");
            echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$cobra_instance->error->error_code.') '.$cobra_instance->error->error_name.' ('.$cobra_instance->error->error_description.')</p>');
        }
    }
}

function personal_id_test_68($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        $cobra_login_instance = $cobra_instance->create_new_standard_login('lt_dan', 'CoreysGoryStory', 5);
        if (isset($cobra_login_instance) && ($cobra_login_instance instanceof CO_Cobra_Login)) {
            echo("<h2 style=\"color:green;font-weight:bold\">The Login instance is valid!</h2>");
            $god_access_instance = new CO_Access('admin', NULL, CO_Config::god_mode_password());
            $test_record = $god_access_instance->get_single_security_record_by_id($cobra_login_instance->id());
            hierarchicalDisplayRecord($test_record);
        } else {
            echo("<h2 style=\"color:red;font-weight:bold\">The User instance is not valid!</h2>");
            echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$cobra_instance->error->error_code.') '.$cobra_instance->error->error_name.' ('.$cobra_instance->error->error_description.')</p>');
        }
    }
}

function personal_id_test_69($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        $cobra_login_instance = $cobra_instance->create_new_standard_login('chocolates', 'CoreysGoryStory', 1000);
        if (isset($cobra_login_instance) && ($cobra_login_instance instanceof CO_Cobra_Login)) {
            echo("<h2 style=\"color:green;font-weight:bold\">The Login instance is valid!</h2>");
            $god_access_instance = new CO_Access('admin', NULL, CO_Config::god_mode_password());
            $test_record = $god_access_instance->get_single_security_record_by_id($cobra_login_instance->id());
            hierarchicalDisplayRecord($test_record);
        } else {
            echo("<h2 style=\"color:red;font-weight:bold\">The User instance is not valid!</h2>");
            echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$cobra_instance->error->error_code.') '.$cobra_instance->error->error_name.' ('.$cobra_instance->error->error_description.')</p>');
        }
    }
}

// ----------------------------------------- STRUCTURE ---------------------------------------------

function personal_id_run_test($in_num, $in_title, $in_explain, $in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $test_num_string = sprintf("%03d", $in_num);
    echo('<div id="test-'.$test_num_string.'" class="inner_closed">');
        echo('<h3 class="inner_header"><a href="javascript:toggle_inner_state(\'test-'.$test_num_string.'\')">TEST '.$in_num.': '.$in_title.'</a></h3>');
        echo('<div class="main_div inner_container">');
            echo('<div class="main_div" style="margin-right:2em">');
                echo('<p class="explain">'.$in_explain.'</p>');
            echo('</div>');
            $st1 = microtime(true);
            $function_name = sprintf('personal_id_test_%02d', $in_num);
            $function_name($in_login, $in_hashed_password, $in_password);
            $fetchTime = sprintf('%01.3f', microtime(true) - $st1);
            echo("<h4>The test took $fetchTime seconds to complete.</h4>");
        echo('</div>');
    echo('</div>');
}

ob_start();
    prepare_databases('security_tests');
    
    echo('<div class="test-wrapper" style="display:table;margin-left:auto;margin-right:auto;text-align:left">');
        echo('<h1 class="header">PERSONAL TOKEN TESTS</h1>');
        echo('<div id="personal_id-tests" class="closed">');
            echo('<h2 class="header"><a href="javascript:toggle_main_state(\'personal_id-tests\')">BASIC TESTS</a></h2>');
            echo('<div class="container">');
                echo('<p class="explain"></p>');
            
                $start = microtime(true);
                
                personal_id_run_basic_tests();
                
                echo('<h5>The entire set of tests took '. sprintf('%01.3f', microtime(true) - $start) . ' seconds to complete.</h5>');
                
            echo('</div>');
        echo('</div>');
    echo('</div>');
$buffer = ob_get_clean();
die($buffer);
?>
