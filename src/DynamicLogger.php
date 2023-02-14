<?php

declare(strict_types=1);

namespace yii\psr;

use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;
use WeakReference;

/**
 * Implements a PSR logger that routes messages to the current Yii Logger.
 */
final class DynamicLogger implements LoggerInterface
{
    use LoggerTrait;
    private ?Logger $logger = null;
    /**
     * Note that using a weak reference here is merely a good practice.
     * In reality the ->get() will never return null since the underlying logger doesn't use a weak reference.
     * @var WeakReference<\yii\log\Logger>|null
     */
    private ?WeakReference $yiiLogger = null;
    private function getLogger(): Logger
    {
        if (!isset($this->logger, $this->yiiLogger) || \Yii::getLogger() !== $this->yiiLogger->get()) {
            $this->yiiLogger = WeakReference::create(\Yii::getLogger());
            $this->logger = new Logger(\Yii::getLogger());
        }
        return $this->logger;
    }
    public function log($level, \Stringable|string $message, array $context = []): void
    {
        $this->getLogger()->log($level, $message, $context);
    }
}
