<?php

namespace WiTTIE\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use WiTTIE\CoreBundle\WiTTIEGlobals;
use WiTTIE\CoreBundle\Entity\Page;

/**
 * @Route("/page")
 */
class PageController extends Controller
{
	/**
	 * @Route("/{id}")
	 * @Template()
	 */
	public function showAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$repo = $em->getRepository('WiTTIE\CoreBundle\Entity\Page');
		
		$page = $repo->findOneById($id);
		$editable = $this->get('security.context')->isGranted('ROLE_USER')?true:false;
		
		WiTTIEGlobals::setBreadcrumb($repo->getPath($page));
		
		return array(
			'page' => $page,
			'editable' => $editable,
		);
	}
	
	/**
	 * @Template()
	 */
	public function pagesAction(Page $page, $depth = 1)
	{
		$depth = 1;
		if($depth == 1)
			$children = $page->getChildren();
		else
		{
			$em = $this->getDoctrine()->getEntityManager();
			$repo = $em->getRepository('WiTTIE\CoreBundle\Entity\Page');
			
			$allChildren = $repo->children($page);
			$children = array();
			
			$children = array();
			$backtrack = array();
			$topLvl = $page->getLvl();
			$curLvl = 1;
			
			foreach($allChildren as $child)
				if(($lvl = $child->getLvl() - $topLvl) <= $depth)
				{
					$child = $child->getTitle();
					
					echo $lvl.' ';
					$children[] = $child;
				}
		}
		
		return array('children' => $children);
	}
}
