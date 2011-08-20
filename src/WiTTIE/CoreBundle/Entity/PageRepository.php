<?php

namespace WiTTIE\CoreBundle\Entity;

use Gedmo\Tree\Entity\Repository\NestedTreeRepository as EntityRepository;

/**
 * PageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PageRepository extends EntityRepository
{
	public function findOneById($id, $options = array())
	{
		$options = array_merge(array('id' => $id), $options);
		return $this->getQuery($options)->getSingleResult();
	}
	
	public function getQuery($options = array())
	{
		$qb = $this->createQueryBuilder('p');
		
		$qb->leftJoin('p.responses','r');
		$qb->addSelect('r');
		
		$qb->leftJoin('p.children','c');
		$qb->addSelect('c');
		
		$qb->leftJoin('p.slots','s');
		$qb->addSelect('s');
		
		if(isset($options['id']))
			$qb->andWhere('p.id = :id')->setParameter('id', $options['id']);
		
		return $qb->getQuery();
	}
}