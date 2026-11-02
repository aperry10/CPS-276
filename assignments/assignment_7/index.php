
<?php
require_once "Page.php";

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

    <p>
        <a href="listFiles.php">Show File List</a>
    </p>

    

<form action="php/fileuploadProc.php"
      method="POST"
      enctype="multipart/form-data">

    <div class="mb-3">
        <label for="displayName" class="form-label">
            File Name
        </label>

        <input type="text"
               class="form-control"
               id="displayName"
               name="displayName"
               required>
    </div>

    <div class="mb-3">
        <label for="formFile" class="form-label">
            Choose PDF File
        </label>

        <input class="form-control"
               type="file"
               id="formFile"
               name="pdfFile"
               accept=".pdf,application/pdf"
               required>
    </div>

    <button type="submit"
            name="upload"
            class="btn btn-primary">
        Upload
    </button>

</form>
