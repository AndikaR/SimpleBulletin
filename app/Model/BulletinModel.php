<?php

class BulletinModel extends MySQL
{
  const TITLE_MIN_LENGTH    = 10;
  const TITLE_MAX_LENGTH    = 32;
  const MESSAGE_MIN_LENGTH  = 10;
  const MESSAGE_MAX_LENGTH  = 200;
  const PASSWORD_MAX_LENGTH = 4;

  protected $tableName = 'bulletin';

  public function validate($title, $message, $password)
  {
    $errors = array();

    if (strlen($title) === 0) {
      $errors[] = 'Your title cannot be empty';
    } elseif ((mb_strlen($title, 'UTF-8') < self::TITLE_MIN_LENGTH) || 
              (mb_strlen($title, 'UTF-8') > self::TITLE_MAX_LENGTH)) {
      $errors[] = 'Your title must be ' . self::TITLE_MIN_LENGTH . ' to ' . self::TITLE_MAX_LENGTH . ' characters long';
    }

    if (strlen($message) === 0) {
      $errors[] = 'Your message cannot be empty';
    } elseif ((mb_strlen($message, 'UTF-8') < self::MESSAGE_MIN_LENGTH) || 
              (mb_strlen($message, 'UTF-8') > self::MESSAGE_MAX_LENGTH)) {
      $errors[] = 'Your message must be ' . self::MESSAGE_MIN_LENGTH . ' to ' . self::MESSAGE_MAX_LENGTH . ' characters long';
    }

    if (strlen($password) > 0) {
      if (!ctype_digit($password) || 
          strlen($password) < self::PASSWORD_MAX_LENGTH ||
          strlen($password) > self::PASSWORD_MAX_LENGTH) {
        $errors[] = 'Your password must be ' . self::PASSWORD_MAX_LENGTH . ' digit numbers';
      }
    }

    return $errors;
  }
  
  public function save($data)
  {
    $errors = $this->validate(
      $data['title'],
      $data['message'],
      $data['password']
    );

    if (empty($errors)) {
      $this->insert(array(
        'title'     => $data['title'], 
        'message'   => $data['message'], 
        'password'  => $data['password'],
        'post_date' => date('Y-m-d H:i:s')
      ));
    }

    return $errors;
  }
  
  public function modify($data, $sqlParams = array())
  {
    $errors = $this->validate(
      $data['title'],
      $data['message'],
      $data['password']
    );

    if (empty($errors)) {
      $this->update(
        array(
          'title'   => $data['title'],
          'message' => $data['message']
        ),
        $sqlParams
      );
    }

    return $errors;
  }
}
