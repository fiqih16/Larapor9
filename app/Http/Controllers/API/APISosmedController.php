<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Requests\Sosmed\StoreSosmedRequest;
use App\Services\Sosmed\SosmedService;
use Exception;

class APISosmedController extends BaseController
{
    private $sosmedService;

    public function __construct(SosmedService $sosmedService)
    {
        $this->sosmedService = $sosmedService;
    }

    public function store(StoreSosmedRequest $request)
    {
        try {
            $request->validated();
            $sosmed = $this->sosmedService->createSosmed($request);
            return $this->sendResponse('Successfully Created Sosmed', 200, $sosmed);
        } catch (Exception $err) {
            return $this->sendError('Fail', 422, $err->getMessage());
        }
    }
}