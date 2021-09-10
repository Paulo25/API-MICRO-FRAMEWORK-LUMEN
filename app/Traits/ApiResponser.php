<?php

namespace App\Traits;

/**
 * Traits podem ser úteis para que compartilhemos determinadas funcionalidades (códigos)
 * entre classes que não são relacionadas (de hierarquias/tipos diferentes).
 */
trait ApiResponser
{
          
          protected function successResponse($data, $message = '', $statusCode = 200)
          {
                    return response()->json([
                              'metadata' => $data,
                              'message' => $message,
                              'success' => true
                    ], $statusCode);
          }

          protected function errorResponse($errors, $message = '', $statusCode = 500, $headers = [])
          {
                    if ($headers) {
                              return response()->json([
                                        "errors" =>  $errors,
                                        'message' => $message,
                                        'success' => false
                              ], $statusCode, $headers);
                    } else {
                              return response()->json([
                                        "errors" =>  $errors,
                                        'message' => $message,
                                        'success' => false
                              ], $statusCode);
                    }
          }
}
