<?php

function helloWorld(){
	echo "Hello World!";
}

function pre_dump($arg, $die = null){
	echo "<pre>";
	var_dump($arg);
	echo "</pre>";
	if($die) die;
}