<?php
/***************************************************************************************************************************/
/**
    CHAMELEON Object Abstraction Layer
    
    © Copyright 2018, Little Green Viper Software Development LLC.
    
    This code is proprietary and confidential code, 
    It is NOT to be reused or combined into any application,
    unless done so, specifically under written license from Little Green Viper Software Development LLC.

    Little Green Viper Software Development: https://littlegreenviper.com
*/
require_once(dirname(dirname(__FILE__)).'/functions.php');

function dc_area_test_relay($in_test_number, $in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $function_name = sprintf('dc_area_test_%02d', $in_test_number);
    
    $function_name($in_login, $in_hashed_password, $in_password);
}
    
function dc_area_test_01($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $access_instance = NULL;
    
    if ( !defined('LGV_ACCESS_CATCHER') ) {
        define('LGV_ACCESS_CATCHER', 1);
    }
    
    require_once(CO_Config::main_class_dir().'/co_cobra.class.php');
    
    $access_instance = new CO_Cobra($in_login, $in_hashed_password, $in_password);
    
    if ($access_instance->valid) {
        echo("<h2>The access instance is valid!</h2>");
        $st1 = microtime(TRUE);
        $test_item = $access_instance->get_all_security_readable_records();
        $fetchTime = sprintf('%01.3f', microtime(TRUE) - $st1);
        echo('<div class="inner_div">');
            echo("<h3>See what security items we have access to.</h2>");
            if ( isset($test_item) ) {
                if (is_array($test_item)) {
                    if (count($test_item)) {
                        echo("<h4>We got ".count($test_item)." records in $fetchTime seconds.</h4>");
                        $count = 0;
                        foreach ( $test_item as $item ) {
                            display_record($item);
                        }
                    }
                }
            }
        echo('</div>');
        $st1 = microtime(TRUE);
        $test_item = $access_instance->generic_search();
        $fetchTime = sprintf('%01.3f', microtime(TRUE) - $st1);
        echo('<div class="inner_div">');
            echo("<h3>See what data items we have access to.</h2>");
            if ( isset($test_item) ) {
                if (is_array($test_item)) {
                    if (count($test_item)) {
                        echo("<h4>We got ".count($test_item)." records in $fetchTime seconds.</h4>");
                        $count = 0;
                        foreach ( $test_item as $item ) {
                            display_record($item);
                        }
                    }
                }
            }
        echo('</div>');
    } else {
        echo("<h2 style=\"color:red;font-weight:bold\">The access instance is not valid!</h2>");
        echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$access_instance->error->error_code.') '.$access_instance->error->error_name.' ('.$access_instance->error->error_description.')</p>');
    }
}
    
function dc_area_test_02($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $access_instance = NULL;
    
    if ( !defined('LGV_ACCESS_CATCHER') ) {
        define('LGV_ACCESS_CATCHER', 1);
    }
    
    require_once(CO_Config::main_class_dir().'/co_cobra.class.php');
    
    $access_instance = new CO_Cobra($in_login, $in_hashed_password, $in_password);
    
    if ($access_instance->valid) {
        echo("<h2>The access instance is valid!</h2>");
        $st1 = microtime(TRUE);
        $test_item = $access_instance->get_all_security_writeable_records();
        $fetchTime = sprintf('%01.3f', microtime(TRUE) - $st1);
        echo('<div class="inner_div">');
            echo("<h3>See what security items we have access to.</h2>");
            if ( isset($test_item) ) {
                if (is_array($test_item)) {
                    if (count($test_item)) {
                        echo("<h4>We got ".count($test_item)." records in $fetchTime seconds.</h4>");
                        $count = 0;
                        foreach ( $test_item as $item ) {
                            display_record($item);
                        }
                    }
                }
            }
        echo('</div>');
        $st1 = microtime(TRUE);
        $test_item = $access_instance->get_all_data_writeable_records();
        $fetchTime = sprintf('%01.3f', microtime(TRUE) - $st1);
        echo('<div class="inner_div">');
            echo("<h3>See what data items we have access to.</h2>");
            if ( isset($test_item) ) {
                if (is_array($test_item)) {
                    if (count($test_item)) {
                        echo("<h4>We got ".count($test_item)." records in $fetchTime seconds.</h4>");
                        $count = 0;
                        foreach ( $test_item as $item ) {
                            display_record($item);
                        }
                    }
                }
            }
        echo('</div>');
    } else {
        echo("<h2 style=\"color:red;font-weight:bold\">The access instance is not valid!</h2>");
        echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$access_instance->error->error_code.') '.$access_instance->error->error_name.' ('.$access_instance->error->error_description.')</p>');
    }
}

ob_start();
    prepare_databases('dc_area_tests');
    
    echo('<div class="test-wrapper" style="display:table;margin-left:auto;margin-right:auto;text-align:left">');
        echo('<h1 class="header">DC AREA TESTS</h1>');
        echo('<div id="dc-area-tests" class="closed">');
            echo('<h2 class="header"><a href="javascript:toggle_main_state(\'dc-area-tests\')">LOG IN AND ACCESS TESTS</a></h2>');
            echo('<div class="container">');
                echo('<p class="explain">This set of tests simulate what may be a fairly typical installation. We have 1723 NA meetings in the mid-Atlantic area.</p>');
                echo('<p class="explain">There are 5 states represented, eech, with an admin that can log in and manage the records for that state.</p>');
            
                echo('<div id="test-001" class="inner_closed">');
                    echo('<h3 class="inner_header"><a href="javascript:toggle_inner_state(\'test-001\')">TEST 1: Log In as "MDAdmin", and See All The Readable Entries.</a></h3>');
                    echo('<div class="main_div inner_container">');
                        echo('<div class="main_div" style="margin-right:2em">');
                            ?>
                            <p class="explain"></p>
                            <?php
                        echo('</div>');
                        dc_area_test_relay(1, 'MDAdmin', 'CodYOzPtwxb4A');
                        $start = microtime(TRUE);
                        echo('<h5>The test took '. sprintf('%01.3f', microtime(TRUE) - $start) . ' seconds.</h5>');
                    echo('</div>');
                echo('</div>');
            
                echo('<div id="test-002" class="inner_closed">');
                    echo('<h3 class="inner_header"><a href="javascript:toggle_inner_state(\'test-002\')">TEST 2: Log In as "MDAdmin", and See All The Writeable Entries.</a></h3>');
                    echo('<div class="main_div inner_container">');
                        echo('<div class="main_div" style="margin-right:2em">');
                            ?>
                            <p class="explain"></p>
                            <?php
                        echo('</div>');
                        dc_area_test_relay(2, 'MDAdmin', 'CodYOzPtwxb4A');
                        $start = microtime(TRUE);
                        echo('<h5>The test took '. sprintf('%01.3f', microtime(TRUE) - $start) . ' seconds.</h5>');
                    echo('</div>');
                echo('</div>');
            
                echo('<div id="test-003" class="inner_closed">');
                    echo('<h3 class="inner_header"><a href="javascript:toggle_inner_state(\'test-003\')">TEST 3: Log In as "VAAdmin", and See All The Readable Entries.</a></h3>');
                    echo('<div class="main_div inner_container">');
                        echo('<div class="main_div" style="margin-right:2em">');
                            ?>
                            <p class="explain"></p>
                            <?php
                        echo('</div>');
                        dc_area_test_relay(1, 'VAAdmin', 'CodYOzPtwxb4A');
                        $start = microtime(TRUE);
                        echo('<h5>The test took '. sprintf('%01.3f', microtime(TRUE) - $start) . ' seconds.</h5>');
                    echo('</div>');
                echo('</div>');
            
                echo('<div id="test-004" class="inner_closed">');
                    echo('<h3 class="inner_header"><a href="javascript:toggle_inner_state(\'test-004\')">TEST 4: Log In as "VAAdmin", and See All The Writeable Entries.</a></h3>');
                    echo('<div class="main_div inner_container">');
                        echo('<div class="main_div" style="margin-right:2em">');
                            ?>
                            <p class="explain"></p>
                            <?php
                        echo('</div>');
                        dc_area_test_relay(2, 'VAAdmin', 'CodYOzPtwxb4A');
                        $start = microtime(TRUE);
                        echo('<h5>The test took '. sprintf('%01.3f', microtime(TRUE) - $start) . ' seconds.</h5>');
                    echo('</div>');
                echo('</div>');
            
                echo('<div id="test-005" class="inner_closed">');
                    echo('<h3 class="inner_header"><a href="javascript:toggle_inner_state(\'test-005\')">TEST 5: Log In as "DCAdmin", and See All The Readable Entries.</a></h3>');
                    echo('<div class="main_div inner_container">');
                        echo('<div class="main_div" style="margin-right:2em">');
                            ?>
                            <p class="explain"></p>
                            <?php
                        echo('</div>');
                        dc_area_test_relay(1, 'DCAdmin', 'CodYOzPtwxb4A');
                        $start = microtime(TRUE);
                        echo('<h5>The test took '. sprintf('%01.3f', microtime(TRUE) - $start) . ' seconds.</h5>');
                    echo('</div>');
                echo('</div>');
            
                echo('<div id="test-006" class="inner_closed">');
                    echo('<h3 class="inner_header"><a href="javascript:toggle_inner_state(\'test-006\')">TEST 6: Log In as "DCAdmin", and See All The Writeable Entries.</a></h3>');
                    echo('<div class="main_div inner_container">');
                        echo('<div class="main_div" style="margin-right:2em">');
                            ?>
                            <p class="explain"></p>
                            <?php
                        echo('</div>');
                        dc_area_test_relay(2, 'DCAdmin', 'CodYOzPtwxb4A');
                        $start = microtime(TRUE);
                        echo('<h5>The test took '. sprintf('%01.3f', microtime(TRUE) - $start) . ' seconds.</h5>');
                    echo('</div>');
                echo('</div>');
            
                echo('<div id="test-007" class="inner_closed">');
                    echo('<h3 class="inner_header"><a href="javascript:toggle_inner_state(\'test-007\')">TEST 7: Log In as "WVAdmin", and See All The Readable Entries.</a></h3>');
                    echo('<div class="main_div inner_container">');
                        echo('<div class="main_div" style="margin-right:2em">');
                            ?>
                            <p class="explain"></p>
                            <?php
                        echo('</div>');
                        dc_area_test_relay(1, 'WVAdmin', 'CodYOzPtwxb4A');
                        $start = microtime(TRUE);
                        echo('<h5>The test took '. sprintf('%01.3f', microtime(TRUE) - $start) . ' seconds.</h5>');
                    echo('</div>');
                echo('</div>');
            
                echo('<div id="test-008" class="inner_closed">');
                    echo('<h3 class="inner_header"><a href="javascript:toggle_inner_state(\'test-008\')">TEST 8: Log In as "WVAdmin", and See All The Writeable Entries.</a></h3>');
                    echo('<div class="main_div inner_container">');
                        echo('<div class="main_div" style="margin-right:2em">');
                            ?>
                            <p class="explain"></p>
                            <?php
                        echo('</div>');
                        dc_area_test_relay(2, 'WVAdmin', 'CodYOzPtwxb4A');
                        $start = microtime(TRUE);
                        echo('<h5>The test took '. sprintf('%01.3f', microtime(TRUE) - $start) . ' seconds.</h5>');
                    echo('</div>');
                echo('</div>');
            
                echo('<div id="test-09" class="inner_closed">');
                    echo('<h3 class="inner_header"><a href="javascript:toggle_inner_state(\'test-09\')">TEST 9: Log In as "DEAdmin", and See All The Readable Entries.</a></h3>');
                    echo('<div class="main_div inner_container">');
                        echo('<div class="main_div" style="margin-right:2em">');
                            ?>
                            <p class="explain"></p>
                            <?php
                        echo('</div>');
                        dc_area_test_relay(1, 'DEAdmin', 'CodYOzPtwxb4A');
                        $start = microtime(TRUE);
                        echo('<h5>The test took '. sprintf('%01.3f', microtime(TRUE) - $start) . ' seconds.</h5>');
                    echo('</div>');
                echo('</div>');
            
                echo('<div id="test-010" class="inner_closed">');
                    echo('<h3 class="inner_header"><a href="javascript:toggle_inner_state(\'test-010\')">TEST 10: Log In as "DEAdmin", and See All The Writeable Entries.</a></h3>');
                    echo('<div class="main_div inner_container">');
                        echo('<div class="main_div" style="margin-right:2em">');
                            ?>
                            <p class="explain"></p>
                            <?php
                        echo('</div>');
                        dc_area_test_relay(2, 'DEAdmin', 'CodYOzPtwxb4A');
                        $start = microtime(TRUE);
                        echo('<h5>The test took '. sprintf('%01.3f', microtime(TRUE) - $start) . ' seconds.</h5>');
                    echo('</div>');
                echo('</div>');
                
            echo('</div>');
        echo('</div>');
    echo('</div>');
$buffer = ob_get_clean();
die($buffer);
?>
