<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\SpecialtyResource;
use App\Specialty;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class SpecialtyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param null $relationships
     * @return AnonymousResourceCollection
     */
    public function index($relationships = null)
    {
        $specialties = Specialty::with($relationships ? explode('-', $relationships) : [])->get();
        return SpecialtyResource::collection($specialties);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Request
     */
    public function store(Request $request)
    {
        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @param null $relationships
     * @return SpecialtyResource
     */
    public function show($id, $relationships = null)
    {
        $specialty = Specialty::with($relationships ? explode('-', $relationships) : [])->find($id);
        return new SpecialtyResource($specialty);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Specialty $specialty
     * @return Request
     */
    public function update(Request $request, Specialty $specialty)
    {
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Specialty $specialty
     * @return Response
     */
    public function destroy(Specialty $specialty)
    {
        //
    }
}
