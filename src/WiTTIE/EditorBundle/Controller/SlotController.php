<?php

namespace WiTTIE\EditorBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class SlotController extends Controller
{
	public function viewAction($slot, $editable = false)
	{
		$controller = 'WiTTIEEditorBundle:Slot:'.$slot->getType().'View';
		
		if($editable)
			$slot->setEditable();
		
		return $this->forward($controller ,array('slot' => $slot));
	}
	
	/**
	 * @Template()
	 */
	public function titleViewAction($slot)
	{
		return array('slot' => $slot);
	}
	
	/**
	 * @Template()
	 */
	public function titleEditAction($slot)
	{
		return array('slot' => $slot);
	}
	
	/**
	 * @Template()
	 */
	public function headlineViewAction($slot)
	{
		return array('slot' => $slot);
	}
	
	/**
	 * @Template()
	 */
	public function headlineEditAction($slot)
	{
		$headline = new \WiTTIE\EditorBundle\Slot\Headline();
		$headline->setOptions($slot->getOptions());
		
		$form = $this->createFormBuilder($headline)
			->add('title','text')
			->getForm();
		
		if ($this->getRequest()->getMethod() == 'POST')
		{
			$form->bindRequest($this->getRequest());
			if ($form->isValid())
			{
				$em = $this->getDoctrine()->getEntityManager();
				$slot->setOptions($headline->getOptions());
				$em->flush();
				
				return new Response('reload');
			}
		}
		
		return array('slot' => $slot, 'form' => $form->createView());
	}
	
	/**
	 * @Template()
	 */
	public function richtextViewAction($slot)
	{
		return array('slot' => $slot);
	}
	
	/**
	 * @Template()
	 */
	public function richtextEditAction($slot)
	{
		$richtext = new \WiTTIE\EditorBundle\Slot\Richtext();
		$richtext->setOptions($slot->getOptions());
		
		$form = $this->createFormBuilder($richtext)
			->add('content','textarea')
			->getForm();
		
		if ($this->getRequest()->getMethod() == 'POST')
		{
			$form->bindRequest($this->getRequest());
			if ($form->isValid())
			{
				$em = $this->getDoctrine()->getEntityManager();
				$slot->setOptions($richtext->getOptions());
				$em->flush();
				
				return new Response('reload');
			}
		}
		
		return array('slot' => $slot, 'form' => $form->createView());
	}
	
	/**
	 * @Template()
	 */
	public function ruleViewAction($slot)
	{
		return array('slot' => $slot);
	}
	
	/**
	 * @Template()
	 */
	public function ruleEditAction($slot)
	{
		$rule = new \WiTTIE\EditorBundle\Slot\Rule();
		$rule->setOptions($slot->getOptions());
		
		$form = $this->createFormBuilder($rule)
			->add('style','choice',array('choices' => \WiTTIE\EditorBundle\Slot\Rule::$styles))
			->getForm();
		
		if ($this->getRequest()->getMethod() == 'POST')
		{
			$form->bindRequest($this->getRequest());
			if ($form->isValid())
			{
				$em = $this->getDoctrine()->getEntityManager();
				$slot->setOptions($rule->getOptions());
				$em->flush();
				
				return new Response('reload');
			}
		}
		
		return array('slot' => $slot, 'form' => $form->createView());
	}
}
