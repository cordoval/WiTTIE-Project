<?php

namespace WiTTIE\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use WiTTIE\CoreBundle\Entity\Response;
use WiTTIE\CoreBundle\Entity\Group;

/**
 * WiTTIE\CoreBundle\Entity\Page
 *
 * @ORM\Table()
 * @Gedmo\Tree(type="nested")
 * @ORM\Entity(repositoryClass="WiTTIE\CoreBundle\Entity\PageRepository")
 */
class Page
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
	 * @var string $title
	 *
	 * @Gedmo\Sluggable
	 * @ORM\Column(name="title", type="string", length=255)
	 */
	private $title;
	
	/**
	 * @var string $slug
	 *
	 * @Gedmo\Slug
	 * @ORM\Column(name="slug", type="string", length=255)
	 */
	private $slug;
	
	/**
	 * @var Collection $responses
	 *
	 * @ORM\OneToMany(targetEntity="WiTTIE\CoreBundle\Entity\Response", mappedBy="page")
	 */
	protected $responses;
	
	/**
	 * @var Group $group_editors
	 *
	 * @ORM\ManyToOne(targetEntity="WiTTIE\CoreBundle\Entity\Group")
	 */
	protected $group_editors;
	
	/**
	 * @var Group $group_administrators
	 *
	 * @ORM\ManyToOne(targetEntity="WiTTIE\CoreBundle\Entity\Group")
	 */
	protected $group_administrators;
	
	/**
	 * @var Collection $slots
	 *
	 * @ORM\OneToMany(targetEntity="WiTTIE\EditorBundle\Entity\Slot", mappedBy="page")
	 */
	protected $slots;
	
	/**
	 * @Gedmo\TreeLeft
	 * @ORM\Column(name="lft", type="integer")
	 */
	private $lft;
	 
	/**
	 * @Gedmo\TreeLevel
	 * @ORM\Column(name="lvl", type="integer")
	 */
	private $lvl;
	 
	/**
	 * @Gedmo\TreeRight
	 * @ORM\Column(name="rgt", type="integer")
	 */
	private $rgt;
	 
	/**
	 * @Gedmo\TreeRoot
	 * @ORM\Column(name="root", type="integer")
	 */
	private $root;
	 
	/**
	 * @Gedmo\TreeParent
	 * @ORM\ManyToOne(targetEntity="Page", inversedBy="children")
	 */
	private $parent;
	 
	/**
	 * @ORM\OneToMany(targetEntity="Page", mappedBy="parent")
	 * @ORM\OrderBy({"lft" = "ASC"})
	 */
	private $children;
	
	
	/**
	 * constructor
	 *
	 * @param string $title
	 * @param WiTTIE\CoreBundle\Entity\Page $parent
	 */
	public function __construct($title = null, Page $parent = null)
	{
		$this->responses = new ArrayCollection();
		
		if($title)
			$this->setTitle($title);
		if($parent)
			$this->setParent($parent);
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
	 * Set title
	 *
	 * @param string $title
	 */
	public function setTitle($title)
	{
		$this->title = $title;
	}
	
	/**
	 * Get title
	 *
	 * @return string 
	 */
	public function getTitle()
	{
		return $this->title;
	}
	
	/**
	 * Set slug
	 *
	 * @param string $slug
	 */
	public function setSlug($slug)
	{
		$this->slug = $slug;
	}
	
	/**
	 * Get slug
	 *
	 * @return string 
	 */
	public function getSlug()
	{
		return $this->slug;
	}
	
	/**
	 * Add response
	 *
	 * @param WiTTIE\CoreBundle\Entity\Response $response
	 */
	public function addResponses(Response $response)
	{
		$this->responses[] = $response;
	}
	
	/**
	 * Get responses
	 *
	 * @return Doctrine\Common\Collections\Collection 
	 */
	public function getResponses()
	{
		return $this->responses;
	}
	
	/**
	 * Set lft
	 *
	 * @param integer $lft
	 */
	public function setLft($lft)
	{
		$this->lft = $lft;
	}
	
	/**
	 * Get lft
	 *
	 * @return integer 
	 */
	public function getLft()
	{
		return $this->lft;
	}
	
	/**
	 * Set lvl
	 *
	 * @param integer $lvl
	 */
	public function setLvl($lvl)
	{
		$this->lvl = $lvl;
	}
	
	/**
	 * Get lvl
	 *
	 * @return integer 
	 */
	public function getLvl()
	{
		return $this->lvl;
	}
	
	/**
	 * Set rgt
	 *
	 * @param integer $rgt
	 */
	public function setRgt($rgt)
	{
		$this->rgt = $rgt;
	}
	
	/**
	 * Get rgt
	 *
	 * @return integer 
	 */
	public function getRgt()
	{
		return $this->rgt;
	}
	
	/**
	 * Set root
	 *
	 * @param integer $root
	 */
	public function setRoot($root)
	{
		$this->root = $root;
	}
	
	/**
	 * Get root
	 *
	 * @return integer 
	 */
	public function getRoot()
	{
		return $this->root;
	}
	
	/**
	 * Set parent
	 *
	 * @param WiTTIE\CoreBundle\Entity\Page $parent
	 */
	public function setParent(Page $parent)
	{
		$this->parent = $parent;
	}
	
	/**
	 * Get parent
	 *
	 * @return WiTTIE\CoreBundle\Entity\Page 
	 */
	public function getParent()
	{
		return $this->parent;
	}
	
	/**
	 * Add children
	 *
	 * @param WiTTIE\CoreBundle\Entity\Page $children
	 */
	public function addChildren(Page $children)
	{
		$this->children[] = $children;
	}
	
	/**
	 * Get children
	 *
	 * @return Doctrine\Common\Collections\Collection 
	 */
	public function getChildren()
	{
		return $this->children;
	}
	
	/**
	 * Add slots
	 *
	 * @param WiTTIE\EditorBundle\Entity\Slot $slots
	 */
	public function addSlots(\WiTTIE\EditorBundle\Entity\Slot $slots)
	{
		$this->slots[] = $slots;
	}
	
	/**
	 * Get slots
	 *
	 * @return Doctrine\Common\Collections\Collection 
	 */
	public function getSlots()
	{
		return $this->slots;
	}
	
	/**
	 * Set group_editors
	 *
	 * @param WiTTIE\CoreBundle\Entity\Group $groupEditors
	 */
	public function setGroupEditors(Group $groupEditors)
	{
		$this->group_editors = $groupEditors;
	}
	
	/**
	 * Get group_editors
	 *
	 * @return WiTTIE\CoreBundle\Entity\Group 
	 */
	public function getGroupEditors()
	{
		return $this->group_editors;
	}
	
	/**
	 * Set group_administrators
	 *
	 * @param WiTTIE\CoreBundle\Entity\Group $groupAdministrators
	 */
	public function setGroupAdministrators(Group $groupAdministrators)
	{
		$this->group_administrators = $groupAdministrators;
	}
	
	/**
	 * Get group_administrators
	 *
	 * @return WiTTIE\CoreBundle\Entity\Group 
	 */
	public function getGroupAdministrators()
	{
		return $this->group_administrators;
	}
}