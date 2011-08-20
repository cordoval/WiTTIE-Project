<?php

namespace WiTTIE\EditorBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
	/**
	 * @Route("/edit/{id}")
	 */
	public function editAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$repo = $em->getRepository('WiTTIE\EditorBundle\Entity\Slot');
		
		$slot = $repo->findOneById($id);
		
		$ajax = $this->getRequest()->isXmlHttpRequest();
		$controller = 'WiTTIEEditorBundle:Slot:'.$slot->getType().'Edit';
		$content = $this->forward($controller, array('slot' => $slot));
		
		if($ajax)
		{
			$options = array();
			if($content->getContent() == 'reload')
				$options = array('reload' => true);
			else
			{
				$options = array('content' => $content->getContent(), 'form' => true);
				if($slot->getType() == 'richtext')
					$options['width'] = 540;
			}
			
			return new Response(json_encode($options));
		}
		else
			return $content;
	}
	
	/**
	 * @Route("/delete/{id}")
	 * @Template()
	 */
	public function deleteAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$repo = $em->getRepository('WiTTIE\EditorBundle\Entity\Slot');
		
		$slot = $repo->findOneById($id);
		
		$em->remove($slot);
		$em->flush();
		
		return new Response(json_encode(array('reload' => true)));
	}
	
	/**
	 * @Route("/up/{id}")
	 * @Template()
	 */
	public function upAction($id)
	{
		return array();
	}
	
	/**
	 * @Route("/down/{id}")
	 * @Template()
	 */
	public function downAction($id)
	{
		return array();
	}
	
	/**
	 * @Route("/new/{id}/{type}", defaults={ "type" = null })
	 * @Template()
	 */
	public function newAction($id, $type)
	{
		$type = new \WiTTIE\EditorBundle\Slot\Type();
		
		$form = $this->createFormBuilder($type)
			->add('type','choice',array('expanded' => true, 'choices' => array('headline','richtext','rule')))
			->getForm();
		
		if ($this->getRequest()->getMethod() == 'POST')
		{
			$form->bindRequest($this->getRequest());
			if ($form->isValid())
			{
				$em = $this->getDoctrine()->getEntityManager();
				$repo = $em->getRepository('WiTTIE\EditorBundle\Entity\Slot');
				
				$slot = $repo->findOneById($id);
				$page = $slot->getPage();
				
				$slot = new \WiTTIE\EditorBundle\Entity\Slot($type->getType());
				
				$em->persist($slot);
				$em->flush();
				
				return new Response('reload');
			}
		}
		
		$content = $this->render('WiTTIEEditorBundle:Default:new.html.twig', array('id' => $id, 'form' => $form->createView()));
		
		return new Response(json_encode(array('content' => $content->getContent(), 'form' => true)));
	}
	
	/**
	 * @Template()
	 */
	public function slotsAction($slots, $editable = false)
	{
		return array(
			'slots' => $slots,
			'editable' => $editable,
		);
	}
}
