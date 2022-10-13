<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthResponse extends JsonResource
{
    // public $message;
    // public $status;
    // public $errors;

    // public function __construct($message, $status, $errors, $resource)
    // {
    //     parent::__construct($resource);
    //     $this->message = $message;
    //     $this->status = $status;
    //     $this->errors = $errors;
    // }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            // 'message' => $this->message,
            // 'status' => $this->status,
            // 'errors' => $this->errors,
            // 'data' => $this->resource

            'name' => $this->name,
            'email' => $this->email,
        ];
    }
}
