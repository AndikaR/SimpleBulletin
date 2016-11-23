<?php

class BaseController
{
  protected $defaultAction = 'index';

  public function invoke($actionKey = 'method', $param = array())
  {
    try {
      $method = get_value($actionKey);

      if (!method_exists($this, $method)) {
        $method = $this->defaultAction;
      }

      $this->$method($param);
    } catch (Exception $e) {
      error_log($e->getMessage());
      $this->showError(500);
    }
  }

  public function redirect($target)
  {
    header("Location: {$target}");

    exit;
  }
  
  public function showError($errorCode)
  {
    header($_SERVER['SERVER_PROTOCOL'], true, $errorCode);

    $this->render("{$errorCode}.php", array(), ERROR_VIEW_PATH);
    
    exit;
  }

  public function render($filename, $data = array(), $path = VIEW_ROOT)
  {
    try {
      $file = $path . $filename;

      extract($data);
      ob_start();
      include $file;
      ob_end_flush();
    } catch (Exception $e) {
      throw $e;
    }
  }
}
