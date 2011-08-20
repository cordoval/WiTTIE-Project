<?php

namespace WiTTIE\EditorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use WiTTIE\CoreBundle\Entity\User;
use WiTTIE\CoreBundle\Entity\Page;
use WiTTIE\CoreBundle\Entity\Response;

/**
 * WiTTIE\EditorBundle\Entity\Slot
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="WiTTIE\EditorBundle\Entity\SlotRepository")
 */
class Slot
{
	/**
	 * @var integer $id
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @var string $type
	 *
	 * @ORM\Column(name="type", type="string", length=255)
	 */
	private $type;
	
	/**
	 * @var array $options
	 *
	 * @ORM\Column(name="options", type="array")
	 */
	private $options;
	
	/**
	 * @ORM\ManyToOne(targetEntity="WiTTIE\CoreBundle\Entity\Page")
	 */
	private $page;
	
	/**
	 * @ORM\ManyToOne(targetEntity="WiTTIE\CoreBundle\Entity\Response")
	 */
	private $response;
	
	/**
	 * @ORM\ManyToOne(targetEntity="WiTTIE\CoreBundle\Entity\User")
	 */
	private $user;
	
	private $editable = false;
	
	
	/**
	 * constructor
	 *
	 * @param string $title
	 * @param WiTTIE\CoreBundle\Entity\Page $parent
	 */
	public function __construct($type, $options = array())
	{
		$this->setType($type);
		if($options)
			$this->setOptions($options);
	}
	
	/**
	 * Get id
	 *
	 * @return integer 
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * Set type
	 *
	 * @param string $type
	 */
	public function setType($type)
	{
		$this->type = $type;
	}	

	/**
	 * Get type
	 *
	 * @return string 
	 */
	public function getType()
	{
		return $this->type;
	}
	
	/**
	 * Set options
	 *
	 * @param array $options
	 */
	public function setOptions($options)
	{
		$this->options = $options;
	}
	
	/**
	 * Get options
	 *
	 * @return array 
	 */
	public function getOptions()
	{
		return $this->options;
	}
	
	/**
	 * Set page
	 *
	 * @param WiTTIE\CoreBundle\Entity\Page $page
	 */
	public function setPage(Page $page)
	{
		$this->page = $page;
	}
	
	/**
	 * Get page
	 *
	 * @return WiTTIE\CoreBundle\Entity\Page 
	 */
	public function getPage()
	{
		return $this->page;
	}
	
	/**
	 * Set response
	 *
	 * @param WiTTIE\CoreBundle\Entity\Response $response
	 */
	public function setResponse(Response $response)
	{
		$this->response = $response;
	}
	
	/**
	 * Get response
	 *
	 * @return WiTTIE\CoreBundle\Entity\Response 
	 */
	public function getResponse()
	{
		return $this->response;
	}
	
	/**
	 * Set user
	 *
	 * @param WiTTIE\CoreBundle\Entity\User $user
	 */
	public function setUser(User $user)
	{
		$this->user = $user;
	}
	
	/**
	 * Get user
	 *
	 * @return WiTTIE\CoreBundle\Entity\User 
	 */
	public function getUser()
	{
		return $this->user;
	}
	
	public function setEditable($editable = true)
	{
		$this->editable = $editable;
	}
	
	public function getEditable()
	{
		return $this->editable;
	}
}