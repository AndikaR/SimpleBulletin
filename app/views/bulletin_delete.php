<?php include(COMMON_VIEW_PATH . 'header.php') ?>

<div style="margin: 0 auto; width: 400px">
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
      <tr style="text-align: center;">
        <td>
          <span>Are you sure?</span>
        </td>
      </tr>
      <tr style="text-align: center;">
        <td>
          <input type="hidden" name="password" value="<?php echo sanitize($bulletin['password']) ?>" />
          <input type="hidden" name="id" value="<?php echo sanitize($bulletin['id']) ?>" />
          <input type="hidden" name="page" value="<?php echo sanitize($page) ?>" />
          <input type="hidden" name="method" value="delete" />
          <button type="submit" name="confirm">Yes</button>
          <button type="button" name="cancel" onclick="window.location.href='index.php?page=<?php echo sanitize($page) ?>';">No</button>
        </td>
      </tr>
    </table>
  </form>
</div>

<?php include(COMMON_VIEW_PATH . 'footer.php') ?>
