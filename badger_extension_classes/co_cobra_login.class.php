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

require_once(CO_Config::db_classes_class_dir().'/co_security_login.class.php');
require_once(dirname(__FILE__).'/co_login_manager.class.php');

/***************************************************************************************************************************/
/**
 */
class CO_Cobra_Login extends CO_Security_Login {
    protected $_special_first_time_security_exemption;

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
        $this->_special_first_time_security_exemption = TRUE;
    }
    
    /***********************/
    /**
    A user cannot change their own ID list.
    
    \returns TRUE, if the current logged-in user can edit IDs for this login.
     */
    public function user_can_edit_ids() {
        $ret = parent::user_can_edit_ids();
        
        // God objects can only be edited by themselves.
        if (!$ret && !$this->i_am_a_god()) {
            $current_user = $this->get_access_object()->get_login_item();
        
            // Only a login Manager can edit, and it can't be us.
            if (($current_user instanceof CO_Login_Manager) && ($current_user->id() != $this->id())) {
                $ids = $this->get_access_object()->get_security_ids();
        
                $my_write_item = intval($this->write_security_id);
        
                if (isset($ids) && is_array($ids) && count($ids)) {
                    $ret = in_array($my_write_item, $ids);
                }
            }
        }
        
        return $ret;
    }

    /***********************/
    /**
    This weird little function allows a creator to once -and only once- add an ID to itself, as long as that ID is for this object.
    This is a "Heisenberg" query. Once it's called, the security exemption is gone.
    
    returns TRUE, if the security exemption was on.
     */
    public function security_exemption() {
        $ret = $this->_special_first_time_security_exemption;
        $this->_special_first_time_security_exemption = FALSE;
        
        return $ret;
    }
};
