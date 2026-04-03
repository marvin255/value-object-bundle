<?php

declare(strict_types=1);

namespace Marvin255\ValueObjectBundle\Tests;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use PHPUnit\Framework\MockObject\Stub;
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
     * @return Stub&AbstractPlatform
     */
    protected function createAbstarctPlatformMock(): AbstractPlatform
    {
        return $this->createStub(AbstractPlatform::class);
    }
}
