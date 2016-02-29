<html>

<?php

try {

	$db = new PDO('mysql:host=localhost;dbname=employees;charset=utf8', 'username', 'password');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$cache = new Memcached(); //Build a new memcached object
	$cache->addServer('localhost', 11211); //11211 should always be the second parameter
	$key = 'some SQL query'; //This is the key for a key-value pair in the cache object

	$result = $cache->get($key); //See if there's data for this query in the cache

	//If there's nothing in the cache, we need to query the SQL server
	if (!$result) {

  	 $select = db->query("SELECT first_name FROM employee where last_name = 'bob'"); //Execute the query on SQL server
   	 
   	 $result = $select->fetchAll(PDO::FETCH_OBJ); //Fetch result 
   	 $cache->set($key, serialize($row)); //Load the result into the cache
	
	} else {

		//If there is something in the cache, we're all good!

	}

	//Down here we'd use the query for something. For example:
	foreach($result as $item){
		echo $item['first_name'] . " ";
		echo $item['last_name'] . ": ";
		echo "$" .$item['salary'] . "<br \>";
	}

} catch(PDOException $e){
	echo "Error: " . $e->getMessage();
}
?>

</html>
