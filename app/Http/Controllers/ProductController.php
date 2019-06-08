<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Log;
use Auth;
use App\Messages;
use App\User;
use App\Category;
use App\Product;

class ProductController extends Controller
{
    /**
     * Show the Products.
     *     
     * @return Response
     */
    public function index()
    {
        try {
            // Get the pagination from config files
            $paginate = 15;
            // Get all the Products
            $products = Product::orderBy('id', 'desc')
                ->paginate($paginate);

            // Get user's list
            $users =  User::pluck('name', 'id');

            // Pass all the parameters to its view
            return view('admin.products.index', ['products' => $products, 'users' => $users]);
        } catch (Exception $ex) {
            // Log the error
            Log::error("Method: " . __METHOD__ . ", Line " . __LINE__ . ": " . (string)$ex);
            return redirect()->route('/');
        }
    }

    /**
     * Add new Product
     */
    public function add()
    {
        try {
            // Get user's list
            $categories =  Category::pluck('name', 'id');

            return view('admin.products.add', ['categories' => $categories]);
        } catch (Exception $ex) {
            // Log the error
            Log::error("Method: " . __METHOD__ . ", Line " . __LINE__ . ": " . (string)$ex);
            return redirect()->route('/');
        }
    }

    /**
     *  Save the Product
     */
    public function create(Request $request)
    {
        try {
            // Build validation object
            $validation = Product::validate(Input::all());
            if ($validation->fails()) {
                return redirect('products/add')
                    ->with('errors', $validation->errors());
            } else {
                // Initialise our Advertisement class to save data in
                $product = new Product;
                $product->category_id = $request->input('category_id');
                $product->name = $request->input('name');
                $product->sku = $request->input('sku');
                $product->price = $request->input('price');
                $product->description = $request->input('description');
                $product->created_by = Auth::user()->id;

                // Save the Product
                $product->save();

                // Log the save information
                Log::info('Product details saved successfully.');

                return redirect('products')
                    ->with('message', Messages::PRODUCT_MESSAGE_CREATE_SUCCESS);
            }
        } catch (Exception $ex) {
            // Log the error
            Session::flash('alert-class', 'alert-denger');
            Session::flash('message', 'Error while saving a detail');
            \Log::error("Method: " . __METHOD__ . ", Line " . __LINE__ . ": " . (string)$ex);
            return redirect()->back()->withInput();
        }
    }
}
