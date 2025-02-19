<?php

namespace App\Tests\Functional\User;

use AppBundle\Entity\User\User;
use App\Tests\AbstractApiTest;

abstract class AbstractUserTest extends AbstractApiTest
{
    protected const entityClass = User::class;
    protected const baseRouteName = 'api_user';
}