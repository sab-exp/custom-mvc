<?php

namespace Core;

class View {

    // Render a View file 
    public static function render($view, $args = []) {

        extract($args, EXTR_SKIP);

        $file = "../App/Views/$view"; //relative to Core directory

        if (is_readable($file)) {
            require $file;
        }
        else {
            echo "$file not found";
        }
    }
    // Twig Render a View file 
    public static function renderTemplate($template, $args = []) {

            
        $loader = new \Twig_Loader_Filesystem('../App/Views');
        $twig = new \Twig\Environment($loader);

        echo $twig->render($template, $args);

    }

}

?>