<?php 
if(isset($_POST)){
    //    new mysqli('server'   ,'username' ,'password','db name');
    $db = new mysqli('localhost','read_only','password','341Project');

    if ($db->connect_errno > 0) {
        die('Could not connect: ' . $db->connect_error);
    }
    
    $sql = "SELECT * FROM battle";
    if(!$result = $db->query($sql)){
        die('There was an error running the query [' . $db->error . ']');
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
        <h1>List of Battles</h1>
      </div>
    </div>
    
      <div class="row">
      <div class="large-12 columns">
        <h2>Your result is: </h2>
        <?php
            echo("<table><tr><th>Start Date</th><th>End Date</th><th>Title</th><th>Location</th></tr>");
            while($battle = $result->fetch_assoc()){
                echo ('<tr><td>' . $battle["start_date"] . '</td><td>' . $battle["end_date"] . '</td><td>' . $battle["title"] . '</td><td>' . $battle["location"] . '</td></tr>');
            }
            echo("</table>");
            $result->free();
            $db->close();
        ?>
      </div>
    </div>
    </body>
    </html>