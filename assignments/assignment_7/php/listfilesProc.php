

<?php

require_once __DIR__ . "/../classes/Pdo_methods.php";

$pdo = new PdoMethods();

$sql = "SELECT * FROM files";

$records = $pdo->selectNotBinded($sql);

$list = "";

if ($records == "error") {

    $list = "There was an error retrieving files.";

}
elseif (count($records) == 0) {

    $list = "No files found.";

}
else {

    $list = "<ul>";

    foreach ($records as $row) {

        $name = htmlspecialchars(
            $row['displayName'],
            ENT_QUOTES,
            'UTF-8'
        );

        $path = htmlspecialchars(
            $row['filePath'],
            ENT_QUOTES,
            'UTF-8'
        );

        $list .= "<li><a target='_blank' href='{$path}'>{$name}</a></li>";

    }

    $list .= "</ul>";

}

?>
