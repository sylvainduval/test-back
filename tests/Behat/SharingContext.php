<?php

namespace App\Tests\Behat;

use Behat\Behat\Context\Context;
use Twig\Environment;

class SharingContext implements Context, \ArrayAccess
{
	/** @var array */
	private $values = [];

	/** @var Environment */
	private $twig;

	public function __construct(Environment $twig)
	{
		$this->twig = $twig;
	}

	/**
	 * @param string $string
	 *
	 * @return string
	 * @throws \Exception
	 */
	public function renderTwigTemplate(string $string): string
	{
		try {
			return $this->twig->render(
				$this->twig->createTemplate($string),
				$this->values
			);
		} catch (\Exception $e) {
			throw new \Exception('Exception occurs while rendering Twig Template');
		}
	}

	public function offsetExists($offset): bool
	{
		return array_key_exists($offset, $this->values);
	}

	public function offsetGet($offset)
	{
		return $this->values[$offset];
	}

	public function offsetSet($offset, $value): void
	{
		$this->values[$offset] = $value;
	}

	public function offsetUnset($offset): void
	{
		unset($this->values[$offset]);
	}

	public function merge(array $array): void
	{
		$this->values = array_merge($this->values, $array);
	}
}
