<?php
  require_once('includes/sessions.php');
  require_once('includes/functions.php');
?>

<?php

  $connection = make_connection();

  if(isset($_POST["section_submit"])) {
    $sec_nm = mysqli_real_escape_string($connection, $_POST["section_name"]);
    $sec_shrt_nm = mysqli_real_escape_string($connection, $_POST["section_short_name"]);
    $sec_area = (float) mysqli_real_escape_string($connection, $_POST["section_area"]);
    $stats = mysqli_real_escape_string($connection, $_POST["status"]);

    $query = " INSERT INTO sections ";
    $query .= "(section_name, short_section_name, area, status )";
    $query .= "VALUES ('{$sec_nm}', '{$sec_shrt_nm}', {$sec_area}, '{$stats}')" ;

    $result = mysqli_query($connection, $query);

    confirm_query($result);
    echo "Inserted successfully!";
  }
  else {
    $sec_nm = NULL;
    $sec_shrt_nm = NULL;
    $sec_area = NULL;
    $stats = NULL;
  }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>R.D. Tea | Manage Sections</title>
    </head>
    <body>

        <form class="add_section" action="manage_sections.php" method="post">
                <input type="text" name="section_name" placeholder="Section Name" required>
                <input type="text" name="section_short_name" placeholder="Section Short Name" required>
                <input type="text" name="section_area" placeholder="Section Area" required>
                <input type="text" name="status" placeholder="Section Status" required>

                <input type="submit" name="section_submit" value="Add a Section">
        </form>
        <form id="remove_section" action="manage_sections.php" method="post" size="10">
            <select name="sec_shrt_nm" form="remove_section" required>

                <?php
                  $q = "SELECT * FROM sections";
                  $result = mysqli_query($connection, $q);

                  confirm_query($result);
                  //$_POST['sec_short_nm'] = NULL;

                  echo "<option value=NULL> </option>";
                  while($sec_values = mysqli_fetch_assoc($result)) {
                ?>

                    <option value="<?php echo htmlentities($sec_values['short_section_name']) ?>" ><?php echo htmlentities($sec_values['section_name']) ?></option>

                <?php
                  }
                ?>

            </select>
                <input type="submit" name="rmv_sec_submit" value="Remove a Section">

                <?php if(isset($_POST['rmv_sec_submit'])) {
                        $ssn = mysqli_real_escape_string($connection, $_POST['sec_shrt_nm']);

                        $q = "DELETE FROM sections WHERE short_section_name = '{$ssn}'";
                        $result = mysqli_query($connection, $q);

                        confirm_query($result);
                        echo "Deleted successfully!";

                      }
                      else {
                        $ssn = NULL;
                      }

                ?>
        </form>
    </body>
</html>
