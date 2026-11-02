
<?php

require_once "../classes/Pdo_methods.php";

$pdo = new PdoMethods();

$sql = "SELECT * FROM files";

$records = $pdo->selectNotBinded($sql);

if ($records == "error") {

    echo "There was an error retrieving files.";

}
elseif (count($records) == 0) {

    echo "No files found.";

}
else {

    echo "<ul>";

    foreach ($records as $row) {

        $name = htmlspecialchars($row['displayName'], ENT_QUOTES, 'UTF-8');

        $path = htmlspecialchars($row['filePath'], ENT_QUOTES, 'UTF-8');

        echo "<li><a target='_blank' href='{$path}'>{$name}</a></li>";

    }

    echo "</ul>";

}

?>
