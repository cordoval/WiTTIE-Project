<?php

namespace WiTTIE\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use WiTTIE\CoreBundle\Entity\User;
use WiTTIE\CoreBundle\Entity\Page;
use WiTTIE\CoreBundle\Entity\Response;
use WiTTIE\EditorBundle\Entity\Slot;
use WiTTIE\CoreBundle\WiTTIEGlobals;

class DefaultController extends Controller
{
	/**
	 * @Route("/", name="_homepage")
	 * @Template()
	 */
	public function indexAction()
	{
		return array();
	}
	
	/**
	 * @Route("/help")
	 * @Template()
	 */
	public function helpAction()
	{
		return array(
			'blank' => $this->getRequest()->query->get('format') == 'blank'?true:false,
		);
	}
	
	/**
	 * @Route("/load")
	 */
	public function loadAction()
	{
		if(!$this->get('security.context')->isGranted('ROLE_SUPER_ADMIN'))
		{
			$this->redirect($this->generateUrl('_homepage'));
		}
		
		$em = $this->getDoctrine()->getEntityManager();
		
		$users = array(
			array('Christopher','christopher@hmudesign.com'),
			array('Liz','christopher+liz@hmudesign.com'),
		);
		
		foreach($users as $i => $u)
		{
			$user = new User();
			$user->setUsername($u[0]);
			$user->setPlainPassword(strtolower($u[0]));
			$user->setEmail($u[1]);
			if(!$i) $user->addRole('ROLE_SUPER_ADMIN');
			$user->setEnabled(true);
			$em->persist($user);
			
			$slot = new Slot('title');
			$slot->setUser($user);
			$em->persist($slot);
			
			$slot = new Slot('richtext',array('content' => '<p>'.$u[0].'</p>'));
			$slot->setUser($user);
			$em->persist($slot);
		}
		
		$pages = array(
			'In Our Schools' => array(
				'slots' => array(
					array('title'),
					array('richtext',array('content' => "<p>This education text is being created by pre-service teachers at Old Dominion University enrolled in TLED 301. The text contains important readings for all educators.</p>"))
				),
				'Student Authored Content' => array(
					'slots' => array(
						array('title'),
						array('headline',array('content' => 'What Should A Good Article Include', 'level' => 2)),
						array('richtext',array('content' => "<ul>\n\t<li>Proper citation</li>\n\t<li>Specific learning objectives</li>\n\t<li>Flow/organization</li>\n\t<li>Strong title and catchy intro</li>\n\t<li>Multimedia; visually appealing</li>\n\t<li>Objective tone. NO BIAS!</li>\n\t<li>Grammar and spelling</li>\n\t<li>Quality information</li>\n</ul>")),
						array('rule',array('class' => 'stars')),
						array('headline',array('content' => 'What Should A Good Article Not Include', 'level' => 2)),
						array('richtext',array('content' => "<ul>\n\t<li>Personal opinion; bias</li>\n\t<li>Opinionated sentences</li>\n\t<li>False information</li>\n\t<li>Long quotes</li>\n</ul>")),
						array('rule',array('class' => '')),
					),
					'Ch 1 Diversity' => array(
						'Teaching Special Needs Students',
						'GLBT Students Inside & Outside of Class',
					),
					'Ch 2 Sociological Influences' => array(
						'Bullying',
						'Socioeconomic Status',
						'Head Down, Hood Up - Learned Helplessness',
					),
					'Ch 3 Being a Teacher' => array(
						'Philosophies and Philosophers',
						'Connecting to Students',
						'Wildcard',
					),
					'Ch 4 Education - Past Present and Future' => array(
						'Education Past - Lessons Learned',
						'Education Future - What Awaits Us?',
						'Alternative Models and Programs',
					),
					'Ch 5 Effective Teaching & Assessment' => array(
						'How Students Learn',
						'Project-Based Learning',
						'Student-led Conferences',
					),
				),
				'About The Authors',
				'Table of Contents',
			)
		);
		
		$this->load($em,$pages);
		$em->flush();
		
		return $this->redirect($this->generateUrl('_homepage'));
	}
	
	private function load($em, $pages, $parent = null)
	{
		foreach($pages as $title => $children)
		{
			if(is_int($title))
			{
				$title = $children;
				$children = null;
			}
			
			$page = new Page($title,$parent);
			
			if(isset($children['slots']))
			{
				foreach($children['slots'] as $s)
				{
					if(isset($s[1]))
						$slot = new Slot($s[0],$s[1]);
					else
						$slot = new Slot($s[0]);
					
					$slot->setPage($page);
					$em->persist($slot);
				}
				unset($children['slots']);
			}
			else
			{
				$slot = new Slot('title');
				$slot->setPage($page);
				$em->persist($slot);
				
				$slot = new Slot('richtext',array('content' => '<p>'.$title.'</p>'));
				$slot->setPage($page);
				$em->persist($slot);
			}
			
			$em->persist($page);
			
			if($parent) echo $parent->getLvl().' ';
			
			if(is_array($children))
				$this->load($em, $children, $page);
			elseif($parent and $parent->getParent())
			{
				foreach(range(1,5) as $i)
				{
					$response = new Response('Response '.$i,$page);
					
					$slot = new Slot('title');
					$slot->setResponse($response);
					$em->persist($slot);
					
					$slot = new Slot('richtext',array('content' => '<p>hello '.$i.'</p>'));
					$slot->setResponse($response);
					$em->persist($slot);
					
					$em->persist($response);
				}
			}
		}
	}
	
	/**
	 * @Template()
	 */
	public function catchAction()
	{
		return array();
	}
}
