<?php

declare(strict_types=1);

namespace yii\psr;

use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;

/**
 * Implements a PSR logger that routes messages to the current Yii Logger.
 */
final class DynamicLogger implements LoggerInterface
{
    use LoggerTrait;
    private ?Logger $logger = null;
    private \yii\log\Logger|null $yiiLogger = null;
    private function getLogger(): Logger
    {
        if (!isset($this->logger, $this->yiiLogger) || \Yii::getLogger() !== $this->yiiLogger) {
            $this->yiiLogger = \Yii::getLogger();
            $this->logger = new Logger(\Yii::getLogger());
        }
        return $this->logger;
    }
    public function log($level, \Stringable|string $message, array $context = []): void
    {
        $this->getLogger()->log($level, $message, $context);
    }
}
