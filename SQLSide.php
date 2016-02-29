<html>

<?php

try {
	$db = new PDO('mysql:host=localhost;dbname=employees;charset=utf8', 'username', 'password');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//An example query from class. The concatenation of the MYSQLND_QC_ENABLE_SWITCH flag at the start of the query tells SQL to cache the result.
	$select = $db->query("/*" . MYSQLND_QC_ENABLE_SWITCH . "*/" . "SELECT first_name, last_name, salary FROM employees e, salaries s WHERE e.emp_no = s.emp_no AND s.salary > 150000 AND s.to_date IN (SELECT max(to_date) FROM salaries) ORDER BY s.salary");


	//Print out results (not specific to this example)
	$myArr = $select->fetchAll(PDO::FETCH_ASSOC);
	foreach($myArr as $item){
		echo $item['first_name'] . " ";
		echo $item['last_name'] . ": ";
		echo "$" .$item['salary'] . "<br \>";
	}

} catch(PDOException $e){
	echo "Error: " . $e->getMessage();
}
?>

</html>
