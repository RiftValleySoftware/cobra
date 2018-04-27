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

if ( !defined('LGV_CONFIG_CATCHER') ) {
    define('LGV_CONFIG_CATCHER', 1);
}

$config_file_path = dirname(__FILE__).'/../config/omfgwtfdude_config.class.php';
require_once($config_file_path);
require_once(dirname(dirname(__FILE__)).'/functions.php');

function owner_test_relay($in_test_number, $in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $function_name = sprintf('owner_test_%02d', $in_test_number);
    
    $function_name($in_login, $in_hashed_password, $in_password);
}
    
function owner_test_01($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $access_instance = NULL;
    
    if ( !defined('LGV_ACCESS_CATCHER') ) {
        define('LGV_ACCESS_CATCHER', 1);
    }
    
    require_once(CO_Config::main_class_dir().'/co_cobra.class.php');
    
    $access_instance = new CO_Cobra($in_login, $in_hashed_password, $in_password);
    
    if ($access_instance->valid) {
        $st1 = microtime(TRUE);
        $owner_object = $access_instance->get_single_data_record_by_id(2061608);
        
        if (isset($owner_object) && $owner_object) {
            $count = $owner_object->count();
            $fetchTime = sprintf('%01.3f', microtime(TRUE) - $st1);
            echo('<div class="inner_div">');
                echo('<p>We "own" '.$count.' records!</p>');
            echo('</div>');
            echo('<p>The test took '.$fetchTime.' seconds.</p>');
        }
    } else {
        echo("<h2 style=\"color:red;font-weight:bold\">The access instance is not valid!</h2>");
        echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$access_instance->error->error_code.') '.$access_instance->error->error_name.' ('.$access_instance->error->error_description.')</p>');
    }
}
    
function owner_test_02($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $access_instance = NULL;
    
    if ( !defined('LGV_ACCESS_CATCHER') ) {
        define('LGV_ACCESS_CATCHER', 1);
    }
    
    require_once(CO_Config::main_class_dir().'/co_cobra.class.php');
    
    $access_instance = new CO_Cobra($in_login, $in_hashed_password, $in_password);
    
    if ($access_instance->valid) {
        $st1 = microtime(TRUE);
        $owner_object = $access_instance->get_single_data_record_by_id(2061608);
        
        if (isset($owner_object) && $owner_object) {
            $count = $owner_object->generic_search(Array('location' => Array('longitude' => -77.2189556, 'latitude' => 33.9850, 'radius' => 100.0)), 0, 0, FALSE, TRUE);
            $fetchTime = sprintf('%01.3f', microtime(TRUE) - $st1);
            echo('<div class="inner_div">');
                echo('<p class="explain">This test looks at the Chesapeake Bay, and grabs a bunch of records within a 100-Km radius of the bay.</p>');
                echo('<p class="explain">Since this is a US border dataset, we\'ll get quite a few hits.</p>');
                echo('<p>We found '.$count.' records!</p>');
            echo('</div>');
            echo('<p>The test took '.$fetchTime.' seconds.</p>');
            
            $st1 = microtime(TRUE);
            $count = intval($owner_object->generic_search(Array('location' => Array('longitude' => -118.4695, 'latitude' => 38.2336562, 'radius' => 200.0)), 0, 0, FALSE, TRUE));
            $fetchTime = sprintf('%01.3f', microtime(TRUE) - $st1);
            echo('<div class="inner_div">');
                echo('<p class="explain">Now, we try Venice Beach (CA), with a radius of 200Km. We expect to find zero records, even though there are plenty in the dataset.</p>');
                echo('<p>We found '.$count.' records!</p>');
            echo('</div>');
            echo('<p>The test took '.$fetchTime.' seconds.</p>');
            
            $st1 = microtime(TRUE);
            $data_points = $owner_object->generic_search(Array('location' => Array('longitude' => -77.2189556, 'latitude' => 33.9850, 'radius' => 100.0)), 0, 0, FALSE, FALSE, TRUE);
            $fetchTime = sprintf('%01.3f', microtime(TRUE) - $st1);
            echo('<div class="inner_div">');
                echo('<p class="explain">Now, we try the Chesapeake Bay test again, but this time, we get the IDs of the datapoints involved.</p>');
                echo('<div id="owner_test_02-03" class="inner_closed">');
                    echo('<h3 class="inner_header"><a href="javascript:toggle_inner_state(\'owner_test_02-03\')">We found '.count($data_points).' records!</a></h3>');
                    echo('<div class="main_div inner_container">');
                        echo('<ul class="crowded_list"><li class="li_crowded_list">'.implode(',</li><li class="li_crowded_list">', $data_points).'</li></ul>');
                    echo('</div>');
                echo('</div>');
            echo('</div>');
            echo('<p style="clear:both">The test took '.$fetchTime.' seconds.</p>');
            
            $st1 = microtime(TRUE);
            $data_points = $owner_object->generic_search(Array('location' => Array('longitude' => -77.2189556, 'latitude' => 33.9850, 'radius' => 100.0)));
            $fetchTime = sprintf('%01.3f', microtime(TRUE) - $st1);
            echo('<div class="inner_div">');
                echo('<p class="explain">Now, we try the Chesapeake Bay test again, but this time, we get the full objects, and display the names.</p>');
                echo('<div id="owner_test_02-04" class="inner_closed">');
                    echo('<h3 class="inner_header"><a href="javascript:toggle_inner_state(\'owner_test_02-04\')">We found '.count($data_points).' records!</a></h3>');
                    echo('<div class="main_div inner_container">');
                        echo('<ul class="crowded_list"><li class="li_crowded_list">'.implode(',</li><li class="li_crowded_list">', array_map(function($in){return $in->name;}, $data_points)).'</li></ul>');
                    echo('</div>');
                echo('</div>');
            echo('</div>');
            echo('<p style="clear:both">The test took '.$fetchTime.' seconds.</p>');
        }
    } else {
        echo("<h2 style=\"color:red;font-weight:bold\">The access instance is not valid!</h2>");
        echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$access_instance->error->error_code.') '.$access_instance->error->error_name.' ('.$access_instance->error->error_description.')</p>');
    }
}
    
function owner_test_03($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $access_instance = NULL;
    
    if ( !defined('LGV_ACCESS_CATCHER') ) {
        define('LGV_ACCESS_CATCHER', 1);
    }
    
    require_once(CO_Config::main_class_dir().'/co_cobra.class.php');
    
    $access_instance = new CO_Cobra($in_login, $in_hashed_password, $in_password);
    
    if ($access_instance->valid) {
        $st1 = microtime(TRUE);
        $owner_object = $access_instance->get_single_data_record_by_id(2061608);
        
        if (isset($owner_object) && $owner_object) {
            $count = $access_instance->generic_search(Array('location' => Array('longitude' => -81.4980687, 'latitude' => 25.8296825, 'radius' => 100.0)), FALSE, 0, 0, FALSE, TRUE);
            $fetchTime = sprintf('%01.3f', microtime(TRUE) - $st1);
            echo('<div class="inner_div">');
                echo('<p class="explain">We go to a spot on the West Coast of Florida, where the dataset ends. We first check the access instance, where we\'ll get a whole bunch of hits:</p>');
                echo('<p>We found '.$count.' records!</p>');
            echo('</div>');
            echo('<p>The test took '.$fetchTime.' seconds.</p>');
            
            $count = $owner_object->generic_search(Array('location' => Array('longitude' => -81.4980687, 'latitude' => 25.8296825, 'radius' => 100.0)), 0, 0, FALSE, TRUE);
            $fetchTime = sprintf('%01.3f', microtime(TRUE) - $st1);
            echo('<div class="inner_div">');
                echo('<p class="explain">Next, we query the owner object, where only those items that are "owned" are returned:</p>');
                echo('<p>We found '.$count.' records!</p>');
            echo('</div>');
            echo('<p>The test took '.$fetchTime.' seconds.</p>');
        }
    } else {
        echo("<h2 style=\"color:red;font-weight:bold\">The access instance is not valid!</h2>");
        echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$access_instance->error->error_code.') '.$access_instance->error->error_name.' ('.$access_instance->error->error_description.')</p>');
    }
}

ob_start();

    echo('<div class="test-wrapper" style="display:table;margin-left:auto;margin-right:auto;text-align:left">');            
        echo('<h1 class="header">OWNER TESTS</h1>');

        echo('<div id="owner-tests" class="closed">');
            echo('<h2 class="header"><a href="javascript:toggle_main_state(\'owner-tests\')">MASSIVE DATASET TESTS</a></h2>');
            echo('<div class="container">');
            
            if (FALSE !== strpos('localhost', $_SERVER['SERVER_NAME'])) {
                echo('<div id="test-038" class="inner_closed">');
                    echo('<h3 class="inner_header"><a href="javascript:toggle_inner_state(\'test-038\')">TEST 38: Look at a YUGE Dataset</a></h3>');
                    echo('<div class="main_div inner_container">');
                        echo('<div class="main_div" style="margin-right:2em">');
                            echo('<p class="explain">First, let\'s just count how many records we "own."</p>');
                            echo('<p class="explain">We expect to see 697332 "owned" records.</p>');
                        echo('</div>');
                        owner_test_relay(1);
                    echo('</div>');
                echo('</div>');
            
                echo('<div id="test-039" class="inner_closed">');
                    echo('<h3 class="inner_header"><a href="javascript:toggle_inner_state(\'test-039\')">TEST 39: Do a radius location search on a big dataset.</a></h3>');
                    echo('<div class="main_div inner_container">');
                        echo('<div class="main_div" style="margin-right:2em">');
                            echo('<p class="explain">This test looks at the US borders, and does a number of tests.</p>');
                            echo('<p class="explain">The "owner" instance we\'ll be testing has only East Coast USA datapoints.</p>');
                        echo('</div>');
                        owner_test_relay(2);
                    echo('</div>');
                echo('</div>');
            
                echo('<div id="test-040" class="inner_closed">');
                    echo('<h3 class="inner_header"><a href="javascript:toggle_inner_state(\'test-040\')">TEST 40: Go on a vacation to Florida!</a></h3>');
                    echo('<div class="main_div inner_container">');
                        echo('<div class="main_div" style="margin-right:2em">');
                            echo('<p class="explain">Same dataset, but now we\'re taking a Florida vacation.</p>');
                        echo('</div>');
                        owner_test_relay(3);
                    echo('</div>');
                echo('</div>');
            } else {
                echo('<h3>TESTS SKIPPED, BECAUSE THE SERVER CAN\'T HANDLE THEM.</h3>');
            }
            echo('</div>');
        echo('</div>');
    echo('</div>');
$buffer = ob_get_clean();
die($buffer);
?>
