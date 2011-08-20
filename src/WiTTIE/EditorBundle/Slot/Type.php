<?php

namespace WiTTIE\EditorBundle\Slot;

use Symfony\Component\Validator\Constraints as Assert;

class Type
{
	/**
	 * @Assert\NotBlank()
	 * #@Assert\Choice()
	 */
	protected $type;
	
	public function setType($type)
	{
		$this->type = $type;
	}
	
	public function getType()
	{
		return $this->type;
	}
}