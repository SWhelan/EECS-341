<?php 
if(isset($_POST)){
    require("queries.php");
    require("templates.php");
    
    //    new mysqli('server'   ,'username' ,'password','db name');
    $db = new mysqli('localhost','read_only','password','341Project');
    $result = "";
    $error = "";
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
        $erro .= 'Could not connect: ' . $db->connect_error;
    }
    if($_POST['query'] != 'showAllQueries'){
        if($_POST['type'] == 'userQuery'){
        
            $title = "Your Query";
            $sql = mysqli_real_escape_string($db, $_POST['query']);
            $html = '<table>';
        
        } else if($_POST['query'] != ""){
            $queryType = $_POST['query'];
            $title = $queries[$queryType]['title'];
            $sql = $queries[$queryType]['sql'];
            $html = '<table><tr>';        
        } 
        
        if(!$sql || !$result = $db->query($sql)){
            $error .= 'There was an error running the query: "' .$sql . '" [' . $db->error . ']</br></br>';
        } else {
            $fields = $result->fetch_fields();
                foreach ($fields as $field){
                    $html .= '<th>';
                    $html .= $field->name;
                    $html .= '</th>';
                }
            $html .= '</tr>';
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
        }
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
    <?php echo(getHeader());?>
    <div class="row">
      <div class="large-12 columns">
        <h1><?php echo($title);?></h1>
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
        <h2>Your result is: </h2>
        <?php
            if($error){
                echo($error);
            } else {
                echo("Your query is: " . $sql .";");
                echo("</br></br>");
                echo($html);
                if($result){
                    $result->free();
                }
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