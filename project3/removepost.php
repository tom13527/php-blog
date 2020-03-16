<?php
  require_once('authorize.php');
  require_once('navmenu.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>The Blog - Remove a Post</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
    <h2>The Blog - Remove a Post</h2>
    
<?php
    require_once('connectvars.php');
    
    // If the database information is all set... 
    if (isset($_GET['id']) && isset($_GET['title']) && isset($_GET['date']) && isset($_GET['post']))
    {
        // Grab the score data from the server - NOT FOR MODIFIYING DATA
        $id = $_GET['id'];
        $title = $_GET['title'];
        $date = $_GET['date'];
        $post = $_GET['post'];
    }
    else if (isset($_POST['id']) && isset($_POST['title']) && isset($_POST['date']))
    {
        // Grab the data from the POST
        $id = $_POST['id'];
        $title = $_POST['title'];
        $date = $_POST['date'];
    }
    else 
    {
        echo '<p class="error">Sorry, no post was specified for removal.</p>';
    }
    if (isset($_POST['submit']))
    {
        if ($_POST['confirm'] == 'Yes')
        {
            // Connect to the database
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                    or die("Error connecting to database");
            // Delete information from database
            $query = "DELETE FROM blog WHERE id = $id LIMIT 1";
            mysqli_query($dbc, $query)
                    or die("Error in query");
            mysqli_close;
            
            // Confirm that deletion was successful
            echo '<p>The blog with the title of ' . $title . ' was successfully removed.</p>';
        }
        else 
        {
            echo '<p class="error">The post was not removed.</p>';    
        }
    }
    else if (isset($id) && isset($title) && isset($date) && isset($post))
    {
        // Create form to delete the post
        echo '<div class="admin"><p>Are you sure you want to delete the following post?</p>';
        echo '<p><strong>Title: </strong>' . $title . '<br /><strong>Date: </strong>' . 
                $date . '<br /></p>';
        echo '<form method="post" action="removepost.php">';
        echo '<input type="radio" name="confirm" value="Yes" /> Yes ';
        echo '<input type="radio" name="confirm" value="no" checked="checked" /> No <br />';
        echo '<input type="submit" value="Submit" name="submit" />';
        echo '<input type="hidden" name="id" value="' . $id . '" />';
        echo '<input type="hidden" name="title" value="' . $title . '" />';
        echo '<input type="hidden" name="date" value="' . $date . '" />';
        echo '</form>';
    }
    
    echo '<p><a href="admin.php">&lt;&lt; Back to admin page</a></p></div>';

?>
    
</body>
</html>