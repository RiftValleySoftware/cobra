<?php
/***************************************************************************************************************************/
/**
    COBRA Security Administration Layer
    
    © Copyright 2018, The Great Rift Valley Software Company
    
    LICENSE:
    
    MIT License
    
    Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation
    files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy,
    modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the
    Software is furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
    OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
    IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF
    CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

    The Great Rift Valley Software Company: https://riftvalleysoftware.com
*/
defined( 'LGV_CONFIG_CATCHER' ) or die ( 'Cannot Execute Directly' );	// Makes sure that this file is in the correct context.

/***************************************************************************************************************************/
/**
 */
define('_MAIN_DB_TYPE_', 'mysql');
define('_SECURITY_DB_TYPE_', 'mysql');

class CO_Config {
    /***********************************************************************************************************************/
    /*                                                     CHANGE THIS                                                     */
    /***********************************************************************************************************************/
    
    static $lang = 'en';                            ///< The default language for the server.
    static $min_pw_len = 8;                         ///< The minimum password length.
    static $session_timeout_in_seconds = 2;         ///< Two-Second API key timeout.
    static $god_session_timeout_in_seconds  = 1;    ///< API key session timeout for the "God Mode" login, in seconds (integer value). Default is 10 minutes.
    static $use_personal_tokens = false;             ///< If TRUE, then we can use "personal IDs."
    
    static $god_mode_password = 'BWU-HA-HAAAA-HA!';
    
    static $data_db_name = 'littlegr_badger_data';
    static $data_db_host = 'localhost';
    static $data_db_type = _MAIN_DB_TYPE_;
    static $data_db_login = 'littlegr_badg';
    static $data_db_password = 'pnpbxI1aU0L(';

    static $sec_db_name = 'littlegr_badger_security';
    static $sec_db_host = 'localhost';
    static $sec_db_type = _SECURITY_DB_TYPE_;
    static $sec_db_login = 'littlegr_badg';
    static $sec_db_password = 'pnpbxI1aU0L(';

    /**
    This is the Google API key. It's required for CHAMELEON to do address lookups and other geocoding tasks.
    CHAMELEON requires this to have at least the Google Geocoding API enabled.
    */
    static $google_api_key = 'AIzaSyAPCtPBLI24J6qSpkpjngXAJtp8bhzKzK8';
    
    static private $_god_mode_id = 2;   ///< Default is 2 (First security item created).
    static private $_god_mode_password = 'BWU-HA-HAAAA-HA!'; ///< Plaintext password for the God Mode ID login. This overrides anything in the ID row.

    /***********************/
    /**
    We encapsulate this, because this is likely to be called from methods, and this prevents it from being changed.
    
    \returns the God Mode user password, in cleartext.
     */
    static function god_mode_password() {
        $ret = strval(self::$_god_mode_password);  // This just ensures that the return will be an ephemeral string, so there is no access to the original.
        
        return $ret;
    }
    
    /***********************/
    /**
    \returns the POSIX path to the main COBRA directory.
     */
    static function base_dir() {
        return dirname(dirname(dirname(__FILE__)));
    }
    
    /***********************************************************************************************************************/
    /*                                                  DON'T CHANGE THIS                                                  */
    /***********************************************************************************************************************/

    /***********************/
    /**
    We encapsulate this, and not the password, because this is likely to be called from methods, and this prevents it from being changed.
    
    \returns the God Mode user ID.
     */
    static function god_mode_id() {
        $id = intval(self::$_god_mode_id);  // This just ensures that the return will be an ephemeral int.
        
        return $id;
    }
    
    /***********************************************************************************************************************/
    /*                                                    COBRA STUFF                                                      */
    /***********************************************************************************************************************/
        
    /***********************/
    /**
    \returns the POSIX path to the COBRA main access class directory.
     */
    static function main_class_dir() {
        return self::base_dir().'/main';
    }
    
    /***********************/
    /**
    \returns the POSIX path to the COBRA localization directory.
     */
    static function lang_class_dir() {
        return self::base_dir().'/lang';
    }
    
    /***********************/
    /**
    \returns the POSIX path to the user-defined extended database row classes.
     */
    static function db_classes_extension_class_dir() {
        return Array(self::base_dir().'/badger_extension_classes', self::chameleon_db_classes_extension_class_dir());
    }
    
    /***********************/
    /**
    \returns the POSIX path to the CHAMELEON testing directory.
     */
    static function test_class_dir() {
        return self::base_dir().'/test';
    }
    
    /***********************/
    /**
    Includes the given file.
     */
    static function require_extension_class(   $in_filename    ///< The name of the file we want to require.
                                            ) {
        if (is_array(self::db_classes_extension_class_dir())) {
            foreach (self::db_classes_extension_class_dir() as $dir) {
                if (file_exists("$dir/$in_filename")) {
                    require_once("$dir/$in_filename");
                    break;
                }
            }
        } else {
            require_once(self::db_classes_extension_class_dir().'/'.$in_filename);
        }
    }

    /***********************************************************************************************************************/
    /*                                                  CHAMELEON STUFF                                                    */
    /***********************************************************************************************************************/

    /***********************/
    /**
    \returns the POSIX path to the main CHAMELEON database base classes.
     */
    static function chameleon_base_dir() {
        return self::base_dir().'/chameleon';
    }
    
    /***********************/
    /**
    \returns the POSIX path to the CHAMELEON main access class directory.
     */
    static function chameleon_main_class_dir() {
        return self::chameleon_base_dir().'/main';
    }
    
    /***********************/
    /**
    \returns the POSIX path to the CHAMELEON localization directory.
     */
    static function chameleon_lang_class_dir() {
        return self::chameleon_base_dir().'/lang';
    }
    
    /***********************/
    /**
    \returns the POSIX path to the CHAMELEON user-defined extended database row classes.
     */
    static function chameleon_db_classes_extension_class_dir() {
        return self::chameleon_base_dir().'/badger_extension_classes';
    }
    
    /***********************/
    /**
    \returns the POSIX path to the CHAMELEON testing directory.
     */
    static function chameleon_test_class_dir() {
        return self::chameleon_base_dir().'/test';
    }
    
    /***********************************************************************************************************************/
    /*                                                    BADGER STUFF                                                     */
    /***********************************************************************************************************************/
    
    /***********************/
    /**
    \returns the POSIX path to the BADGER main access class directory.
     */
    static function badger_base_dir() {
        return self::chameleon_base_dir().'/badger';
    }

    /***********************/
    /**
    \returns the POSIX path to the main BADGER database base classes.
     */
    static function db_class_dir() {
        return self::badger_base_dir().'/db';
    }
    
    /***********************/
    /**
    \returns the POSIX path to the BADGER extended database row classes.
     */
    static function db_classes_class_dir() {
        return self::badger_base_dir().'/db_classes';
    }
    
    /***********************/
    /**
    \returns the POSIX path to the BADGER main access class directory.
     */
    static function badger_main_class_dir() {
        return self::badger_base_dir().'/main';
    }
    
    /***********************/
    /**
    \returns the POSIX path to the BADGER main access class directory.
     */
    static function badger_shared_class_dir() {
        return self::badger_base_dir().'/shared';
    }
    
    /***********************/
    /**
    \returns the POSIX path to the BADGER localization directory.
     */
    static function badger_lang_class_dir() {
        return self::badger_base_dir().'/lang';
    }
    
    /***********************/
    /**
    \returns the POSIX path to the BADGER user-defined extended database row classes.
     */
    static function badger_db_classes_extension_class_dir() {
        return self::badger_base_dir().'/badger_extension_classes';
    }
    
    /***********************/
    /**
    \returns the POSIX path to the BADGER testing directory.
     */
    static function badger_test_class_dir() {
        return self::badger_base_dir().'/test';
    }
}
