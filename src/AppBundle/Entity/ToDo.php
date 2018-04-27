<?php

namespace AppBundle\Entity;

use AppBundle\Exception\NotDoneUntilItsDoneException;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ToDoRepository")
 * @ORM\Table(name="todo")
 */
class ToDo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @Assert\NotBlank()
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @Assert\NotBlank()
     * @ORM\Column(type="datetime")
     */
    private $dueDate;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="integer")
     */
    private $priority;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="todosCreated")
     */
    private $createdBy;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string")
     */
    private $category;

    /**
     * @Gedmo\Slug(fields={"description"})
     * @ORM\Column(type="string", unique=true)
     */
    private $slug;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * @throws NotDoneUntilItsDoneException
     */
    public function setDueDate(\DateTime $dueDate): void
    {
        if ($dueDate < $this->createdAt) {
            throw new NotDoneUntilItsDoneException();
        }
        $this->dueDate = $dueDate;
    }

    public function getPriority()
    {
        return $this->priority;
    }

    public function setPriority($priority): void
    {
        $this->priority = $priority;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }

    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category): void
    {
        $this->category = $category;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug($slug): void
    {
        $this->slug = $slug;
    }

    public function setCreatedBy($createdBy): void
    {
        $this->createdBy = $createdBy;
    }
}
