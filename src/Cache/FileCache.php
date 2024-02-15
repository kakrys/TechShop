<?php

namespace Up\Cache;

use Closure;
use Up\Models\Product;
use Up\Models\Brand;
use Up\Models\Image;
use Up\Models\Tag;

class FileCache
{
	public function set(string $key, mixed $value, int $ttl): void
	{
		$hash = sha1($key);
		$path = ROOT . '/var/cache/' . $hash . '.php';

		$data = [
			'data' => $value,
			'ttl' => time() + $ttl,
		];

		file_put_contents($path, serialize($data));

	}

	public function get(string $key): mixed
	{
		$hash = sha1($key);
		$path = ROOT . '/var/cache/' . $hash . '.php';

		if (!file_exists($path))
		{
			return null;
		}

		$data = unserialize(file_get_contents($path), ['allowed_classes' => [Tag::class,Brand::class,Product::class,Image::class]]);
		$ttl = $data['ttl'];

		if (time() > $ttl)
		{
			return null;
		}

		return $data;
	}

	public function remember(string $key, int $ttl, Closure $fetcher)
	{
		$data = $this->get($key);

		if ($data === null)
		{
			$value = $fetcher();
			$this->set($key, $value, $ttl);
			return $value;
		}

		return $data;

	}

}
