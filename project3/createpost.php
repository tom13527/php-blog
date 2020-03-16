<!DOCTYPE html>
<html>
    <head>
        <title>Make A Post</title> 
        <link rel="stylesheet" type="text/css" href="styles.css" />
    </head>
<?php
    session_start();
    require_once("connectvars.php");
    
    // Show the navigation menu
    require_once('navmenu.php');
    
    if(isset($_POST['submit']))
    {
        // Connect to the database
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        
        // Get form data
        $title = mysqli_real_escape_string($dbc, trim($_POST['title']));
        $post = mysqli_real_escape_string($dbc, trim($_POST['post']));
        
        // Insert post to blog table
        $query = "INSERT INTO blog (date, title, post) VALUES (NOW(), '$title', '$post')";
        
        $data = mysqli_query($dbc, $query)
                or die('Error in query');
                
        mysqli_close($dbc);
        
        echo "<div='success' Your post was successfully submitted!</div>";
    }
    
?>    
    <body>
        <h2>Create A Post</h2>
        <div id="form">
            <form action="createpost.php" method="post" enctype="multipart_form-data">
                <input placeholder="Post Title" type="text" name="title" value""/><br/><br/>
                <textarea placeholder="Enter post here. Max of 300 characters." type="textarea" name="post" rows="30" cols="30"></textarea><br/>
                <input type="submit" value="Submit Post" name="submit" />
            </form>
        </div>
    </body>
</html>
