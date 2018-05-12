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

require_once(dirname(__FILE__).'/co_cobra_login.class.php');

/***************************************************************************************************************************/
/**
 */
class CO_Login_Manager extends CO_Cobra_Login {
    protected   $_added_new_id; ///< This is a very temporary, ephemeral semaphore that we use to allow us to add an ID when we create a new object.
    
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
        $this->_added_new_id = NULL;
    }
    
    /***********************/
    /**
    This allows us to add one single ID to our list.
    We set our ephemeral ID, then we add the ID, which should pass, just this once.
    
    \returns TRUE, if the operation succeeded.
     */
    public function add_new_login_id(   $in_login_id    ///< The integer ID of the new login item.
                                    ) {
        $this->_added_new_id = intval($in_login_id);
        $ret = $this->add_id($in_login_id);
        unset($this->_added_new_id);
        return $ret;
    }
    
    /***********************/
    /**
    A user cannot change their own ID list. However, managers get a special one-time exemption.
    
    \returns TRUE, if the current logged-in user can edit IDs for this login.
     */
    public function user_can_edit_ids() {
        $ret = parent::user_can_edit_ids();
        
        // God objects can only be edited by themselves.
        if (!$ret && !$this->i_am_a_god() && $this->_added_new_id) {
            $test_obj = $this->get_access_object();
            
            // It's a two-stage test. We also need to make sure that the CHAMELEON instance agrees that this is kosher.
            if ($test_obj instanceof CO_Chameleon) {
                $ret = $test_obj->test_access($this->_added_new_id);
            }
        }
        
        return $ret;
    }
    
    /***********************/
    /**
    A manager can only have one token label object. This fetches it from the CHAMELEON instance.
    
    If the object does not exist, then a new one is created.
    
    \returns the manager's token label object.
     */
    public function get_my_token_label_object() {
        $ret = NULL;
        
        $token_label_objects = $this->get_access_id()->get_security_token_labels();
        
        if (isset($token_label_objects) && is_array($token_label_objects) && count($token_label_objects)) {
            foreach ($token_label_objects as $object) {
                if ($object->get_manager_id() == $this->id()) {
                    $ret = $object;
                    break;
                }
            }
        }
        
        // See if we need to create one.
        if (!isset($ret) || !($ret instanceof CO_Token_Labels)) {
        }
        
        return $ret;
    }
};
