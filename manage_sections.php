<?php
  if(isset($_POST["section_submit"])) {

  }
  else {

  }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>R.D. Tea | Manage Sections</title>
    </head>
    <body>
        <form class="add_section" action="manage_section.php" method="post">
                <input type="text" name="section_name" placeholder="Section Name" required>
                <input type="text" name="section_short_name" placeholder="Section Short Name" required>
                <input type="number" name="section_area" placeholder="Section Area" required>
                <input type="text" name="status" placeholder="Section Status" required>

                <input type="submit" name="section_submit" value="Add a Section">
        </form>
        <form class="remove_section" action="#" method="post">
                <input type="submit" name="section_submit" value="Remove a Section">
        </form>
    </body>
</html>
