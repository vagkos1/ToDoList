<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $password;

    /**
     * we'll set the plain password on the user and encode it automatically via a Doctrine listener when it saves.
     * we are not going to persist this with Doctrine - never store plain text passwords
     * this is just a temporary storage place during a request
     *
     * we need the following assertion to only apply to the registration form.
     * when the user wants to update their user info, they may want to keep using the same password :)
     */
    private $plainPassword;

    /**
     * The roles property will hold an array of roles.
     * When we save, Doctrine will automatically json_encode that array and store it in a singe field.
     * When we query, it will json_decode that back to the array.
     * Every user must have at least one role.
     *
     * @ORM\Column(type="json_array")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $lastName;

    /**
     * @ORM\OneToMany(targetEntity="ToDo", mappedBy="createdBy")
     */
    private $todosCreated;

    public function __construct()
    {
        $this->todosCreated = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getRoles()
    {
        $roles = $this->roles;

        if (!in_array('ROLE_USER', $roles)) {
            $roles[] = 'ROLE_USER';
        }

        return $roles;
    }

    public function getPassword()
    {
        return $this->password;
    }

    // not necessary since we'll use bcrypt, which comes with a built in mechanism to salt passwords.
    public function getSalt()
    {
    }

    public function getUsername()
    {
        return $this->email;
    }

    // Symfony calls this after logging in.
    //// minor security measure to prevent the plain password from accidentally getting saved.
    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPassword($password): void
    {
        $this->password = $password;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($plainPassword): void
    {
        $this->plainPassword = $plainPassword;

        // guarantees that the User entity looks "dirty" to Doctrine
        // when changing the plainPassword (since we are not saving the plain password in the DB)
        $this->password = null;
    }

    public function setRoles($roles)
    {
        $this->roles = $roles;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName = null): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName = null): void
    {
        $this->lastName = $lastName;
    }

    public function getFullName()
    {
        return trim($this->firstName . ' ' . $this->lastName);
    }

    /**
     * @return ArrayCollection|ToDo[]
     */
    public function getTodosCreated()
    {
        return $this->todosCreated;
    }

    public function addTodo(ToDo $todo)
    {
        // technically it's an arrayCollection but we can treat it as an array
        $this->todosCreated[] = $todo;
    }

    public function __toString(): string
    {
        return $this->firstName . " " . $this->lastName;
    }
}
