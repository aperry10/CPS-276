
<?php

require_once 'Pdo_methods.php';

class Date_time {

    private $pdo;

    public function __construct() {
        $this->pdo = new PdoMethods();
    }

    public function init($page) {

        if ($page == "index") {
            return $this->addNote();
        }

        if ($page == "display") {
            return $this->displayNotes();
        }

    }

    private function addNote() {

        $output = "";

        if (isset($_POST['addNote'])) {

            $dateTime = $_POST['dateTime'];
            $note = trim($_POST['note']);

            if (empty($dateTime) || empty($note)) {

                $output = "You must enter a date, time, and note.";

            } else {

                $timestamp = strtotime($dateTime);

                $sql = "INSERT INTO note (date_time, note)
                        VALUES (:date_time, :note)";

                $bindings = array(
                    array(':date_time', $timestamp, 'int'),
                    array(':note', $note, 'str')
                );

                $result = $this->pdo->otherBinded($sql, $bindings);

                if ($result == 'noerror') {

                    $output = "Note successfully added!";

                } else {

                    $output = "There was an error adding your note.";

                }
            }
        }

        return $output;
    }

    private function displayNotes() {

        $output = "";

        if (isset($_POST['getNotes'])) {

            $begDate = $_POST['begDate'];
            $endDate = $_POST['endDate'];

            if (empty($begDate) || empty($endDate)) {

                return "No notes found for the date range selected.";

            }

            $beginTimestamp = strtotime($begDate . ' 00:00:00');
            $endTimestamp = strtotime($endDate . ' 23:59:59');

            if ($beginTimestamp === false ||
                $endTimestamp === false ||
                $beginTimestamp > $endTimestamp) {

                return "No notes found for the date range selected.";

            }

            $sql = "SELECT date_time, note
                    FROM note
                    WHERE date_time BETWEEN :begDate AND :endDate
                    ORDER BY date_time DESC";

            $bindings = array(
                array(':begDate', $beginTimestamp, 'int'),
                array(':endDate', $endTimestamp, 'int')
            );

            $records = $this->pdo->selectBinded($sql, $bindings);

            if ($records == 'error') {

                return "There was an error retrieving the notes.";

            }

            if (count($records) > 0) {

                $output = '<table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Date and Time</th>
                            <th>Note</th>
                        </tr>
                    </thead>
                    <tbody>';

                foreach ($records as $row) {

                    $date = date(
                        'm/d/Y h:i A',
                        $row['date_time']
                    );

                    $output .= '<tr>
                        <td>' . htmlspecialchars($date) . '</td>
                        <td>' . htmlspecialchars($row['note']) . '</td>
                    </tr>';

                }

                $output .= '</tbody></table>';

            } else {

                $output = "No notes found for the date range selected.";

            }

        }

        return $output;
    }

}

?>
