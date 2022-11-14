<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *    title="Laraporto API",
 *    version="1.0.0",
 *    description="L5 Swagger OpenApi description",
 *   @OA\Contact(
 *     email="fiqih1666@gmail.com",
 *   ),
 *   @OA\License(
 *     name="Apache 2.0",
 *     url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *   )
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}