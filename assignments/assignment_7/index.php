
<?php
require_once "page.php";
require_once "php/fileuploadProc.php";

$page = new Page();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>File Upload</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container">

    <h1>File Upload</h1>

    <p><a href="listFiles.php">Show File List</a></p>

    <p><?php echo htmlspecialchars($message); ?></p>

    <form method="post" action="index.php" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="fileName" class="form-label">File Name</label>
            <input type="text" class="form-control"
                   id="fileName" name="fileName" required>
        </div>

        <div class="mb-3">
            <input type="file" class="form-control"
                   name="file" accept=".pdf,application/pdf" required>
        </div>

        <button type="submit" name="fileUpload"
                class="btn btn-primary">Upload File</button>

    </form>

</div>

</body>
</html>
