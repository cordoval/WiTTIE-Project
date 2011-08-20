<?php

namespace WiTTIE\CoreBundle;

use Symfony\Component\EventDispatcher\Event;

use WiTTIE\CoreBundle\Entity\Page;

class WiTTIEGlobals
{
	protected static $book;
	protected static $breadcrumb;
	
	protected static $slot_types = array(
		'headline' => array(),
		'ckeditor' => array(),
		'rule' => array(),
	);
	
	public static function setBook(Page $book)
	{
		self::$book = $book;
	}
	
	public function getBook()
	{
		if(self::$book)
			return self::$book;
		return null;
	}
	
	public static function setBreadcrumb($breadcrumb, $pop = true)
	{
		if($pop)
			$last = array_pop($breadcrumb);
		
		self::$breadcrumb = $breadcrumb;
		
		if(! $book = array_shift($breadcrumb))
			$book = $last;
		self::setBook($book);
	}
	
	public function getBreadcrumb()
	{
		if(self::$breadcrumb)
			return self::$breadcrumb;
		return null;
	}
	
	public function getSlotTypes()
	{
		return self::$slot_types;
	}
}
