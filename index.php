<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>War Database</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
    <script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
    </head>
  <body>
    
    <div class="row">
      <div class="large-12 columns">
        <h1>Welcome</h1>
      </div>
    </div>
        <div class="row">
      <div class="large-12 columns">
        <h3>Please select a query.</h3>
      </div>
    </div>
    
    <form method="post" action="result.php">
        <div class="row">
        <div class="large-12 columns">
          <input type="radio" name="query" value="listBattles" ><label for="query">List of Battles</label>
        </div>
        <div class="large-12 columns">
          <input type="radio" name="query" value="longestBattle"><label for="query">Longest Battle</label>
        </div>
        <div class="large-12 columns">
          <input type="radio" name="query" value="shortestBattle"><label for="query">Shortest Battle</label>
        </div>
        <div class="large-12 columns">
          <input type="radio" name="query" value="mostForces"><label for="query">Highest Number of Soldiers</label>
        </div>
        <div class="large-12 columns">
          <input type="radio" name="query" value="mostParticipants"><label for="query">Highest Number of Participants</label>
        </div>
        <div class="large-12 columns">
          <input type="radio" name="query" value="highCasualtiesLoss"><label for="query">Highest Number of Casualties in a Losing Battle</label>
        </div>
        <div class="large-12 columns">
          <input type="radio" name="query" value="highCasualtiesWin"><label for="query">Highest Number of Casualties in a Winning Battle</label>
        </div>
        <div class="large-12 columns">
          <input type="radio" name="query" value="lowCasualtiesLoss"><label for="query">Lowest Number of Casualties in a Losing Battle</label>
        </div>
        <div class="large-12 columns">
          <input type="radio" name="query" value="lowCasualtiesWin"><label for="query">Lowest Number of Casualties in a Winning Battle</label>
        </div>
        <div class="large-12 columns">
          <input type="radio" name="query" value="byLocation"><label for="query">Battles in Location:</label>
          <input type="textbox" name="location" placeholder="enter location...">
        </div>
        <div class ="large-12 columns">
            <input type="radio" name="query" value="winsByParticipant"><label for="query">Number of Wins by Participant:</label>
        </div>
        <div class ="large-12 columns">
            <input type="radio" name="query" value="lossesByParticipant"><label for="query">Number of Losses by Participant:</label>
        </div>
        <div class = "large-12 columns">
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
