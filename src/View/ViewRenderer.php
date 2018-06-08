<?php

namespace SON\View;

class ViewRenderer {

    private $pathTemplates;
    private $templateName;
    /**
     * ViewRenderer constructor.
     * @param $pathTemplates
     */
    public function __contruct($pathTemplates)
    {
        $this->pathTemplates = $pathTemplates;
    }

    public function render($name, array $data = []){
        $this->templateName = $name;
        extract($data);
        ob_start();
        include $this->pathTemplates . "/{$this->templateName}.php";
        $saida = ob_get_clean();
        return $saida;
    }
}