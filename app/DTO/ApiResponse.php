<?php

namespace App\DTO;

use Illuminate\Http\JsonResponse;

class ApiResponse {
    private ?bool   $success;
    private         $content;
    private ?int    $statusCode; 

    public function __construct()
    {
        $this->success = false;
        $this->content = '';
        $this->statusCode = null;
    }

    public function setSuccess(bool $success) : ApiResponse {
        $this->success = $success;
        return $this;
    }

    public function getSuccess() : ?bool {
        return $this->success;
    }

    public function setContent($content) : ApiResponse {
        $this->content = $content;
        return $this;
    }

    public function getContent() : ?string {
        return $this->content;
    }

    public function setStatusCode(int $statusCode) : ApiResponse {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function getStatusCode() : ?int {
        return $this->statusCode;
    }

    public function create() : JsonResponse {
        return response()->json(
            [
                'success'    => $this->success,
                'content'    => $this->content,
                'statusCode' => $this->statusCode
            ]
        );
    }
}
