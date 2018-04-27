<?php

namespace Tests\AppBundle\Entity;


use AppBundle\Entity\ToDo;
use AppBundle\Exception\NotDoneUntilItsDoneException;
use PHPUnit\Framework\TestCase;

class ToDoTest extends TestCase
{
    /** @var ToDo */
    private $todo;

    public function setUp()
    {
        $this->todo = new ToDo();
    }

    /**
     * @throws NotDoneUntilItsDoneException
     */
    public function testCannotSetDueDateBeforeCreationDate()
    {
        $this->todo->setCreatedAt(new \DateTime('2018-04-21'));

        $this->expectException(NotDoneUntilItsDoneException::class);

        $this->todo->setDueDate(new \DateTime('2018-04-20'));
    }
}
