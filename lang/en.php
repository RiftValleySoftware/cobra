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
defined( 'LGV_LANG_CATCHER' ) or die ( 'Cannot Execute Directly' );	// Makes sure that this file is in the correct context.
    
/***************************************************************************************************************************/
/**
 */
class CO_COBRA_Lang {
    static  $cobra_error_name_invalid_chameleon = 'Invalid CHAMELEON Instance';
    static  $cobra_error_desc_invalid_chameleon = 'COBRA cannot be initialized with the given CHAMELEON instance.';
    static  $cobra_error_name_user_not_authorized = 'Current User Not Authorized';
    static  $cobra_error_desc_user_not_authorized = 'The current user is not authorized to create user objects.';
    static  $cobra_error_name_instance_failed_to_initialize = 'User Not Initialized';
    static  $cobra_error_desc_instance_failed_to_initialize = 'The user object failed to initialize properly.';
    static  $cobra_error_name_user_already_exists = 'User Already Exists';
    static  $cobra_error_desc_user_already_exists = 'The specified user already exists.';
    static  $cobra_error_name_login_unavailable = 'The Login Is Unavailable';
    static  $cobra_error_desc_login_unavailable = 'The reqested login is unavailable to this user.';
    static  $cobra_error_name_login_error = 'Login Error';
    static  $cobra_error_desc_login_error = 'There was an unspecified error with this login.';
}
?>