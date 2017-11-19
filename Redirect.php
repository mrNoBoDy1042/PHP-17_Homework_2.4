<?php
function redirect($header){
  header("$header");
  exit;
}
