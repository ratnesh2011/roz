<?php

echo "hello";

session_start();
    require('Smarty.class.php');
    require('SmartyPaginate.class.php');
    
    $smarty =& new Smarty;
    
    // required connect
    SmartyPaginate::connect();
    // set items per page
    SmartyPaginate::setLimit(25);

    // assign your db results to the template
    $smarty->assign('results', get_db_results());
    // assign {$paginate} var
    SmartyPaginate::assign($smarty);
    // display results
    $smarty->display('index.tpl');
 function get_db_results() {
        // normally you would have an SQL query here,
        // for this example we fabricate a 100 item array
        // (emulating a table with 100 records)
        // and slice out our pagination range
        // (emulating a LIMIT X,Y MySQL clause)
        $_data = range(1,100);
        SmartyPaginate::setTotal(count($_data));
        return array_slice($_data, SmartyPaginate::getCurrentIndex(),
            SmartyPaginate::getLimit());
    }
?>