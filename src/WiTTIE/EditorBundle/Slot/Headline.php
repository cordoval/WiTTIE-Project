<?php

namespace WiTTIE\EditorBundle\Slot;

use Symfony\Component\Validator\Constraints as Assert;

class Headline
{
	/**
	 * @Assert\NotBlank
	 */
	protected $title;
	
	protected $_options;
	
	public function setTitle($title)
	{
		$this->title = $title;
		$this->_options['content'] = $title;
	}
	
	public function getTitle()
	{
		return $this->title;
	}
	
	public function setOptions($options)
	{
		$this->_options = $options;
		$this->title = $options['content'];
	}
	
	public function getOptions()
	{
		return $this->_options;
	}
}