<?php require(PROTECT);

class test extends Libraries {
	function input() {
		echo "<script>alert('construct works');</script>";
	}
	function input() {
		echo "<script>alert('works');</script>";
	}
}
new test();