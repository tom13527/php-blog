<?php
  require_once ('authorize.php');
  require_once('navmenu.php');
?>

<!DOCTYPE html>
<html>
<head>
  <title>The Blog - Approve a Post</title>
  <link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
  <h2>The Blog - Approve a Post</h2>

<?php
  require_once('connectvars.php');

  if (isset($_GET['id']) && isset($_GET['title']) && isset($_GET['date']) && isset($_GET['post'])) 
  {
    // Grab the post data from the GET
    $id = $_GET['id'];
    $title = $_GET['title'];
    $date = $_GET['date'];
    $post = $_GET['post'];
  }
  else if (isset($_POST['id']) && isset($_POST['title']) && isset($_POST['date'])) 
  {
    // Grab the score data from the POST
    $id = $_POST['id'];
    $title = $_POST['title'];
    $date = $_POST['date'];
  }
  else 
  {
    echo '<p class="error">Sorry, no post was specified for approval.</p>';
  }

  if (isset($_POST['submit'])) 
  {
    if ($_POST['confirm'] == 'Yes') 
    {
      // Connect to the database
      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
            or die("Error in connection"); 

      // Approve the post by setting the approved column in the database
      $query = "UPDATE blog SET approved = 1 WHERE id = $id";
      mysqli_query($dbc, $query)
            or die("Error in query");
      mysqli_close($dbc);

      // Confirm success with the user
      echo '<p>The post ' . $title . '  was successfully approved.';
    }
    else {
      echo '<p class="error">Sorry, there was a problem approving the post.</p>';
    }
  }
  else if (isset($id) && isset($title) && isset($date) && isset($post)) {
    echo '<div class="admin"><p>Are you sure you want to approve the following post?</p>';
    echo '<p><strong>Title: </strong>' . $title . '<br /><strong>Date: </strong>' 
            . $date . '</p>';
    echo '<form method="post" action="approvepost.php">';
    echo '<input type="radio" name="confirm" value="Yes" /> Yes ';
    echo '<input type="radio" name="confirm" value="No" checked="checked" /> No <br />';
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
