<?php
	if (!function_exists('isAuth')) {
		function isAuth() {
			if (isset($_SESSION['user']) && !empty($_SESSION['user']))
				return true;
			else
				return false;
		}
	}