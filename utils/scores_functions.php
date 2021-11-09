<?php
function getLuckyScores($con) {
    $query = "select user_name, attempt, date_created from lucky_guess_records 
            where result = 'won' order by attempt, date_created ASC LIMIT 20";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {

        echo "<table border=1 style='border-collapse:collapse;'>
        <tr>
            <center>
            <th style='width: 80px'><b>RANK</b></th>
            <th style='width: 215px'><b>NAME</b></th>
            <th style='width: 135px'><b>ATTEMPTS</b></th>
            <th style='width: 135px'><b>DATE</b></th>
            </center>
        </tr>";

        $x = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . ++$x . "</td>";
            echo "<td>" . $row['user_name'] . "</td>";
            echo "<td>" . $row['attempt'] . "</td>";
            echo "<td>" . $row['date_created'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
}
?>