<?php

namespace WiTTIE\CoreBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use WiTTIE\CoreBundle\Entity\Group;

/**
 * WiTTIE\CoreBundle\Entity\User
 *
 * @ORM\Table(name="wittie_user")
 * @ORM\Entity
 */
class User extends BaseUser
{
	/**
	 * @var integer $id
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	
	/**
	 * @ORM\ManyToMany(targetEntity="WiTTIE\CoreBundle\Entity\Group")
	 * @ORM\JoinTable(
	 *	  name="wittie_user_group",
	 *	  joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
	 *	  inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
	 * )
	 */
	protected $groups;
	
	/**
	 * @var Collection $slots
	 *
	 * @ORM\OneToMany(targetEntity="WiTTIE\EditorBundle\Entity\Slot", mappedBy="user")
	 */
	protected $slots;
	
	
	public function __construct()
	{
		parent::__construct();
		
		$this->groups = new ArrayCollection();
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
	 * Add groups
	 *
	 * @param WiTTIE\CoreBundle\Entity\Group $groups
	 */
	public function addGroups(Group $groups)
	{
		$this->groups[] = $groups;
	}
	
	/**
	 * Get groups
	 *
	 * @return Doctrine\Common\Collections\Collection 
	 */
	public function getGroups()
	{
		return $this->groups;
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
}