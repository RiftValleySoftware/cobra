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
defined( 'LGV_ACCESS_CATCHER' ) or die ( 'Cannot Execute Directly' );	// Makes sure that this file is in the correct context.

define('__COBRA_VERSION__', '1.0.0.0000');

require_once(CO_Config::chameleon_main_class_dir().'/co_chameleon.class.php');

$lang = CO_Config::$lang;

global $g_lang_override;    // This allows us to override the configured language at initiation time.

if (isset($g_lang_override) && $g_lang_override && file_exists(CO_Config::lang_class_dir().'/'.$g_lang_override.'.php')) {
    $lang = $g_lang_override;
}

$lang_file = CO_Config::lang_class_dir().'/'.$lang.'.php';
$lang_common_file = CO_Config::lang_class_dir().'/common.inc.php';

if ( !defined('LGV_LANG_CATCHER') ) {
    define('LGV_LANG_CATCHER', 1);
}

require_once($lang_file);
require_once($lang_common_file);

/***************************************************************************************************************************/
/**
 */
class CO_Cobra {
    private $_chameleon_instance = NULL;    ///< This is the CHAMELEON instance that is associated with this COBRA instance.
    
    /***********************************************************************************************************************/    
    /***********************/
    /**
    The constructor.
     */
	public function __construct(    $in_chameleon_instance = NULL   ///< The CHAMELEON instance associated with this COBRA instance.
	                            ) {
	    $this->_chameleon_instance = $in_chameleon_instance;
	    $this->version = __COBRA_VERSION__;
    }
    
    /***********************/
    /**
    \returns an array of integers, with each one representing a special security token for editing security items.
     */
    public function get_security_ids() {
        return $this->_chameleon_instance->get_security_ids();
    }
    
    /***********************/
    /**
    This createsa a new blank user object to go with a login (given as an ID).
    
    \returns a new instance of a user collection.
     */
    public function make_user_from_login(   $in_login_id = NULL ///< The login ID that is associated with the user collection. If NULL, then the current login is used.
                                        ) {
        $user = $this->_chameleon_instance->get_user_from_login($in_login_id);   // First, see if it's already a thing.
        
        if (!$user) {   // If not, we will create a new one, based on the given login.
            $login_id = $this->_chameleon_instance->get_login_id();  // Default is the current login.
        
            if (isset($in_login_id) && (0 < intval($in_login_id))) {    // See if they seek a different login.
                $login_id = intval($in_login_id);
            }
            
            // Assuming all is well, we need to create a new user. We have to be a login manager to do this.
            if (isset($in_login_id) && (0 < intval($in_login_id))) {
                $login_item = $this->_chameleon_instance->get_login_item($in_login_id);
                
                if (isset($login_item) && ($login_item instanceof CO_Security_Login)) {
                    $user = $this->_chameleon_instance->make_new_blank_record('CO_User_Collection');
                
                    if ($user) {
                        $user->set_login($in_login_id);
                    } else {
                        $this->error = new LGV_Error(   CO_COBRA_Lang_Common::$cobra_error_code_instance_failed_to_initialize,
                                                        CO_COBRA_Lang::$cobra_error_name_instance_failed_to_initialize,
                                                        CO_COBRA_Lang::$cobra_error_desc_instance_failed_to_initialize);
                    }
                } else {
                    $this->error = new LGV_Error(   CO_COBRA_Lang_Common::$cobra_error_code_instance_failed_to_initialize,
                                                    CO_COBRA_Lang::$cobra_error_name_instance_failed_to_initialize,
                                                    CO_COBRA_Lang::$cobra_error_desc_instance_failed_to_initialize);
                }
            } elseif (!($this->_chameleon_instance->get_user_object() instanceof CO_Login_Manager)) {
                $this->error = new LGV_Error(   CO_COBRA_Lang_Common::$cobra_error_code_user_not_authorized,
                                                CO_COBRA_Lang::$cobra_error_name_user_not_authorized,
                                                CO_COBRA_Lang::$cobra_error_desc_user_not_authorized);
            }
        }
        
        return $user;
    }
};
