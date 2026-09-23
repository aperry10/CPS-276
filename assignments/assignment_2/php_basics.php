<?php
$numbers = [];

for ($i = 1; $i <= 50; $i++) {
    $numbers[] = $i;
}

$evenNumbers = ""; // Should keep only the even numbers.

foreach ($numbers as $number) { // a number divided by 2 should be even.
    if ($number % 2 === 0) {
        $evenNumbers .= $number . " ";
    }
}

$form = <<<HTML
<div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email">
</div>

<div class="mb-3">
    <label for="message" class="form-label">Message</label>
    <textarea class="form-control" id="message" rows="3"></textarea>
</div>
HTML;

function createTable($rows, $columns)
{
    $table = "<table class='table table-bordered'>";

    for ($i = 1; $i <= $rows; $i++) {
        $table .= "<tr>";

        for ($j = 1; $j <= $columns; $j++) {
            $table .= "<td>Row $i, Col $j</td>";
        }

        $table .= "</tr>";
    }

    $table .= "</table>";

    return $table;
}

$table = createTable(8, 6);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Even Numbers</title>
  </head>
  <body class="container">
    <main>
      <h1>Even Numbers</h1>
      <?php echo $evenNumbers; ?>
      <h2>Email Form</h2>
      <?php echo $form; ?>
      <h2>Table</h2>

      <?php echo $table; ?>

    </main>
  </body>
</html>   