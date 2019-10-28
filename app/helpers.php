<?php

function googleCloudCredentials() {
	return config('services.google.cloud');
}

function isoLanguageCode($string) {
	$twoChars = explode('-', $string)[0];
	return strlen($twoChars) == 2 ? $twoChars : null;
}
