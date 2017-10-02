
<?php
require("include/db.php");
require("include/header.php");
require("include/nav.php");
require("include/rss_util.php");

$form = <<< 'HTML'
<br />
<br />
<form action="search.php" method="POST">
    <div align="center">
        <span id="desc"> Search news:</span>
        <input type="text" name="input" />
        <input type="submit" value="Submit" />
    </div>
</form>
HTML;

echo $form;
// Get user input
$input = $_POST['input'];
echo "<br />Results for: ";
echo $input;

echo "<div id=\"content\">\n";

$query = "SELECT DISTINCT items.id AS id,feedTitle,feedLink,itemTitle,itemPubDate,itemLink,itemDesc FROM feeds,items WHERE items.itemDesc LIKE '%" . $input . "%' " . "OR items.itemTitle LIKE '%" . $input . "%'";
DisplayColumn($db, $query);

echo "</div>\n";

function DisplayColumn($db, $query)
{
	if (isset($_GET['feed'])) {
		$query .= " WHERE id=" . $_GET['feed'];
	}
	$rows = Query($db, $query);
	$rssItems = LoadCachedItems($rows);

	$prev = NULL;
	foreach ($rssItems as $item) {
		DisplayItem($prev, $item);
		$prev = $item;
	}
}

function DisplayItem($prev, $item)
{
    echo "<article>";

    // Separator (or not) and feed title
    if ($prev == NULL || $prev['feedTitle'] != $item['feedTitle'] ) {
	echo "<div class=\"itemSep\"></div>\n";

	// Feed favicon.ico
	$url = preg_replace('/^https?:\/\//', '', $item['feedLink']);
	if ($url != "") {
		$imgurl = "https://www.google.com/s2/favicons?domain=";
		$imgurl .= $url;

		echo "<div class=\"feedIcon\">";
		"\" type=\"image/x-icon\"></div>\n";
		echo '<img src="';
		echo $imgurl;
		echo '" width="16" height="16" />';
		echo "</div>\n";
	}

	// Feed title
	if (($item['feedTitle'] != NULL) &&
	    (strlen($item['feedTitle']) > 0)) {
		echo "<span class=\"feedTitle\">" .
			"<a href=\"http://aggregation.co?feed=" .
			$item['id'] . "\">" .  $item['feedTitle'] .
			"</a></span>\n";
	}
    }
    // Item pub date
    date_default_timezone_set("America/Denver");
    echo "<span class=\"itemPubDate\">" .
	date("M j  g:ia", strtotime($item['itemPubDate'])) .
	"</span>\n";

    // Item title
    echo "<div class=\"itemTitle\">";

    if (($item['itemTitle'] != NULL) && (strlen($item['itemTitle']) > 0)) {

        if ($item['itemLink'] != NULL)
	    echo "<a href=\"" . $item['itemLink'] . "\">";

	echo $item['itemTitle'];

        if ($item['itemLink'] != NULL)
	    echo "</a>";

    }
    echo "</div>\n";

    // Item description
    echo "<div class=\"itemDesc\">" . $item['itemDesc'] . "</div>\n";
    echo "</article>\n";
}

require("include/footer.php");
?>
