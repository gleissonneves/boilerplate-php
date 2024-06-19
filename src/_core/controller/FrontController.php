<?php

namespace src\_core\controller;

use src\_core\template\TemplateEngine;

class FrontController {
  protected $templateEngine;

  public function __construct($templateDir = 'views') {
    $this->templateEngine = new TemplateEngine($templateDir);
  }

  public function view($template, $data = array()) {
    $this->templateEngine->view($template, $data);
  }
}
