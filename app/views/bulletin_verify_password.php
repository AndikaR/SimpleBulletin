<?php include(COMMON_VIEW_PATH . 'header.php') ?>

<div style="margin: 0 auto; width: 400px">
  <?php include(COMMON_VIEW_PATH . 'errors.php') ?>
  <form action="index.php" method="post">
    <table style="width: 100%; border-collapse: collapse; table-layout: fixed;">
      <tr>
        <td style="border-top: 1px solid #000; width: 30%;">
          <span><?php echo sanitize($bulletin['title']) ?></span>
        </td>
      <tr> 
        <td style="word-wrap: break-word;">
          <span><?php echo nl2br(sanitize($bulletin['message'])) ?></span>
        </td>
      </tr>
      <tr style="border-bottom: 1px solid #000;">
        <td style="text-align: right; width: 300px;">
          <span><?php echo sanitize(format_date($bulletin['post_date'])) ?></span>
        </td>
      </tr>
      <?php if (empty($bulletin['password'])) : ?>
        <tr style="text-align: center;">
          <td>
            <button type="button" name="cancel" onclick="window.location.href='index.php?page=<?php echo sanitize($page) ?>';">Back</button>
          </td>
        </tr>
      <?php else : ?>
        <tr style="vertical-align: middle; margin-bottom: 2%;">
          <td>
            <p style="display: inline-block;">Pass</p>
            <input type="hidden" name="id" value="<?php echo sanitize($id) ?>" />
            <input type="hidden" name="page" value="<?php echo sanitize($page) ?>" />
            <input type="password" name="password" value="<?php echo sanitize($password) ?>" style="width: 50%; display: inline-block" />
            <button style="display: inline-block;" type="submit" name="method" value="<?php echo sanitize($method) ?>"><?php echo ucfirst(sanitize($method)) ?></button>
          </td>
        </tr>
      <?php endif ?>
    </table>
  </form>
</div>

<?php include(COMMON_VIEW_PATH . 'footer.php') ?>
