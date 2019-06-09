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
use App\ProductViews;
use App\ProductBids;
// Notification
use Notification;
use App\Notifications\HigherBidPlaced;

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
            // Get the pagination limit from the config files
            $page_limit = config('app.page_limit');

            // Get all the Products
            $products = Product::orderBy('id', 'desc')
                ->paginate($page_limit);
            // Lazy loads the Category and User for the product
            $products->load('category', 'user');
            

            // Pass all the parameters to its view
            return view('admin.products.index', ['products' => $products]);
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
            $product = new Product;
            // Get categories's list
            $categories =  Category::pluck('name', 'id');

            return view('admin.products.addedit', ['product' => $product, 'categories' => $categories]);
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

    /**
     *  Edit the Product
     */
    public function edit($refId)
    {
        try {
            // Decode the Id
            $id = intval($refId, 36) - 1000;
            // Find the Voucher details with its ID
            $product = Product::find($id);
            // Get categories's list
            $categories =  Category::pluck('name', 'id');

            return view('admin.products.addedit', ['product' => $product, 'categories' => $categories]);
        } catch (Exception $ex) {
            // Log the error
            Log::error("Method: " . __METHOD__ . ", Line " . __LINE__ . ": " . (string)$ex);
            return redirect()->route('/');
        }
    }

    /**
     *  Update the Product
     */
    public function update(Request $request, $refId)
    {
        try {
            // Validate the required fields
            $validation = Product::validate(Input::all());
            if ($validation->fails()) {
                return redirect('products/edit/' . $refId)
                    ->with('errors', $validation->errors());
            } else {
                $id = intval($refId, 36) - 1000;
                // Initialise our User class to update data in
                $product = Product::find($id);
                $product->category_id = $request->input('category_id');
                $product->name = $request->input('name');
                $product->sku = $request->input('sku');
                $product->price = $request->input('price');
                $product->description = $request->input('description');
                $product->created_by = Auth::user()->id;

                $product->save();
                // Log the save information
                Log::info('Product details for the updated successfully.');

                return redirect('products')
                    ->with('message', Messages::PRODUCT_MESSAGE_UPDATE_SUCCESS);
            }
        } catch (Exception $ex) {
            // Log the error
            Log::error("Method: " . __METHOD__ . ", Line " . __LINE__ . ": " . (string)$ex);
            return redirect()->route('/');
        }
    }

    /**
     *  Delete the Product
     */
    public function delete($refId)
    {
        try {
            // Decode the Id
            $id = intval($refId, 36) - 1000;

            // Find the Product
            $product = Product::find($id);

            $product->delete();
            // Log the save information
            Log::info('Product details for the ' . $id . ' deleted successfully.');

            return redirect('products')
                ->with('message', Messages::PRODUCT_MESSAGE_DELETE_SUCCESS);
        } catch (Exception $ex) {
            // Log the error
            Log::error("Method: " . __METHOD__ . ", Line " . __LINE__ . ": " . (string)$ex);
            return redirect()->route('/');
        }
    }

    /**
     *  View the Product
     */
    public function view($refId)
    {
        try {
            // Decode the Id
            $id = intval($refId, 36) - 1000;
            // Find the Voucher details with its ID -- Eager loading for Category and User
            $product = Product::with('category', 'user')->find($id);

            // Get the count of product views
            $total_product_views = ProductViews::where('product_id', $id)->count();
            // Get the product bids
            $product_bids = ProductBids::where('product_id', $id)
                ->orderBy('id', 'desc')
                ->get();

            return view('admin.products.view', ['product' => $product, 'product_bids' => $product_bids, 'total_product_views' => $total_product_views]);
        } catch (Exception $ex) {
            // Log the error
            Log::error("Method: " . __METHOD__ . ", Line " . __LINE__ . ": " . (string)$ex);
            return redirect()->route('/');
        }
    }

    /**
     *  View the Product Preview from Frontend
     */
    public function productview($refId)
    {
        try {
            // Decode the Id
            $id = intval($refId, 36) - 1000;
            // Find the Voucher details with its ID
            $product = Product::find($id);

            // Save the product views
            $product_views = new ProductViews;
            $product_views->product_id = $id;
            $product_views->visitors_ip = request()->ip();

            $product_views->save();

            $latest_bid_amt = 0;
            // Get the latest bid on the product
            $latest_bid = ProductBids::where('product_id', $id)
                ->orderBy('id', 'desc')
                ->first();
            if ($latest_bid != null) {
                $latest_bid_amt = $latest_bid->amount;
            }

            return view('frontend.productview', ['product' => $product, 'latest_bid_amt' => $latest_bid_amt]);
        } catch (Exception $ex) {
            // Log the error
            Log::error("Method: " . __METHOD__ . ", Line " . __LINE__ . ": " . (string)$ex);
            return redirect()->route('/');
        }
    }

    /**
     *  Place the bid for the Product from Frontend
     */
    public function placebid(Request $request, $refId)
    {
        try {
            // Validate the required fields
            $validation = ProductBids::validate(Input::all());
            if ($validation->fails()) {
                return redirect('productview/' . $refId)
                    ->with('errors', $validation->errors());
            } else {
                // Decode the Id
                $id = intval($refId, 36) - 1000;

                $bid_amount = $request->input('amount');
                // Save the product bid
                $product_bid = new ProductBids;
                $product_bid->product_id = $id;
                $product_bid->email = $request->input('email');
                $product_bid->amount = $bid_amount;

                // Notify only if a higher bid is placed
                $highest_bid_amt = ProductBids::where('product_id', $id)->max('amount');                
                if($bid_amount > $highest_bid_amt) {
                    $details = [
                        'greeting' => 'Hi',
                        'body' => 'Higher bid is placed for the product',
                        'actionURL' => url('/'),
                        'product_id' => $id,
                        'amount' => $bid_amount
                    ];

                    $product_bids = ProductBids::where('product_id', $id)->get();

                    // Send notification
                    // Notification::send($product_bids, new HigherBidPlaced($details));
                }

                // Now save the bid to database
                $product_bid->save();

                // Using Helper Functions
                // if(function_exists('carbon')) {
                //     $time = carbon();
                //     $toupper = strupper('maninder');
                // }

                // Log the save information
                Log::info('Product details for the updated successfully.');

                return redirect('productview/' . $refId)
                    ->with('message', Messages::PRODUCT_MESSAGE_PLACEBID_SUCCESS);
            }
        } catch (Exception $ex) {
            // Log the error
            Log::error("Method: " . __METHOD__ . ", Line " . __LINE__ . ": " . (string)$ex);
            return redirect()->route('/');
        }
    }
}
