<?php
require_once"src/vendor/autoload.php";

$title = $_POST["title"];
$text = $_POST["text"];
$sentences_number = $_POST["sentences_number"];
$textapi = new AYLIEN\TextAPI("902d185f", "030d0697982d6fe0eb11914fa314e97e");
$summary = $textapi->Summarize(array('title' => $title, 'text' => $text, 'sentences_number' => $sentences_number));
foreach ($summary->sentences as $sentence) {
  echo "<li>",$sentence,"</li></br>";
}
?>