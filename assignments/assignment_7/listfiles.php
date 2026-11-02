
<?php

require_once "Crud.php";
require_once "Page.php";

$crud = new Crud();

$files = $crud->getFiles();

$page = new Page();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Uploaded PDF Files</title>
</head>

<body>

<?php echo $page->nav(); ?>

<h1>Uploaded PDF Documents</h1>

<?php echo $files; ?>

</body>
</html>
