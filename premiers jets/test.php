<form method="post">

<input type="text" name="test1"> c'est le premier test
<input type="text" value="test2"> c'est le second
<input type="text" name="test3" value="testostérone"> c'est le troisième
<input type="text" name="test4" value=" "> c'est le quatre

<input type="submit" name="submit">

</form>

<?php
print_r($_POST['test1']);
echo "</br>";
print_r($_POST['test2']);
echo "</br>";
print_r($_POST['test3']);
echo "</br>";
print_r($_POST['test4']);
echo "</br>";
?>