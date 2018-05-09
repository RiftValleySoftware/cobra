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

function analysis_run_tests() {
    analysis_run_test(29, 'PASS: Get Logins \'king-cobra\' Can See', '', 'king-cobra', NULL, 'CoreysGoryStory');
    analysis_run_test(30, 'PASS: Get Logins \'asp\' Can See', '', 'asp', NULL, 'CoreysGoryStory');
    analysis_run_test(31, 'PASS: Get Logins The God Admin Can See', '', 'admin', NULL, CO_Config::$god_mode_password);
    analysis_run_test(32, 'PASS: Get Logins \'king-cobra\' Can See (When Logged In As God)', '', 'admin', NULL, CO_Config::$god_mode_password);
    analysis_run_test(33, 'PASS: Get Logins \'asp\' Can See (When Logged In As God)', '', 'admin', NULL, CO_Config::$god_mode_password);
    analysis_run_test(34, 'PASS: Get Logins \'king-cobra\' Can Modify', '', 'king-cobra', NULL, 'CoreysGoryStory');
    analysis_run_test(35, 'PASS: Get Logins \'asp\' Can Modify', '', 'asp', NULL, 'CoreysGoryStory');
    analysis_run_test(36, 'PASS: Get Logins The God Admin Can Modify', '', 'admin', NULL, CO_Config::$god_mode_password);
    analysis_run_test(37, 'PASS: Get Logins \'king-cobra\' Can Modify (When Logged In As God)', '', 'admin', NULL, CO_Config::$god_mode_password);
    analysis_run_test(38, 'PASS: Get Logins \'asp\' Can Modify (When Logged In As God)', '', 'admin', NULL, CO_Config::$god_mode_password);
    analysis_run_test(39, 'PASS: Get Logins \'cobra\' Can See', '', 'cobra', NULL, 'CoreysGoryStory');
    analysis_run_test(40, 'PASS: Get Logins \'cobra\' Can Modify', '', 'cobra', NULL, 'CoreysGoryStory');
    analysis_run_test(41, 'PASS: Get Logins \'cobra\' Can See (When Logged In As God)', '', 'admin', NULL, CO_Config::$god_mode_password);
}

// ------------------------------------------ TESTS ------------------------------------------------

function analysis_test_29($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        $visible_logins = $cobra_instance->get_all_logins();
        
        if (isset($visible_logins) && is_array($visible_logins) && count($visible_logins)) {
            foreach ($visible_logins as $record) {
                hierarchicalDisplayRecord($record);
            }
        }
    }
}

function analysis_test_30($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    analysis_test_29($in_login, $in_hashed_password, $in_password);
}

function analysis_test_31($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    analysis_test_29($in_login, $in_hashed_password, $in_password);
}

function analysis_test_32($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        $visible_logins = $cobra_instance->get_all_logins('king-cobra');
        
        if (isset($visible_logins) && is_array($visible_logins) && count($visible_logins)) {
            foreach ($visible_logins as $record) {
                hierarchicalDisplayRecord($record);
            }
        }
    }
}

function analysis_test_33($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        $visible_logins = $cobra_instance->get_all_logins('asp');
        
        if (isset($visible_logins) && is_array($visible_logins) && count($visible_logins)) {
            foreach ($visible_logins as $record) {
                hierarchicalDisplayRecord($record);
            }
        }
    }
}

function analysis_test_34($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        $visible_logins = $cobra_instance->get_all_logins(NULL, true);
        
        if (isset($visible_logins) && is_array($visible_logins) && count($visible_logins)) {
            foreach ($visible_logins as $record) {
                hierarchicalDisplayRecord($record);
            }
        }
    }
}

function analysis_test_35($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    analysis_test_34($in_login, $in_hashed_password, $in_password);
}

function analysis_test_36($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    analysis_test_34($in_login, $in_hashed_password, $in_password);
}

function analysis_test_37($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        $visible_logins = $cobra_instance->get_all_logins('king-cobra', true);
        
        if (isset($visible_logins) && is_array($visible_logins) && count($visible_logins)) {
            foreach ($visible_logins as $record) {
                hierarchicalDisplayRecord($record);
            }
        }
    }
}

function analysis_test_38($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        $visible_logins = $cobra_instance->get_all_logins('asp', true);
        
        if (isset($visible_logins) && is_array($visible_logins) && count($visible_logins)) {
            foreach ($visible_logins as $record) {
                hierarchicalDisplayRecord($record);
            }
        }
    }
}

function analysis_test_39($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    analysis_test_29($in_login, $in_hashed_password, $in_password);
}

function analysis_test_40($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    analysis_test_34($in_login, $in_hashed_password, $in_password);
}

function analysis_test_41($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        $visible_logins = $cobra_instance->get_all_logins('cobra');
        
        if (isset($visible_logins) && is_array($visible_logins) && count($visible_logins)) {
            foreach ($visible_logins as $record) {
                hierarchicalDisplayRecord($record);
            }
        }
    }
}

// ----------------------------------------- STRUCTURE ---------------------------------------------

function analysis_run_test($in_num, $in_title, $in_explain, $in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $test_num_string = sprintf("%03d", $in_num);
    echo('<div id="test-'.$test_num_string.'" class="inner_closed">');
        echo('<h3 class="inner_header"><a href="javascript:toggle_inner_state(\'test-'.$test_num_string.'\')">TEST '.$in_num.': '.$in_title.'</a></h3>');
        echo('<div class="main_div inner_container">');
            echo('<div class="main_div" style="margin-right:2em">');
                echo('<p class="explain">'.$in_explain.'</p>');
            echo('</div>');
            $st1 = microtime(TRUE);
            $function_name = sprintf('analysis_test_%02d', $in_num);
            $function_name($in_login, $in_hashed_password, $in_password);
            $fetchTime = sprintf('%01.3f', microtime(TRUE) - $st1);
            echo("<h4>The test took $fetchTime seconds to complete.</h4>");
        echo('</div>');
    echo('</div>');
}

ob_start();
    prepare_databases('instance_tests');
    
    echo('<div class="test-wrapper" style="display:table;margin-left:auto;margin-right:auto;text-align:left">');
        echo('<h1 class="header">ANALYSIS TOOLS TESTS</h1>');
        echo('<div id="edit-tests" class="closed">');
            echo('<h2 class="header"><a href="javascript:toggle_main_state(\'edit-tests\')">COBRA LOGIN ANALYSIS TESTS</a></h2>');
            echo('<div class="container">');
                echo('<p class="explain">In these tests, we check which logins various users can see.</p>');
            
                $start = microtime(TRUE);
                
                analysis_run_tests();
                
                echo('<h5>The entire set of tests took '. sprintf('%01.3f', microtime(TRUE) - $start) . ' seconds to complete.</h5>');
                
            echo('</div>');
        echo('</div>');
    echo('</div>');
$buffer = ob_get_clean();
die($buffer);
?>
