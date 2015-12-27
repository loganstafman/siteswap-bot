<?php
$limit = $_GET['l'];
$offset = $_GET['o'];
if(!isset($limit)) $limit = 6;
if(!isset($offset)) $offset = 0;
$sqlite_dir = 'sqlite:siteswaps.sqlite';
$imgur_base_url = "http://i.imgur.com/";
$dbh = new PDO($sqlite_dir) or die("cannot open sqlite db");
$query = "SELECT * FROM siteswaps ORDER BY ID DESC LIMIT :limit OFFSET :offset";
$sth = $dbh->prepare($query);
$sth->execute(array(':limit' => $limit, ':offset' => $offset));
foreach ($sth->fetchAll() as $row) {
	$siteswap = $row[1];
	$link = $imgur_base_url . $row[2] . ".gif";
	echo '<div class="col-sm-4 portfolio-item">
                     <a href="http://siteswapbot.com/' . $siteswap . '" class="portfolio-link" data-toggle="modal">
                         <div class="caption">
                             <div class="caption-content">
                                 <i class="fa fa-search-plus fa-3x">' . $siteswap . '</i>
                             </div>
                         </div>
                         <img src="' . $link . '" class="img-responsive" alt="">
                     </a>
                 </div>';
}
?>
