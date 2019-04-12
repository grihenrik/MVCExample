<?php
require_once "Element.php";
/**
 * Description of Form
 *
 * @author turunent
 */
class Form extends Element
{
    public function __construct($content, $action="", $method="POST")
    {
        parent::__construct("form", "", "", $content);
        $this->addAttribute("method", $method);
        $this->addAttribute("action", htmlspecialchars($action?$action:$_SERVER["PHP_SELF"]) );
    }
}
