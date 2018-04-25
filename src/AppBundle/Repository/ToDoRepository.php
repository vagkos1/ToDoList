<?php

namespace AppBundle\Repository;


use AppBundle\Entity\ToDo;
use Doctrine\ORM\EntityRepository;

class ToDoRepository extends EntityRepository
{
    /**
     * @return ToDo[]
     */
    public function findAllOrderedByDueDate()
    {
        return $this->createQueryBuilder('todo')
            ->orderBy('todo.dueDate', 'ASC')
            ->getQuery()
            ->execute();
    }
}
