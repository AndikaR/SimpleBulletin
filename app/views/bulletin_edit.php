<?php include(COMMON_VIEW_PATH . 'header.php') ?>

<div style="margin: 0 auto; width: 400px">
  <?php include(COMMON_VIEW_PATH . 'errors.php') ?>
  <form action="index.php" accept-charset="UTF-8" method="post">
    <span> Title </span>
    <br>
    <input type="text" name="title" style="width: 100%;" placeholder="Must be filled in" value="<?php echo sanitize($bulletin['title']) ?>" />
    <br>
    <span> Body </span>
    <br>
    <textarea name="message" rows="5" style="width: 100%;" placeholder="Must be filled in"><?php echo sanitize($bulletin['message']) ?></textarea>
    <br>
    <br>
    <div style="text-align: center; margin-bottom: 2%;">
      <input type="hidden" name="method" value="edit"/>
      <input type="hidden" name="page" value="<?php echo sanitize($page) ?>"/>
      <input type="hidden" name="id" value="<?php echo sanitize($id) ?>"/>
      <input type="hidden" name="password" value="<?php echo sanitize($bulletin['password']) ?>" />
      <button type="submit" name="submit" style="text-align: center;">Submit</button>
      <button type="button" name="cancel" style="text-align: center;" onclick="window.location.href='index.php?page=<?php echo sanitize($page) ?>';">Cancel</button>
    </div>
  </form>
</div>

<?php include(COMMON_VIEW_PATH . 'footer.php') ?>
