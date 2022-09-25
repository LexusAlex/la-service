<?php

declare(strict_types=1);

namespace LaService\Component\Slim\ErrorHandler;

use Slim\Handlers\ErrorHandler;

final class LogErrorHandler extends ErrorHandler
{
    protected function writeToErrorLog(): void
    {
        $this->logger->error($this->exception->getMessage(), [
            'exception' => $this->exception,
            'url' => (string)$this->request->getUri(),
            'ip' => (string)$this->request->getServerParams()['REMOTE_ADDR'],
        ]);
    }
}
