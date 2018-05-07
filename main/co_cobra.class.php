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
    
    /***********************/
    /**
    Factory Function.
    
    This vets the CHAMELEON instance, and makes sure that it's valid before returning a constructed COBRA.
    
    \returns an instance of CO_Cobra upon success. If there was an error set by COBRA (or CHAMELEON), or the vetting failed, that is returned instead of a COBRA instance.
     */
    static function make_cobra($in_chameleon_instance) {
        $ret = NULL;
        
	    // We must have a valid CHAMELEON instance that is logged in. The login user must be a COBRA Manager user (the standard logins cannot use COBRA).
	    if (isset($in_chameleon_instance)
	        && ($in_chameleon_instance instanceof CO_Chameleon)
	        && $in_chameleon_instance->security_db_available()
	        && ($in_chameleon_instance->god_mode() || ($in_chameleon_instance->get_login_item() instanceof CO_Login_Manager))) {
            $ret = new CO_Cobra($in_chameleon_instance);
        } elseif (isset($in_chameleon_instance) && ($in_chameleon_instance instanceof CO_Chameleon)) {
            $ret = new LGV_Error(   CO_COBRA_Lang_Common::$cobra_error_code_user_not_authorized,
                                    CO_COBRA_Lang::$cobra_error_name_user_not_authorized,
                                    CO_COBRA_Lang::$cobra_error_desc_user_not_authorized);
        } else {
            $ret = new LGV_Error(   CO_COBRA_Lang_Common::$cobra_error_code_invalid_chameleon,
                                    CO_COBRA_Lang::$cobra_error_name_invalid_chameleon,
                                    CO_COBRA_Lang::$cobra_error_desc_invalid_chameleon);
        }
    
        return $ret;
    }
    
    /***********************************************************************************************************************/    
    /***********************/
    /**
    The constructor.
    
    We declare it private to prevent it being instantiated outside the factory.
     */
	private function __construct(    $in_chameleon_instance = NULL   ///< The CHAMELEON instance associated with this COBRA instance.
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
    This fetches a user from a given login ID.
    
    The user may be created, if the current login ia a Login Manager, and the second parameter is set to TRUE.
    
    \returns an instance of a user collection. If new, it will be blank.
     */
    public function get_user_from_login(    $in_login_id = NULL,                ///< The login ID that is associated with the user collection. If NULL, then the current login is used.
                                            $in_make_user_if_necessary = FALSE  ///< If TRUE (Default is FALSE), then the user will be created if it does not already exist. Ignored, if we are not a Login Manager.
                                        ) {
        $user = $this->_chameleon_instance->get_user_from_login($in_login_id);   // First, see if it's already a thing.
        
        if (!$user && $in_make_user_if_necessary && ($this->_chameleon_instance->get_login_item() instanceof CO_Login_Manager)) {   // If not, we will create a new one, based on the given login. We must be a manager.
            if (isset($in_login_id) && (0 < intval($in_login_id))) {    // See if they seek a different login.
                $login_id = intval($in_login_id);
            }
            
            // Assuming all is well, we need to create a new user. We have to be a login manager to do this.
            if (isset($in_login_id) && (0 < intval($in_login_id))) {
                $login_item = $this->_chameleon_instance->get_login_item($in_login_id);
                
                if (isset($login_item) && ($login_item instanceof CO_Security_Login)) {
                    if (!$this->_chameleon_instance->check_user_exists($in_login_id)) {
                        $user = $this->_chameleon_instance->make_new_blank_record('CO_User_Collection');
                    
                        if ($user) {
                            if (!isset($user->error)) {
                                $user->set_login($in_login_id); // We set the user's login instance to the login instance we're using as the basis.
                        
                                if (!isset($user->error)) {
                                    $user->set_write_security_id($in_login_id); // Make sure the user can modify their own record.
                                    if (isset($user->error)) {
                                        $this->error = $user->error;
                                        $user->delete_from_db();
                                        $user = NULL;
                                    }
                                } else {
                                    $this->error = $user->error;
                                    $user->delete_from_db();
                                    $user = NULL;
                                }
                            } else {
                                $this->error = $user->error;
                                $user->delete_from_db();
                                $user = NULL;
                            }
                        } else {
                            $this->error = new LGV_Error(   CO_COBRA_Lang_Common::$cobra_error_code_instance_failed_to_initialize,
                                                            CO_COBRA_Lang::$cobra_error_name_instance_failed_to_initialize,
                                                            CO_COBRA_Lang::$cobra_error_desc_instance_failed_to_initialize);
                        }
                    } else {
                        $this->error = new LGV_Error(   CO_COBRA_Lang_Common::$cobra_error_code_user_already_exists,
                                                        CO_COBRA_Lang::$cobra_error_name_user_already_exists,
                                                        CO_COBRA_Lang::$cobra_error_desc_user_already_exists);
                    }
                } else {
                    $this->error = new LGV_Error(   CO_COBRA_Lang_Common::$cobra_error_code_login_unavailable,
                                                    CO_COBRA_Lang::$cobra_error_name_login_unavailable,
                                                    CO_COBRA_Lang::$cobra_error_desc_login_unavailable);
                }
            } else {
                $this->error = new LGV_Error(   CO_COBRA_Lang_Common::$cobra_error_code_login_unavailable,
                                                CO_COBRA_Lang::$cobra_error_name_login_unavailable,
                                                CO_COBRA_Lang::$cobra_error_desc_login_unavailable);
            }
        } elseif (!($this->_chameleon_instance->get_login_item() instanceof CO_Login_Manager)) {
            $this->error = new LGV_Error(   CO_COBRA_Lang_Common::$cobra_error_code_user_not_authorized,
                                            CO_COBRA_Lang::$cobra_error_name_user_not_authorized,
                                            CO_COBRA_Lang::$cobra_error_desc_user_not_authorized);
        }
        
        return $user;
    }
};
