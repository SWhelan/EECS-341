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
