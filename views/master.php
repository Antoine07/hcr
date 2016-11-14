<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
  <nav>
    <a href="<?php echo url() ?>">Login</a>
    <a href="<?php echo url('category') ?>">Category</a>
  </nav>
  <?php echo $content?? 'no data' ?>
</body>
</html>