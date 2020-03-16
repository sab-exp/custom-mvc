<?php

namespace App\Controllers\Admin;

class Users extends \Core\Controller {
    
    protected function before() {
        // echo "(before) ";
        //return false;
    }

    protected function after() {
        // echo " (after)";
    }
    
    public function indexAction() {
        echo "User admin index";
    }
}

?>