<?php

namespace WiTTIE\EditorBundle\Slot;

use Symfony\Component\Validator\Constraints as Assert;

class Richtext
{
	/**
	 * @Assert\NotBlank
	 */
	protected $content;
	
	protected $_options = array();
	
	protected $_defaults = array(
		'content' => '',
	);
	
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
		$this->_options = array_merge($this->_defaults,$options);
		$this->content = $options['content'];
	}
	
	public function getOptions()
	{
		return array_merge($this->_defaults, $this->_options);
	}}