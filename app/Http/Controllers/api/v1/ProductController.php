<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\PayfullHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Product\BuyProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\Repositories\Interfaces\IProductRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{

    private $productRepository;

    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function show($id)
    {
        $product = $this->productRepository->findById($id);
        if ($product) {
            return response()->json([
                'status' => 'success',
                'data' => new ProductResource($product),
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'status' => 'not_found',
                'message' => 'Product not found.'
            ], Response::HTTP_NO_CONTENT);
        }
    }

    public function buy(BuyProductRequest $request)
    {
        $validated = $request->validated();
        $user = $request->user();
        $card = $validated['card'];

        //total price on production
        //$total = $this->productRepository->totalPriceForShopping($validated['products']);

        $meta = [
            'player_id' => $user->id,
            'products' => $validated['products'],
            'address' => $validated['address'],
            'process_type' => PayfullHelper::PROCESS_TYPE_E_COMMERCE_BUY_PRODUCT,
        ];
        $meta = json_encode($meta);
        try {
            $response = PayfullHelper::request($user, $card, '0.01', $meta);
            return response()->json($response);
            //return $response->data;
        } catch (\Exception $ex) {
            return response()->json([
                'status' => 'error',
                'file' => $ex->getFile(),
                'line' => $ex->getLine(),
                'message' => $ex->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
