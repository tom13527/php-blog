<?php
  require_once('authorize.php');
  // username = blog password = blog
  require_once('navmenu.php');
?>

<!DOCTYPE html>
<html>
<head>
  <title>The Blog - Post Administration</title>
  <link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
  <h2>The Blog - Post Administration</h2>
  <div class="admin"><p>Below is a list of The Blog posts. Use this page to remove posts as needed.</p>
  <hr />

<?php
  require_once('connectvars.php');

  // Connect to the database 
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  // Retrieve the score data from MySQL
  $query = "SELECT * FROM blog ORDER BY id DESC";
  $data = mysqli_query($dbc, $query);

  // Loop through the array of score data, formatting it as HTML 
  echo '<table>';
  echo '<tr><th>title</th><th>Date</th><th>Action</th></tr>';
  while ($row = mysqli_fetch_array($data)) { 
    // Display the score data
    echo '<tr class="scorerow"><td><strong>' . $row['title'] . '</strong></td>';
    echo '<td>' . $row['date'] . '</td>';
    echo '<td><a href="removepost.php?id=' . $row['id'] . '&amp;title=' . $row['title'] .
      '&amp;date=' . $row['date'] . '&amp;post=' . $row['post'] . '">Remove</a>';
    if ($row['approved'] == '0') {
      echo ' / <a href="approvepost.php?id=' . $row['id'] . '&amp;title=' . $row['title'] .
        '&amp;date=' . $row['date'] . '&amp;post=' . $row['post'] . '&amp;screenshot=' . '">Approve</a>';
    }
    echo '</td></tr>';
  }
  echo '</table></div>';

  mysqli_close($dbc);
?>

</body> 
</html>
