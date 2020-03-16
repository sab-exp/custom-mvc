<?php

namespace Core;

class View {

    // Render a View file 
    public static function render($view) {
        $file = "../App/Views/$view"; //relative to Core directory

        if (is_readable($file)) {
            require $file;
        }
        else {
            echo "$file not found";
        }
    }

}

?>