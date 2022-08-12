<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
class PassportAuthController extends Controller
{
	
    
	/**
     * Create User
     * @OA\POST (
     *     path="/api/register",
     *     tags={"UnAuthorize"},
	 *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
	 * 			   @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="name",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="email",
     *                          type="string"
     *                      ),
	 *                      @OA\Property(
     *                          property="password",
     *                          type="string"
     *                      ),
	 *                      @OA\Property(
     *                          property="c_password",
     *                          type="string"
     *                      )
     *                 ),
     *                 example={
     *                     "name":"example name",
     *                     "email":"md9.mahabubur@example.com",
     *                     "password":"12345678",
     *                     "c_password":"12345678"
     *                }
     *             )
	 *		   )
	 *		),
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(
     *				@OA\Property(
     *                 type="string",
     *                 property="token",
	 *				   example="some token value"
	 *				)
    
     *         )
     *     )
     * )
     */
    public function register(Request $request)
    {
		
		
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
		
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
  
        $token = $user->createToken('Laravel9PassportAuth')->accessToken;
  
        return response()->json(['token' => $token], 200);
    }
  
    
	/**
     * Login to system
     * @OA\POST (
     *     path="/api/login",
     *     tags={"UnAuthorize"},
	 *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
	 * 			   @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="email",
     *                          type="string"
     *                      ),
	 *                      @OA\Property(
     *                          property="password",
     *                          type="string"
     *                      )
     *                 ),
     *                 example={
     *                     "email":"md9.mahabubur@example.com",
     *                     "password":"enter password"
     *                }
     *             )
	 *		   )
	 *		),
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(
	 *				@OA\Property(
     *                 type="string",
     *                 property="token",
	 *				   example="some token value"
	 *				)
    
     *         )
     *     )
     * )
     */
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
  
        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('Laravel9PassportAuth')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
	/**
     * Show User Details
     * @OA\GET (
     *     path="/api/get-user",
     *     tags={"Authorize"},
	 *     security={{"bearer_token":{}}}, 
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(
     *               @OA\Property(
     *                     type="object",
	 *                     property="user",
	 *					 	@OA\Property(
     *                         property="id",
     *                         type="number",
     *                         example=1
     *                     ),
     *                     @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="example name"
     *                     ),
     *                     @OA\Property(
     *                         property="email",
     *                         type="string",
     *                         example="test@asb.cpm"
     *                     ),
     *                     @OA\Property(
     *                         property="detail",
     *                         type="string",
     *                         example="example detail"
     *                     ),
     *                     @OA\Property(
     *                         property="updated_at",
     *                         type="string",
     *                         example="2021-12-11T09:25:53.000000Z"
     *                     ),
     *                     @OA\Property(
     *                         property="created_at",
     *                         type="string",
     *                         example="2021-12-11T09:25:53.000000Z"
     *                     )
     *                 )
    
     *         )
     *     )
     * )
     */
    public function userInfo() 
    {
     $user = auth()->user();
      
     return response()->json(['user' => $user], 200);
 
    }
}
