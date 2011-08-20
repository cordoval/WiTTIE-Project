<?php

namespace WiTTIE\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use WiTTIE\CoreBundle\Entity\Page;
use WiTTIE\CoreBundle\Entity\Group;

/**
 * WiTTIE\CoreBundle\Entity\Response
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="WiTTIE\CoreBundle\Entity\ResponseRepository")
 */
class Response
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
	 * @var Page $page
	 *
	 * @ORM\ManyToOne(targetEntity="WiTTIE\CoreBundle\Entity\Page", inversedBy="responses")
	 */
	protected $page;
	
	/**
	 * @var Group $group_editors;
	 *
	 * @ORM\ManyToOne(targetEntity="WiTTIE\CoreBundle\Entity\Group")
	 */
	protected $group_editors;
	
	/**
	 * @var Group $group_reviewers
	 *
	 * @ORM\ManyToOne(targetEntity="WiTTIE\CoreBundle\Entity\Group")
	 */
	protected $group_reviewers;
	
	/**
	 * @var Collection $slots
	 *
	 * @ORM\OneToMany(targetEntity="WiTTIE\EditorBundle\Entity\Slot", mappedBy="response")
	 */
	protected $slots;
	
	
	/**
	 * constructor
	 *
	 * @param string $title
	 * @param WiTTIE\CoreBundle\Entity\Page $page
	 */
	public function __construct($title = null, Page $page = null)
	{
		if($title)
			$this->setTitle($title);
		if($page)
			$this->setPage($page);
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
	 * Set group_reviewers
	 *
	 * @param WiTTIE\CoreBundle\Entity\Group $groupReviewers
	 */
	public function setGroupReviewers(Group $groupReviewers)
	{
		$this->group_reviewers = $groupReviewers;
	}
	
	/**
	 * Get group_reviewers
	 *
	 * @return WiTTIE\CoreBundle\Entity\Group 
	 */
	public function getGroupReviewers()
	{
		return $this->group_reviewers;
	}
}