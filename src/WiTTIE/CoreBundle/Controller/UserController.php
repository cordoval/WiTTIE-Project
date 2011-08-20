<?php

namespace WiTTIE\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/user")
 */
class UserController extends Controller
{
	/**
	 * @Route("/{username}")
	 * @Template()
	 */
	public function showAction($username)
	{
		return array('username' => $username);
	}
	
	/**
	 * @Template()
	 */
	public function navigationAction()
	{
		return array();
	}
}
