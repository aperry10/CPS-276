
<?php

class Page {

    public function nav() {

        $nav = <<<NAV
        <nav class="mb-3">
            <a href="index.php">File Upload</a> |
            <a href="listFiles.php">Show File List</a>
        </nav>
NAV;

        return $nav;
    }
}

?>

