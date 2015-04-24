<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>World War I</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
    <script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
    </head>
  <body>
    
    <div class="row">
      <div class="large-12 columns">
        <h1>A Database Approach to World War I</h1>
      </div>
    </div>
    <div class="row">
        <div class="large-12 columns">
            <a href = "/341/index.php"><div class="small button">Static Queries</div></a>
            <a href = "/341/dynamicIndex.php"><div class="small button">Dynamic Queries</div></a>
            <a href = "/341/createYourOwn.php"><div class="small button">User Generated Queries</div></a>
        </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <h2>Dynamic Queries</h2>
        <h3>Please select a query.</h3>
      </div>
    </div>
    
    <form method="post" action="result.php">
        <div class="row">
        <div class="large-12 columns">
          <input type="radio" name="query" value="byLocation"><label for="query">Battles in Location:</label>
          <input type="textbox" name="location" placeholder="enter location...">
        </div>
                <div class="large-12 columns">
          <input type="hidden" name="type" value="dynamic">
        </div>
        <div class ="large-12 columns">
            <input type="radio" name="query" value="winsByParticipant"><label for="query">Number of Wins by Participant:</label>
        </div>
        <div class ="large-12 columns">
            <input type="radio" name="query" value="lossesByParticipant"><label for="query">Number of Losses by Participant:</label>
        </div>
        <div class = "row">
        <div class = "large-6 columns">
            <label>Participant
                <select name = "participant">
                <?php 
                    $db = new mysqli('localhost','read_only','password','341Project');

                    if ($db->connect_errno > 0) {
                        die('Could not connect: ' . $db->connect_error);
                    }
                    $sql = "SELECT * FROM participant";
                    
                    if(!$result = $db->query($sql)){
                        die('There was an error running the query [' . $db->error . ']');
                    }
                    while($participant = $result->fetch_assoc()){
                        echo("<option value=\"".$participant['pid']."\">".$participant['name']."</option>");
                    }
                    $result->free();
                    $db->close();
                ?>
                </select>
            </label>
        </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <input type ="submit" <div  name="submit" class="small button"></div></input>
            </div>
        </div>
    </form>
    
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>
