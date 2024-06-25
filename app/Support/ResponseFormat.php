<?php

namespace App\Support;

use Jiannei\Response\Laravel\Support\Format;

class ResponseFormat extends Format
{
    public function data(?array $data, ?string $message, int $code, $errors = null): array
    {
        return $this->formatDataFields([
            'code' => $code,
            'message' => $this->formatMessage($code, $message),
            'data' => $data ?: (object)$data,
            'error' => $errors ?: (object)[],
            'status' => $this->formatStatus($code),
            'timestamp' => (string)now()->getTimestampMs(),
            'originUrl' => '/' . request()->path()
        ], $this->config);
    }
}

