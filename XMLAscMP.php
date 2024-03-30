<?php
$db = mysqli_connect("localhost", "root", "", "ratingsystem");


$sql = "SELECT * FROM dish_review ORDER BY dish_overall_rating ASC";
$result = mysqli_query($db, $sql);
$all_data = array();
while($row = mysqli_fetch_assoc($result))
{
    $all_data[] = $row;
}

$xml = new DOMDOCUMENT('1.0', 'utf-8');
$dish_reviews = $xml->createElement('dish_reviews');
$xml->appendChild($dish_reviews);
foreach($all_data as $row)
{
    $dish_review = $xml->createElement('dish_review');
    $dish_reviews->appendChild($dish_review);

    $dish_review_id = $xml->createElement('dish_review_id', $row['dish_review_id']);
    $dish_review->appendChild($dish_review_id);
    $dish_id = $xml->createElement('dish_id', $row['dish_id']);
    $dish_review->appendChild($dish_id);
    $user_id = $xml->createElement('user_id', $row['user_id']);
    $dish_review->appendChild($user_id);
    $dish_overall_rating = $xml->createElement('dish_overall_rating', $row['dish_overall_rating']);
    $dish_review->appendChild($dish_overall_rating);


    $dish_quality_rating = $xml->createElement('dish_quality_rating', $row['dish_quality_rating']);
    $dish_review->appendChild($dish_quality_rating);
    $dish_price_rating = $xml->createElement('dish_price_rating', $row['dish_price_rating']);
    $dish_review->appendChild($dish_price_rating);
    $dish_review_text = $xml->createElement('dish_review_text', $row['dish_time_of_upload']);
    $dish_review->appendChild($dish_review_text);
}


$xml->formatOutput = true;
$xml->saveXML();
$xml->save('xmlascmp.xml');

echo "<br> XML file has been created <br>";


$xml2 = simplexml_load_file('xmlascmp.xml');

foreach($xml2->dish_review as $row)
{
    echo $row->dish_review_id . "<br>";
    echo $row->dish_id . "<br>";
    echo $row->user_id . "<br>";
    echo $row->dish_overall_rating . "<br>";
    echo $row->dish_quality_rating . "<br>";
    echo $row->dish_price_rating . "<br>";
    echo $row->dish_review_text . "<br>";
}



?>