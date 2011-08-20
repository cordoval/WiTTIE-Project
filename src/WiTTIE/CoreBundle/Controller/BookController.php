<?php

namespace WiTTIE\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use WiTTIE\CoreBundle\WiTTIEGlobals;
use WiTTIE\CoreBundle\Entity\User;
use WiTTIE\CoreBundle\Entity\Page;
use WiTTIE\CoreBundle\Entity\Response;

/**
 * @Route("/book")
 */
class BookController extends Controller
{
	/**
	 * @Route("/find")
	 * @Template()
	 */
	public function findAction()
	{
		$em = $this->getDoctrine()->getEntityManager();
		$repo = $em->getRepository('WiTTIE\CoreBundle\Entity\Page');
		
		$books = $repo->getRootNodes();
		
		return array('books' => $books);
	}
	
	/**
	 * @Route("/build")
	 * @Template()
	 */
	public function buildAction()
	{
		return array();
	}
	
	/**
	 * @Template()
	 */
	public function navigationAction()
	{
		return array();
	}
}
