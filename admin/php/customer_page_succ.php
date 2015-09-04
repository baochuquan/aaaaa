
<?php
require ('../../includes/config.inc.php');

//redirect if is not admin or unlogged in
if (!isset($_COOKIE['username']) || ($_COOKIE['userlevel'] == 0)) {
	$url = BASE_URL .'index.html';
	header("Location: $url");
	exit();
}
else { 
	// Need the database connection:
	require (MYSQL);
	$start = $_POST["start"];
	if ($_POST["id"] == "successusers") {
			// Fetch all the information of users;
			$q = "SELECT user_id, username, usermail, regist_date, active FROM users WHERE userlevel=0 AND active IS NULL ORDER BY regist_date DESC LIMIT {$start},20";
			$r = @mysqli_query($dbc, $q);
			if (!$r) {
		 		printf("Error: %s\n", mysqli_error($dbc));
		 		exit();
		 	}
		 	$i = 0;
			while ($eachuser = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
				$i++;
				echo 	'<tr>
							<td>' . $i . '</td>
							<td>' . $eachuser['user_id'] . '</td>
							<td>' . $eachuser['username'] . '</td>
							<td>' . $eachuser['usermail'] . '</td>
							<td>' . $eachuser['regist_date'] . '</td>
						 	<td>已激活</td>
						</tr>';
			}
	}
	mysqli_free_result($r);
	mysqli_close($dbc);
}
?>
