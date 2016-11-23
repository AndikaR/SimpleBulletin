<?php include(COMMON_VIEW_PATH . 'header.php') ?>

<div style="margin: 0 auto; width: 500px">
  <?php include(COMMON_VIEW_PATH . 'errors.php') ?>
  <form action="index.php" accept-charset="UTF-8" method="post">
    <span> Title </span>
    <br>
    <input type="text" name="title" style="width: 100%;" placeholder="Must be filled in" value="<?php echo sanitize($title) ?>" />
    <br>
    <span> Body </span>
    <br>
    <textarea name="message" rows="5" style="width: 100%;" placeholder="Must be filled in"><?php echo sanitize($message) ?></textarea>
    <br>
    <span> Password </span>
    <br>
    <div style="text-align: left; margin-bottom: 2%;">
      <input type="password" name="password" value="<?php echo sanitize($password) ?>" style="width: 50%; display: inline-block" />
      <input type="hidden" name="method" value="insert" />
      <input type="submit" name="submit_message" value="Submit" style="text-align: center;" />
    </div>
  </form>
  <?php if (empty($errors)) : ?>
    <table style="width: 100%; border-collapse: collapse; table-layout: fixed;">
      <?php foreach ($bulletins as $bulletin) : ?>
        <tr style="border-top: 1px solid #000;">
          <td colspan="2">
            <?php echo sanitize($bulletin['title']) ?>
          </td>
        </tr> 
        <tr>
          <td style="word-wrap: break-word;" colspan="2">
            <?php echo nl2br(sanitize($bulletin['message'])) ?>
          </td>
        </tr>
        <tr style="border-bottom: 1px solid #000;">
          <td style="text-align: left; width: 200px;">
            <form action="index.php" method="post">
              <p style="display: inline-block;">Pass</p>
              <input type="hidden" name="id" value="<?php echo sanitize($bulletin['id']) ?>" />
              <input type="hidden" name="page" value="<?php echo sanitize($page) ?>" />
              <input type="password" name="password" value="<?php echo sanitize($password) ?>" style="width: 30%; display: inline-block" />
              <button style="display: inline-block;" type="submit" name="method" value="delete">Delete</button>
              <button style="display: inline-block;" type="submit" name="method" value="edit">Edit</button>
            </form>
          </td>
          <td style="text-align: right;">
            <?php echo sanitize(format_date($bulletin['post_date'])) ?>
          </td>
        </tr>
      <?php endforeach ?>
    </table>
    <?php include(COMMON_VIEW_PATH . 'paginator.php') ?>
  <?php endif ?>
</div>

<?php include(COMMON_VIEW_PATH . 'footer.php') ?>

