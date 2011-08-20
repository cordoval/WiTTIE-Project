<?php

namespace WiTTIE\CoreBundle\Entity;

use FOS\UserBundle\Entity\Group as BaseGroup;
use Doctrine\ORM\Mapping as ORM;
use WiTTIE\CoreBundle\Entity\User;

/**
 * WiTTIE\CoreBundle\Entity\Group
 *
 * @ORM\Table(name="wittie_group")
 * @ORM\Entity
 */
class Group extends BaseGroup
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
	 * @ORM\ManyToOne(targetEntity="User")
	 */
	private $owner;
	
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
	 * Set owner
	 *
	 * @param WiTTIE\CoreBundle\Entity\User $owner
	 */
	public function setOwner(User $owner)
	{
		$this->owner = $owner;
	}
	
	/**
	 * Get owner
	 *
	 * @return WiTTIE\CoreBundle\Entity\User 
	 */
	public function getOwner()
	{
		return $this->owner;
	}
}