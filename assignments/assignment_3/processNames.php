<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $action = $_POST["action"] ?? "";
    $names = $_POST["names"] ?? "";

    if ($action === "add") {

        $firstName = $_POST["firstName"] ?? "";
        $lastName = $_POST["lastName"] ?? "";

        if ($firstName !== "" && $lastName !== "") {

            if ($names !== "") {
                $nameList = explode("\n", $names);
            } else {
                $nameList = [];
            }

            // Switches the order of the names.
            $newName = $lastName . ", " . $firstName;

            $nameList[] = $newName;

            // Puts them in alphabetical order.
            sort($nameList);

            // Becomes a string again.
            $names = implode("\n", $nameList);
        }

    } else {

        // Clear the list.
        $names = "";
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Name List</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <h1>Name List</h1>

    <form action="processNames.php" method="post">

        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="firstName" class="form-control">

        <br>

        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="lastName" class="form-control">

        <br>

        <button type="submit" name="action" value="add" class="btn btn-primary">
            Add Name
        </button>

        <button type="submit" name="action" value="clear" class="btn btn-danger">
            Clear Names
        </button>

        <br><br>

        <label for="names">Names:</label>

        <textarea id="names" name="names" rows="10" class="form-control"><?php
            echo htmlspecialchars($names);
        ?></textarea>

    </form>

</div>

</body>
</html>
