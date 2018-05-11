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
