<?php
/***************************************************************************************************************************/
/**
    COBRA Security Administration Layer
    
    © Copyright 2018, Little Green Viper Software Development LLC.
    
    This code is proprietary and confidential code, 
    It is NOT to be reused or combined into any application,
    unless done so, specifically under written license from Little Green Viper Software Development LLC.

    Little Green Viper Software Development: https://littlegreenviper.com
*/
require_once(dirname(dirname(__FILE__)).'/functions.php');
    
// -------------------------------------- TEST DISPATCHER ------------------------------------------

function create_run_tests() {
    create_run_test(9, 'FAIL -Create User From COBRA', 'We log in and instantiate CHAMELEON as a manager, then attempt to create a new user from a login we can\'t see.', 'king-cobra', NULL, 'CoreysGoryStory');
    create_run_test(10, 'PASS -Create User From COBRA', 'We log in and instantiate CHAMELEON as a manager, then attempt to create a new user from a login we can see.', 'asp', NULL, 'CoreysGoryStory');
    create_run_test(11, 'PASS -Get Created User From COBRA', 'We log in and instantiate CHAMELEON as a manager, then attempt to see a new user from a login we can\'t see, but that exists.', 'king-cobra', NULL, 'CoreysGoryStory');
    create_run_test(12, 'FAIL -Get Created User From COBRA', 'We log in and instantiate CHAMELEON as a manager, then attempt to see the same user; however, this time, we set the user to have an access the manager can\'t see, so it will attempt to create it.', 'asp', NULL, 'CoreysGoryStory');
}

// ------------------------------------------ TESTS ------------------------------------------------

function create_test_09($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        $cobra_user_instance = $cobra_instance->get_user_from_login(5, true);

        if (isset($cobra_user_instance) && ($cobra_user_instance instanceof CO_Cobra_Login)) {
            echo("<h2 style=\"color:green;font-weight:bold\">The User instance is valid!</h2>");
        } else {
            echo("<h2 style=\"color:red;font-weight:bold\">The User instance is not valid!</h2>");
            echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$cobra_instance->error->error_code.') '.$cobra_instance->error->error_name.' ('.$cobra_instance->error->error_description.')</p>');
        }
    }
}

function create_test_10($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        $cobra_user_instance = $cobra_instance->get_user_from_login(5, true);

        if (isset($cobra_user_instance) && ($cobra_user_instance instanceof CO_User_Collection)) {
            echo("<h2 style=\"color:green;font-weight:bold\">The User instance is valid!</h2>");
        } else {
            echo("<h2 style=\"color:red;font-weight:bold\">The User instance is not valid!</h2>");
            echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$cobra_instance->error->error_code.') '.$cobra_instance->error->error_name.' ('.$cobra_instance->error->error_description.')</p>');
        }
    }
}

function create_test_11($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        $cobra_user_instance = $cobra_instance->get_user_from_login(5, true);

        if (isset($cobra_user_instance) && ($cobra_user_instance instanceof CO_User_Collection)) {
            echo("<h2 style=\"color:green;font-weight:bold\">The User instance is valid!</h2>");
        } else {
            echo("<h2 style=\"color:red;font-weight:bold\">The User instance is not valid!</h2>");
            echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$cobra_instance->error->error_code.') '.$cobra_instance->error->error_name.' ('.$cobra_instance->error->error_description.')</p>');
        }
    }
}

function create_test_12($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon('admin', '', CO_Config::$god_mode_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        $cobra_user_instance = $cobra_instance->get_user_from_login(5);
        $cobra_user_instance->set_read_security_id(6);
    }
    
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        $cobra_user_instance = $cobra_instance->get_user_from_login(5, true);

        if (isset($cobra_user_instance) && ($cobra_user_instance instanceof CO_User_Collection)) {
            echo("<h2 style=\"color:green;font-weight:bold\">The User instance is valid!</h2>");
        } else {
            echo("<h2 style=\"color:red;font-weight:bold\">The User instance is not valid!</h2>");
            echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$cobra_instance->error->error_code.') '.$cobra_instance->error->error_name.' ('.$cobra_instance->error->error_description.')</p>');
        }
    }
}

// ----------------------------------------- STRUCTURE ---------------------------------------------

function create_run_test($in_num, $in_title, $in_explain, $in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $test_num_string = sprintf("%03d", $in_num);
    echo('<div id="test-'.$test_num_string.'" class="inner_closed">');
        echo('<h3 class="inner_header"><a href="javascript:toggle_inner_state(\'test-'.$test_num_string.'\')">TEST '.$in_num.': '.$in_title.'</a></h3>');
        echo('<div class="main_div inner_container">');
            echo('<div class="main_div" style="margin-right:2em">');
                echo('<p class="explain">'.$in_explain.'</p>');
            echo('</div>');
            $st1 = microtime(TRUE);
            $function_name = sprintf('create_test_%02d', $in_num);
            $function_name($in_login, $in_hashed_password, $in_password);
            $fetchTime = sprintf('%01.3f', microtime(TRUE) - $st1);
            echo("<h4>The test took $fetchTime seconds to complete.</h4>");
        echo('</div>');
    echo('</div>');
}

ob_start();
    prepare_databases('instance_tests');
    
    echo('<div class="test-wrapper" style="display:table;margin-left:auto;margin-right:auto;text-align:left">');
        echo('<h1 class="header">CREATE USER TESTS</h1>');
        echo('<div id="create-tests" class="closed">');
            echo('<h2 class="header"><a href="javascript:toggle_main_state(\'create-tests\')">COBRA USER CREATION TESTS</a></h2>');
            echo('<div class="container">');
                echo('<p class="explain"></p>');
            
                $start = microtime(TRUE);
                
                create_run_tests();
                
                echo('<h5>The entire set of tests took '. sprintf('%01.3f', microtime(TRUE) - $start) . ' seconds to complete.</h5>');
                
            echo('</div>');
        echo('</div>');
    echo('</div>');
$buffer = ob_get_clean();
die($buffer);
?>
