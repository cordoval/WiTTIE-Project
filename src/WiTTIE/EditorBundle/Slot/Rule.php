<?php

namespace WiTTIE\EditorBundle\Slot;

use Symfony\Component\Validator\Constraints as Assert;

class Rule
{
	/**
	 * #@Assert\Choice(callback = "getStyles")
	 */
	protected $style;
	
	protected $_options;
	
	
	public static $styles = array(''=>'Plain','stars'=>'Stars');
	
	public static function getStyles()
	{
		return self::$styles;
	}
	
	public function setStyle($style)
	{
		$this->style = $style;
		$this->_options['class'] = $style;
	}
	
	public function getStyle()
	{
		return $this->style;
	}
	
	public function setOptions($options)
	{
		$this->_options = $options;
		$this->style = $options['class'];
	}
	
	public function getOptions()
	{
		return $this->_options;
	}
}