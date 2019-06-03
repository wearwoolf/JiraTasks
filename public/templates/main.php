<!DOCTYPE html>
<html lang="en">
<head>
    <?php foreach ($header['meta'] as $meta) : ?>
        <?php foreach ($meta as $keyMeta => $valueMeta) : ?>
            <meta <?php  echo $keyMeta;?>="<?php echo $valueMeta;?>" />
        <?php endforeach; ?>
    <?php endforeach; ?>
    <?php foreach ($header['css'] as $css) : ?>
        <link href="<?php echo $css['href'];?>" rel="stylesheet" />
    <?php endforeach; ?>
    <title><?php echo $header['title'];?></title>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
    <span class="navbar-brand mr-auto mr-lg-0"><?php echo $header['title'] ?? '';?></span>
</nav>

<main role="main" class="container">
    <?php echo $body;?>
</main>

<?php foreach ($header['js'] as $js) : ?>
    <script src="<?php echo $js['src'];?>"></script>
<?php endforeach; ?>
</body>
</html>