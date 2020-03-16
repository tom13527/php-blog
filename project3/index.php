<?php
    session_start();
    require_once("connectvars.php");
    
    // Show the navigation menu
    require_once('navmenu.php');
    
?>

<!DOCTYPE <!DOCTYPE html>
<html>
    <head>
        <title>The Blog</title>
        <link rel="stylesheet" type="text/css" href="styles.css" />
    </head>
    <body>
        <h1>The Blog</h1>
        <?php
             
            // Connect to datbase
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                    or die('Error in connecting to database');  
        
            $query = "SELECT * FROM blog WHERE approved = 1 ORDER BY id DESC";
            
            $data = mysqli_query($dbc, $query)
                    or die('Error in query');
                    
            $blog_posts = "";
            
            // Loop through table
            if (mysqli_num_rows($data) > 0)
            {
                // Grab blog posts
                while($row = mysqli_fetch_array($data))
                {
                    $id = $row['id'];
                    $title = $row['title'];
                    $post = $row['post'];
                    $date = $row['date'];
                    
                    $admin = "";
                    
                    // Output blog
                    $blog_posts .= "<div class='post'><h2>$title</h2><h3>($date)</h3><hr><br/>"
                            . "<p>$post</p></div>";
                }
                
                echo $blog_posts;
            } else {
                echo "Sorry, no blog posts at this time!";
            }
            
            mysqli_close($dbc);
        ?>
    </body>
</html>