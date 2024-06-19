<?php

namespace src\_core\template;

use Exception;

class TemplateEngine
{
  protected $templateDir;
  protected $extendedTemplate;
  protected $currentBlock;
  protected $blocks = array();

  public function __construct($templateDir)
  {
    $this->templateDir = $templateDir;
  }

  public function view($template, $data = array())
  {
    $path = APPPATH . $this->templateDir . '/' . $template . '.php';
    if (!file_exists($path)) {
      throw new Exception("Template file not found: $path");
    }

    extract($data);
    include($path);

    if (isset($this->extendedTemplate)) {
      $extendedPath = 'src/' . $this->templateDir . '/' . $this->extendedTemplate . '.php';

      if (!file_exists($extendedPath)) {
        throw new Exception("Extended template file not found: $extendedPath");
      }
      include($extendedPath);
    }
  }

  public function extend($template)
  {
    $this->extendedTemplate = $template;
    ob_start();
  }

  public function startBlock($blockName)
  {
    $this->currentBlock = $blockName;
    ob_start();
  }

  public function endBlock()
  {
    $blockContent = ob_get_clean();
    $this->blocks[$this->currentBlock] = $blockContent;
  }

  public function block($blockName, $defaultContent = '')
  {
    echo isset($this->blocks[$blockName]) ? $this->blocks[$blockName] : $defaultContent;
  }
}
