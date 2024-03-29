<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\DeleteProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\CreateProductRequest;
use App\Product;
use App\Review;

/**
 * Class for products.
 *
 * @since 1.0
 *
 * @version 1.0.0
 */
class ProductController extends Controller
{
    /**
     * Get Products
     *
     * @since 1.0
     *
     * @version 1.0.0
     *
     * @return json string
     */
    public function getProducts()
    {
        $response = [];
        //get products with reviews
        $products = Product::with('reviews')->get();
        $response = ["data" => $products, "status" => Response::HTTP_OK];
        return $response;
    }

    /**
     * Get Product
     *
     * @since 1.0
     *
     * @version 1.0.0
     *
     * @return json string
     */
    public function getProduct($id)
    {
        $response = [];
        $product = Product::find($id);
        if ($product) {
            $response = ["data" => $product, "status" => Response::HTTP_OK];
        } else {
            $response = ["error" => "Invalid product id", "status" => Response::HTTP_OK];
        }
        return $response;
    }


    /**
     * Create new product
     *
     * @since 1.0
     *
     * @version 1.0.0
     *
     * @param App\Http\Requests\CreateProductRequest $request A Request object
     *
     * @return json string
     */
    public function createProduct(CreateProductRequest $request)
    {
        $response = [];
        $name = $request->get('name');
        $description = $request->get('description');

        $product = new Product;
        $product->name = $name;
        $product->description = $description;
        if ($product->save()) {
            $response = ["result" => "success", "status" => Response::HTTP_OK];
        } else {
            $response = ["error" => "An error has occurred while trying to save the records,
                                     please try again later product id", "status" => Response::HTTP_OK];
        }
        return $response;
    }

    /**
     * Update product details
     *
     * @since 1.0
     *
     * @version 1.0.0
     *
     * @param App\Http\Requests\UpdateProductRequest $request A Request object
     *
     * @return json string
     */
    public function updateProduct($id, UpdateProductRequest $request)
    {
        $response = [];
        $name = $request->get('name');
        $description = $request->get('description');
        $product = Product::find($id);
        if ($product) {
            $product->name = $name;
            $product->description = $description;
            $product->save();
            $response = ["result" => "success", "status" => Response::HTTP_OK];
        } else {
            $response = ["error" => "Invalid product id", "status" => Response::HTTP_OK];
        }
        return $response;
    }

    /**
     * Delete product
     *
     * @since 1.0
     *
     * @version 1.0.0
     *
     * @param App\Http\Requests\DeleteProductRequest $request A Request object
     *
     * @return json string
     */
    public function deleteProduct($id, DeleteProductRequest $request)
    {
        $response = [];
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            $response = ["result" => "success", "status" => Response::HTTP_OK];
        } else {
            $response = ["error" => "Invalid product id", "status" => Response::HTTP_OK];
        }
        return $response;
    }
}
