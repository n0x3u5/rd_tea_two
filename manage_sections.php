<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>R.D. Tea | Manage Sections</title>
    </head>
    <body>
        <form id="add_section" action="#" method="post">
                <input type="text" name="section_name" placeholder="Section Name">
                <input type="text" name="section_short_name" placeholder="Section Short Name">
                <input type="number" name="section_area" placeholder="Section Area">
                <input type="text" name="status" placeholder="Section Status">
                <input type="submit" name="section_submit" value="Add a Section">
        </form>
        <form id="remove_section" action="#" method="post" size="10">
            <select name="section_list" form="remove_section" required>
                <option value="1EXTA">1 Extension A</option>
                <option value="1EXTB">1 Extension B</option>
                <option value="3EXT">3 Extension</option>
                <option value="4W">4 West</option>
                <option value="7Y">7 Young</option>
                <option value="8W">8 West</option>
                <option value="11N">11 North</option>
                <option value="12S">12 South</option>
                <option value="20">20</option>
                <option value="19">19</option>
            </select>
                <input type="submit" name="section_submit" value="Remove a Section">
        </form>
    </body>
</html>
