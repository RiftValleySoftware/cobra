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

require_once(CO_Config::badger_main_class_dir().'/co_access.class.php');

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
class CO_Cobra extends CO_Access {
    /***********************************************************************************************************************/    
    /***********************/
    /**
    The constructor.
     */
	public function __construct(    $in_login_id = NULL,        ///< The login ID
                                    $in_hashed_password = NULL, ///< The password, crypt-hashed
                                    $in_raw_password = NULL     ///< The password, cleartext.
	                            ) {
        parent::__construct($in_login_id, $in_hashed_password, $in_raw_password);
	    $this->version = __COBRA_VERSION__;
    }
    
    /***********************/
    /**
    This is designed to be overloaded by COBRA. In that case, it will return a list of security DB access tokens.
    
    \returns an array of integers, with each one representing a security token.
     */
    public function get_security_access_ids() {
        return Array();
    }
};
