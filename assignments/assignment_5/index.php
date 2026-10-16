
<?php

class FileDirectory
{
    public function createFile($folder, $content)
    {
        $dir = __DIR__ . "/directories/" . $folder;

        $valid = true;

        if ($folder == "") {
            $valid = false;
        }

        for ($i = 0; $i < strlen($folder); $i++) {
            $char = strtolower($folder[$i]);

            if (($char < "a" || $char > "z") &&
                ($char < "0" || $char > "9")) {
                $valid = false;
            }
        }

        if (!$valid) {
            return [
                "success" => false,
                "message" => "Folder name must contain letters and numbers only."
            ];
        }

        // Check whether the directory already exists
        if (is_dir($dir)) {
            return [
                "success" => false,
                "message" => "Directory already exists"
            ];
        }

        // Makes the directory.
        $success = mkdir($dir, 0777);

        if (!$success) {
            retun [
                "success" => false,
                "message" => "There was a problem creating the directory."
            ];
        }
        
        chmod($dir, 0777);
        // Creates and opens the file.
        $path = $dir . "/readme.txt";
        $handle = fopen($path, "w");

        if (!$handle) {
            return [
                "success" => false,
                "message" => "Cannot open file for writing."
            ];
        }

        // Writes the content.
        $written = fwrite($handle, $content);

        // Closes the file.
        fclose($handle);

        if ($written === false || $written != strlen($content)) {
            return [
                "success" => false,
                "message" => "There was a problem writing the file."
            ];
        }

        return [
            "success" => true,
            "message" => "Directory and file created successfully!",
            "file" => "directories/" . $folder . "/readme.txt"
        ];
    }
}

$msg = "";
$fileLink = "";

if (isset($_POST["submit"])) {
    $folder = $_POST["folder"] ?? "";
    $content = $_POST["content"] ?? "";

    $work = new FileDirectory();
    $result = $work->createFile($folder, $content);

    $msg = $result["message"];

    if ($result["success"]) {
        $fileLink = $result["file"];
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Files and Directories</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

<div class="container mt-5">

    <h1>Files and Directories</h1>

    <form method="POST">

        <div class="mb-3">
            <label for="folder" class="form-label">
                Folder Name
            </label>

            <input
                type="text"
                class="form-control"
                id="folder"
                name="folder"
                pattern="[A-Za-z0-9]+"
                title="Use letters and numbers only"
                required
            >
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">
                File Content
            </label>

            <textarea
                class="form-control"
                id="content"
                name="content"
                rows="4"
                required
            ></textarea>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">
            Submit
        </button>

    </form>

    <?php if ($msg != "") { ?>

        <div class="alert <?php echo $fileLink != "" ? 'alert-success' : 'alert-danger'; ?> mt-3">

            <?php echo htmlspecialchars($msg); ?>

            <?php if ($fileLink != "") { ?>
                <br>

                <a href="<?php echo htmlspecialchars($fileLink); ?>" target="_blank">
                    Open readme.txt
                </a>
            <?php } ?>

        </div>

    <?php } ?>

</div>

</body>
</html>
