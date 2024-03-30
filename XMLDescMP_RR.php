<?php
$db = mysqli_connect("localhost", "root", "", "ratingsystem");


$sql = "SELECT * FROM resto_review ORDER BY resto_review_overall_rating DESC";
$result = mysqli_query($db, $sql);
$all_data = array();
while($row = mysqli_fetch_assoc($result))
{
    $all_data[] = $row;
}

$xml = new DOMDOCUMENT('1.0', 'utf-8');
$resto_reviews = $xml->createElement('resto_reviews');
$xml->appendChild($resto_reviews);
foreach($all_data as $row)
{
    $resto_review = $xml->createElement('resto_review');
    $resto_reviews->appendChild($resto_review);

    $resto_review_id = $xml->createElement('resto_review_id', $row['resto_review_id']);
    $resto_review->appendChild($resto_review_id);
    $resto_review_overall_rating = $xml->createElement('resto_review_overall_rating', $row['resto_review_overall_rating']);
    $resto_review->appendChild($resto_review_overall_rating);
    $resto_review_date = $xml->createElement('resto_review_date', $row['resto_review_date']);
    $resto_review->appendChild($resto_review_date);
    $resto_id = $xml->createElement('resto_id', $row['resto_id']);
    $resto_review->appendChild($resto_id);
    $user_id = $xml->createElement('user_id', $row['user_id']);
    $resto_review->appendChild($user_id);
}


$xml->formatOutput = true;
$xml->saveXML();
$xml->save('xmldescmp_rr.xml');

echo "<br> XML file has been created <br>";


$xml2 = simplexml_load_file('xmldescmp_rr.xml');

foreach($xml2->resto_review as $row)
{
    echo $row->resto_review . "<br>";
    echo $row->resto_review_id . "<br>";
    echo $row->resto_review_overall_rating . "<br>";
    echo $row->resto_review_date . "<br>";
    echo $row->resto_id . "<br>";
    echo $row->user_id . "<br>";
}



?>