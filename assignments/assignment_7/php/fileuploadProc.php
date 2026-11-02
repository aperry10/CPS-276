
<?php

require_once __DIR__ . "/../classes/Pdo_methods.php";

$message = "";

if (isset($_POST['fileUpload'])) {

    // Check that a file was selected
    if (!isset($_FILES['file']) ||
        $_FILES['file']['error'] == UPLOAD_ERR_NO_FILE) {

        $message = "Please select a PDF file.";

    }

    elseif ($_FILES['file']['error'] != UPLOAD_ERR_OK) {

        $message = "There was an error uploading the file.";

    }

    // Check file size (5MB maximum)
    elseif ($_FILES['file']['size'] > 5242880) {

        $message = "File must be smaller than 5MB.";

    }

    else {

        $displayName = trim($_POST['fileName']);

        if ($displayName == "") {

            $message = "Please enter a file name.";

        }
        else {

            // Check PDF type
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->file($_FILES['file']['tmp_name']);

            $handle = fopen($_FILES['file']['tmp_name'], "rb");
            $signature = fread($handle, 5);
            fclose($handle);

            if ($mimeType != "application/pdf" ||
                $signature != "%PDF-") {

                $message = "Only PDF files are allowed.";

            }
            else {

                // Set files folder
                $folder = __DIR__ . "/../files/";

                if (!is_dir($folder)) {
                    mkdir($folder, 0755, true);
                }

                if (!is_writable($folder)) {

                    $message = "The files folder is not writable. Contact your server administrator.";

                }
                else {

                    // Create unique filename
                    $fileName = bin2hex(random_bytes(16)) . ".pdf";

                    $destination = $folder . $fileName;

                    $filePath = "files/" . $fileName;

                    // Move PDF into files folder
                    if (move_uploaded_file(
                        $_FILES['file']['tmp_name'],
                        $destination
                    )) {

                        $pdo = new PdoMethods();

                        $sql = "INSERT INTO files
                                (displayName, filePath)
                                VALUES (:displayName, :filePath)";

                        $bindings = [
                            [':displayName', $displayName, 'str'],
                            [':filePath', $filePath, 'str']
                        ];

                        $result = $pdo->otherBinded($sql, $bindings);

                        if ($result == "noerror") {

                            $message = "File has been added.";

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

    }

}

?>
