<?php

function getDropdown($name){
        $html = "<div class = 'large-6 columns'>
            <label>Participant
                <select name = '".$name."'>";
                        $hostname = "mysql.sarahlouisewhelan.com";  //the hostname you created when creating the database
$username = "341projectuser";   // the username specified when setting up the database
$password = "341_project";    // the password specified when setting up the database
$database = "341project";   // the database name chosen when setting up the database 

$db = mysqli_connect($hostname, $username, $password, $database);

                    if ($db->connect_errno > 0) {
                        die('Could not connect: ' . $db->connect_error);
                    }
                    $sql = 'SELECT * FROM participant';
                    
                    if(!$result = $db->query($sql)){
                        die('There was an error running the query [' . $db->error . ']');
                    }
                    while($participant = $result->fetch_assoc()){
                        $html .= "<option value=\"".$participant['pid']."\">".$participant['name']."</option>";
                    }
                    $result->free();
                    $db->close();
        
        $html .= "</select>
            </label>
        </div>";
        return $html;
}

function getHeader(){
    $html = '<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>World War I</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
    <script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
    </head>
  <body><div class="row">
      <div class="large-12 columns">
        <h1>A Database Approach to World War I</h1>
      </div>
    </div><div class="row">
        <div class="large-12 columns">
            <a href = "/341/index.php"><div class="small button">Static Queries</div></a>
            <a href = "/341/dynamicIndex.php"><div class="small button">Dynamic Queries</div></a>
            <a href = "/341/createYourOwn.php"><div class="small button">User Generated Queries</div></a>
            <a href = "/341/about.php"><div class="small button">About</div></a>
        </div>
    </div>';
    return $html;
}
?>