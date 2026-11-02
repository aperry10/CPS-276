
<?php

require_once __DIR__ . "/../classes/Pdo_methods.php";

$message = "";

// Check that a file was submitted
if (isset($_POST['upload'])) {

    // Check if a file was selected
    if (!isset($_FILES['pdfFile']) ||
        $_FILES['pdfFile']['error'] == UPLOAD_ERR_NO_FILE) {

        $message = "Please select a PDF file.";

    }

    // Check for errors
    elseif ($_FILES['pdfFile']['error'] != UPLOAD_ERR_OK) {

        $message = "There was an error uploading the file.";

    }

    // Check file size (5MB maximum)
    elseif ($_FILES['pdfFile']['size'] > 5242880) {

        $message = "File must be smaller than 5MB.";

    }

    else {

        // Get filename
        $displayName = trim($_POST['displayName']);

        // Check file type
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($_FILES['pdfFile']['tmp_name']);

        // Check the PDF signature
        $handle = fopen($_FILES['pdfFile']['tmp_name'], "rb");
        $signature = fread($handle, 5);
        fclose($handle);

        if ($mimeType != "application/pdf" ||
            $signature != "%PDF-") {

            $message = "Only PDF files are allowed.";

        }

        else {

            // Set the upload folder
            $folder = __DIR__ . "/../files/";

            // Create folder if it does not exist
            if (!is_dir($folder)) {
                mkdir($folder, 0755, true);
            }

            // Create a unique filename
            $fileName = bin2hex(random_bytes(16)) . ".pdf";

            $destination = $folder . $fileName;

            $filePath = "files/" . $fileName;

            // Move uploaded PDF into files folder
            if (move_uploaded_file(
                $_FILES['pdfFile']['tmp_name'],
                $destination
            )) {

                // Create PDO object
                $pdo = new PdoMethods();

                // Create SQL statement
                $sql = "INSERT INTO files
                        (displayName, filePath)
                        VALUES (:displayName, :filePath)";

                // Bind database values
                $bindings = [
                    [':displayName', $displayName, 'str'],
                    [':filePath', $filePath, 'str']
                ];

                // Insert information into database
                $result = $pdo->otherBinded($sql, $bindings);

                if ($result == "noerror") {

                    $message = "File uploaded successfully!";

                }
                else {

                    unlink($destination);

                    $message = "There was an error saving the file information.";

                }

            }
            else {

                $message = "Unable to move uploaded file.";

            }

        }

    }

}
else {

    $message = "Please submit the upload form.";

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Upload Results</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container">

    <h1>File Upload</h1>

    <p><?php echo htmlspecialchars($message); ?></p>

    <a href="../index.php">Go Back</a>

    <br><br>

    <a href="../listFiles.php">Show File List</a>

</div>

</body>
</html>
