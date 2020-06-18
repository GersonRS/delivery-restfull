<?php

namespace App\Http\Controllers\API;

use App\Address;
use App\Http\Controllers\Controller;
use App\Http\Resources\AddressCollection;
use App\Http\Resources\AddressResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection as AnonymousResourceCollectionAlias;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param null $relationships
     * @return AnonymousResourceCollectionAlias
     */
    public function index($relationships = null)
    {
        $addresses = Address::with($relationships ? explode('-', $relationships) : [])->get();
        return AddressResource::collection($addresses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zipcode' => 'required',
            'complement' => 'required',
            'user_id' => 'required|exist:App\User,id',
        ],[
            'address.required' => 'Please fill out the :attribute.',
            'city.required' => 'Please fill out the :attribute.',
            'state.required' => ':attribute is required.',
            'zipcode.required' => ':attribute is required.',
            'complement.required' => ':attribute is required.',
            'user_id.exist' => ':attribute does not equals.',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'message' => 'Validation errors',
                'errors' =>  $validator->errors(),
                'status' => false], 422);
        }
        $coupon = Address::create($request->all());

        return (new AddressResource($coupon))->additional(['message' => 'Created success', 'status' => true])->response()->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param null $relationships
     * @return AddressResource
     */
    public function show($id, $relationships = null)
    {
        $coupon = Address::with($relationships ? explode('-', $relationships) : [])->findOrFail($id);
        return new AddressResource($coupon);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $address = Address::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => ['message' => 'Establishment not found. Consider adding it!']
            ], 404);
        }
        $validator = Validator::make($request->all(), [
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zipcode' => 'required',
            'complement' => 'required',
            'user_id' => 'required|exist:App\User,id',
        ],[
            'address.required' => 'Please fill out the :attribute.',
            'city.required' => 'Please fill out the :attribute.',
            'state.required' => ':attribute is required.',
            'zipcode.required' => ':attribute is required.',
            'complement.required' => ':attribute is required.',
            'user_id.exist' => ':attribute does not equals.',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'message' => 'Validation errors',
                'errors' =>  $validator->errors(),
                'status' => false], 422);
        }
        $address->fill($request->all());
        $address->save();

        return (new AddressResource($address))->additional(['message' => 'Update success'])->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        try {
            $address = Address::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => [
                    'message' => 'Coupon not found. Consider adding it!'
                ] ], 404);
        }
        $address->delete();
        return (new AddressResource($address))->additional(['message' => 'Delete success'])->response()->setStatusCode(200);
    }
}
