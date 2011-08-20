<?php

namespace WiTTIE\EditorBundle\Slot;

use Symfony\Component\Validator\Constraints as Assert;

class Richtext
{
	/**
	 * @Assert\NotBlank
	 */
	protected $content;
	
	protected $_options;
	
	public function setContent($content)
	{
		$this->content = $content;
		$this->_options['class'] = $content;
	}
	
	public function getContent()
	{
		return $this->content;
	}
	
	public function setOptions($options)
	{
		$this->_options = $options;
		$this->content = $options['content'];
	}
	
	public function getOptions()
	{
		return $this->_options;
	}
}