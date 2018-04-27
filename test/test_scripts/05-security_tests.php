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

function security_test_relay($in_test_number, $in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $function_name = sprintf('security_test_%02d', $in_test_number);
    
    $function_name($in_login, $in_hashed_password, $in_password);
}
    
function security_test_01($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $access_instance = NULL;
    
    if ( !defined('LGV_ACCESS_CATCHER') ) {
        define('LGV_ACCESS_CATCHER', 1);
    }
    
    require_once(CO_Config::main_class_dir().'/co_cobra.class.php');
    
    $access_instance = new CO_Cobra($in_login, $in_hashed_password, $in_password);
    
    if ($access_instance->valid) {
        $dc_collection = $access_instance->get_single_data_record_by_id(2);
        $va_collection = $access_instance->get_single_data_record_by_id(3);
        $md_collection = $access_instance->get_single_data_record_by_id(4);
        $dc_va_collection = $access_instance->get_single_data_record_by_id(8);
        $dc_area_collection = $access_instance->get_single_data_record_by_id(11);
        
        $dc_1 = $access_instance->get_single_data_record_by_id(144);
        $va_1 = $access_instance->get_single_data_record_by_id(26);
        $md_1 = $access_instance->get_single_data_record_by_id(42);

        $dc_2 = $access_instance->get_single_data_record_by_id(146);
        $va_2 = $access_instance->get_single_data_record_by_id(49);
        $md_2 = $access_instance->get_single_data_record_by_id(94);
        
        $dc_3 = $access_instance->get_single_data_record_by_id(553);
        $va_3 = $access_instance->get_single_data_record_by_id(358);
        $md_3 = $access_instance->get_single_data_record_by_id(95);
        
        $dc_4 = $access_instance->get_single_data_record_by_id(691);
        $va_4 = $access_instance->get_single_data_record_by_id(359);
        $md_4 = $access_instance->get_single_data_record_by_id(103);
        
        $dc_1->set_read_security_id(0);
        $dc_1->set_write_security_id(0);
        $va_1->set_read_security_id(0);
        $va_1->set_write_security_id(0);
        $md_1->set_read_security_id(0);
        $md_1->set_write_security_id(0);
        
        $dc_2->set_read_security_id(0);
        $dc_2->set_write_security_id(9);
        $va_2->set_read_security_id(0);
        $va_2->set_write_security_id(8);
        $md_2->set_read_security_id(0);
        $md_2->set_write_security_id(7);
        
        $dc_3->set_read_security_id(9);
        $dc_3->set_write_security_id(9);
        $va_3->set_read_security_id(8);
        $va_3->set_write_security_id(8);
        $md_3->set_read_security_id(7);
        $md_3->set_write_security_id(7);
        
        $dc_4->set_read_security_id(9);
        $dc_4->set_write_security_id(0);
        $va_4->set_read_security_id(8);
        $va_4->set_write_security_id(0);
        $md_4->set_read_security_id(7);
        $md_4->set_write_security_id(0);
        
        $dc_collection->deleteAllChildren();
        $va_collection->deleteAllChildren();
        $md_collection->deleteAllChildren();
        $dc_va_collection->deleteAllChildren();
        $dc_area_collection->deleteAllChildren();
        
        $va_collection->set_read_security_id(8);

        $dc_collection->appendElements(Array($dc_1, $dc_2, $dc_3, $dc_4));
        $va_collection->appendElements(Array($va_1, $va_2, $va_3, $va_4));
        $md_collection->appendElements(Array($md_1, $md_2, $md_3, $md_4));
        $dc_va_collection->appendElements(Array($dc_collection, $va_collection));
        $dc_area_collection->appendElements(Array($md_collection, $dc_va_collection));
        
        $hierarchy = $dc_area_collection->getHierarchy();
        display_raw_hierarchy($hierarchy, '5_1');
    } else {
        echo("<h2 style=\"color:red;font-weight:bold\">The access instance is not valid!</h2>");
        echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$access_instance->error->error_code.') '.$access_instance->error->error_name.' ('.$access_instance->error->error_description.')</p>');
    }
}
    
function security_test_02($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $access_instance = NULL;
    
    if ( !defined('LGV_ACCESS_CATCHER') ) {
        define('LGV_ACCESS_CATCHER', 1);
    }
    
    require_once(CO_Config::main_class_dir().'/co_cobra.class.php');
    
    $access_instance = new CO_Cobra($in_login, $in_hashed_password, $in_password);
    
    if ($access_instance->valid) {
        $dc_area_collection = $access_instance->get_single_data_record_by_id(11);
        
        $hierarchy = $dc_area_collection->getHierarchy();
        display_raw_hierarchy($hierarchy, '5_2_security_'.$in_login);
    } else {
        echo("<h2 style=\"color:red;font-weight:bold\">The access instance is not valid!</h2>");
        echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$access_instance->error->error_code.') '.$access_instance->error->error_name.' ('.$access_instance->error->error_description.')</p>');
    }
}

ob_start();

    echo('<div class="test-wrapper" style="display:table;margin-left:auto;margin-right:auto;text-align:left">');            
        echo('<h1 class="header">SECURITY TESTS</h1>');

        echo('<div id="security-tests" class="closed">');
            prepare_databases('security_tests');
    
            echo('<h2 class="header"><a href="javascript:toggle_main_state(\'security-tests\')">SECURE COMPONENTS</a></h2>');
            echo('<div class="container">');
            
                echo('<div id="test-034" class="inner_closed">');
                    echo('<h3 class="inner_header"><a href="javascript:toggle_inner_state(\'test-034\')">TEST 34: Set Up A Security Situation</a></h3>');
                    echo('<div class="main_div inner_container">');
                        echo('<div class="main_div" style="margin-right:2em">');
                            echo('<p class="explain">We log in as an "All" admin, and set up a collection with varying levels of security and visibility.</p>');
                        echo('</div>');
                        security_test_relay(1, 'AllAdmin', '', 'CoreysGoryStory');
                    echo('</div>');
                echo('</div>');
            
                echo('<div id="test-035" class="inner_closed">');
                    echo('<h3 class="inner_header"><a href="javascript:toggle_inner_state(\'test-035\')">TEST 35: Check As DC Admin</a></h3>');
                    echo('<div class="main_div inner_container">');
                        echo('<div class="main_div" style="margin-right:2em">');
                            echo('<p class="explain">We log in as the "DC" admin, and make sure we can see what we need to, and not what we don\'t.</p>');
                        echo('</div>');
                        security_test_relay(2, 'DCAdmin', '', 'CoreysGoryStory');
                    echo('</div>');
                echo('</div>');
            
                echo('<div id="test-036" class="inner_closed">');
                    echo('<h3 class="inner_header"><a href="javascript:toggle_inner_state(\'test-036\')">TEST 36: Check As Virginia Admin</a></h3>');
                    echo('<div class="main_div inner_container">');
                        echo('<div class="main_div" style="margin-right:2em">');
                            echo('<p class="explain">We log in as the "VA" admin, and make sure we can see what we need to, and not what we don\'t.</p>');
                        echo('</div>');
                        security_test_relay(2, 'VAAdmin', '', 'CoreysGoryStory');
                    echo('</div>');
                echo('</div>');
            
                echo('<div id="test-037" class="inner_closed">');
                    echo('<h3 class="inner_header"><a href="javascript:toggle_inner_state(\'test-037\')">TEST 37: Check As Maryland Admin</a></h3>');
                    echo('<div class="main_div inner_container">');
                        echo('<div class="main_div" style="margin-right:2em">');
                            echo('<p class="explain">We log in as the "MD" admin, and make sure we can see what we need to, and not what we don\'t.</p>');
                        echo('</div>');
                        security_test_relay(2, 'MDAdmin', '', 'CoreysGoryStory');
                    echo('</div>');
                echo('</div>');

            echo('</div>');
        echo('</div>');
    echo('</div>');
$buffer = ob_get_clean();
die($buffer);
?>
