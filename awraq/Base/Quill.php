<?php

namespace awraq\Base;

if (!defined('ABSPATH')) exit;

use Awraq\Base\Officer;

class Quill
{

	private $arrayData;

	public function set($data)
	{
		if (gettype($data) != 'string') return false;
		$this->arrayData = (array)json_decode($data);
	}

	/**
	 * get
	 *
	 * @param  mixed $type
	 * @return void
	 */
	public function get($type = null)
	{

		if ($type == 'html') {
			//get sanitized array
			//Convert Sanitized JSON to HTML
			//return sanitized html string
		}

		//Returning JSON after sanitization
		return json_encode($this->sanitizeJson($this->arrayData));
	}

	/**
	 * sanitizeJson
	 *
	 * @param  mixed $data
	 * @return void
	 */
	private function sanitize($data)
	{
		if (gettype($data) == 'array') {
			foreach ($data as $key => $value) {
				$data[$key] = $this->sanitize($value);
			}
		}
	}
}
