  <?php require("templates.php");?>
    <?php echo(getHeader());?>
        <div class="row">
      <div class="large-12 columns">
        <h2>Static Queries</h2>
        <h3>Please select a query.</h3>
      </div>
    </div>
    
    <form method="post" action="result.php">
        <div class="row">
        <div class="large-12 columns">
          <input type="radio" checked="checked" name="query" value="showAllQueries" ><label for="query">List of All SQL Queries</label>
        </div>
        <?php
            require("queries.php");
            $i = 0;
            $queries = getStaticQueries();
            $keys = array_keys($queries);
            foreach($queries as $query){
               echo('
                <div class="large-12 columns">
                    <input type="radio" name="query" value="'.$keys[$i].'" ><label for="query">'. $query["title"].'</label>
                </div>');
                $i++;
            }
        ?>
        <input type="hidden" name="type" value="static">
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
