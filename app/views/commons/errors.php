<?php if (!empty($errors)) : ?>
  <?php foreach ($errors as $error) : ?>
    <span style="color: red; align: center;"><?php echo $error ?></span>
    <br>
  <?php endforeach ?>
<?php endif ?>
