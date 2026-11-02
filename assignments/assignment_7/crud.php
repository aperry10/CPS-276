
<?php

require_once "classes/Pdo_methods.php";

class Crud extends PdoMethods {

    public function uploadFile() {

        if (!isset($_POST['upload'])) {
            return "";
        }

        $displayName = trim($_POST['displayName'] ?? "");

        if ($displayName == "") {
            return "Please enter a document name";
        }

        if (!isset($_FILES['pdfFile']) ||
            $_FILES['pdfFile']['error'] == UPLOAD_ERR_NO_FILE) {
            return "Please select a PDF file";
        }

        if ($_FILES['pdfFile']['error'] != UPLOAD_ERR_OK) {
            return "There was an upload error";
        }

        if ($_FILES['pdfFile']['size'] > 5242880) {
            return "File must be smaller than 5MB";
        }

        $tmpFile = $_FILES['pdfFile']['tmp_name'];

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($tmpFile);

        $handle = fopen($tmpFile, "rb");
        $signature = fread($handle, 5);
        fclose($handle);

        if ($mimeType != "application/pdf" ||
            $signature != "%PDF-") {
            return "Only PDF files are allowed";
        }

        $folder = __DIR__ . "/files/";

        if (!is_dir($folder)) {
            mkdir($folder, 0755, true);
        }

        $fileName = bin2hex(random_bytes(16)) . ".pdf";

        $destination = $folder . $fileName;
        $filePath = "files/" . $fileName;

        if (!move_uploaded_file($tmpFile, $destination)) {
            return "Unable to upload file";
        }

        $sql = "INSERT INTO files
                (displayName, filePath)
                VALUES (:displayName, :filePath)";

        $bindings = [
            [':displayName', $displayName, 'str'],
            [':filePath', $filePath, 'str']
        ];

        $result = $this->otherBinded($sql, $bindings);

        if ($result == 'error') {
            unlink($destination);
            return "There was an error uploading the file";
        }

        return "File uploaded successfully";
    }

    public function getFiles() {

        $sql = "SELECT * FROM files ORDER BY id DESC";

        $records = $this->selectNotBinded($sql);

        if ($records == 'error') {
            return "There was an error retrieving files";
        }

        if (count($records) == 0) {
            return "No files found";
        }

        return $this->createList($records);
    }

    private function createList($records) {

        $list = "<ul>";

        foreach ($records as $row) {

            $path = htmlspecialchars(
                $row['filePath'],
                ENT_QUOTES,
                'UTF-8'
            );

            $name = htmlspecialchars(
                $row['displayName'],
                ENT_QUOTES,
                'UTF-8'
            );

            $list .= "<li><a target='_blank' rel='noopener noreferrer' href='{$path}'>{$name}</a></li>";
        }

        $list .= "</ul>";

        return $list;
    }
}
