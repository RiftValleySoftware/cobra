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

function basic_test_relay($in_test_number, $in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $function_name = sprintf('basic_test_%02d', $in_test_number);
    
    $function_name($in_login, $in_hashed_password, $in_password);
}
    
function basic_test_01($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $access_instance = NULL;
    
    if ( !defined('LGV_ACCESS_CATCHER') ) {
        define('LGV_ACCESS_CATCHER', 1);
    }
    
    require_once(CO_Config::main_class_dir().'/co_cobra.class.php');
    CO_Config::require_extension_class('co_us_place_collection.class.php');

    $access_instance = new CO_Cobra($in_login, $in_hashed_password, $in_password);
    
    if ($access_instance->valid) {
        echo("<h2>The access instance is valid!</h2>");
        $st1 = microtime(TRUE);
        $item = $access_instance->get_single_data_record_by_id(21131);
        $fetchTime = sprintf('%01.4f', microtime(TRUE) - $st1);
        echo('<div class="inner_div">');
            if ( isset($item) ) {
                display_record($item);
                echo ('<h4>Address:</h4>');
                    echo('<div class="inner_div">');
                    $address = $item->geocode_long_lat();
                    foreach ($address as $key => $value) {
                        if (trim($value)) {
                            echo("<p><strong>$key:</strong> <em>$value</em></p>");
                        }
                    }
                echo('</div>');
                $ll = $item->lookup_address();
                echo ("<p><strong>Longitude and Latitude:</strong> <em>(".$ll['longitude'].", ".$ll['latitude'].")</em></p>");
            }
            echo ("<p><em>This took $fetchTime seconds.</em></p>");
        echo('</div>');
        $st1 = microtime(TRUE);
        $item = $access_instance->get_single_data_record_by_id(11236);
        $fetchTime = sprintf('%01.4f', microtime(TRUE) - $st1);
        echo('<div class="inner_div">');
            if ( isset($item) ) {
                display_record($item);
                echo ('<h4>Address:</h4>');
                    echo('<div class="inner_div">');
                    $address = $item->geocode_long_lat();
                    foreach ($address as $key => $value) {
                        if (trim($value)) {
                            echo("<p><strong>$key:</strong> <em>$value</em></p>");
                        }
                    }
                echo('</div>');
                $ll = $item->lookup_address();
                echo ("<p><strong>Longitude and Latitude:</strong> <em>(".$ll['longitude'].", ".$ll['latitude'].")</em></p>");
            }
            echo ("<p><em>This took $fetchTime seconds.</em></p>");
        echo('</div>');
        $st1 = microtime(TRUE);
        $item = $access_instance->get_single_data_record_by_id(10872);
        $fetchTime = sprintf('%01.4f', microtime(TRUE) - $st1);
        echo('<div class="inner_div">');
            if ( isset($item) ) {
                display_record($item);
                echo ('<h4>Address:</h4>');
                    echo('<div class="inner_div">');
                    $address = $item->geocode_long_lat();
                    foreach ($address as $key => $value) {
                        if (trim($value)) {
                            echo("<p><strong>$key:</strong> <em>$value</em></p>");
                        }
                    }
                echo('</div>');
                $ll = $item->lookup_address();
                echo ("<p><strong>Longitude and Latitude:</strong> <em>(".$ll['longitude'].", ".$ll['latitude'].")</em></p>");
            }
            echo ("<p><em>This took $fetchTime seconds.</em></p>");
        echo('</div>');
        $st1 = microtime(TRUE);
        $item = $access_instance->get_single_data_record_by_id(7562);
        $fetchTime = sprintf('%01.4f', microtime(TRUE) - $st1);
        echo('<div class="inner_div">');
            if ( isset($item) ) {
                display_record($item);
                echo ('<h4>Address:</h4>');
                    echo('<div class="inner_div">');
                    $address = $item->geocode_long_lat();
                    foreach ($address as $key => $value) {
                        if (trim($value)) {
                            echo("<p><strong>$key:</strong> <em>$value</em></p>");
                        }
                    }
                echo('</div>');
                $ll = $item->lookup_address();
                echo ("<p><strong>Longitude and Latitude:</strong> <em>(".$ll['longitude'].", ".$ll['latitude'].")</em></p>");
            }
            echo ("<p><em>This took $fetchTime seconds.</em></p>");
        echo('</div>');
        $st1 = microtime(TRUE);
        $item = $access_instance->get_single_data_record_by_id(1302);
        $fetchTime = sprintf('%01.4f', microtime(TRUE) - $st1);
        echo('<div class="inner_div">');
            if ( isset($item) ) {
                display_record($item);
                echo ('<h4>Address:</h4>');
                    echo('<div class="inner_div">');
                    $address = $item->geocode_long_lat();
                    foreach ($address as $key => $value) {
                        if (trim($value)) {
                            echo("<p><strong>$key:</strong> <em>$value</em></p>");
                        }
                    }
                echo('</div>');
                $ll = $item->lookup_address();
                echo ("<p><strong>Longitude and Latitude:</strong> <em>(".$ll['longitude'].", ".$ll['latitude'].")</em></p>");
            }
            echo ("<p><em>This took $fetchTime seconds.</em></p>");
        echo('</div>');
        $st1 = microtime(TRUE);
        $item = $access_instance->get_single_data_record_by_id(20764);
        $fetchTime = sprintf('%01.4f', microtime(TRUE) - $st1);
        echo('<div class="inner_div">');
            if ( isset($item) ) {
                display_record($item);
                echo ('<h4>Address:</h4>');
                    echo('<div class="inner_div">');
                    $address = $item->geocode_long_lat();
                    foreach ($address as $key => $value) {
                        if (trim($value)) {
                            echo("<p><strong>$key:</strong> <em>$value</em></p>");
                        }
                    }
                echo('</div>');
                $ll = $item->lookup_address();
                echo ("<p><strong>Longitude and Latitude:</strong> <em>(".$ll['longitude'].", ".$ll['latitude'].")</em></p>");
            }
            echo ("<p><em>This took $fetchTime seconds.</em></p>");
        echo('</div>');
    } else {
        echo("<h2 style=\"color:red;font-weight:bold\">The access instance is not valid!</h2>");
        echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$access_instance->error->error_code.') '.$access_instance->error->error_name.' ('.$access_instance->error->error_description.')</p>');
    }
}
    
function basic_test_02($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $access_instance = NULL;
    
    if ( !defined('LGV_ACCESS_CATCHER') ) {
        define('LGV_ACCESS_CATCHER', 1);
    }
    
    require_once(CO_Config::main_class_dir().'/co_cobra.class.php');
    
    $access_instance = new CO_Cobra($in_login, $in_hashed_password, $in_password);
    
    if ($access_instance->valid) {
        echo("<h2>The access instance is valid!</h2>");
        $st1 = microtime(TRUE);
        $test_item = $access_instance->generic_search(Array('location' => Array('longitude' => -77.0502, 'latitude' => 38.8893, 'radius' => 50.0)));
        $fetchTime = sprintf('%01.4f', microtime(TRUE) - $st1);
        echo('<div class="inner_div">');
            if ( isset($test_item) ) {
                if (is_array($test_item)) {
                    if (count($test_item)) {
                        echo("<h4>We got ".count($test_item)." records in $fetchTime seconds.</h4>");
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
    
function basic_test_03($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $access_instance = NULL;
    
    if ( !defined('LGV_ACCESS_CATCHER') ) {
        define('LGV_ACCESS_CATCHER', 1);
    }
    
    require_once(CO_Config::main_class_dir().'/co_cobra.class.php');
    
    $access_instance = new CO_Cobra($in_login, $in_hashed_password, $in_password);
    
    if ($access_instance->valid) {
        $st1 = microtime(TRUE);
        $item = $access_instance->get_single_data_record_by_id(2);
        $fetchTime = sprintf('%01.4f', microtime(TRUE) - $st1);
        echo('<div class="inner_div">');
            if ( isset($item) ) {
                display_record($item);
            }
            echo ("<p><em>This took $fetchTime seconds.</em></p>");
        echo('</div>');
        
        $st1 = microtime(TRUE);
        $item = $access_instance->get_single_data_record_by_id(3);
        $fetchTime = sprintf('%01.4f', microtime(TRUE) - $st1);
        echo('<div class="inner_div">');
            if ( isset($item) ) {
                display_record($item);
            }
            echo ("<p><em>This took $fetchTime seconds.</em></p>");
        echo('</div>');
        
        $st1 = microtime(TRUE);
        $item = $access_instance->get_single_data_record_by_id(4);
        $fetchTime = sprintf('%01.4f', microtime(TRUE) - $st1);
        echo('<div class="inner_div">');
            if ( isset($item) ) {
                display_record($item);
            }
            echo ("<p><em>This took $fetchTime seconds.</em></p>");
        echo('</div>');
    } else {
        echo("<h2 style=\"color:red;font-weight:bold\">The access instance is not valid!</h2>");
        echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$access_instance->error->error_code.') '.$access_instance->error->error_name.' ('.$access_instance->error->error_description.')</p>');
    }
}
    
function basic_test_04($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $access_instance = NULL;
    
    if ( !defined('LGV_ACCESS_CATCHER') ) {
        define('LGV_ACCESS_CATCHER', 1);
    }
    
    require_once(CO_Config::main_class_dir().'/co_cobra.class.php');
    
    $access_instance = new CO_Cobra($in_login, $in_hashed_password, $in_password);
    
    if ($access_instance->valid) {
        $st1 = microtime(TRUE);
        $collection_item = $access_instance->get_single_data_record_by_id(4);
        $fetchTime = sprintf('%01.4f', microtime(TRUE) - $st1);
        echo('<div class="inner_div">');
            if ( isset($collection_item) ) {
                display_record($collection_item);
            }
            echo ("<p><em>This took $fetchTime seconds.</em></p>");
        echo('</div>');
        $st1 = microtime(TRUE);
        $test_item1 = $access_instance->generic_search(Array('access_class' => 'CO_US_Place','tags' => Array('', '', '', '', '', 'DC')));
        $fetchTime = sprintf('%01.4f', microtime(TRUE) - $st1);
        echo('<div class="inner_div">');
            echo ("<h4>BEFORE:</h4>");
            if ( isset($test_item1) ) {
                if (is_array($test_item1)) {
                    if (count($test_item1)) {
                        echo("<h4>We got ".count($test_item1)." records in $fetchTime seconds.</h4>");
                        for ($i = 0; $i < (count($test_item1) / 2); $i++) {
                            $collection_item->appendElement(array_shift($test_item1));
                        }
                    }
                }
            }
            
            $collection_item2 = $access_instance->get_single_data_record_by_id(3);
            $st1 = microtime(TRUE);
            $test_item2 = $access_instance->generic_search(Array('access_class' => 'CO_US_Place','tags' => Array('', '', '', '', '', 'DE')));
            $fetchTime = sprintf('%01.4f', microtime(TRUE) - $st1);
            if ( isset($test_item2) ) {
                if (is_array($test_item2)) {
                    if (count($test_item2)) {
                        echo("<h4>We got ".count($test_item2)." records in $fetchTime seconds.</h4>");
                        for ($i = 0; $i < (count($test_item2) / 2); $i++) {
                            $collection_item2->appendElement(array_shift($test_item2));
                        }
                    }
                }
            }
            
            $collection_item->appendElement($collection_item2);
        
            $collection_item->appendElements($test_item1);
            
            echo ("<h4>AFTER:</h4>");
            hierarchicalDisplayRecord($collection_item);
        echo('</div>');
    } else {
        echo("<h2 style=\"color:red;font-weight:bold\">The access instance is not valid!</h2>");
        echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$access_instance->error->error_code.') '.$access_instance->error->error_name.' ('.$access_instance->error->error_description.')</p>');
    }
}
    
function basic_test_05($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $access_instance = NULL;
    
    if ( !defined('LGV_ACCESS_CATCHER') ) {
        define('LGV_ACCESS_CATCHER', 1);
    }
    
    require_once(CO_Config::main_class_dir().'/co_cobra.class.php');
    
    $access_instance = new CO_Cobra($in_login, $in_hashed_password, $in_password);
    
    if ($access_instance->valid) {
        $st1 = microtime(TRUE);
        $collection_item = $access_instance->get_single_data_record_by_id(2);
        $fetchTime = sprintf('%01.4f', microtime(TRUE) - $st1);
        echo('<div class="inner_div">');
            if ( isset($collection_item) ) {
                display_record($collection_item);
            }
            echo ("<p><em>This took $fetchTime seconds.</em></p>");
        echo('</div>');
        $st1 = microtime(TRUE);
        $test_item1 = $access_instance->generic_search(Array('access_class' => 'CO_US_Place','tags' => Array('', '', '', '', '', 'DC')));
        $fetchTime = sprintf('%01.4f', microtime(TRUE) - $st1);
        echo('<div class="inner_div">');
            echo ("<h4>BEFORE:</h4>");
            if ( isset($test_item1) ) {
                if (is_array($test_item1)) {
                    if (count($test_item1)) {
                        echo("<h4>We got ".count($test_item1)." records in $fetchTime seconds.</h4>");
                        for ($i = 0; $i < (count($test_item1) / 2); $i++) {
                            $collection_item->appendElement(array_shift($test_item1));
                        }
                    }
                }
            }
            
            $collection_item2 = $access_instance->get_single_data_record_by_id(3);
            $st1 = microtime(TRUE);
            $test_item2 = $access_instance->generic_search(Array('access_class' => 'CO_US_Place','tags' => Array('', '', '', '', '', 'DE')));
            $fetchTime = sprintf('%01.4f', microtime(TRUE) - $st1);
            if ( isset($test_item2) ) {
                if (is_array($test_item2)) {
                    if (count($test_item2)) {
                        echo("<h4>We got ".count($test_item2)." records in $fetchTime seconds.</h4>");
                        for ($i = 0; $i < (count($test_item2) / 2); $i++) {
                            $collection_item2->appendElement(array_shift($test_item2));
                        }
                    }
                }
            }
            
            $collection_item->appendElement($collection_item2);
        
            $collection_item->appendElements($test_item1);
            
            echo ("<h4>AFTER:</h4>");

            hierarchicalDisplayRecord($collection_item);
        echo('</div>');
    } else {
        echo("<h2 style=\"color:red;font-weight:bold\">The access instance is not valid!</h2>");
        echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$access_instance->error->error_code.') '.$access_instance->error->error_name.' ('.$access_instance->error->error_description.')</p>');
    }
}

ob_start();

    prepare_databases('basic_tests');
    
    echo('<div class="test-wrapper" style="display:table;margin-left:auto;margin-right:auto;text-align:left">');
        echo('<h1 class="header">BASIC TESTS</h1>');
        echo('<div id="basic-login-tests" class="closed">');
            echo('<h2 class="header"><a href="javascript:toggle_main_state(\'basic-login-tests\')">TEST PLACES</a></h2>');
            echo('<div class="container">');
            
                echo('<div id="test-011" class="inner_closed">');
                    echo('<h3 class="inner_header"><a href="javascript:toggle_inner_state(\'test-011\')">TEST 11: Select a location and radius, and Read The Entries.</a></h3>');
                    echo('<div class="main_div inner_container">');
                        echo('<div class="main_div" style="margin-right:2em">');
                            echo('<p class="explain">This test will dump a subset of the "places" that have been instantiated in the database.</p>');
                            echo('<p class="explain">It works by choosing a location in Washington DC, and searching for meetings within a 50Km radius.</p>');
                        echo('</div>');
                        basic_test_relay(2);
                    echo('</div>');
                echo('</div>');
            
                echo('<div id="test-012" class="inner_closed">');
                    echo('<h3 class="inner_header"><a href="javascript:toggle_inner_state(\'test-012\')">TEST 12: Test Geocode.</a></h3>');
                    echo('<div class="main_div inner_container">');
                        echo('<div class="main_div" style="margin-right:2em">');
                        echo('<p class="explain">This test will fetch six known records, and will ask the location object to do a geocode and address lookup.</p>');
                        echo('</div>');
                        basic_test_relay(1);
                    echo('</div>');
                echo('</div>');
                
            echo('</div>');
        echo('</div>');
            
        echo('<div id="basic-c-tests" class="closed">');
            echo('<h2 class="header"><a href="javascript:toggle_main_state(\'basic-c-tests\')">TEST COLLECTIONS</a></h2>');
            echo('<div class="container">');
            
                echo('<div id="test-013" class="inner_closed">');
                    echo('<h3 class="inner_header"><a href="javascript:toggle_inner_state(\'test-013\')">TEST 13: Basic Collection Class Tests.</a></h3>');
                    echo('<div class="main_div inner_container">');
                        echo('<div class="main_div" style="margin-right:2em">');
                        echo('<p class="explain">This will access the collection classes we inserted into the dataset, and display their data.</p>');
                        echo('</div>');
                        basic_test_relay(3);
                    echo('</div>');
                echo('</div>');
            
                echo('<div id="test-014" class="inner_closed">');
                    echo('<h3 class="inner_header"><a href="javascript:toggle_inner_state(\'test-014\')">TEST 14: Try Modifying A Collection We Don\'t Own.</a></h3>');
                    echo('<div class="main_div inner_container">');
                        echo('<div class="main_div" style="margin-right:2em">');
                        echo('</div>');
                        basic_test_relay(4, 'DCAdmin', '', 'CoreysGoryStory');
                    echo('</div>');
                echo('</div>');
            
                echo('<div id="test-015" class="inner_closed">');
                    echo('<h3 class="inner_header"><a href="javascript:toggle_inner_state(\'test-015\')">TEST 15: Try Modifying A Collection We Own, but An Internal Collection We Don\'t.</a></h3>');
                    echo('<div class="main_div inner_container">');
                        echo('<div class="main_div" style="margin-right:2em">');
                        echo('</div>');
                        basic_test_relay(5, 'DCAdmin', '', 'CoreysGoryStory');
                    echo('</div>');
                echo('</div>');
                
                echo('<div id="test-016" class="inner_closed">');
                    echo('<h3 class="inner_header"><a href="javascript:toggle_inner_state(\'test-016\')">TEST 16: Try Modifying Multiple Collections We Own Outright.</a></h3>');
                    echo('<div class="main_div inner_container">');
                        echo('<div class="main_div" style="margin-right:2em">');
                        echo('</div>');
                        basic_test_relay(5, 'AllAdmin', 'CodYOzPtwxb4A');
                    echo('</div>');
                echo('</div>');
                
            echo('</div>');
        echo('</div>');
    echo('</div>');
$buffer = ob_get_clean();
die($buffer);
?>
