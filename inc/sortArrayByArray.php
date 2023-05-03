<?php
function ifrs_sortArrayByArrayValues($array, $orderArray) {
  $ordered = array();
  foreach ($orderArray as $value) {
    $key = array_search($value, $array);
    if ($key !== false) {
      $ordered[$key] = $value;
      unset($array[$key]);
    }
  }
  return $ordered + $array;
}
