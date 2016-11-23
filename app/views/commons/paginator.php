<div style="margin: 0 auto; text-align: center; margin-top: 2%;">
  <?php if ($paginator->hasPrevious()) : ?>
    <a href="index.php?page=<?php echo $paginator->getPrevious() ?>">&lt;</a>
  <?php endif ?>
  <?php if ($paginator->hasData()) : ?>
    <?php foreach ($paginator->getPageNumbers() as $pageNumber) : ?>
      <?php if ($paginator->isCurrentPage($pageNumber)) : ?>
        <span><?php echo $pageNumber ?></span>
      <?php else : ?>
        <a href="index.php?page=<?php echo $pageNumber ?>"><?php echo $pageNumber ?></a>
      <?php endif ?>
    <?php endforeach ?>
  <?php endif ?>
  <?php if ($paginator->hasNext()) : ?>
    <a href="index.php?page=<?php echo $paginator->getNext() ?>">&gt;</a>
  <?php endif ?>
</div>
