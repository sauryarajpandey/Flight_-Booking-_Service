<?php

$a[] = "KTM";
$a[] = "Chituwan";
$a[] = "Vellore";
$a[] = "Dehli";
$a[] = "Bangalore";
$a[] = "Bangladesh";
$a[] = "Chennai";
$a[] = "Kalluam";
$a[] = "Bhaktapur";
$a[] = "Lumbini";
$a[] = "Swayambhu";
$a[] = "India";
$a[] = "Nepal";
$a[] = "China";


$q = $_REQUEST["q"];

$hint = "";

if ($q !== "") {
  $q = strtolower($q);
  $len=strlen($q);
  foreach($a as $name) {
    if (stristr($q, substr($name, 0, $len))) {
      if ($hint === "") {
        $hint = $name;
      } else {
        $hint .= ", $name";
      }
    }
  }
}


echo $hint === "" ? "no suggestion" : $hint;
?>
