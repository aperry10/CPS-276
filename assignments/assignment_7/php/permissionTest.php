<?php

$folder = __DIR__ . "/../files/";

echo "Folder: " . $folder . "<br>";

echo "Folder exists: ";
var_dump(is_dir($folder));

echo "<br>Folder writable: ";
var_dump(is_writable($folder));

echo "<br>PHP user: ";
echo get_current_user();

?>