
<?php

$output = "";

require_once 'classes/Date_time.php';

$dt = new Date_time();

$output = $dt->init("index");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Add Notes</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link href="public/css/main.css" rel="stylesheet">
</head>

<body>

<div class="container">

    <h1>Add a Note</h1>

    <p><?php echo $output; ?></p>

    <form action="index.php" method="post">

        <div class="row">
            <div class="col-md-6">

                <div class="form-group">
                    <label for="dateTime">Date and Time</label>

                    <input
                        type="datetime-local"
                        class="form-control"
                        id="dateTime"
                        name="dateTime">
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-6">

                <div class="form-group">
                    <label for="note">Note</label>

                    <textarea
                        class="form-control"
                        id="note"
                        name="note"
                        rows="5"></textarea>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-6">

                <div class="form-group">
                    <input
                        type="submit"
                        class="btn btn-primary"
                        name="addNote"
                        value="Add Note">
                </div>

            </div>
        </div>

    </form>

    <p><a href="display_notes.php">Display Notes</a></p>

</div>

</body>
</html>
