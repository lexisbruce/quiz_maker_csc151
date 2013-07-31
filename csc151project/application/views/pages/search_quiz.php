<form action="<?php echo site_url().'/controller/searchQuizzesSuccessful' ?>" method="post">
<input type="hidden" name="username" value="<?php echo $username ?>">
<input type="hidden" name="password" value="<?php echo $password ?>">

<fieldset>
<legend>Search Quiz by Category:</legend>
<select name = "category">
	<option>---------------------</option>
	<option value = "Mathematics">Mathematics</option>
	<option value = "English">English</option>
	<option value = "Computer">Computer</option>
	<option value = "History">History</option>
	<option value = "Science">Science</option>
	
	<input type = "submit" value = "Search"></input>
</select>
</fieldset>
</form>