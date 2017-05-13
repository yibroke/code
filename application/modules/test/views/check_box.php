
<form action="<?php echo base_url(); ?>test/check_box_submit" method="post">
    <!-- Choices -->
    Red     <input type="checkbox" name="color[]" id="color" value="Red"><br>
    Green   <input type="checkbox" name="color[]" id="color" value="Green"><br>
    Blue    <input type="checkbox" name="color[]" id="color" value="Blue"><br>
    Cyan    <input type="checkbox" name="color[]" id="color" value="Cyan"><br>
    Magenta <input type="checkbox" name="color[]" id="color" value="Magenta"><br>
    Yellow  <input type="checkbox" name="color[]" id="color" value="Yellow"><br>
    Black   <input type="checkbox" name="color[]" id="color" value="Black"><br>
    <!-- Submit -->
    <input type="submit" name="submit" value="submit">
</form>

