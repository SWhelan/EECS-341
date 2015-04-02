<?php 
if(isset($_POST)){
    //    new mysqli('server'   ,'username' ,'password','db name');
    $db = new mysqli('localhost','read_only','password','341Project');

    if ($db->connect_errno > 0) {
        die('Could not connect: ' . $db->connect_error);
    }
    
    if($_POST['query'] == "listBattles"){
        $title = "List of Battles";
        $sql = "SELECT * FROM battle";
        $html = "<table><tr><th>Start Date</th><th>End Date</th><th>Title</th><th>Location</th></tr>";
        
        if(!$result = $db->query($sql)){
            die('There was an error running the query [' . $db->error . ']');
        }
        while($battle = $result->fetch_assoc()){
            $html .= '<tr><td>' . $battle["start_date"] . '</td><td>' . $battle["end_date"] . '</td><td>' . $battle["title"] . '</td><td>' . $battle["location"] . '</td></tr>';
        }
        $html .= "</table>";
    } else if($_POST['query'] == "longestBattle"){
        $title = "Longest Battle";
        $sql = "SELECT *, DATEDIFF(b.end_date, b.start_date) as num_days FROM battle as b WHERE DATEDIFF(b.end_date, b.start_date) IN (SELECT            MAX(DATEDIFF(b.end_date, b.start_date)) as num_days FROM battle as b)";
        
        if(!$result = $db->query($sql)){
            die('There was an error running the query [' . $db->error . ']');
        }
        $html = "<table><tr><th>Start Date</th><th>End Date</th><th>Title</th><th>Location</th><th>Number of Days</th></tr>";
        while($battle = $result->fetch_assoc()){
            $html .= '<tr><td>' . $battle["start_date"] . '</td><td>' . $battle["end_date"] . '</td><td>' . $battle["title"] . '</td><td>' . $battle["location"] . '</td><td>' . $battle["num_days"] . '</td></tr>';
        }
        $html .= "</table>";
    } else if($_POST['query'] == "shortestBattle"){
        $title = "Shortest Battle";
        $sql = "SELECT *, DATEDIFF(b.end_date, b.start_date) as num_days FROM battle as b WHERE DATEDIFF(b.end_date, b.start_date) IN (SELECT            MIN(DATEDIFF(b.end_date, b.start_date)) as num_days FROM battle as b)";
        
        if(!$result = $db->query($sql)){
            die('There was an error running the query [' . $db->error . ']');
        }
        $html = "<table><tr><th>Start Date</th><th>End Date</th><th>Title</th><th>Location</th><th>Number of Days</th></tr>";
        while($battle = $result->fetch_assoc()){
            $html .= '<tr><td>' . $battle["start_date"] . '</td><td>' . $battle["end_date"] . '</td><td>' . $battle["title"] . '</td><td>' . $battle["location"] . '</td><td>' . $battle["num_days"] . '</td></tr>';
        }
        $html .= "</table>";
    } else if($_POST['query'] == "mostForces"){
        $title = "List of Battles by Number of Soldiers";
        $sql = "SELECT b.title, b.location, b.start_date, b.end_date, forces.force_size FROM battle as b, (SELECT p.battle_id as bid, SUM(p.force_size) as force_size FROM participates_in_battle as p GROUP BY p.battle_id) as forces WHERE forces.bid  = b.bid AND forces.force_size IS NOT NULL
ORDER BY forces.force_size DESC";

        if(!$result = $db->query($sql)){
            die('There was an error running the query [' . $db->error . ']');
        }
        $html = "<table><tr><th>Start Date</th><th>End Date</th><th>Title</th><th>Location</th><th>Total Soldiers (All Sides)</th></tr>";
        while($battle = $result->fetch_assoc()){
            $html .= '<tr><td>' . $battle["start_date"] . '</td><td>' . $battle["end_date"] . '</td><td>' . $battle["title"] . '</td><td>' . $battle["location"] . '</td><td>' . $battle["force_size"] . '</td></tr>';
        }
        $html .= "</table>";
    } else if($_POST['query'] == "mostParticipants"){
        $title = "List of Battles by Number of Participants";
        $sql = "SELECT b.title, b.location, b.start_date, b.end_date, participants.participant_count FROM battle as b, (SELECT p.battle_id, COUNT(p.participant_id) as participant_count FROM participates_in_battle as p GROUP BY p.battle_id) as participants WHERE participants.battle_id = b.bid ORDER BY participants.participant_count DESC";
        
        if(!$result = $db->query($sql)){
            die('There was an error running the query [' . $db->error . ']');
        }
        $html = "<table><tr><th>Start Date</th><th>End Date</th><th>Title</th><th>Location</th><th>Total Participants (All Sides)</th></tr>";
        while($battle = $result->fetch_assoc()){
            $html .= '<tr><td>' . $battle["start_date"] . '</td><td>' . $battle["end_date"] . '</td><td>' . $battle["title"] . '</td><td>' . $battle["location"] . '</td><td>' . $battle["participant_count"] . '</td></tr>';
        }
        $html .= "</table>";
    } else if($_POST['query'] == "byLocation"){
        $location = mysqli_real_escape_string($db, $_POST['location']);
        $title = "List of Battles in Location: " . $location;
        $sql = "SELECT *  FROM battle as b WHERE b.location LIKE '%".$location."%'";
        
        $html = "<table><tr><th>Start Date</th><th>End Date</th><th>Title</th><th>Location</th></tr>";
        
        if(!$result = $db->query($sql)){
            die('There was an error running the query [' . $db->error . ']');
        }
        while($battle = $result->fetch_assoc()){
            $html .= '<tr><td>' . $battle["start_date"] . '</td><td>' . $battle["end_date"] . '</td><td>' . $battle["title"] . '</td><td>' . $battle["location"] . '</td></tr>';
        }
        $html .= "</table>";
    }


      
    
}
?>

<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Result</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
    <script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
  </head>
  <body>
    <div class="row">
      <div class="large-12 columns">
        <h1><?php echo($title);?></h1>
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <h2>Your result is: </h2>
        <?php
            echo("Your query is: " . $sql .";");
            echo("</br></br>");
            echo($html);
            $result->free();
            $db->close();
        ?>
      </div>
    </div>
    <div class="row">
        <div class="large-12 columns">
            <a href="/341/index.php" class="button">Choose Another Query</a>
        </div>
    </div>
    </body>
    </html>