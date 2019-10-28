<?php

namespace App\Services;

interface TranslateAdapterInterface {

	public function translate($text, $target, $source = null);
}
