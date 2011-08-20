<?php

namespace WiTTIE\CoreBundle\EventListener;

use Symfony\Component\EventDispatcher\Event;
use WiTTIE\CoreBundle\WiTTIEGlobals;

class WiTTIEListener
{
	protected $twig;
	
	public function __construct(\Twig_Environment $twig)
	{
		$this->twig = $twig;
	}
	
	public function listener(Event $event)
	{
		$this->twig->addGlobal('wittie', new WiTTIEGlobals());
	}
}
