<?php

declare(strict_types=1);

namespace yiiunit\extensions\psr;

use PHPUnit\Framework\TestCase;
use Psr\Log\InvalidArgumentException;
use Psr\Log\LogLevel;
use yii\log\Logger as YiiLogger;
use yii\psr\Logger;

/**
 * @covers \yii\psr\Logger
 */
final class LoggerTest extends TestCase
{
    public function testLogUsesMap(): void
    {
        $yiiLogger = $this->getMockBuilder(YiiLogger::class)->getMock();
        $yiiLogger->expects($this->once())->method('log')->with('test', YiiLogger::LEVEL_INFO, );

        $logger = new Logger($yiiLogger, [
            LogLevel::CRITICAL => YiiLogger::LEVEL_INFO,
        ]);

        $logger->log(LogLevel::CRITICAL, 'test');
    }

    public function testInvalidLogLevel(): void
    {
        $yiiLogger = $this->getMockBuilder(YiiLogger::class)->getMock();
        $logger = new Logger($yiiLogger);

        $this->expectException(InvalidArgumentException::class);
        $logger->log('badlevel', 'test');
    }

    public function testNonStringLogLevel(): void
    {
        $yiiLogger = $this->getMockBuilder(YiiLogger::class)->getMock();
        $logger = new Logger($yiiLogger);

        $this->expectException(InvalidArgumentException::class);
        $logger->log(15, 'test');
    }
}
