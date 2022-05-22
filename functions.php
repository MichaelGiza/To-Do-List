<?php
function connection_sql() {               
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'tasked';
    try {
    	return new PDO('mysql:host=' . $servername . ';dbname=' . $dbname . ';charset=utf8', $username, $password);
    } catch (PDOException $exception) {
    	exit('Failed to connect to database!');
    }
}

function template($file_name) {            
echo <<<EOT
<html>
	<head>
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
    <nav class="navigation">
    	<div>
    		<h1>Database for orders:</h1>
    	</div>
    </nav>
EOT;
}

?>
    </body>
</html>