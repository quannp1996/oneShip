<?php

namespace App\Ship\core\Traits\HelpersTraits;

trait ApiResTrait
{
  public function sendResponse($data, string $message = '', int $code = 200)
  {
    return response()->json([
      'success' => true,
      'data' => $data,
      'message' => $message,
      'code' => $code,
    ], $code, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
  }

  public function sendError($error = 'unauthorize', int $code = 200, string $message = '')
  {
    return response()->json([
      'success' => false,
      'data' => [],
      'message' => $message,
      'code' => $code,
      'error' => $error,
    ], $code, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
  }
} // End class
