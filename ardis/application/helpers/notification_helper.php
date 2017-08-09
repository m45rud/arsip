<?php defined('BASEPATH') or exit('No direct script access allowed');

if (! function_exists('success')) {
	function success($text) {
		$alert = "
			<div id='notif' class='alert alert-success' role='alert'>
				<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
				<span class='sr-only'>Sukses:</span>
				$text
			</div>
		";

		return $alert;
	}
}

if (! function_exists('error')) {
	function error($text) {
		$alert = "
			<div id='notif' class='alert alert-error' role='alert'>
				<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
				<span class='sr-only'>Error:</span>
				$text
			</div>
		";

		return $alert;
	}
}
