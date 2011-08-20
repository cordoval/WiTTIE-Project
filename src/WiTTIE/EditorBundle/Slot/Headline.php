<?php

namespace WiTTIE\EditorBundle\Slot;

use Symfony\Component\Validator\Constraints as Assert;

class Headline
{
	/**
	 * @Assert\NotBlank
	 */
	protected $title;
	
	/**
	 * @Assert\NotBlank
	 */
	protected $level;
	
	protected $_options = array();
	
	protected $_defaults = array(
		'content' => 'Headline',
		'level' => '2',
	);
	
	public function setTitle($title)
	{
		$this->title = $title;
		$this->_options['content'] = $title;
	}
	
	public function getTitle()
	{
		return $this->title;
	}
	
	public function setLevel($level)
	{
		$this->level = $level;
		$this->_options['level'] = $level;
	}
	
	public function getLevel()
	{
		return $this->level;
	}
	
	public function setOptions($options)
	{
		$this->_options = array_merge($this->_defaults,$options);
		$this->title = $options['content'];
		$this->level = $options['level'];
	}
	
	public function getOptions()
	{
		return array_merge($this->_defaults, $this->_options);
	}
}