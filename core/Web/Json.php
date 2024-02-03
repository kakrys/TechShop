<?php

namespace Core\Web;

class Json
{
	public static function encode($data, $options = null): string|bool
	{
		if ($options === null)
		{
			$options = JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_THROW_ON_ERROR;
		}
		return json_encode($data, $options);
	}

	/**
	 * @throws \JsonException
	 */
	public static function decode($data): mixed
	{
		return json_decode($data, true, 512,JSON_THROW_ON_ERROR);
	}
}