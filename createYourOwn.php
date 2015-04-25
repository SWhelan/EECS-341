  <?php require("templates.php");?>
    <?php echo(getHeader());?>
    
    <div class="row">
      <div class="large-12 columns">
        <h2>User Generated Queries</h2>
        <h3>Please enter your own "SELECT" query.</h3>
      </div>
    </div>
    
    <form method="post" action="result.php">
        <div class="row">
        <div class="large-12 columns">
          <textarea name="query" placeholder="enter query..."></textarea>
        </div>
        <div class="large-12 columns">
          <input type="hidden" name="type" value="userQuery">
        </div>
            <div class="large-12 columns">
                <input type ="submit" <div  name="submit" class="small button"></div></input>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="large-12 columns">
          <p>For your convenience here is the schema with the attributes of each relation and foreign key constraints in an easier to view format.</p>
          <img src="/341/schema.jpg" name="schema"></textarea>
        </div>
    </div>
    
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>
