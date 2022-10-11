<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Portofolio\StorePortofolioRequest;
use App\Services\Portofolio\PortofolioService;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class APIPortofolioController extends BaseController
{
    private $portofolioService;

    public function __construct(PortofolioService $portofolioService)
    {
        $this->portofolioService = $portofolioService;
    }

    public function store(StorePortofolioRequest $request)
    {
        try {
            $request->validated();
            $portofolio = $this->portofolioService->createPortofolio($request);
            return $this->sendResponse('Successfully Created Portofolio', 200, $portofolio);
        } catch (Exception $err) {
            return $this->sendError('Fail', 422, $err->getMessage());
        }
    }
}