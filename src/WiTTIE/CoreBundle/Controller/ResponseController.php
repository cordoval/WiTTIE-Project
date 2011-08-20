<?php

namespace WiTTIE\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use WiTTIE\CoreBundle\WiTTIEGlobals;
use WiTTIE\CoreBundle\Entity\Page;

/**
 * @Route("/response")
 */
class ResponseController extends Controller
{
	/**
	 * @Route("/{id}")
	 * @Template()
	 */
	public function showAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$repo = $em->getRepository('WiTTIE\CoreBundle\Entity\Response');
		
		$response = $repo->findOneById($id);
		$editable = $this->get('security.context')->isGranted('ROLE_USER')?true:false;
		
		$repoP = $em->getRepository('WiTTIE\CoreBundle\Entity\Page');
		$page = $repoP->findOneById($response->getPage()->getId());
		WiTTIEGlobals::setBreadcrumb($repoP->getPath($page),false);
		
		return array(
			'response' => $response,
			'editable' => $editable,
		);
	}
	
	/**
	 * @Template()
	 */
	public function responsesAction(Page $page)
	{
		$responses = $page->getResponses();
		
		return array('responses' => $responses);
	}
}
