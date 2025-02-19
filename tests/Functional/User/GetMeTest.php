<?php

namespace App\Tests\Functional\User;

use EasyApiBundle\Util\Tests\crud\functions\GetTestFunctionsTrait;

class GetMeTest extends AbstractUserTest
{
    use GetTestFunctionsTrait;

    protected static function initExecuteSetupOnAllTest()
    {
        static::$executeSetupOnAllTest = false;
    }

    protected static function getGetRouteName()
    {
        return static::baseRouteName.'_get_me';
    }

    /**
     * GET - Nominal case.
     */
    public function testGet(): void
    {
        $this->doTestGenericGet();
    }

    /**
     * GET - Error case - 401 - Without authentication.
     */
    public function testGetWithoutAuthentication(): void
    {
        $this->doTestGenericGetWithoutAuthentication();
    }
}
