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
require_once(dirname(dirname(__FILE__)).'/functions.php');
    
// -------------------------------------- TEST DISPATCHER ------------------------------------------

function create_run_tests() {
//     create_run_test(9, 'FAIL -Create User From COBRA', 'We log in and instantiate CHAMELEON as a manager, then attempt to create a new user from a login we can\'t see.', 'king-cobra', NULL, 'CoreysGoryStory');
    create_run_test(10, 'PASS -Create User From COBRA', 'We log in and instantiate CHAMELEON as a manager, then attempt to create a new user from a login we can see.', 'asp', NULL, 'CoreysGoryStory');
    create_run_test(11, 'FAIL -Get Created User From COBRA', 'We log in and instantiate CHAMELEON as a manager, then attempt to see the same user; however, this time, we set the user to have an access the manager can\'t see, so it will attempt to create it. It should be noted that this manager can see the login ID, but not the user.', 'asp', NULL, 'CoreysGoryStory');
    create_run_test(12, 'FAIL -Get Created User From COBRA', 'We do it again, but this time, use a manager that can see the login (but not the user).', 'asp', NULL, 'CoreysGoryStory');
    create_run_test(13, 'PASS -Get Created User From COBRA', 'We do it again, but this time, use a manager that can see the user (but not the login).', 'king-cobra', NULL, 'CoreysGoryStory');
    create_run_test(14, 'FAIL -Create A Standard Login', 'Create a standard login from COBRA. However, we first try doing it with too short a password.', 'asp', NULL, 'CoreysGoryStory');
    create_run_test(15, 'FAIL -Create A Standard Login (Duplicate)', 'Create a standard login from COBRA, but use a different manager and try the same ID.', 'king-cobra', NULL, 'CoreysGoryStory');
    create_run_test(16, 'FAIL -Create A Standard Login (Duplicate)', 'Create a standard login from COBRA, but this time, we go in as God. It should also fail.', 'admin', NULL, CO_Config::god_mode_password());
    create_run_test(17, 'PASS -Create A Manager Login', 'Create a login manager login from COBRA.', 'asp', NULL, 'CoreysGoryStory');
    create_run_test(18, 'PASS -Create Another Manager Login', 'Using the manager we just created, create another manager login.', 'beavis', NULL, 'CoreysGoryStory');
    create_run_test(19, 'PASS -Create Another Standard Login', 'Using the manager we just created, create another standard login.', 'butthead', NULL, 'CoreysGoryStory');
    create_run_test(20, 'PASS -Create User From COBRA', 'We log in and instantiate CHAMELEON as a manager, then attempt to create a new user from the login we just created.', 'butthead', NULL, 'CoreysGoryStory');
    create_run_test(21, 'PASS -Create Standalone User From COBRA', 'We log in and instantiate CHAMELEON as a manager, then attempt to create a new standalone user.', 'beavis', NULL, 'CoreysGoryStory');
    create_run_test(22, 'FAIL -Try to Directly Delete a Login We Don\'t Own', 'We log in and instantiate CHAMELEON as a manager, then attempt to delete the "popeye" login, which we don\'t own.', 'asp', NULL, 'CoreysGoryStory');
    create_run_test(23, 'PASS -Try to Directly Delete a Login We Own', 'We log in and instantiate CHAMELEON as a manager, then attempt to delete the "popeye" login, which we now own.', 'butthead', NULL, 'CoreysGoryStory');
    create_run_test(24, 'PASS -Recreate the "popeye" Login', 'We log in and instantiate CHAMELEON as a manager, then create a new login to replace the one we just deleted.', 'butthead', NULL, 'CoreysGoryStory');
    create_run_test(25, 'PASS -Delete the "popeye" Login, Using COBRA', 'We log in and instantiate CHAMELEON as a manager, then use the COBRA function to delete the login (only) that we just recreated.', 'butthead', NULL, 'CoreysGoryStory');
    create_run_test(26, 'PASS -Recreate the "popeye" Login, and a User', 'We log in and instantiate CHAMELEON as a manager, then create a new login to replace the one we just deleted, as well as a user for that login.', 'butthead', NULL, 'CoreysGoryStory');
    create_run_test(27, 'FAIL -Try to Delete the "popeye" Login, and the associated user, Using COBRA', 'We log in and instantiate CHAMELEON as a manager without access to the login, then use the COBRA function to attempt to delete the login (and the user) that we just recreated.', 'asp', NULL, 'CoreysGoryStory');
    create_run_test(28, 'PASS -Delete the "popeye" Login, and the associated user, Using COBRA', 'We log in and instantiate CHAMELEON as a manager, then use the COBRA function to delete the login (and the user) that we just recreated.', 'butthead', NULL, 'CoreysGoryStory');
}

// ------------------------------------------ TESTS ------------------------------------------------

function create_test_09($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        $cobra_user_instance = $cobra_instance->get_user_from_login(5, true);

        if (isset($cobra_user_instance) && ($cobra_user_instance instanceof CO_Cobra_Login)) {
            echo("<h2 style=\"color:green;font-weight:bold\">The User instance is valid!</h2>");
        } else {
            echo("<h2 style=\"color:red;font-weight:bold\">The User instance is not valid!</h2>");
            echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$cobra_instance->error->error_code.') '.$cobra_instance->error->error_name.' ('.$cobra_instance->error->error_description.')</p>');
        }
    }
}

function create_test_10($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        $cobra_user_instance = $cobra_instance->get_user_from_login(5, true);

        if (isset($cobra_user_instance) && ($cobra_user_instance instanceof CO_User_Collection)) {
            echo("<h2 style=\"color:green;font-weight:bold\">The User instance is valid!</h2>");
        } else {
            echo("<h2 style=\"color:red;font-weight:bold\">The User instance is not valid!</h2>");
            echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$cobra_instance->error->error_code.') '.$cobra_instance->error->error_name.' ('.$cobra_instance->error->error_description.')</p>');
        }
    }
}

function create_test_11($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon('admin', '', CO_Config::god_mode_password());
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        $cobra_user_instance = $cobra_instance->get_user_from_login(5);
        $cobra_user_instance->set_read_security_id(6);
        $cobra_user_instance->set_write_security_id(6); // We need to do this, because write trumps read.
    }

    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        $cobra_user_instance = $cobra_instance->get_user_from_login(5, true);
        if (isset($cobra_user_instance) && ($cobra_user_instance instanceof CO_User_Collection)) {
            echo("<h2 style=\"color:green;font-weight:bold\">The User instance is valid!</h2>");
        } else {
            echo("<h2 style=\"color:red;font-weight:bold\">The User instance is not valid!</h2>");
            echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$cobra_instance->error->error_code.') '.$cobra_instance->error->error_name.' ('.$cobra_instance->error->error_description.')</p>');
        }
    }
}

function create_test_12($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        $cobra_user_instance = $cobra_instance->get_user_from_login(5, true);

        if (isset($cobra_user_instance) && ($cobra_user_instance instanceof CO_User_Collection)) {
            echo("<h2 style=\"color:green;font-weight:bold\">The User instance is valid!</h2>");
        } else {
            echo("<h2 style=\"color:red;font-weight:bold\">The User instance is not valid!</h2>");
            echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$cobra_instance->error->error_code.') '.$cobra_instance->error->error_name.' ('.$cobra_instance->error->error_description.')</p>');
        }
    }
}

function create_test_13($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        $cobra_user_instance = $cobra_instance->get_user_from_login(5);

        if (isset($cobra_user_instance) && ($cobra_user_instance instanceof CO_User_Collection)) {
            echo("<h2 style=\"color:green;font-weight:bold\">The User instance is valid!</h2>");
        } else {
            echo("<h2 style=\"color:red;font-weight:bold\">The User instance is not valid!</h2>");
        }
    }
}

function create_test_14($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        // First, try it with too short a password.
        $new_login = $cobra_instance->create_new_standard_login('bluto', '1234567');
        
        if ($new_login) {
            echo("<h2 style=\"color:red;font-weight:bold\">The Login Should not have been created!</h2>");
        } else {
            echo("<h2 style=\"color:red;font-weight:bold\">The Login was not created, which is good.</h2>");
            echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$cobra_instance->error->error_code.') '.$cobra_instance->error->error_name.' ('.$cobra_instance->error->error_description.')</p>');
            $new_login = $cobra_instance->create_new_standard_login('bluto', 'CoreysGoryStory');

            if (isset($new_login) && ($new_login instanceof CO_Cobra_Login)) {
                echo("<h2 style=\"color:green;font-weight:bold\">The New Login is valid!</h2>");
            } else {
                echo("<h2 style=\"color:red;font-weight:bold\">The Login is not valid!</h2>");
                echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$cobra_instance->error->error_code.') '.$cobra_instance->error->error_name.' ('.$cobra_instance->error->error_description.')</p>');
            }
        }
    }
}

function create_test_15($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        // Try to create a login with the same Login ID.
        $new_login = $cobra_instance->create_new_standard_login('bluto', 'CoreysGoryStory');

        if (isset($new_login) && ($new_login instanceof CO_Cobra_Login)) {
            echo("<h2 style=\"color:green;font-weight:bold\">The New Login is valid!</h2>");
        } else {
            echo("<h2 style=\"color:red;font-weight:bold\">The Login is not valid!</h2>");
            echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$cobra_instance->error->error_code.') '.$cobra_instance->error->error_name.' ('.$cobra_instance->error->error_description.')</p>');
        }
    }
}

function create_test_16($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        // Try to create a login with the same Login ID.
        $new_login = $cobra_instance->create_new_standard_login('bluto', 'CoreysGoryStory');

        if (isset($new_login) && ($new_login instanceof CO_Cobra_Login)) {
            echo("<h2 style=\"color:green;font-weight:bold\">The New Login is valid!</h2>");
        } else {
            echo("<h2 style=\"color:red;font-weight:bold\">The Login is not valid!</h2>");
            echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$cobra_instance->error->error_code.') '.$cobra_instance->error->error_name.' ('.$cobra_instance->error->error_description.')</p>');
        }
    }
}

function create_test_17($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        // Try to create a login manager login.
        $new_login = $cobra_instance->create_new_manager_login('beavis', 'CoreysGoryStory');

        if (isset($new_login) && ($new_login instanceof CO_Cobra_Login)) {
            echo("<h2 style=\"color:green;font-weight:bold\">The New Manager Login is valid!</h2>");
        } else {
            echo("<h2 style=\"color:red;font-weight:bold\">The Login is not valid!</h2>");
            echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$cobra_instance->error->error_code.') '.$cobra_instance->error->error_name.' ('.$cobra_instance->error->error_description.')</p>');
        }
    }
}

function create_test_18($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        // Try to create a login manager login.
        $new_login = $cobra_instance->create_new_manager_login('butthead', 'CoreysGoryStory');

        if (isset($new_login) && ($new_login instanceof CO_Cobra_Login)) {
            echo("<h2 style=\"color:green;font-weight:bold\">The New Manager Login is valid!</h2>");
        } else {
            echo("<h2 style=\"color:red;font-weight:bold\">The Login is not valid!</h2>");
            echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$cobra_instance->error->error_code.') '.$cobra_instance->error->error_name.' ('.$cobra_instance->error->error_description.')</p>');
        }
    }
}

function create_test_19($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        // Try to create a standard login.
        $new_login = $cobra_instance->create_new_standard_login('popeye', 'CoreysGoryStory');

        if (isset($new_login) && ($new_login instanceof CO_Cobra_Login)) {
            echo("<h2 style=\"color:green;font-weight:bold\">The New Standard Login is valid!</h2>");
        } else {
            echo("<h2 style=\"color:red;font-weight:bold\">The Login is not valid!</h2>");
            echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$cobra_instance->error->error_code.') '.$cobra_instance->error->error_name.' ('.$cobra_instance->error->error_description.')</p>');
        }
    }
}

function create_test_20($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        $cobra_user_instance = $cobra_instance->get_user_from_login(12, true);

        if (isset($cobra_user_instance) && ($cobra_user_instance instanceof CO_User_Collection)) {
            echo("<h2 style=\"color:green;font-weight:bold\">The User instance is valid!</h2>");
        } else {
            echo("<h2 style=\"color:red;font-weight:bold\">The User instance is not valid!</h2>");
            echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$cobra_instance->error->error_code.') '.$cobra_instance->error->error_name.' ('.$cobra_instance->error->error_description.')</p>');
        }
    }
}

function create_test_21($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        $cobra_user_instance = $cobra_instance->make_standalone_user();

        if (isset($cobra_user_instance) && ($cobra_user_instance instanceof CO_User_Collection)) {
            echo("<h2 style=\"color:green;font-weight:bold\">The User instance is valid!</h2>");
        } else {
            echo("<h2 style=\"color:red;font-weight:bold\">The User instance is not valid!</h2>");
            echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$cobra_instance->error->error_code.') '.$cobra_instance->error->error_name.' ('.$cobra_instance->error->error_description.')</p>');
        }
    }
}

function create_test_22($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        $cobra_login_instance = $cobra_instance->get_login_instance('popeye');

        if (isset($cobra_login_instance) && ($cobra_login_instance instanceof CO_Cobra_Login)) {
            echo("<h2 style=\"color:green;font-weight:bold\">The User instance is valid!</h2>");
            if ($cobra_login_instance->delete_from_db()) {
                echo("<h2 style=\"color:green;font-weight:bold\">Oh dear, we were able to delete the login!</h2>");
            } else {
                echo("<h2 style=\"color:red;font-weight:bold\">We could NOT delete the login, which is good.</h2>");
            }
        } else {
            echo("<h2 style=\"color:red;font-weight:bold\">The User instance is not valid!</h2>");
        }
    }
}

function create_test_23($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        $cobra_login_instance = $cobra_instance->get_login_instance('popeye');

        if (isset($cobra_login_instance) && ($cobra_login_instance instanceof CO_Cobra_Login)) {
            echo("<h2 style=\"color:green;font-weight:bold\">The User instance is valid!</h2>");
            if ($cobra_login_instance->delete_from_db()) {
                echo("<h2 style=\"color:green;font-weight:bold\">We could delete the login, which is good.</h2>");
            } else {
                echo("<h2 style=\"color:red;font-weight:bold\">Oh dear, we were unable to delete the login!</h2>");
            }
        } else {
            echo("<h2 style=\"color:red;font-weight:bold\">The User instance is not valid!</h2>");
        }
    }
}

function create_test_24($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        // Try to create a standard login.
        $new_login = $cobra_instance->create_new_standard_login('popeye', 'CoreysGoryStory');

        if (isset($new_login) && ($new_login instanceof CO_Cobra_Login)) {
            echo("<h2 style=\"color:green;font-weight:bold\">The New Standard Login is valid!</h2>");
        } else {
            echo("<h2 style=\"color:red;font-weight:bold\">The Login is not valid!</h2>");
            echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$cobra_instance->error->error_code.') '.$cobra_instance->error->error_name.' ('.$cobra_instance->error->error_description.')</p>');
        }
    }
}

function create_test_25($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        if ($cobra_instance->delete_login('popeye')) {
            echo("<h2 style=\"color:green;font-weight:bold\">We could delete the login, which is good.</h2>");
        } else {
            echo("<h2 style=\"color:red;font-weight:bold\">Oh dear, we were unable to delete the login!</h2>");
        }
    }
}

function create_test_26($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        // Try to create a standard login.
        $new_login = $cobra_instance->create_new_standard_login('popeye', 'CoreysGoryStory');

        if (isset($new_login) && ($new_login instanceof CO_Cobra_Login)) {
            echo("<h2 style=\"color:green;font-weight:bold\">The New Standard Login is valid!</h2>");
            $cobra_user_instance = $cobra_instance->get_user_from_login($new_login->id(), true);

            if (isset($cobra_user_instance) && ($cobra_user_instance instanceof CO_User_Collection)) {
                echo("<h2 style=\"color:green;font-weight:bold\">The User instance is valid!</h2>");
            } else {
                echo("<h2 style=\"color:red;font-weight:bold\">The User instance is not valid!</h2>");
                echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$cobra_instance->error->error_code.') '.$cobra_instance->error->error_name.' ('.$cobra_instance->error->error_description.')</p>');
            }
        } else {
            echo("<h2 style=\"color:red;font-weight:bold\">The Login is not valid!</h2>");
            echo('<p style="margin-left:1em;color:red;font-weight:bold">Error: ('.$cobra_instance->error->error_code.') '.$cobra_instance->error->error_name.' ('.$cobra_instance->error->error_description.')</p>');
        }
    }
}

function create_test_27($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        if ($cobra_instance->delete_login('popeye', true)) {
            echo("<h2 style=\"color:green;font-weight:bold\">We could delete the login and the user, which is NOT good.</h2>");
        } else {
            echo("<h2 style=\"color:red;font-weight:bold\">We were unable to delete the login, which is what we want.</h2>");
        }
    }
}

function create_test_28($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $chameleon_instance = make_chameleon($in_login, $in_hashed_password, $in_password);
    $cobra_instance = make_cobra($chameleon_instance);
    
    if (isset($cobra_instance) && ($cobra_instance instanceof CO_Cobra)) {
        if ($cobra_instance->delete_login('popeye', true)) {
            echo("<h2 style=\"color:green;font-weight:bold\">We could delete the login and the user, which is good.</h2>");
        } else {
            echo("<h2 style=\"color:red;font-weight:bold\">Oh dear, we were unable to delete the login!</h2>");
        }
    }
}

// ----------------------------------------- STRUCTURE ---------------------------------------------

function create_run_test($in_num, $in_title, $in_explain, $in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $test_num_string = sprintf("%03d", $in_num);
    echo('<div id="test-'.$test_num_string.'" class="inner_closed">');
        echo('<h3 class="inner_header"><a href="javascript:toggle_inner_state(\'test-'.$test_num_string.'\')">TEST '.$in_num.': '.$in_title.'</a></h3>');
        echo('<div class="main_div inner_container">');
            echo('<div class="main_div" style="margin-right:2em">');
                echo('<p class="explain">'.$in_explain.'</p>');
            echo('</div>');
            $st1 = microtime(true);
            $function_name = sprintf('create_test_%02d', $in_num);
            $function_name($in_login, $in_hashed_password, $in_password);
            $fetchTime = sprintf('%01.3f', microtime(true) - $st1);
            echo("<h4>The test took $fetchTime seconds to complete.</h4>");
        echo('</div>');
    echo('</div>');
}

ob_start();
    prepare_databases('instance_tests');
    
    echo('<div class="test-wrapper" style="display:table;margin-left:auto;margin-right:auto;text-align:left">');
        echo('<h1 class="header">CREATE USER AND LOGIN TESTS</h1>');
        echo('<div id="create-tests" class="closed">');
            echo('<h2 class="header"><a href="javascript:toggle_main_state(\'create-tests\')">COBRA CREATION TESTS</a></h2>');
            echo('<div class="container">');
                echo('<p class="explain"></p>');
            
                $start = microtime(true);
                
                create_run_tests();
                
                echo('<h5>The entire set of tests took '. sprintf('%01.3f', microtime(true) - $start) . ' seconds to complete.</h5>');
                
            echo('</div>');
        echo('</div>');
    echo('</div>');
$buffer = ob_get_clean();
die($buffer);
?>
