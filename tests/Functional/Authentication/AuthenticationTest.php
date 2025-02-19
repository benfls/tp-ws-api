<?php

namespace App\Tests\Functional\Authentication;

use App\Tests\Functional\AbstractAppBundleTest;
use EasyApiJwtAuthentication\Util\Tests\AuthenticationTestTrait;

class AuthenticationTest extends AbstractAppBundleTest
{
    use AuthenticationTestTrait;
}