<?php

function sanitize($str, $flags = ENT_QUOTES, $encode = 'UTF-8')
{
  return htmlentities(stripslashes($str), $flags, $encode); 
}

function format_date($param, $format = 'd-m-Y H:i')
{
  return date($format, strtotime($param));
}

function load_class($class)
{
  require $class . '.php';
}

function get_value($key = null, $default = null)
{
  $request = array_merge($_GET, $_POST);

  if (empty($key)) {  
    return $request; 
  }
  
  return isset($request[$key]) ? $request[$key] : $default;
}
