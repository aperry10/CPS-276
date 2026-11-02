
<?php

class Page {

    public function nav() {

        $nav = <<<NAV
        <nav>
            <ul>
                <li><a href="index.php">Upload PDF</a></li>
                <li><a href="listFiles.php">View Uploaded Files</a></li>
            </ul>
        </nav>
NAV;

        return $nav;
    }
}

?>
