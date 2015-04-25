    <?php require("templates.php");?>
    <?php echo(getHeader());?>
    
    <div class="row">
      <div class="large-12 columns">
        <h2>Dynamic Queries</h2>
        <h3>Please select a query.</h3>
      </div>
    </div>
    
    <form method="post" action="result.php">
        <div class="row">
        <div class="large-12 columns">
          <input type="radio" name="query" checked="checked" value="byLocation"><label for="query">Battles in Location:</label>
          <input type="textbox" name="location" placeholder="enter location...">
        </div>
                <div class="large-12 columns">
          <input type="hidden" name="type" value="dynamic">
        </div>
        <div class ="large-12 columns">
            <input type="radio" name="query" value="winsByParticipant"><label for="query">Number of Wins by Participant:</label>
        <div class = "row">
            <?php echo(getDropdown("participant1")); ?>
        </div>
        </div>
        <div class ="large-12 columns">
            <input type="radio" name="query" value="lossesByParticipant"><label for="query">Number of Losses by Participant:</label>
        <div class = "row">
            <?php echo(getDropdown("participant2")); ?>
        </div>
        </div>
                <div class ="large-12 columns">
            <input type="radio" name="query" value="battlesByParticipant"><label for="query">Battles fought by Participant:</label>
        <div class = "row">
            <?php echo(getDropdown("participant3")); ?>
        </div>
        </div>
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
