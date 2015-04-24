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
          <input type="radio" name="query" value="showAllQueries" ><label for="query">List of All SQL Queries</label>
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
