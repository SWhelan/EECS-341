<?php 
if(isset($_POST)){
    require("queries.php");
    
    //    new mysqli('server'   ,'username' ,'password','db name');
    $db = new mysqli('localhost','read_only','password','341Project');
    $result = "";
    if($_POST['type'] == 'static'){
        $queries = getStaticQueries();
        $hrefBack = 'index.php';    
    } else if($_POST['type'] == 'dynamic'){
        $hrefBack = 'dynamicIndex.php';
        $queries = getDynamicQueries($db);
    } else if($_POST['type'] == 'userQuery'){
        $hrefBack = 'createYourOwn.php';
    }
    if ($db->connect_errno > 0) {
        die('Could not connect: ' . $db->connect_error);
    }
    
    if($_POST['query'] != 'showAllQueries'){
        if($_POST['type'] == 'userQuery'){
        
            $title = "Your Query";
            $sql = mysqli_real_escape_string($db, $_POST['query']);
            $html = '<table>';
            //$html .= $queries[$queryType]['initHtml'];
        
        } else {
        
            $queryType = $_POST['query'];
            
            $title = $queries[$queryType]['title'];
            $sql = $queries[$queryType]['sql'];
            $html = '<table>';
            $html .= $queries[$queryType]['initHtml'];
        
        }
        
        if(!$result = $db->query($sql)){
            die('There was an error running the query [' . $db->error . ']');
        }
        while($battle = $result->fetch_assoc()){
            $html .= '<tr>';
            foreach ($battle as $column){
                    $html .= '<td>';
                    $html .= $column;
                    $html .= '</td>';
            }
            $html .= '</tr>';
        }
        $html .= '</table>';
    } else {
        $title = 'List of Queries';
        $sql = 'List Queries';
        $html = '<table><tr><th>Title</th><th>SQL</th></tr>';
        foreach($queries as $query){
            $html .= '<tr>';
            $html .= '<td>';
            $html .= $query['title'];
            $html .= '</td>';
            $html .= '<td>';
            $html .= $query['sql'] . ';';
            $html .= '</td>';
            $html .= '</tr>';
        }
        $html .= '</table>';
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
            if($result){
                $result->free();
            }
            $db->close();
        ?>
      </div>
    </div>
    <div class="row">
        <div class="large-12 columns">
            <a href="/341/<?php echo($hrefBack); ?>" class="button">Choose Another Query</a>
        </div>
    </div>
    </body>
    </html>