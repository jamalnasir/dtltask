<?php

namespace App\Traits;

use Symfony\Component\HttpFoundation\JsonResponse;

trait ResponseTrait
{

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendSuccessResponse($data = null, $message = null) : JsonResponse
    {
        $response = ['success' => true];

        if ($message !== null) {
            $response['message'] = $message;
        }

        if ($data !== null) {
            $response['data'] = $data;
        }

        return response()->json($response);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendErrorResponse($error, $errorMessages = [], $code = 404) : JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (! empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

}