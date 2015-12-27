<?php
	$OUT = "out.gif";
	$GIF_GEN_EXE = "./GenerateGif";
	$CLIENT_ID = "CLIENT_ID";
	$IMGUR_API = "https://api.imgur.com/3/image.json";

	$siteswap = $_GET['ss'];
	//check to make sure it's only valid characters
	$valid_chars = "/[a-zA-Z\d(,\*\[\])]*[a-zA-Z\d\*\])]+/";
	preg_match($valid_chars,$siteswap,$matches);
	if($matches[0] != $siteswap) {
		echo "Sorry, $siteswap is not a siteswap! (Contains invalid characters)";
		exit();
	}
	$sqlite_dir = 'sqlite:siteswaps.sqlite';
	$imgur_base_url = "http://i.imgur.com/";
	$dbh = new PDO($sqlite_dir) or die("cannot open sqlite db");
	$query = "SELECT * FROM siteswaps WHERE siteswap=:siteswap";
	$sth = $dbh->prepare($query);
	$sth->execute(array(':siteswap' => $siteswap));
	$result = $sth->fetchAll();
	foreach ($result as $row) {
		$imgurId = $row[2];
		header('Location: ' . $imgur_base_url . $imgurId . ".gif");
		exit();
	}
	//No result found, call the siteswap bot...
	if(file_exists($OUT)) unlink($OUT);
	shell_exec("xvfb-run " . $GIF_GEN_EXE . ' "' . $siteswap . '"');
	if(!file_exists($OUT)) {
		echo "<html><head></head><body>";
		echo "Sorry, <code>" . htmlspecialchars($siteswap) . "</code> is not a siteswap!";
		echo "</body></html>";
		exit();
	}
	$id = uploadGif($OUT);
	if($id == "") {
		echo "Problem uploading to imgur...sorry";
		exit();
	}
	//first, check to make sure it's not already been added to the db...
	$result = $dbh->query($query);
	foreach($result as $row) {
		$imgurId = $row[2];
		header('Location: ' . $imgur_base_url . $imgurId . ".gif");
		exit();
	}
	//insert into db
	$stmt = $dbh->prepare("INSERT INTO siteswaps (SITESWAP,URL) VALUES (:ss, :url)");
	$stmt->bindParam(":ss",$siteswap);
	$stmt->bindParam(":url",$id);
	$stmt->execute();
	//now that it's in the db, change the location.
	header('Location: ' . $imgur_base_url . $id . ".gif");
	return;

	function uploadGif($filename) {
		global $CLIENT_ID,$IMGUR_API;
		$handle = fopen($filename, "r");
		$data = fread($handle, filesize($filename));
		$pvars = array('image' => base64_encode($data));
		$timeout = 30;
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $IMGUR_API);
		curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $CLIENT_ID));
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
		$out = curl_exec($curl);
		curl_close($curl);
		$pms = json_decode($out,true);
		$id = $pms['data']['id'];
		return $id;
	}
?>
