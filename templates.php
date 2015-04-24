<?php

function getDropdown($name){
        $html = "<div class = 'large-6 columns'>
            <label>Participant
                <select name = '".$name."'>";
                    $db = new mysqli('localhost','read_only','password','341Project');

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
    $html = '    <div class="row">
      <div class="large-12 columns">
        <h1>A Database Approach to World War I</h1>
      </div>
    </div><div class="row">
        <div class="large-12 columns">
            <a href = "/341/index.php"><div class="small button">Static Queries</div></a>
            <a href = "/341/dynamicIndex.php"><div class="small button">Dynamic Queries</div></a>
            <a href = "/341/createYourOwn.php"><div class="small button">User Generated Queries</div></a>
        </div>
    </div>';
    return $html;
}
?>