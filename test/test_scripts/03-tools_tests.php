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
    analysis_run_test(29, 'PASS: Get Logins The God Admin Can See', 'We log in with the \'God\' login, and see which logins we can see (should be all of them).', 'admin', NULL, CO_Config::$god_mode_password);
    analysis_run_test(30, 'PASS: Get Logins \'king-cobra\' Can See', 'We log in with the \'king-cobra\' login, and see which logins we can see. Even though \'king-cobra\' can see 2 (the \'God\' ID), We should not be able to see the \'God\' login.', 'king-cobra', NULL, 'CoreysGoryStory');
    analysis_run_test(31, 'PASS: Get Logins \'asp\' Can See', 'We log in with the \'asp\' login, and see which logins we can see.', 'asp', NULL, 'CoreysGoryStory');
    analysis_run_test(32, 'PASS: Get Logins \'king-cobra\' Can See (When Logged In As God)', 'We log in with the \'God\' login, and check the permissions for the \'king-cobra\' manager login. We should not be able to see the \'God\' login.', 'admin', NULL, CO_Config::$god_mode_password);
    analysis_run_test(33, 'PASS: Get Logins \'asp\' Can See (When Logged In As God)', 'We log in with the \'God\' login, and check the permissions for the \'asp\' manager login.', 'admin', NULL, CO_Config::$god_mode_password);
    analysis_run_test(34, 'PASS: Get Logins The God Admin Can Modify', 'We log in with the \'God\' login, and see which logins we can modify (should be all of them).', 'admin', NULL, CO_Config::$god_mode_password);
    analysis_run_test(35, 'PASS: Get Logins \'king-cobra\' Can Modify', 'We log in with the \'king-cobra\' login, and see which logins we can see. Even though \'king-cobra\' can see 2 (the \'God\' ID), We should not be able to see the \'God\' login.', 'king-cobra', NULL, 'CoreysGoryStory');
    analysis_run_test(36, 'PASS: Get Logins \'asp\' Can Modify', 'We log in with the \'asp\' login, and see which logins we can modify.', 'asp', NULL, 'CoreysGoryStory');
    analysis_run_test(37, 'PASS: Get Logins \'king-cobra\' Can Modify (When Logged In As God)', 'We log in with the \'God\' login, and check the permissions for the \'king-cobra\' manager login. We should not be able to see the \'God\' login.', 'admin', NULL, CO_Config::$god_mode_password);
    analysis_run_test(38, 'PASS: Get Logins \'asp\' Can Modify (When Logged In As God)', 'We log in with the \'God\' login, and check the permissions for the \'asp\' manager login.', 'admin', NULL, CO_Config::$god_mode_password);
    analysis_run_test(39, 'FAIL: Get Logins \'cobra\' Can See', 'We log in with the \'cobra\' login, and check the read permissions. This should fail, as we should not even be able instantiate a COBRA instance.', 'cobra', NULL, 'CoreysGoryStory');
    analysis_run_test(40, 'FAIL: Get Logins \'cobra\' Can Modify', 'We log in with the \'cobra\' login, and check the modify permissions. This should fail, as we should not even be able instantiate a COBRA instance.', 'cobra', NULL, 'CoreysGoryStory');
    analysis_run_test(41, 'FAIL: Get Logins \'krait\' Can See', 'We log in with the \'krait\' login, and check the read permissions. This should fail, as we should not even be able instantiate a COBRA instance.', 'cobra', NULL, 'CoreysGoryStory');
    analysis_run_test(42, 'FAIL: Get Logins \'krait\' Can Modify', 'We log in with the \'krait\' login, and check the modify permissions. This should fail, as we should not even be able instantiate a COBRA instance.', 'cobra', NULL, 'CoreysGoryStory');
    analysis_run_test(43, 'PASS: Get Logins \'cobra\' Can See (When Logged In As God)', 'We log in with the \'God\' login, and check the permissions for the \'cobra\' standard user login. We will now be able to see it.', 'admin', NULL, CO_Config::$god_mode_password);
    analysis_run_test(44, 'PASS: Get Logins \'krait\' Can See (When Logged In As God)', 'We log in with the \'God\' login, and check the permissions for the \'krait\' standard user login. We will now be able to see it. Even though \'krait\' has the \'God\' ID in its list, we should not be able to see the \'God\' login.', 'admin', NULL, CO_Config::$god_mode_password);
    analysis_run_test(45, 'PASS: Get Logins \'cobra\' Can Modify (When Logged In As God)', 'We log in with the \'God\' login, and check the permissions for the \'cobra\' standard user login. We will now be able to modify it.', 'admin', NULL, CO_Config::$god_mode_password);
    analysis_run_test(46, 'PASS: Get Logins \'krait\' Can Modify (When Logged In As God)', 'We log in with the \'God\' login, and check the permissions for the \'krait\' standard user login. We will now be able to modify it. Even though \'krait\' has the \'God\' ID in its list, we should not be able to modify the \'God\' login.', 'admin', NULL, CO_Config::$god_mode_password);
    analysis_run_test(47, 'FAIL: Get Logins \'norm\' Can See', 'We log in with the \'norm\' login, and check the read permissions. This should fail, as we should not even be able instantiate a COBRA instance.', 'cobra', NULL, 'CoreysGoryStory');
    analysis_run_test(48, 'PASS: Get Logins \'norm\' Can See (When Logged In As God)', 'We log in with the \'God\' login, and check the permissions for the \'norm\' standard user login. We will now be able to see it.', 'admin', NULL, CO_Config::$god_mode_password);
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
        $visible_logins = $cobra_instance->get_all_logins(FALSE, 'king-cobra');
        
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
        $visible_logins = $cobra_instance->get_all_logins(FALSE, 'asp');
        
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
        $visible_logins = $cobra_instance->get_all_logins(TRUE);
        
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
        $visible_logins = $cobra_instance->get_all_logins(TRUE, 'king-cobra');
        
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
        $visible_logins = $cobra_instance->get_all_logins(TRUE, 'asp');
        
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
    analysis_test_29($in_login, $in_hashed_password, $in_password);
}

function analysis_test_42($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    analysis_test_34($in_login, $in_hashed_password, $in_password);
}

function analysis_test_43($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        $visible_logins = $cobra_instance->get_all_logins(FALSE, 'cobra');
        
        if (isset($visible_logins) && is_array($visible_logins) && count($visible_logins)) {
            foreach ($visible_logins as $record) {
                hierarchicalDisplayRecord($record);
            }
        }
    }
}

function analysis_test_44($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        $visible_logins = $cobra_instance->get_all_logins(FALSE, 'krait');
        
        if (isset($visible_logins) && is_array($visible_logins) && count($visible_logins)) {
            foreach ($visible_logins as $record) {
                hierarchicalDisplayRecord($record);
            }
        }
    }
}

function analysis_test_45($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        $visible_logins = $cobra_instance->get_all_logins(TRUE, 'cobra');
        
        if (isset($visible_logins) && is_array($visible_logins) && count($visible_logins)) {
            foreach ($visible_logins as $record) {
                hierarchicalDisplayRecord($record);
            }
        }
    }
}

function analysis_test_46($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        $visible_logins = $cobra_instance->get_all_logins(TRUE, 'krait');
        
        if (isset($visible_logins) && is_array($visible_logins) && count($visible_logins)) {
            foreach ($visible_logins as $record) {
                hierarchicalDisplayRecord($record);
            }
        }
    }
}

function analysis_test_47($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    analysis_test_29($in_login, $in_hashed_password, $in_password);
}

function analysis_test_48($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        $visible_logins = $cobra_instance->get_all_logins(FALSE, 'norm');
        
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
            echo('<h2 class="header"><a href="javascript:toggle_main_state(\'edit-tests\')">COBRA LOGIN VISIBILITY TESTS</a></h2>');
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
