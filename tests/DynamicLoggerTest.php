<?php

declare(strict_types=1);
namespace yiiunit\extensions\psr;

use PHPUnit\Framework\TestCase;
use yii\log\Logger as YiiLogger;
use yii\psr\DynamicLogger;

/**
 * @covers \yii\psr\DynamicLogger
 */
final class DynamicLoggerTest extends TestCase
{
    public function testLoggerUsesCurrent(): void
    {
        $yiiLogger1 = $this->getMockBuilder(YiiLogger::class)->getMock();
        $yiiLogger1->expects($this->once())->method('log')->with('test1', YiiLogger::LEVEL_INFO, );

        $yiiLogger2 = $this->getMockBuilder(YiiLogger::class)->getMock();
        $yiiLogger2->expects($this->once())->method('log')->with('test2', YiiLogger::LEVEL_INFO, );

        $logger = new DynamicLogger();
        \Yii::setLogger($yiiLogger1);

        $logger->info('test1');

        \Yii::setLogger($yiiLogger2);
        $logger->info('test2');
    }
}
