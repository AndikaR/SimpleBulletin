<?php

class BulletinController extends BaseController
{
  const ROWS_PER_PAGE = 10;
  const MAX_BUTTON    = 5;

  public function index()
  {
    $model = new BulletinModel();
    $data  = array();

    $data['paginator'] = $this->getPaginator(
      $model->count(array('condition' => 'is_deleted = 0')),
      get_value('page', 1)
    );

    if (!$data['paginator']->isPageExists()) {
      $this->showError(404);
    }

    $data['title']    = get_value('title');
    $data['message']  = get_value('message');
    $data['password'] = get_value('password');

    $data['page'] = $data['paginator']->getCurrentPage();

    $data['bulletins'] = $model->fetch(array(
      'condition' => 'is_deleted = 0',
      'order'     => 'post_date DESC',
      'offset'    => $data['paginator']->getOffset(),
      'limit'     => $data['paginator']->getItemsPerPage()
    ));

    $this->render('bulletin.php', $data);
  }

  public function edit()
  {
    $model = new BulletinModel();
    $data  = array();

    $data['password'] = get_value('password');
    $data['id']       = get_value('id');
    $data['page']     = get_value('page', 1);
    $data['method']   = get_value('method');

    if (empty($data['id'])) {
      $this->showError(404);
    }

    $bulletin = $model->fetch(array(
      'condition' => "id = {$model->escape($data['id'])} AND is_deleted = 0"
    ));

    if (empty($bulletin[0])) {
      $this->showError(400);
    }

    $data['bulletin'] = $bulletin[0];
    $data['errors']   = array();

    if (empty($data['bulletin']['password'])) {
      $data['errors'][] = 'This message cannot be edited because no password set for this message';
    } elseif ($data['bulletin']['password'] !== $data['password']) {
      $data['errors'][] = 'The password you entered does not match. Please try again.';
    }

    if (empty($data['errors'])) {
      if (isset($_POST['submit'])) {
        $data['bulletin']['title']   = get_value('title');
        $data['bulletin']['message'] = get_value('message');
        
        $data['errors'] = $model->modify(
          $data['bulletin'],
          array('condition' => "id = {$model->escape($data['id'])}")
        );

        if (empty($data['errors'])) {
          $this->redirect("index.php?page={$data['page']}");
        }
      }

      $this->render('bulletin_edit.php', $data);
    } else {
      $this->render('bulletin_verify_password.php', $data);
    }
  }
  
  public function delete()
  {
    $model = new BulletinModel();
    $data  = array();
    
    $data['password'] = get_value('password');
    $data['id']       = get_value('id');
    $data['page']     = get_value('page', 1);
    $data['method']   = get_value('method');

    if (empty($data['id'])) {
      $this->showError(404);
    }

    $bulletin = $model->fetch(array(
      'condition' => "id = {$model->escape($data['id'])} AND is_deleted = 0"
    ));

    if (empty($bulletin[0])) {
      $this->showError(400);
    }

    $data['bulletin'] = $bulletin[0];
    $data['errors']   = array();

    if (empty($data['bulletin']['password'])) {
      $data['errors'][] = 'This message cannot be deleted because no password set for this message';
    } elseif ($data['bulletin']['password'] !== $data['password']) {
      $data['errors'][] = 'The password you entered does not match. Please try again.';
    }
  
    if (empty($data['errors'])) {
      if (isset($_POST['confirm'])) {
        $result = $model->update(
          array('is_deleted' => 1),
          array('condition'  => "id = {$model->escape($data['id'])}")
        );

        $count = $model->count(array('condition' => 'is_deleted = 0'));

        if ($data['page'] > 1) {
          if ($count <= (($data['page'] - 1) * self::ROWS_PER_PAGE)) {
            $data['page'] = $data['page'] - 1;
          }
        }

        $this->redirect("index.php?page={$data['page']}");
      }

      $this->render('bulletin_delete.php', $data);
    } else {
      $this->render('bulletin_verify_password.php', $data);
    }
  }

  public function insert()
  { 
    $model = new BulletinModel();
    $data  = array();

    $data['title']    = get_value('title');
    $data['message']  = get_value('message');
    $data['password'] = get_value('password');

    $data['errors'] = $model->save($data);

    if (empty($data['errors'])) {
      $this->redirect('index.php');
    }

    $this->render('bulletin.php', $data);
  }
  
  protected function getPaginator($count, $page)
  {
    return new Paginator(
      $count, 
      $page, 
      self::MAX_BUTTON, 
      self::ROWS_PER_PAGE
    );
  }
}
