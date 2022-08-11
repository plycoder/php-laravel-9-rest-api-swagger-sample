<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctors;
use Illuminate\Http\Request;
use Validator;
class DoctorController extends Controller
{
	/**
     * Get Doctor List
     * @OA\GET (
     *     path="/api/doctors",
     *     tags={"Authorize"},
	 *     security={{"bearer_token":{}}}, 
	 *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json"
	 *		   )
	 *		),
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(
	 *				@OA\Property(
     *                 type="boolean",
     *                 property="success",
	 *				   example=true
	 *				),
	 *				@OA\Property(
     *                 type="string",
     *                 property="message",
	 *				   example="Doctors List"
	 *				),
     *             @OA\Property(
     *                 type="array",
     *                 property="data",
     *                 @OA\Items(
     *                     type="object",
	 *					 	@OA\Property(
     *                         property="id",
     *                         type="number",
     *                         example=1
     *                     ),
     *                     @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="example title"
     *                     ),
     *                     @OA\Property(
     *                         property="email",
     *                         type="string",
     *                         example="test@asb.cpm"
     *                     ),
     *                     @OA\Property(
     *                         property="detail",
     *                         type="string",
     *                         example="example content"
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
     *             ),
     *         )
     *     )
     * )
     */
	public function index()
	{
		$doctors = Doctors::all();
		return response()->json([
		"success" => true,
		"message" => "Doctors List",
		"data" => $doctors
		]);
	}
	
	/**
     * Create Doctor
     * @OA\POST (
     *     path="/api/doctors",
     *     tags={"Authorize"},
	 *     security={{"bearer_token":{}}}, 
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
     *                          property="detail",
     *                          type="string"
     *                      )
     *                 ),
     *                 example={
     *                     "name":"example name",
     *                     "email":"md9.mahabubur@example.com",
     *                     "detail":"example detail"
     *                }
     *             )
	 *		   )
	 *		),
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(
     *				@OA\Property(
     *                 type="boolean",
     *                 property="success",
	 *				   example=true
	 *				),
	 *				@OA\Property(
     *                 type="string",
     *                 property="message",
	 *				   example="Doctors created successfully."
	 *				),
     *               @OA\Property(
     *                     type="object",
	 *                     property="data",
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
	public function store(Request $request)
	{
	$input = $request->all();
	$validator = Validator::make($input, [
	'name' => 'required',
	'detail' => 'required'
	]);
	if($validator->fails()){
	return $this->sendError('Validation Error.', $validator->errors());       
	}
	$doctors = Doctors::create($input);
	return response()->json([
	"success" => true,
	"message" => "Doctors created successfully.",
	"data" => $doctors
	]);
	} 
	
	/**
     * Show Doctor Details
     * @OA\GET (
     *     path="/api/doctors/{id}",
     *     tags={"Authorize"},
	 *     security={{"bearer_token":{}}}, 
	 *     @OA\Parameter(
     *        name="id",
     *        in="path",
     *        description="doctor Id",
     *        @OA\Schema(
     *           type="integer",
     *           format="int64"
     *        ),
     *        required=true,
     *        example=1
	 *		),
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(
     *				@OA\Property(
     *                 type="boolean",
     *                 property="success",
	 *				   example=true
	 *				),
	 *				@OA\Property(
     *                 type="string",
     *                 property="message",
	 *				   example="Doctors retrieved successfully."
	 *				),
     *               @OA\Property(
     *                     type="object",
	 *                     property="data",
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
	public function show($id)
	{
	$doctor = Doctors::find($id);
	if (is_null($doctor)) {
	return $this->sendError('Doctors not found.');
	}
	return response()->json([
	"success" => true,
	"message" => "Doctors retrieved successfully.",
	"data" => $doctor
	]);
	}
	/**
     * Update Doctor
     * @OA\PUT (
     *     path="/api/doctors/{id}",
     *     tags={"Authorize"},
	 *     security={{"bearer_token":{}}}, 
	 *     @OA\Parameter(
     *        name="id",
     *        in="path",
     *        description="doctor Id",
     *        @OA\Schema(
     *           type="integer",
     *           format="int64"
     *        ),
     *        required=true,
     *        example=1
	 *		),
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
     *                          property="detail",
     *                          type="string"
     *                      )
     *                 ),
     *                 example={
     *                     "name":"example name",
     *                     "detail":"example detail"
     *                }
     *             )
	 *		   )
	 *		),
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(
     *				@OA\Property(
     *                 type="boolean",
     *                 property="success",
	 *				   example=true
	 *				),
	 *				@OA\Property(
     *                 type="string",
     *                 property="message",
	 *				   example="Doctors updated successfully."
	 *				),
     *               @OA\Property(
     *                     type="object",
	 *                     property="data",
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
	public function update(Request $request, Doctors $doctor)
	{
	$input = $request->all();
	$validator = Validator::make($input, [
	'name' => 'required',
	'detail' => 'required'
	]);
	if($validator->fails()){
	return $this->sendError('Validation Error.', $validator->errors());       
	}
	$doctor->name = $input['name'];
	$doctor->detail = $input['detail'];
	$doctor->save();
	return response()->json([
	"success" => true,
	"message" => "Doctors updated successfully.",
	"data" => $doctor
	]);
	}
	/**
     * Delete Doctor
     * @OA\DELETE (
     *     path="/api/doctors/{id}",
     *     tags={"Authorize"},
	 *     security={{"bearer_token":{}}}, 
	 *     @OA\Parameter(
     *        name="id",
     *        in="path",
     *        description="doctor Id",
     *        @OA\Schema(
     *           type="integer",
     *           format="int64"
     *        ),
     *        required=true,
     *        example=1
	 *		),
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(
     *				@OA\Property(
     *                 type="boolean",
     *                 property="success",
	 *				   example=true
	 *				),
	 *				@OA\Property(
     *                 type="string",
     *                 property="message",
	 *				   example="Doctors deleted successfully."
	 *				),
     *               @OA\Property(
     *                     type="object",
	 *                     property="data",
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
	public function destroy(Doctors $doctor)
	{
	$doctor->delete();
	return response()->json([
	"success" => true,
	"message" => "Doctors deleted successfully.",
	"data" => $doctor
	]);
	}
}
