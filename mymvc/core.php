<?php

class Core {
    public function loadView ($viewPath, $data)
    {
        extract($data);
        ob_start();
        require 'view/' . $viewPath;
        $strView = ob_get_contents();
        ob_end_clean();
        echo $strView;
    }
}