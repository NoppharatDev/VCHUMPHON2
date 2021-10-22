<?php

require_once('Database.Class.php');
require_once('MinifyHTML.Class.php');

class HeadHTML extends Database {

    public $headHTML = "Fall! : headHTML";
    public $metaHTML = "";
    public $linkHTML = "";
    public $scriptHTML = "";
    public $titleHTML = "Fall! : titleHTML";
    public $titleText = "VCHUMPHON";

    function __construct() {
        ob_start("xxxRunxxx");
    }

    public function getHead() {
        $this->addMeta("<meta charset=\"UTF-8\">");
        $this->addMeta("<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">");
        $this->addMeta("<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">");
        $this->addLink("<link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css\">");
        $this->addLink("<link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css\" integrity=\"sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO\" crossorigin=\"anonymous\">");
        $this->addLink("<link rel=\"stylesheet\" href=\"//{$_SERVER['HTTP_HOST']}/assets/css/style.css\" />");
        $this->addLink("<link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css\" />");
        $this->addScript("<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js\"></script>");
        $this->addScript("<script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js\"></script>");
        $this->addScript("<script src=\"//cdn.jsdelivr.net/npm/sweetalert2@11\"></script>");
        $this->addScript("<script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js\" integrity=\"sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy\" crossorigin=\"anonymous\"></script>");
        $this->addScript("<script src=\"//{$_SERVER['HTTP_HOST']}/assets/js/script.js\"></script>");
        $this->titleHTML = "<title>{$this->titleText}</title>";
        $this->headHTML =   "<head>\n{$this->metaHTML}\n{$this->linkHTML}\n{$this->scriptHTML}\n{$this->titleHTML}\n</head>\n";
        return $this->headHTML;

    }

    public function addMeta($meth) {
        $this->metaHTML .= "{$meth}\n";
    }

    public function addLink($link) {
        $this->linkHTML .= "{$link}\n";
    }

    public function addScript($script) {
        $this->scriptHTML .= "{$script}\n";
    }

    public function editTitleText($title) {
        $this->titleText .= "{$title}\n";
    }

}

?>