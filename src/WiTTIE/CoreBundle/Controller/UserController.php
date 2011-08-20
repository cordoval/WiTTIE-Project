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
	 * @Route("/{username}", defaults = { "username" = null})
	 * @Template()
	 */
	public function showAction($username = null)
	{
		if($username == null)
		{
			$user = $this->container->get('security.context')->getToken()->getUser();
			$editable = true;
		}
		else
		{
			$user = array();
			$editable = false;
		}
		
		return array(
			'user' => $user,
			'editable' => $editable,
		);
	}
	
	/**
	 * @Template()
	 */
	public function navigationAction()
	{
		return array();
	}
}
