<?php

declare(strict_types=1);

namespace Marvin255\ValueObjectBundle\Tests;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Base test case for all tests.
 *
 * @internal
 */
abstract class BaseCase extends TestCase
{
    /**
     * Create mock for AbstractPlatform.
     *
     * @return MockObject&AbstractPlatform
     */
    protected function createAbstarctPlatformMock(): AbstractPlatform
    {
        return $this->getMockBuilder(AbstractPlatform::class)->getMock();
    }
}
