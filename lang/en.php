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
    static  $cobra_error_name_user_not_authorized = 'Current User Not Authorized';
    static  $cobra_error_desc_user_not_authorized = 'The current user is not authorized to create user objects.';
    static  $cobra_error_name_instance_failed_to_initialize = 'User Not Initialized';
    static  $cobra_error_desc_instance_failed_to_initialize = 'The user object failed to initialize properly.';
}
?>