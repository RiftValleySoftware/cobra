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
require_once(dirname(dirname(__FILE__)).'/functions.php');

ob_start();
    prepare_databases('admin_tests');
    
    echo('<div class="test-wrapper" style="display:table;margin-left:auto;margin-right:auto;text-align:left">');
        echo('<h1 class="header">ADMIN TESTS</h1>');
        echo('<div id="admin-tests" class="closed">');
            echo('<h2 class="header"><a href="javascript:toggle_main_state(\'admin-tests\')">TESTS</a></h2>');
            echo('<div class="container">');
                echo('<p class="explain"></p>');
            
                $start = microtime(TRUE);
                
                echo('<div id="test-001" class="inner_closed">');
                    echo('<h3 class="inner_header"><a href="javascript:toggle_inner_state(\'test-001\')">TEST 1:</a></h3>');
                    echo('<div class="main_div inner_container">');
                        echo('<div class="main_div" style="margin-right:2em">');
                            echo('<p class="explain"></p>');
                        echo('</div>');
                        admin_test_relay(1);
                    echo('</div>');
                echo('</div>');
                
                echo('<h5>The entire set of tests took '. sprintf('%01.3f', microtime(TRUE) - $start) . ' seconds to complete.</h5>');
                
            echo('</div>');
        echo('</div>');
    echo('</div>');
$buffer = ob_get_clean();
die($buffer);

function admin_test_relay($in_test_number, $in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $function_name = sprintf('admin_test_%02d', $in_test_number);
    
    $function_name($in_login, $in_hashed_password, $in_password);
}
    
function admin_test_01($in_login = NULL, $in_hashed_password = NULL, $in_password = NULL) {
    $cobra_instance = make_cobra($in_login, $in_hashed_password, $in_password);
    
    if ($cobra_instance) {
        $st1 = microtime(TRUE);
        $fetchTime = sprintf('%01.3f', microtime(TRUE) - $st1);
        echo('<div class="inner_div">');
echo('COBRA:<pre>'.htmlspecialchars(print_r($cobra_instance, true)).'</pre>');
        echo('</div>');
    }
}
?>
