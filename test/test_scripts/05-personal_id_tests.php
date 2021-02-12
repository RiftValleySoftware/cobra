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

global $global_num_ids;

$global_num_ids = 50;

// -------------------------------------- TEST DISPATCHER ------------------------------------------

function personal_id_run_basic_tests() {
    personal_id_run_test(64, 'PASS- BASIC LOG IN AND CHECK (NO IDs)', 'Sign in as the \'King Cobra\' Admin, and check for no personal IDs.', 'king-cobra', NULL, 'CoreysGoryStory');
    personal_id_run_test(65, 'PASS- BASIC LOG IN AND CHECK', 'Sign in as the \'Asp\' Admin, and check for one personal ID.', 'asp', NULL, 'CoreysGoryStory');
    personal_id_run_test(66, 'PASS- BASIC CREATE NO INITIAL IDS', 'Sign in as the God Admin, Create A new login, and assign it no new personal IDs.', 'admin', NULL, CO_Config::god_mode_password());
    personal_id_run_test(67, 'PASS- BASIC CREATE ONE INITIAL ID', 'Sign in as the \'Asp\' Admin, Create A new login, and assign it 1 new personal ID.', 'asp', NULL, 'CoreysGoryStory');
    personal_id_run_test(68, 'PASS- BASIC CREATE FIVE INITIAL IDS', 'Sign in as the \'duke\' Admin, Create A new login, and assign it 5 new personal IDs.', 'duke', NULL, 'CoreysGoryStory');
    personal_id_run_test(69, 'PASS- BASIC CREATE ONE THOUSAND INITIAL IDS', 'Sign in as the \'Emperor\' Admin, Create A new login, and assign it 1,000 new personal IDs.', 'emperor', NULL, 'CoreysGoryStory');
}
    
// -------------------------------------- TEST DISPATCHER ------------------------------------------

function personal_id_run_advanced_tests() {
    global $global_num_ids;
    personal_id_run_test(70, 'PASS- CREATE AND CHECK '.$global_num_ids.' RANDOM IDS', 'Sign in as the \'Asp\' Admin, create IDs at random, with random numbers of personal IDs, then ensure that the IDs and types match.', 'asp', NULL, 'CoreysGoryStory');
}

// --------------------------------------- BASIC TESTS ---------------------------------------------

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

// --------------------------------------- ADVANCED TESTS ------------------------------------------

function personal_id_test_70($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    global $global_num_ids;

    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    $god_access_instance = new CO_Access('admin', NULL, CO_Config::god_mode_password());
    
    $tracker = [];
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        set_time_limit ( max(30, intval($global_num_ids) * 2) );
    
        for ($index = 0; $index < $global_num_ids; $index++) {
            $is_manager = rand(0, 1);
            $num_personal_ids = intval(rand(0, 200));
            $login_id = ($is_manager ? "manager" : "user")."_".strval($index);
            $tracker[] = ['login_id' => $login_id, 'is_manager' => $is_manager, 'num_personal_ids' => $num_personal_ids];
            make_one_user($cobra_instance, $login_id, $is_manager, $num_personal_ids);
        }
        
        if (is_array($tracker) && count($tracker)) {
            $pass = true;
            foreach ($tracker as $track) {
                $pass = $pass || examine_one_user($god_access_instance, $track);
            }
            
            echo('<div id="personal_id-tests-advanced-results" class="closed">');
                if ($pass) {
                    echo('<h4 class="header"><a href="javascript:toggle_main_state(\'personal_id-tests-advanced-results\')"><span style="color:green">TEST PASSES</span></a></h4>');
                } else {
                    echo('<h4 class="header"><a href="javascript:toggle_main_state(\'personal_id-tests-advanced-results\')"><span style="color:red">TEST FAILS</span></a></h4>');
                }
                echo('<div class="container">');
                    foreach ($tracker as $track) {
                        display_one_user($god_access_instance, $track);
                    }
                echo('</div>');
            echo('</div>');
        } else {
            echo("<h2 style=\"color:red;font-weight:bold\">Failed to Create Users!</h2>");
        }
        
        set_time_limit ( 30 );
    }
}

function make_one_user($in_cobra_instance, $in_user_id, $in_is_manager, $in_number_of_personal_ids) {
    $cobra_login_instance = NULL;
    
    if ($in_is_manager) {
        $cobra_login_instance = $in_cobra_instance->create_new_manager_login($in_user_id, 'CoreysGoryStory', $in_number_of_personal_ids);
    } else {
        $cobra_login_instance = $in_cobra_instance->create_new_standard_login($in_user_id, 'CoreysGoryStory', $in_number_of_personal_ids);
    }
    
    if (!isset($cobra_login_instance) || (!($cobra_login_instance instanceof CO_Cobra_Login) && !($cobra_login_instance instanceof CO_Cobra_Login_Manager))) {
        echo("<h4 style=\"color:red;font-weight:bold\">The User instance is not valid!</h4>");
        echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$in_cobra_instance->error->error_code.') '.$in_cobra_instance->error->error_name.' ('.$in_cobra_instance->error->error_description.')</p>');
        $cobra_login_instance = NULL;
    }
    
    return $cobra_login_instance;
}

function examine_one_user($in_god_access_instance, $in_tracker) {
    $test_record = $in_god_access_instance->get_login_item_by_login_string($in_tracker['login_id']);
    if (isset($test_record) && ($test_record instanceof CO_Cobra_Login)) {
        $personal_ids = $test_record->personal_ids();
        if (!is_array($personal_ids) || (count($personal_ids) != $in_tracker['num_personal_ids'])) {
            echo("<h4 style=\"color:red;font-weight:bold\">The number of personal IDs for ".$in_tracker['login_id']." is invalid!</h4>");
        } else {
            if ($in_tracker['is_manager'] && ($test_record instanceof CO_Login_Manager)) {
                return true;
            } else {
                echo("<h4 style=\"color:red;font-weight:bold\">".$in_tracker['login_id']." should be a manager!</h4>");
            }
        }
    } else {
        echo("<h4 style=\"color:red;font-weight:bold\">The User instance is not valid!</h4>");
        echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$cobra_instance->error->error_code.') '.$cobra_instance->error->error_name.' ('.$cobra_instance->error->error_description.')</p>');
    }
    
    return false;
}

function display_one_user($in_god_access_instance, $in_tracker) {
    $test_record = $in_god_access_instance->get_login_item_by_login_string($in_tracker['login_id']);
    hierarchicalDisplayRecord($test_record);
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
        echo('<div id="personal_id-tests-basic" class="closed">');
            echo('<h2 class="header"><a href="javascript:toggle_main_state(\'personal_id-tests-basic\')">BASIC TESTS</a></h2>');
            echo('<div class="container">');
                echo('<p class="explain"></p>');
            
                $start = microtime(true);
                
                personal_id_run_basic_tests();
                
                echo('<h5>The entire set of tests took '. sprintf('%01.3f', microtime(true) - $start) . ' seconds to complete.</h5>');
                
            echo('</div>');
        echo('</div>');
        
        echo('<div id="personal_id-tests-advanced" class="closed">');
            echo('<h2 class="header"><a href="javascript:toggle_main_state(\'personal_id-tests-advanced\')">ADVANCED TESTS</a></h2>');
            echo('<div class="container">');
                echo('<p class="explain"></p>');
            
                $start = microtime(true);
                
                personal_id_run_advanced_tests();
                
                echo('<h5>The entire set of tests took '. sprintf('%01.3f', microtime(true) - $start) . ' seconds to complete.</h5>');
                
            echo('</div>');
        echo('</div>');
    echo('</div>');
$buffer = ob_get_clean();
die($buffer);
?>
