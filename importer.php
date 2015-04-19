<?php
    $db = new mysqli('localhost','root','','341Project');

    if ($db->connect_errno > 0) {
        die('Could not connect: ' . $db->connect_error);
    }
$file = fopen("./wars1.csv", 'r');
if (!$file) {
    echo "Error opening state file";
    exit();
}
$conflictId = 2;
$allianceId = 3;
while (($data = fgetcsv($file)) !== FALSE) {
    $conflict = array();
    $conflict['title'] = $data[2];
    $conflict['start_date'] = $data[0];
    $conflict['end_date'] = $data[1];
    $sql = "INSERT INTO `341project`.`conflict` (`id`, `title`, `start_date`, `end_date`) VALUES (NULL, '".$conflict['title']."', '".$conflict['start_date']."', '".$conflict['end_date']."')";
    $db->query($sql);
    $alliance = array();
    $alliance['win'] = $data[3];
    $alliance['lost'] = $data[4];
                $sql3 = "INSERT INTO `341project`.`alliance` (`aid`, `title`, `description`) VALUES (".$allianceId.", '".$alliance['win']."', NULL)";
                if(!$result = $db->query($sql3)){
            die('There was an error running the query [' .$sql3. $db->error . ']');
        }
            $sql4 = "INSERT INTO `341project`.`participates_in_conflict` (`conflict_id`, `alliance_id`, `enter_date`, `exit_date`, `status`, `location`) VALUES ('".$conflictId."', '".$allianceId."', '".$conflict['start_date']."', '".$conflict['end_date']."', 'win', NULL)";
            if(!$result = $db->query($sql4)){
            die('There was an error running the query [' . $sql4. $db->error . ']');
        }
    $allianceId++;
                $sql6 = "INSERT INTO `341project`.`alliance` (`aid`, `title`, `description`) VALUES (".$allianceId.", '".$alliance['lost']."', NULL)";
                if(!$result = $db->query($sql6)){
            die('There was an error running the query [' . $sql6. $db->error . ']');
        }
            $sql5 = "INSERT INTO `341project`.`participates_in_conflict` (`conflict_id`, `alliance_id`, `enter_date`, `exit_date`, `status`, `location`) VALUES ('".$conflictId."', '".$allianceId."', '".$conflict['start_date']."', '".$conflict['end_date']."', 'lose', NULL)";
            if(!$result = $db->query($sql5)){
            die('There was an error running the query [' .$sql5. $db->error . ']');
        }
    $allianceId++;
        /*
    $sql2 = "SELECT * FROM alliance as a WHERE a.title = '".$alliance['win']."'";
    if(!$result = $db->query($sql2)){
            $sql3 = "INSERT INTO `341project`.`alliance` (`aid`, `title`, `description`) VALUES (".$allianceId.", '".$alliance['win']."', NULL)";
        $db->query($sql3);
        $allianceWinId = $allianceId;
        $allianceId++;

    } else {
        $allianceWin = $result->fetch_assoc();
        $allianceWinId = $allianceWin['aid'];
    }
    $sql4 = "INSERT INTO `341project`.`participates_in_conflict` (`conflict_id`, `alliance_id`, `enter_date`, `exit_date`, `status`, `location`) VALUES ('".$conflictId."', '".$allianceWinId."', '".$conflict['start_date']."', '".$conflict['end_date']."', 'win', NULL)";
    $db->query($sql4);
    
    
    $sql5 = "SELECT * FROM alliance as a WHERE a.title = '".$alliance['lost']."'";
    if(!$result = $db->query($sql5)){
            $sql3 = "INSERT INTO `341project`.`alliance` (`aid`, `title`, `description`) VALUES (".$allianceId.", '".$alliance['lost']."', NULL)";
        $db->query($sql3);
        $allianceLoseId = $allianceId;
        $allianceId++;
    } else {
        $allianceLose = $result->fetch_assoc();
        $allianceLoseId = $allianceWin['aid'];
    }
    $sql6 = "INSERT INTO `341project`.`participates_in_conflict` (`conflict_id`, `alliance_id`, `enter_date`, `exit_date`, `status`, `location`) VALUES ('".$conflictId."', '".$allianceLoseId."', '".$conflict['start_date']."', '".$conflict['end_date']."', 'lose', NULL)";
    $db->query($sql6);*/
    
    $conflictId++;
}
?>