<?php

namespace AppBundle\Exception;

class NotDoneUntilItsDoneException extends \Exception
{
    protected $message = "Due Date must come after the creation Date!";
}
