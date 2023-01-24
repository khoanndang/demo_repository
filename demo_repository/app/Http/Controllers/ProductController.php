<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\Version1\ApiController;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Repositories\Product\ProductInterface;

class ProductController extends ApiController {

    public $productRepository;

    public function __construct(ProductInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @OA\Get(
     *     path="/api/product/find-by-status",
     *     tags={"PRODUCT"},
     *     summary="Finds products by status",
     *     description="API get products by status",
     *     operationId="findByStatus",
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Status values that needed to be considered for filter",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             default="available",
     *             type="string",
     *             enum={"available", "pending", "sold"},
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     ),
     * )
     */
    public function findByStatus(Request $request) {
        $status = $request->input('status', null);
        $result = $this->productRepository->findByStatus($status);
        // transformer
        // response API
        
        return $this->respondWithSuccess($result, 'Find products by status is complete');
    }

    /**
     * @OA\Get(
     *     path="/api/product/test-version",
     *     tags={"PRODUCT"},
     *     summary="Test version",
     *     description="Test version",
     *     operationId="testVersion",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     ),
     * )
     */
    public function testVersion(Request $request) {
        $result = $this->productRepository->testVersion();
        return $this->respondWithSuccess($result, 'Test version is complete');
    }

    /**
     * @OA\Post(
     *  path="/api/product/create-product",
     *  operationId="storeProduct",
     *  summary="Insert a new Product",
     *  description="Insert a new Product",
     *  tags={"PRODUCT"},
     *  @OA\RequestBody(
     *    description="Product to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/Product")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="Product created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Product"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function storeProduct(Request $request)
    {
        $data = Product::create($request->data);
        return response()->json(['data' => $data], 201);
    }
}