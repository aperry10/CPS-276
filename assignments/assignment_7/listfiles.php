<?php

require_once "page.php";
require_once "php/listfilesProc.php";

$page = new Page();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>List Files</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container">

    <h1>List Files</h1>

    <?php echo $page->nav(); ?>

    <?php echo $list; ?>

</div>

</body>
</html>