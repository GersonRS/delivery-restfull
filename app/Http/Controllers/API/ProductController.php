<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function promotions()
    {
        $products = Product::with(['promotion'])
            ->whereHas('availabilities', function (Builder $query) {
                $query->orderBy('weekday', 'asc');
                $query->where([
                    ['availabilities.weekday', '=', date("l")],
                    ['availabilities.start', '<', date('H:i:s', time())],
                ]);
            })
            ->join('promotions', 'products.id', '=', 'promotions.product_id')
            ->select('products.*', DB::raw('(products.price - promotions.value) as discount'))
            ->orderByDesc('discount')
            ->get();
        return ProductResource::collection($products->where('discount', '>', 0));
//        $products = DB::table('products')
//            ->join('promotions', 'products.id', '=', 'promotions.product_id')
//            ->join('availabilities', function ($join) {
//                $join->on('products.id', '=', 'availabilities.product_id')
//                    ->where([
//                        ['availabilities.weekday', '=', date("l")],
//                        ['availabilities.start', '<', date('H:i:s', time())],
//                    ]);
//            })
//            ->select(
//                'products.id',
//                'products.name',
//                'products.description',
//                'products.price',
//                'products.image',
//                'products.active',
//                'availabilities.weekday',
//                'promotions.value',
//                DB::raw('(products.price - promotions.value) as discount')
//            )
//            ->orderByDesc('discount')
//            ->limit(10)
//            ->get();
//        return ($products->where('discount', '>', 0))->unique('id');
    }

    /**
     * Display a listing of the resource.
     *
     * @param null $relationships
     * @return AnonymousResourceCollection
     */
    public function index($relationships = null)
    {
        $products = Product::with($relationships ? explode('-', $relationships) : [])->get();
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required',
            'category_id' => 'required|exist:App\Category,id',
            'establishment_id' => 'required|exist:App\Establishment,id',
        ], [
            'name.required' => 'Please fill out the :attribute.',
            'description.required' => 'Please fill out the :attribute.',
            'price.required' => ':attribute is required.',
            'image.required' => ':attribute does not equals.',
            'category_id.required' => ':attribute does not equals.',
            'category_id.exist' => ':attribute does not equals.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
                'status' => false], 422);
        }
        $product = Product::create($request->all());

        return (new ProductResource($product))->additional(['message' => 'Created success', 'status' => true])->response()->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param null $relationships
     * @return ProductResource
     */
    public function show($id, $relationships = null)
    {
        $product = Product::with($relationships ? explode('-', $relationships) : [])->findOrFail($id);
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => ['message' => 'User not found. Consider adding it!']
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required',
            'category_id' => 'required|exist:App\Category,id',
            'establishment_id' => 'required|exist:App\Establishment,id',
        ], [
            'name.required' => 'Please fill out the :attribute.',
            'description.required' => 'Please fill out the :attribute.',
            'price.required' => ':attribute is required.',
            'image.required' => ':attribute does not equals.',
            'category_id.required' => ':attribute does not equals.',
            'category_id.exist' => ':attribute does not equals.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
                'status' => false], 422);
        }
        $product->fill($request->all());
        $product->save();

        return (new ProductResource($product))->additional(['message' => 'Update success', 'status' => true])->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => [
                    'message' => 'User not found. Consider adding it!'
                ]], 404);
        }
        $product->delete();
        return (new ProductResource($product))->additional(['message' => 'Delete success', 'status' => true])->response()->setStatusCode(200);
    }
}
