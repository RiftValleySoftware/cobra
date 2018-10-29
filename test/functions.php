<?php
/***************************************************************************************************************************/
/**
    COBRA Security Administration Layer
    
    © Copyright 2018, Little Green Viper Software Development LLC/The Great Rift Valley Software Company
    
    LICENSE:
    
    FOR OPEN-SOURCE (COMMERCIAL OR FREE):
    This code is released as open source under the GNU Plublic License (GPL), Version 3.
    You may use, modify or republish this code, as long as you do so under the terms of the GPL, which requires that you also
    publish all modificanions, derivative products and license notices, along with this code.
    
    UNDER SPECIAL LICENSE, DIRECTLY FROM LITTLE GREEN VIPER OR THE GREAT RIFT VALLEY SOFTWARE COMPANY:
    It is NOT to be reused or combined into any application, nor is it to be redistributed, republished or sublicensed,
    unless done so, specifically WITH SPECIFIC, WRITTEN PERMISSION from Little Green Viper Software Development LLC,
    or The Great Rift Valley Software Company.

    Little Green Viper Software Development: https://littlegreenviper.com
    The Great Rift Valley Software Company: https://riftvalleysoftware.com

    Little Green Viper Software Development: https://littlegreenviper.com
*/
    if (!class_exists('CO_Config')) {
        $config_file_path = dirname(__FILE__).'/config/s_config.class.php';
    
        date_default_timezone_set ( 'UTC' );
    
        if ( !defined('LGV_CONFIG_CATCHER') ) {
            define('LGV_CONFIG_CATCHER', 1);
        }
    
        require_once($config_file_path);
    }
    
    if ( !defined('LGV_ACCESS_CATCHER') ) {
        define('LGV_ACCESS_CATCHER', 1);
    }
    
    require_once(CO_Config::main_class_dir().'/co_cobra.class.php');
    require_once(CO_Config::chameleon_main_class_dir().'/co_chameleon.class.php');
    
    function make_chameleon($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
        $chameleon_instance = NULL;
    
        $chameleon_instance = new CO_Chameleon($in_login, $in_hashed_password, $in_password);
        if (isset($chameleon_instance) && $chameleon_instance) {
            if ($chameleon_instance->valid) {
                echo("<h2 style=\"color:green;\">The CHAMELEON instance is valid!</h2>");
            } else {
                echo("<h2 style=\"color:red;font-weight:bold\">The CHAMELEON instance is not valid!</h2>");
                echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$chameleon_instance->error->error_code.') '.$chameleon_instance->error->error_name.' ('.$chameleon_instance->error->error_description.')</p>');
            }
        }
    
        return $chameleon_instance;
    }
    
    function make_cobra($chameleon_instance = NULL) {
        $cobra_instance = CO_Cobra::make_cobra($chameleon_instance);
        
        if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
            echo("<h2 style=\"color:green;\">The COBRA instance is valid!</h2>");
        } elseif (isset($cobra_instance) && isset($cobra_instance->error) && ($cobra_instance->error instanceof LGV_Error)) {
            echo("<h2 style=\"color:red;font-weight:bold\">The COBRA instance is not valid!</h2>");
            echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$cobra_instance->error->error_code.') '.$cobra_instance->error->error_name.' ('.$cobra_instance->error->error_description.')</p>');
        } else {
            echo("<h2 style=\"color:red;font-weight:bold\">The COBRA instance is not valid!</h2>");
        }
    
        return $cobra_instance;
    }
    
    function prepare_databases($in_file_prefix) {
        if ( !defined('LGV_DB_CATCHER') ) {
            define('LGV_DB_CATCHER', 1);
        }

        require_once(CO_Config::db_class_dir().'/co_pdo.class.php');
    
        if ( !defined('LGV_ERROR_CATCHER') ) {
            define('LGV_ERROR_CATCHER', 1);
        }

        require_once(CO_Config::badger_shared_class_dir().'/error.class.php');
        
        $pdo_data_db = NULL;
        try {
            $pdo_data_db = new CO_PDO(CO_Config::$data_db_type, CO_Config::$data_db_host, CO_Config::$data_db_name, CO_Config::$data_db_login, CO_Config::$data_db_password);
        } catch (Exception $exception) {
// die('<pre style="text-align:left">'.htmlspecialchars(print_r($exception, true)).'</pre>');
                    $error = new LGV_Error( 1,
                                            'INITIAL DATABASE SETUP FAILURE',
                                            'FAILED TO INITIALIZE A DATABASE!',
                                            $exception->getFile(),
                                            $exception->getLine(),
                                            $exception->getMessage());
                echo('<h1 style="color:red">ERROR WHILE TRYING TO ACCESS DATABASES!</h1>');
                echo('<pre>'.htmlspecialchars(print_r($error, true)).'</pre>');
        }
        
        if ($pdo_data_db) {
            $pdo_security_db = new CO_PDO(CO_Config::$sec_db_type, CO_Config::$sec_db_host, CO_Config::$sec_db_name, CO_Config::$sec_db_login, CO_Config::$sec_db_password);
            
            if ($pdo_security_db) {
                $data_db_sql = file_get_contents(CO_Config::test_class_dir().'/sql/'.$in_file_prefix.'_data_'.CO_Config::$data_db_type.'.sql');
                $security_db_sql = file_get_contents(CO_Config::test_class_dir().'/sql/'.$in_file_prefix.'_security_'.CO_Config::$sec_db_type.'.sql');
                
                $error = NULL;
        
                try {
                    $pdo_data_db->preparedExec($data_db_sql);
                    $pdo_security_db->preparedExec($security_db_sql);
                } catch (Exception $exception) {
// die('<pre style="text-align:left">'.htmlspecialchars(print_r($exception, true)).'</pre>');
                    $error = new LGV_Error( 1,
                                            'INITIAL DATABASE SETUP FAILURE',
                                            'FAILED TO INITIALIZE A DATABASE!',
                                            $exception->getFile(),
                                            $exception->getLine(),
                                            $exception->getMessage());
                                                    
                echo('<h1 style="color:red">ERROR WHILE TRYING TO OPEN DATABASES!</h1>');
                echo('<pre>'.htmlspecialchars(print_r($error, true)).'</pre>');
                }
            return;
            }
        }
        echo('');
        echo('<h1 style="color:red">UNABLE TO OPEN DATABASE!</h1>');
    }
    
    function display_raw_hierarchy($in_hierarchy_array, $modifier) {
        if (isset($in_hierarchy_array) && is_array($in_hierarchy_array) && count($in_hierarchy_array)) {
            if (isset($in_hierarchy_array['children'])) {
                echo('<div id="collection_wrapper_'.$in_hierarchy_array['object']->id().'_'.$modifier.'" class="inner_closed">');
                    echo('<h3 class="inner_header"><a href="javascript:toggle_inner_state(\'collection_wrapper_'.$in_hierarchy_array['object']->id().'_'.$modifier."')\">");
            } else {
                echo('<h3 class="inner_header">');
            }
            
            echo($in_hierarchy_array['object']->name);
            echo(' (READ: '.$in_hierarchy_array['object']->read_security_id);
            echo(', WRITE: '.$in_hierarchy_array['object']->write_security_id.')');
    
            if (isset($in_hierarchy_array['children'])) {
                echo(" <em>(".count($in_hierarchy_array['children']).")</em>");
                echo('</a></h3>');
                foreach ($in_hierarchy_array['children'] as $child) {
                    echo('<div class="main_div inner_container">');
                        display_raw_hierarchy($child, $modifier);
                    echo('</div>');
                }
                echo('</div>');
            } else {
                echo('</h3>');
            }
        }
    }
            
    function hierarchicalDisplayRecord($in_record, $in_hierarchy_level = 0, $in_parent_object = NULL, $shorty = false) {
        $daddy = isset($in_parent_object) && $in_parent_object ? $in_parent_object->whosYourDaddy($in_record) : NULL;
    
        if ($in_hierarchy_level) {
            echo('<div style="margin-left:'.strval($in_hierarchy_level + 2).'em;margin-top:1em;border:'.strval($in_hierarchy_level + 1).'px dashed black;padding:0.125em">');
            
            if (NULL != $daddy) {
                echo("<p>Ancestry is ".(($daddy == $in_parent_object) ? '' : 'un')."confirmed</p>");
            }

            echo("<p>Hierarchy level: $in_hierarchy_level</p>");
            
            if (isset($in_parent_object) && method_exists($in_parent_object, 'id')) {
                $id_no = $in_parent_object->id();
                echo("<p>Parent Object ID: $id_no</p>");
            }
        } else {
            echo("<div>");
        }
        
        display_record($in_record, $in_hierarchy_level, $shorty);
        
        echo('</div>');
    }
    
    function display_record($in_record_object, $in_hierarchy_level = 0, $shorty = false) {
        echo("<h5 style=\"margin-top:0.5em\">ITEM ".$in_record_object->id().":</h5>");
        if (isset($in_record_object) && $in_record_object) {
            echo('<div class="inner_div">');
                if (!$shorty) {
                    $access_object = $in_record_object->get_access_object();
                    if ($access_object) {
                        $login_item = $access_object->get_login_item();
                        if ($login_item) {
                            echo('<p style="font-style:italic;margin-top:0.25em;margin-bottom:0.25em">'.'This user ("'.$login_item->name.'"), is logged in as "'.$login_item->login_id.'" ('.implode(', ', $login_item->ids()).').</p>');
                            if ($in_record_object->user_can_write()) {
                                echo('<p style="color: green;font-weight:bold;font-size:large;font-style:italic;margin-bottom:0.25em">This user can modify this record.</p>');
                            }
                        }
                    }
            
                    if (isset($in_record_object->login_id)) {
                        echo("<p>Login ID: ".$in_record_object->login_id."</p>");
                    }
                
                    echo("<p>$in_record_object->class_description</p>");
                    echo("<p>$in_record_object->instance_description</p>");
                    echo("<p>Read: $in_record_object->read_security_id</p>");
                    echo("<p>Write: $in_record_object->write_security_id</p>");
                    if (method_exists($in_record_object, 'get_lang')) {
                        echo("<p>Lang: ".$in_record_object->get_lang()."</p>");
                    }
            
                    if (method_exists($in_record_object, 'owner_id') && intval($in_record_object->owner_id())) {
                        echo("<p>Owner: ".intval($in_record_object->owner_id())."</p>");
                    }
            
                    if (isset($in_record_object->last_access)) {
                        echo("<p>Last access: ".date('g:i:s A, F j, Y', $in_record_object->last_access)."</p>");
                    }
            
                    if (isset($in_record_object->distance)) {
                        $distance = sprintf('%01.3f', $in_record_object->distance);
                        echo("<p>Distance: $distance"."Km</p>");
                    }
                
                    if (method_exists($in_record_object, 'tags')) {
                        if ($in_record_object instanceof CO_Place) {
                            foreach ($in_record_object->address_elements as $key => $value) {
                                if (trim($value)) {
                                    echo("<p>$key: \"$value\"</p>");
                                }
                            }
                            if (($in_record_object instanceof CO_US_Place) && isset($in_record_object->tags()[7])) {
                                echo("<p>Tag 7: \"".$in_record_object->tags()[7]."\"</p>");
                            }
                            if (isset($in_record_object->tags()[8])) {
                                echo("<p>Tag 8: \"".$in_record_object->tags()[8]."\"</p>");
                            }
                            if (isset($in_record_object->tags()[9])) {
                                echo("<p>Tag 9: \"".$in_record_object->tags()[9]."\"</p>");
                            }
                            $address = $in_record_object->get_readable_address();
                            if ($address) {
                                echo("<p>Address: \"$address.\"</p>");
                            }
                        } else {
                            foreach ($in_record_object->tags() as $key => $value) {
                                echo("<p>Tag $key: \"$value\"</p>");
                            }
                        }
                    }
            
                    if ( $in_record_object instanceof CO_Security_Login) {
                        if (method_exists($in_record_object, 'ids')) {
                            echo("<p>IDs: ".implode(', ', $in_record_object->ids())."</p>");
                        } else {
                            echo("<h4>NO IDS!</h4>");
                        }
                    }
                        
                    if (method_exists($in_record_object, 'children')) {
                        $children = $in_record_object->children();
                
                        foreach ($children as $child) {
                            hierarchicalDisplayRecord($child, $in_hierarchy_level + 1, $in_record_object, $shorty);
                        }
                    }
                } else {
                    echo("<p>$in_record_object->name <em>(".$in_record_object->id().")</em></p>");
                }
            echo('</div>');
        } else {
            echo("<h4>Invalid Object!</h4>");
        }
    }
        
?>