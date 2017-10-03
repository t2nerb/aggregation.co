<?php
require("include/db.php");
require("include/header.php");
require("include/nav.php");

$form = <<< 'HTML'
<br />
<br />
<form action="feeds.php" method="POST">
    <div align="center">
        <span id="desc"> Add RSS feed:</span>
        <input type="text" name="input" placeholder="URL" />
        <input type="text" name="colnum" placeholder="Column number"/>
        <input type="submit" value="Submit" />
    </div>
</form>
HTML;
echo $form;

$input = $_POST['input'];
$colnum = $_POST['colnum'];

$add_query = "INSERT INTO feeds (displayColumn, link) VALUES (" . $colnum . ", '" . $input . "')";
// echo $add_query;
Query($db, $add_query);

// Get all the user's feeds
$query = "SELECT * FROM feeds";
$rows = Query($db, $query);


function FeedIcon($link)
{
        // Feed favicon.ico
        $url = preg_replace('/^https?:\/\//', '', $link);
        if ($url != "") {
                $imgurl = "https://www.google.com/s2/favicons?domain=";
                $imgurl .= $url;

                echo "<div class=\"feedsListIcon\">";
                "\" type=\"image/x-icon\"></div>\n";
                echo '<img src="';
                echo $imgurl;
                echo '" width="16" height="16" />';
                echo "</div>\n";
        }


}

// Create an array of links and titles
foreach ($rows as $row) {
	echo "<article>";
	$rss = simplexml_load_file($row['link']);
	if ($rss) {
		FeedIcon($row['link']);

		if (strlen($rss->channel->title) == 0) {
			echo "<span class=\"feedsListTitle\">" .
			    "<a href=\"./?feed=" .
			    $row['id'] .
			    "\">" .
			    $row['link'] .
			    "</a></span>\n";
/*
			echo "<span class=\"feedsListTitle\">" .
			    $row['link'] . "</span>\n";
*/
		} else {
			echo "<span class=\"feedsListTitle\">" .
			    "<a href=\"./?feed=" .
			    $row['id'] .
			    "\">" .
			    $rss->channel->title .
			    "</a></span>\n";
/*
			echo "<span class=\"feedsListTitle\">" .
			    $rss->channel->title . "</span>\n";
*/
		}
		echo "<div class=\"feedsListLink\">" .  $row['link'] .
		    "</div>\n";

	} else {
		echo "<div>" . $row['link'] . " not found</div>\n";
	}
	echo "</article>\n";
}

require("include/footer.php");
