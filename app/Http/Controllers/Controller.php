<?php

namespace App\Http\Controllers;
use OpenApi\Attributes as OA;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

 
	/**
	* @OA\PathItem (
	* path="/"
	* ),
	* @OA\Info (
	*      version="1.0.0",
	*      title="Rest API",
	*      description="Laravel Rest API with Swagger OpenApi"
	* ),
	* @OA\Tag(name="UnAuthorize", description="No user login required"),
	* @OA\Tag(name="Authorize", description="User login required"),
	* @OA\SecurityScheme(
    *      securityScheme="bearer_token",
    *      type="http",
    *      scheme="bearer"
    * )
	*/
 
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
