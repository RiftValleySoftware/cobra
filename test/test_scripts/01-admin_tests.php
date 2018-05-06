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
    
// -------------------------------- TEST DISPATCHER ---------------------------------------------

function run_tests() {
    run_test(1, 'Invalid Valid Big Lizard, but Invalid Direct Instantiation Test', 'We have a valid, manager-user-logged-in CHAMELEON, but try to directly instantiate a COBRA instance, which should fail.', 'king-cobra', NULL, 'CoreysGoryStory');
    run_test(2, 'Invalid Bad Lizard Test', 'We just create a COBRA instance, give it an invalid CHAMELEON, and make sure it is NOT valid.', NULL, NULL, NULL);
    run_test(3, 'Invalid Lizard Test', 'We just create a COBRA instance, give it a valid, not-even-attempted-logged-in CHAMELEON, and make sure it is NOT valid.', NULL, NULL, NULL);
    run_test(4, 'Invalid Errored Lizard Test', 'We just create a COBRA instance, give it a valid, mistake-so-not-logged-in CHAMELEON, and make sure it is NOT valid.', 'norm', NULL, 'OOPSIE');
    run_test(5, 'Invalid Weed Lizard Test', 'We just create a COBRA instance, give it a valid, non-cobra-level-user-logged-in CHAMELEON, and make sure it is NOT valid.', 'norm', 'CodYOzPtwxb4A', NULL);
    run_test(6, 'Invalid Garden-Variety Lizard Test', 'We just create a COBRA instance, give it a valid, standard-user-logged-in CHAMELEON, and make sure it is NOT valid.', 'krait', 'CodYOzPtwxb4A', NULL);
    run_test(7, 'Valid Big Lizard Test', 'We just create a COBRA instance, give it a valid, manager-user-logged-in CHAMELEON, and make sure it is valid.', 'king-cobra', NULL, 'CoreysGoryStory');
    run_test(8, 'Valid God Lizard Test', 'We just create a COBRA instance, give it a valid, God-logged-in CHAMELEON, and make sure it is valid.', 'admin', NULL, CO_Config::$god_mode_password);
}

// -------------------------------- TESTS ---------------------------------------------

function admin_test_01($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    try {
        $cobra_instance = new CO_Cobra($chameleon_instance);
    } catch (Error $e) {
        echo("<h2 style=\"color:red;font-weight:bold\">The COBRA instance is not valid!</h2>");
    }
}

function admin_test_02($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $cobra_instance = make_cobra('BUBBA');
}

function admin_test_03($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon();
    $cobra_instance = make_cobra($chameleon_instance);
}

function admin_test_04($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
}

function admin_test_05($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
}

function admin_test_06($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
}

function admin_test_07($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
}

function admin_test_08($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
}

// -------------------------------- STRUCTURE ---------------------------------------------

function run_test($in_num, $in_title, $in_explain, $in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $test_num_string = sprintf("%03d", $in_num);
    echo('<div id="test-'.$test_num_string.'" class="inner_closed">');
        echo('<h3 class="inner_header"><a href="javascript:toggle_inner_state(\'test-'.$test_num_string.'\')">TEST '.$in_num.': '.$in_title.'</a></h3>');
        echo('<div class="main_div inner_container">');
            echo('<div class="main_div" style="margin-right:2em">');
                echo('<p class="explain">'.$in_explain.'</p>');
            echo('</div>');
            $st1 = microtime(TRUE);
            $function_name = sprintf('admin_test_%02d', $in_num);
            $function_name($in_login, $in_hashed_password, $in_password);
            $fetchTime = sprintf('%01.3f', microtime(TRUE) - $st1);
            echo("<h4>The test took $fetchTime seconds to complete.</h4>");
        echo('</div>');
    echo('</div>');
}

ob_start();
    prepare_databases('admin_tests');
    
    echo('<div class="test-wrapper" style="display:table;margin-left:auto;margin-right:auto;text-align:left">');
        echo('<h1 class="header">ADMIN TESTS</h1>');
        echo('<div id="instance-tests" class="closed">');
            echo('<h2 class="header"><a href="javascript:toggle_main_state(\'instance-tests\')">BASIC COBRA INSTANTIATION TESTS</a></h2>');
            echo('<div class="container">');
                echo('<p class="explain"></p>');
            
                $start = microtime(TRUE);
                
                run_tests();
                
                echo('<h5>The entire set of tests took '. sprintf('%01.3f', microtime(TRUE) - $start) . ' seconds to complete.</h5>');
                
            echo('</div>');
        echo('</div>');
    echo('</div>');
$buffer = ob_get_clean();
die($buffer);
?>
