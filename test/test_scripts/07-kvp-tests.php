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

$config_file_path = dirname(__FILE__).'/../config/s_config.class.php';

require_once($config_file_path);
require_once(dirname(dirname(__FILE__)).'/functions.php');

function kvp_test_relay($in_test_number, $in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $function_name = sprintf('kvp_test_%02d', $in_test_number);
    
    $function_name($in_login, $in_hashed_password, $in_password);
}
    
function kvp_test_01($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $access_instance = NULL;
    
    if ( !defined('LGV_ACCESS_CATCHER') ) {
        define('LGV_ACCESS_CATCHER', 1);
    }
    
    require_once(CO_Config::main_class_dir().'/co_cobra.class.php');
    
    $access_instance = new CO_Cobra($in_login, $in_hashed_password, $in_password);
    
    if ($access_instance->valid) {
        $st1 = microtime(TRUE);
        $test_subject = $access_instance->make_new_blank_record('CO_KeyValue');
        
        if (isset($test_subject) && $test_subject ) {
            $success = $test_subject->set_key('Rick Moranis', 'Sigorney Weaver');
            if ($success) {
                $the_gatekeeper = $access_instance->get_value_for_key('Rick Moranis');
                
                if (isset($the_gatekeeper)) {
                    if ($the_gatekeeper == 'Sigorney Weaver') {
                        $access_instance = NULL;
                        $access_instance = new CO_Cobra($in_login, $in_hashed_password, $in_password);
    
                        if ($access_instance->valid) {
                            $the_gatekeeper = $access_instance->get_value_for_key('Rick Moranis');
                        
                            if (isset($the_gatekeeper)) {
                                if ($the_gatekeeper == 'Sigorney Weaver') {
                                    echo('<h3>WOOT! Tests Pass!</h3>');
                                } else {
                                    echo("<h2 style=\"color:red;font-weight:bold\">The Keymaster lost his girlfriend!</h2>");
                                }
                            } else {
                                echo("<h2 style=\"color:red;font-weight:bold\">The Keymaster is lost!</h2>");
                                echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$access_instance->error->error_code.') '.$access_instance->error->error_name.' ('.$access_instance->error->error_description.')</p>');
                            }
                        } else {
                            echo("<h2 style=\"color:red;font-weight:bold\">There was an error with accessing the Keymaster!</h2>");
                            echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$access_instance->error->error_code.') '.$access_instance->error->error_name.' ('.$access_instance->error->error_description.')</p>');
                        }
                    } else {
                        echo("<h2 style=\"color:red;font-weight:bold\">The Keymaster has no girlfriend!</h2>");
                    }
                } else {
                    echo("<h2 style=\"color:red;font-weight:bold\">We could not find the Keymaster!</h2>");
                }
            } else {
                echo("<h2 style=\"color:red;font-weight:bold\">The Keymaster was unable to perform!</h2>");
                echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$test_subject->error->error_code.') '.$test_subject->error->error_name.' ('.$test_subject->error->error_description.')</p>');
            }
        } else {
            echo("<h2 style=\"color:red;font-weight:bold\">The Keymaster was eaten by Zool!</h2>");
            echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$access_instance->error->error_code.') '.$access_instance->error->error_name.' ('.$access_instance->error->error_description.')</p>');
        }
        
        $fetchTime = sprintf('%01.3f', microtime(TRUE) - $st1);
        echo('<p>The test took '.$fetchTime.' seconds.</p>');
    } else {
        echo("<h2 style=\"color:red;font-weight:bold\">The access instance is not valid!</h2>");
        echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$access_instance->error->error_code.') '.$access_instance->error->error_name.' ('.$access_instance->error->error_description.')</p>');
    }
}
    
function kvp_test_02($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $access_instance = NULL;
    
    if ( !defined('LGV_ACCESS_CATCHER') ) {
        define('LGV_ACCESS_CATCHER', 1);
    }
    
    require_once(CO_Config::main_class_dir().'/co_cobra.class.php');
    
    $access_instance = new CO_Cobra($in_login, $in_hashed_password, $in_password);
    
    if ($access_instance->valid) {
        $st1 = microtime(TRUE);
        $test_subject = $access_instance->make_new_blank_record('CO_KeyValue');
        
        if (isset($test_subject) && $test_subject ) {
            $the_text_payload = file_get_contents(dirname(dirname(__FILE__)).'/config/TheGreatShadow.txt');
            $success = $test_subject->set_key('The Great Shadow', $the_text_payload);
            if ($success) {
                $text_value = $access_instance->get_value_for_key('The Great Shadow');
                
                if (isset($text_value)) {
                    if ($text_value == $the_text_payload) {
                        $access_instance = NULL;
                        $access_instance = new CO_Cobra($in_login, $in_hashed_password, $in_password);
    
                        if ($access_instance->valid) {
                            $text_value = $access_instance->get_value_for_key('The Great Shadow');
                        
                            if (isset($text_value)) {
                                if ($text_value == $the_text_payload) {
                                    echo('<h3>WOOT! Tests Pass!</h3>');
                                } else {
                                    echo("<h2 style=\"color:red;font-weight:bold\">The payloads don\'t match!</h2>");
                                }
                            } else {
                                echo("<h2 style=\"color:red;font-weight:bold\">There was no text payload!</h2>");
                                echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$access_instance->error->error_code.') '.$access_instance->error->error_name.' ('.$access_instance->error->error_description.')</p>');
                            }
                        } else {
                            echo("<h2 style=\"color:red;font-weight:bold\">There was an error with accessing the value!</h2>");
                            echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$access_instance->error->error_code.') '.$access_instance->error->error_name.' ('.$access_instance->error->error_description.')</p>');
                        }
                    } else {
                        echo("<h2 style=\"color:red;font-weight:bold\">The initial payloads don\'t match!</h2>");
                    }
                } else {
                    echo("<h2 style=\"color:red;font-weight:bold\">We could not find the value!</h2>");
                }
            } else {
                echo("<h2 style=\"color:red;font-weight:bold\">The value was not saved!</h2>");
                echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$test_subject->error->error_code.') '.$test_subject->error->error_name.' ('.$test_subject->error->error_description.')</p>');
            }
        } else {
            echo("<h2 style=\"color:red;font-weight:bold\">The user was not allowed to save the value!</h2>");
            echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$access_instance->error->error_code.') '.$access_instance->error->error_name.' ('.$access_instance->error->error_description.')</p>');
        }
        
        $fetchTime = sprintf('%01.3f', microtime(TRUE) - $st1);
        echo('<p>The test took '.$fetchTime.' seconds.</p>');
    } else {
        echo("<h2 style=\"color:red;font-weight:bold\">The access instance is not valid!</h2>");
        echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$access_instance->error->error_code.') '.$access_instance->error->error_name.' ('.$access_instance->error->error_description.')</p>');
    }
}
    
function kvp_test_03($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $access_instance = NULL;
    
    if ( !defined('LGV_ACCESS_CATCHER') ) {
        define('LGV_ACCESS_CATCHER', 1);
    }
    
    require_once(CO_Config::main_class_dir().'/co_cobra.class.php');
    
    $access_instance = new CO_Cobra($in_login, $in_hashed_password, $in_password);
    
    if ($access_instance->valid) {
        $st1 = microtime(TRUE);
        $test_subject = $access_instance->make_new_blank_record('CO_KeyValue');
        
        if (isset($test_subject) && $test_subject ) {
            $the_image_payload = file_get_contents(dirname(dirname(__FILE__)).'/config/Yosemite.jpg');
            $success = $test_subject->set_key('Yosemite', $the_image_payload);
            if ($success) {
                $retrieved_payload = $access_instance->get_value_for_key('Yosemite');
                
                if (isset($retrieved_payload)) {
                    if ($retrieved_payload == $the_image_payload) {
                        $access_instance = NULL;
                        $access_instance = new CO_Cobra($in_login, $in_hashed_password, $in_password);
    
                        if ($access_instance->valid) {
                            $retrieved_payload = $access_instance->get_value_for_key('Yosemite');
                        
                            if (isset($retrieved_payload)) {
                                if ($retrieved_payload == $the_image_payload) {
                                    echo('<div id="yosemite-image" class="inner_closed">');
                                        echo('<h3 class="inner_header"><a href="javascript:toggle_inner_state(\'yosemite-image\')">WOOT! Tests Pass!</a></h3>');
                                        echo('<div class="main_div inner_container">');
                                            $image_base64_data = base64_encode ($the_image_payload);
                                            echo('<h4>BEFORE:</h4>');
                                            echo('<img src="data:image/jpeg;base64,'.$image_base64_data.'" alt="Nice View" />');
                                            $image_base64_data = base64_encode ($retrieved_payload);
                                            echo('<h4>AFTER:</h4>');
                                            echo('<img src="data:image/jpeg;base64,'.$image_base64_data.'" alt="Nice View" />');
                                        echo('</div>');
                                    echo('</div>');
                                } else {
                                    echo("<h2 style=\"color:red;font-weight:bold\">The payloads don\'t match!</h2>");
                                }
                            } else {
                                echo("<h2 style=\"color:red;font-weight:bold\">There was no text payload!</h2>");
                                if ($access_instance->error) {
                                    echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$access_instance->error->error_code.') '.$access_instance->error->error_name.' ('.$access_instance->error->error_description.')</p>');
                                }
                            }
                        } else {
                            echo("<h2 style=\"color:red;font-weight:bold\">There was an error with accessing the value!</h2>");
                            if ($access_instance->error) {
                                echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$access_instance->error->error_code.') '.$access_instance->error->error_name.' ('.$access_instance->error->error_description.')</p>');
                            }
                        }
                    } else {
                        echo("<h2 style=\"color:red;font-weight:bold\">The initial payloads don\'t match!</h2>");
                    }
                } else {
                    echo("<h2 style=\"color:red;font-weight:bold\">We could not find the value!</h2>");
                }
            } else {
                echo("<h2 style=\"color:red;font-weight:bold\">The value was not saved!</h2>");
                if ($test_subject->error) {
                    echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$test_subject->error->error_code.') '.$test_subject->error->error_name.' ('.$test_subject->error->error_description.')</p>');
                }
            }
        } else {
            echo("<h2 style=\"color:red;font-weight:bold\">The user was not allowed to save the value!</h2>");
            if ($access_instance->error) {
                echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$access_instance->error->error_code.') '.$access_instance->error->error_name.' ('.$access_instance->error->error_description.')</p>');
            }
        }
        
        $fetchTime = sprintf('%01.3f', microtime(TRUE) - $st1);
        echo('<p>The test took '.$fetchTime.' seconds.</p>');
    } else {
        echo("<h2 style=\"color:red;font-weight:bold\">The access instance is not valid!</h2>");
        if ($access_instance->error) {
            echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$access_instance->error->error_code.') '.$access_instance->error->error_name.' ('.$access_instance->error->error_description.')</p>');
        }
    }
}

ob_start();

    prepare_databases('kvp_tests');
    
    echo('<div class="test-wrapper" style="display:table;margin-left:auto;margin-right:auto;text-align:left">');            
        echo('<h1 class="header">KEY/VALUE TESTS</h1>');

        echo('<div id="kvp-tests" class="closed">');
            echo('<h2 class="header"><a href="javascript:toggle_main_state(\'kvp-tests\')">SIMPLE STORAGE TESTS</a></h2>');
            echo('<div class="container">');
            
                echo('<div id="test-041" class="inner_closed">');
                    echo('<h3 class="inner_header"><a href="javascript:toggle_inner_state(\'test-041\')">TEST 41: Store and retrieve small data -No Login</a></h3>');
                    echo('<div class="main_div inner_container">');
                        echo('<div class="main_div" style="margin-right:2em">');
                            echo('<p class="explain">We start by not logging in. We expect this to fail.</p>');
                        echo('</div>');
                        kvp_test_relay(1);
                    echo('</div>');
                echo('</div>');
            
                echo('<div id="test-042" class="inner_closed">');
                    echo('<h3 class="inner_header"><a href="javascript:toggle_inner_state(\'test-042\')">TEST 42: Store and retrieve small data -God Login</a></h3>');
                    echo('<div class="main_div inner_container">');
                        echo('<div class="main_div" style="margin-right:2em">');
                            echo('<p class="explain">Now we login with the "God" login. This should work.</p>');
                        echo('</div>');
                        kvp_test_relay(1, 'admin', '', CO_Config::$god_mode_password);
                    echo('</div>');
                echo('</div>');
            
                echo('<div id="test-043" class="inner_closed">');
                    echo('<h3 class="inner_header"><a href="javascript:toggle_inner_state(\'test-043\')">TEST 43: Store and retrieve large text data -God Login</a></h3>');
                    echo('<div class="main_div inner_container">');
                        echo('<div class="main_div" style="margin-right:2em">');
                            echo('<p class="explain">We save and retrieve the entire text of "The Great Shadow," by Arthur Conan Doyle.</p>');
                        echo('</div>');
                        kvp_test_relay(2, 'admin', '', CO_Config::$god_mode_password);
                    echo('</div>');
                echo('</div>');
            
                echo('<div id="test-044" class="inner_closed">');
                    echo('<h3 class="inner_header"><a href="javascript:toggle_inner_state(\'test-044\')">TEST 44: Store and retrieve large image data -God Login</a></h3>');
                    echo('<div class="main_div inner_container">');
                        echo('<div class="main_div" style="margin-right:2em">');
                            echo('<p class="explain">We save and retrieve a 1279 X 835 JPEG image of Yosemite Park.</p>');
                        echo('</div>');
                        kvp_test_relay(3, 'admin', '', CO_Config::$god_mode_password);
                    echo('</div>');
                echo('</div>');

            echo('</div>');
        echo('</div>');
    echo('</div>');
$buffer = ob_get_clean();
die($buffer);
?>
