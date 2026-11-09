
<?php

$output = "";

require_once 'classes/Date_time.php';

$dt = new Date_time();

$output = $dt->init("display");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Display Notes</title>

    <link rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link href="public/css/main.css" rel="stylesheet">
</head>

<body>

<div class="container">

    <h1>Display Notes</h1>


    <form action="display_notes.php" method="post">

        <div class="row">
            <div class="col-md-6">

                <div class="form-group">

                    <label for="begDate">Beginning Date</label>

                    <input type="date"
                    class="form-control"
                    id="begDate"
                    name="begDate">

                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-6">

                <div class="form-group">

                    <label for="endDate">Ending Date</label>

                    <input type="date"
                    class="form-control"
                    id="endDate"
                    name="endDate">

                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-6">

                <div class="form-group">

                    <input type="submit"
                    class="btn btn-primary"
                    name="getNotes"
                    value="Get Notes">

                </div>

            </div>
        </div>

    </form>
    <p><?php echo $output; ?></p>
    <p><a href="index.php">Add Notes</a></p>

</div>

</body>
</html>
