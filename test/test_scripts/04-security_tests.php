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

function security_run_tests_1() {
    security_run_test(54, 'PASS -ID Visibility (God)', 'We log in as \'God\', and look at the \'emperor\' login. We examine the security IDs, and look at all its IDs.', 'admin', NULL, CO_Config::$god_mode_password);
    security_run_test(55, 'PASS -ID Visibility (king-cobra)', 'We log in as \'king-cobra\', and look at the \'emperor\' login. We examine the security IDs, and make sure that we only see the ones we\'re cleared to see.', 'king-cobra', NULL, 'CoreysGoryStory');
    security_run_test(56, 'PASS -ID Visibility (duke)', 'We log in as \'duke\', and look at the \'emperor\' login. We examine the security IDs, and make sure that we only see the ones we\'re cleared to see.', 'duke', NULL, 'CoreysGoryStory');
    security_run_test(57, 'FAIL -Login Visibility (asp)', 'We log in as \'asp\', and try to look at the \'emperor\' login. We expect this to fail, as \'asp\' is not cleared to view \'emperor\'.', 'asp', NULL, 'CoreysGoryStory');
    security_run_test(58, 'FAIL -Login Visibility (krait)', 'We log in as \'krait\', and try to look directly at the \'emperor\' login. We expect this to fail, as \'krait\' is not a manager object.', 'krait', NULL, 'CoreysGoryStory');
    security_run_test(59, 'PASS -Create New Security ID', 'We log in as \'asp\', and create a new security token.', 'asp', NULL, 'CoreysGoryStory');
    security_run_test(60, 'FAIL -Create New Security ID', 'We log in as \'krait\', and try to create a new security token. We shouldn\'t even be able to get in the front door.', 'krait', NULL, 'CoreysGoryStory');
    security_run_test(61, 'PASS -Create New Security ID', 'We log in as \'God\', and create a new security token.', 'admin', NULL, CO_Config::$god_mode_password);
    security_run_test(62, 'FAIL -Delete Security ID', 'We log in as \'asp\', and try to delete a security token. It should fail on the last step', 'asp', NULL, 'CoreysGoryStory');
    security_run_test(63, 'PASS -Delete Security ID', 'We log in as \'God\', and try to delete a security token. This time, it should work.', 'admin', NULL, CO_Config::$god_mode_password);
}

// ------------------------------------------ TESTS ------------------------------------------------

function security_test_54($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $palpatine = $chameleon_instance->get_login_item_by_login_string('emperor');
    if (isset($palpatine) && ($palpatine instanceof CO_Security_Login)) {
        hierarchicalDisplayRecord($palpatine);
    } else {
        echo('<h3 style="color:red">Unable to see the \'emperor\' login!</h3>');
    }
}

function security_test_55($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    security_test_54($in_login, $in_hashed_password, $in_password);
}

function security_test_56($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    security_test_54($in_login, $in_hashed_password, $in_password);
}

function security_test_57($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    security_test_54($in_login, $in_hashed_password, $in_password);
}

function security_test_58($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    security_test_54($in_login, $in_hashed_password, $in_password);
}

function security_test_59($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    if (isset($chameleon_instance) && ($chameleon_instance instanceof CO_Chameleon)) {
        $cobra_instance = make_cobra($chameleon_instance);
        if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
            $new_security_token_id = $cobra_instance->make_security_token();
            
            if ($new_security_token_id) {
                echo('<h3 style="color:green">The new security token ID is '.$new_security_token_id.'</h3>');
            } else {
                echo('<h3 style="color:red">Unable to create the security token!</h3>');
                echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$cobra_instance->error->error_code.') '.$cobra_instance->error->error_name.' ('.$cobra_instance->error->error_description.')</p>');
            }
        } else {
            echo('<h3 style="color:red">Unable to create the COBRA instance!</h3>');
        }
    } else {
        echo('<h3 style="color:red">Unable to create the CHAMELEON instance!</h3>');
    }
}

function security_test_60($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    security_test_59($in_login, $in_hashed_password, $in_password);
}

function security_test_61($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    security_test_59($in_login, $in_hashed_password, $in_password);
}

function security_test_62($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    if (isset($chameleon_instance) && ($chameleon_instance instanceof CO_Chameleon)) {
        $cobra_instance = make_cobra($chameleon_instance);
        if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
            $security_token = $chameleon_instance->get_single_security_record_by_id(14);
            
            if (isset($security_token) && ($security_token instanceof CO_Security_ID)) {
                echo('<h3 style="color:green">We could read the security token.</h3>');
                if ($security_token->delete_from_db()) {
                    echo('<h3 style="color:green">We successfully deleted Security Token 14!</h3>');
                } else {
                    echo('<h3 style="color:red">We couldn\'t delete Security Token 14!</h3>');
                }
            } else {
                echo('<h3 style="color:red">ERROR! Can\'t get the security token! That\'s not good!</h3>');
            }
        } else {
            echo('<h3 style="color:red">Unable to create the COBRA instance!</h3>');
        }
    } else {
        echo('<h3 style="color:red">Unable to create the CHAMELEON instance!</h3>');
    }
}

function security_test_63($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    security_test_62($in_login, $in_hashed_password, $in_password);
}

// ----------------------------------------- STRUCTURE ---------------------------------------------

function security_run_test($in_num, $in_title, $in_explain, $in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $test_num_string = sprintf("%03d", $in_num);
    echo('<div id="test-'.$test_num_string.'" class="inner_closed">');
        echo('<h3 class="inner_header"><a href="javascript:toggle_inner_state(\'test-'.$test_num_string.'\')">TEST '.$in_num.': '.$in_title.'</a></h3>');
        echo('<div class="main_div inner_container">');
            echo('<div class="main_div" style="margin-right:2em">');
                echo('<p class="explain">'.$in_explain.'</p>');
            echo('</div>');
            $st1 = microtime(TRUE);
            $function_name = sprintf('security_test_%02d', $in_num);
            $function_name($in_login, $in_hashed_password, $in_password);
            $fetchTime = sprintf('%01.3f', microtime(TRUE) - $st1);
            echo("<h4>The test took $fetchTime seconds to complete.</h4>");
        echo('</div>');
    echo('</div>');
}

ob_start();
    prepare_databases('security_tests');
    
    echo('<div class="test-wrapper" style="display:table;margin-left:auto;margin-right:auto;text-align:left">');
        echo('<h1 class="header">SECURITY TESTS</h1>');
        echo('<div id="security-tests" class="closed">');
            echo('<h2 class="header"><a href="javascript:toggle_main_state(\'security-tests\')">COBRA SECURITY TESTS</a></h2>');
            echo('<div class="container">');
                echo('<p class="explain"></p>');
            
                $start = microtime(TRUE);
                
                security_run_tests_1();
                
                echo('<h5>The entire set of tests took '. sprintf('%01.3f', microtime(TRUE) - $start) . ' seconds to complete.</h5>');
                
            echo('</div>');
        echo('</div>');
    echo('</div>');
$buffer = ob_get_clean();
die($buffer);
?>
