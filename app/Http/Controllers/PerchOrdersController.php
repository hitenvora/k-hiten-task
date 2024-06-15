<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Http\Resources\ReturnPerchOrderResource;
use App\Models\AdminCustomerModels;
use App\Models\AdminOrderCart;
use App\Models\AppOrder;
use App\Models\BankDetails;
use App\Models\Ingredient;
use App\Models\Inventory;
use App\Models\PaymentLog;
use App\Models\PerchOrder;
use App\Models\PerchParty;
use App\Models\PerchProduct;
use App\Models\Product;
use App\Models\purchaseIngredient;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class PerchOrdersController extends Controller
{
    public function newOrder(Request $request): View
    {
        $AdminCustomer = PerchParty::where('id', $request->party)->first();
        $array = explode(',', $AdminCustomer->products);
        $Product = Product::whereIn('id', $array)->orderBy('id', 'DESC')->get();
        $bank_list = BankDetails::all();
        return view('admin-pages/perch-order/add', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'AdminCustomer' => $AdminCustomer,
            'Product' => $Product,
            'layout' => 'side-menu',
            'bank_list' => $bank_list
        ]);
    }

    public function newIngredientOrder(Request $request): View
    {
        $AdminCustomer = PerchParty::where('id', $request->party)->first();
        $array = explode(',', $AdminCustomer->ingredient);
        $Ingredient = Ingredient::whereIn('id', $array)->orderBy('id', 'DESC')->get();
        return view('admin-pages/perch-order/add_ingredient', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'AdminCustomer' => $AdminCustomer,
            'Ingredient' => $Ingredient,
            'layout' => 'side-menu'
        ]);
    }

    public function saveOrder(Request $request)
    {
        try {


            $validate = $request->validate([
                'customer' => 'required',
                'bill_due_date' => 'required',
                'product' => 'required',
                'quantity' => 'required',
                'price' => 'required',
                'taxes' => 'required',
                'tbAmount' => 'required',
                // 'discount' => 'required',
                'sub_total' => 'required',
                // 't_discount' => 'required',
                't_tax' => 'required',
                'final_amount' => 'required',
            ]);

            // dd($request->all());
            $order = new PerchOrder();
            $order->total_text = $request->t_tax;
            $order->discount = $request->t_discount;
            $order->sub_total = $request->sub_total;
            $order->total = $request->final_amount;
            $order->discount_in_percentage = $request->discount;
            $order->partie_id = $request->customer;
            $order->bill_due_date = $request->bill_due_date;
            $order->payment_type = $request->payment_type;
            $order->check_number = $request->check_number;
            $order->rtgs_number = $request->rtgs_number;
            $order->bank_id = $request->bank_id;

            $order->status = 3;
            $order->save();


            foreach ($request->product as $key => $value) {
                # code...
                $cart = new PerchProduct();
                $cart->orders_id = $order->id;
                $cart->product_id = $value;
                $cart->product_price = $request->price[$key];
                $cart->product_quntity = $request->quantity[$key];
                $cart->taxes = $request->taxes[$key];
                $cart->sub_total = $request->tbAmount[$key];
                $cart->save();

                $Inventory = Inventory::where('product_id', $value)->first();
                if ($Inventory == null) {
                    $Inventory = new Inventory();
                    $Inventory->product_id = $value;
                }
                $Inventory->inventorie = $Inventory->inventorie + $cart->product_quntity;
                $Inventory->save();
            }

            $PaymentLog = new PaymentLog();
            $cart->perch_id = $order->id;
            $cart->note = "your Perch Order transaction.";
            $cart->rupee = $order->total;
            $cart->credit_debit = 1;
            $order->payment_type = $request->payment_type;
            $PaymentLog->save();

            return redirect()->route('perch.order.list');
        } catch (\Exception $e) {
        
        }
    }
    public function saveIngredientOrder(Request $request)
    {
        // $validate = $request->validate([
        //     'customer' => 'required',
        //     'bill_due_date' => 'required',
        //     // 'product' => 'required',
        //     'ingredient' => 'required',
        //     'quantity' => 'required',
        //     'price' => 'required',
        //     'taxes' => 'required',
        //     'tbAmount' => 'required',
        //     // 'discount' => 'required',
        //     'sub_total' => 'required',
        //     // 't_discount' => 'required',
        //     't_tax' => 'required',
        //     'final_amount' => 'required',
        // ]);

        $order = new PerchOrder();
        $order->total_text = 0;
        $order->discount = 0;
        $order->sub_total = $request->sub_total;
        $order->total = $request->final_amount;
        $order->discount_in_percentage = 0;
        $order->partie_id = $request->customer;
        $order->bill_due_date = $request->bill_due_date;
        $order->status = 3;
        $order->type = 1;
        $order->save();


        foreach ($request->ingredient as $key => $value) {
            # code...
            $cart = new purchaseIngredient();
            $cart->orders_id = $order->id;
            $cart->ingredient_id = $value;
            $cart->ingredient_price = $request->price[$key];
            $cart->ingredient_quntity = $request->quantity[$key];
            $cart->sub_total = $request->tbAmount[$key];
            $cart->save();

            $Ingredient = Ingredient::where('id', $value)->first();
            $Ingredient->qty = $Ingredient->qty + $cart->ingredient_quntity;
            $Ingredient->save();
        }

      

        return redirect()->route('perch.order.list');
    }

    public function editOrder($id): View
    {
        $Order = PerchOrder::findOrFail($id);
        $AdminCustomer = PerchParty::where('id', $Order->partie_id)->first();

        $array = explode(',', $AdminCustomer->products);
        $Product = Product::whereIn('id', $array)->orderBy('id', 'DESC')->get();

        $bank_list = BankDetails::all();
        return view('admin-pages/perch-order/edit', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'AdminCustomer' => $AdminCustomer,
            'Product' => $Product,
            'Order' => $Order,
            'bank_list' => $bank_list,
            'layout' => 'side-menu'
        ]);
    }

    public function editIngredientOrder($id): View
    {
        $Order = PerchOrder::findOrFail($id);
        $AdminCustomer = PerchParty::where('id', $Order->partie_id)->first();

        $array = explode(',', $AdminCustomer->ingredient);
        $Ingredient = Ingredient::whereIn('id', $array)->orderBy('id', 'DESC')->get();
        $purchaseIngredient = purchaseIngredient::where('orders_id', $Order->id)->orderBy('id', 'DESC')->get();

        return view('admin-pages/perch-order/editingredient', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'AdminCustomer' => $AdminCustomer,
            'purchaseIngredient' => $purchaseIngredient,
            'Ingredient' => $Ingredient,
            'Order' => $Order,
            'layout' => 'side-menu'
        ]);
    }
    public function updateIngredientOrder(Request $request, $id)
    {


        $order = PerchOrder::findOrFail($id);
        if ($order == null) {
            $order = new PerchOrder();
            $order->total_text = 0;
            $order->discount = 0;
            $order->sub_total = $request->sub_total;
            $order->total = $request->final_amount;
            $order->discount_in_percentage = 0;
            $order->partie_id = $request->customer;
            $order->bill_due_date = $request->bill_due_date;
            $order->status = 3;
            $order->type = 1;
            $order->save();
        }

        foreach ($request->ingredient as $key => $value) {

            $cart = purchaseIngredient::where('ingredient_id', $value)->where('orders_id', $order->id)->first();
            $old_qty = 0;
            if ($cart == null) {
                $cart = new purchaseIngredient();
            } else {
                $old_qty = $cart->ingredient_quntity;
            }
            $cart->orders_id = $order->id;
            $cart->ingredient_id = $value;
            $cart->ingredient_price = $request->price[$key];
            $cart->ingredient_quntity = $request->quantity[$key];
            $cart->sub_total = $request->tbAmount[$key];
            $cart->save();
            // $Ingredient = Ingredient::where('id', $value)->first();
            $Ingredient = Ingredient::where('id', $value)->first();
            $Ingredient->qty = $old_qty - $request->quantity[$key];
            $Ingredient->save();
        }

        return redirect()->route('perch.order.list');
    }

    public function updateOrder(Request $request, $id)
    {
        try {
            //code...

            $validate = $request->validate([
                'customer' => 'required',
                'bill_due_date' => 'required',
                'product' => 'required',
                'quantity' => 'required',
                'price' => 'required',
                'taxes' => 'required',
                'tbAmount' => 'required',
                // 'discount' => 'required',
                'sub_total' => 'required',
                // 't_discount' => 'required',
                't_tax' => 'required',
                'final_amount' => 'required',
            ]);
            $PerchOrder = PerchOrder::findOrFail($id);

            $order = new PerchOrder();
            $order->total_text = $request->t_tax;
            $order->discount = $request->t_discount;
            $order->sub_total = $request->sub_total;
            $order->partie_id = $request->customer;
            $order->total = $request->final_amount;
            $order->discount_in_percentage = $request->discount;
            $order->bill_due_date = $request->bill_due_date;
            
            $order->payment_type = $request->payment_type;
            $order->check_number = $request->check_number;
            $order->rtgs_number = $request->rtgs_number;
            $order->bank_id = $request->bank_id;
            

            $order->status = $PerchOrder->status;
            $order->save();

            $PerchOrderCart = PerchProduct::where('orders_id', $PerchOrder->id)->get();
            $PerchOrder->delete();
            foreach ($PerchOrderCart as $value) {
                $Inventory = Inventory::where('product_id', $value->product_id)->first();

                if ($Inventory == null) {
                    $Inventory = new Inventory();
                    $Inventory->product_id = $value->product_id;
                }
                $Inventory->inventorie = $Inventory->inventorie - $value->product_quntity;
                $Inventory->save();
                $value->delete();
            }
            foreach ($request->product as $key => $value) {
                # code...
                $cart = new PerchProduct();
                $cart->orders_id = $order->id;
                // $cart->Client_id = $request->customer;
                $cart->product_id = $value;
                $cart->product_price = $request->price[$key];
                $cart->product_quntity = $request->quantity[$key];
                $cart->taxes = $request->taxes[$key];
                $cart->sub_total = $request->tbAmount[$key];
                $cart->save();

                $Inventory = Inventory::where('product_id', $value)->first();

                if ($Inventory == null) {
                    $Inventory = new Inventory();
                    $Inventory->product_id = $value;
                }
                $Inventory->inventorie = $Inventory->inventorie + $cart->product_quntity;
                $Inventory->save();
            }

            return redirect()->route('perch.order.list');
        } catch (\Throwable $th) {
            //throw $th;
            // dd($th);
        }
    }

    public function updateStatus($id)
    {
        $PerchOrder = PerchOrder::findOrFail($id);
        if ($PerchOrder->status == '1') {
            $PerchOrder->status = '2';
            $PerchOrder->save();
            return redirect()->back();
        }
        if ($PerchOrder->status == '2') {
            $PerchOrder->status = '3';
            $PerchOrder->save();
            return redirect()->back();
        }
        if ($PerchOrder->status == '3') {
            $PerchOrder->status = '1';
            $PerchOrder->save();
            return redirect()->back();
        }

        return redirect()->back();
    }

    public function perchOrderList(): View
    {
        $orders = PerchOrder::orderBy('id', 'DESC')->get();
        $AdminCustomer = PerchParty::orderBy('id', 'DESC')->get();
        return view('admin-pages/perch-order/list', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'orders' => $orders,
            'Partys' => $AdminCustomer,
            'layout' => 'side-menu'
        ]);
    }

    public function fetchProduct($id)
    {
        try {
            $product = Product::findOrFail($id);
            return new ProductResource($product);
        } catch (\Exception $e) {
            // Handle the exception, for example, return an error response
            return response()->json(['error' => 'Product not found.'], 404);
        }
    }

    public function generateInvoicePDF($invoiceId)
    {
        // Fetch invoice data from the database
        $invoice = PerchOrder::findOrFail($invoiceId);
        $orders = PerchProduct::where('app_orders_id', $invoice->id)->get();
        return view('invoice_template', compact('invoice', 'orders'));
        // Load invoice template
        $html = view('invoice_template', compact('invoice'))->render();

        // Create an instance of Dompdf
        $pdf = new Dompdf();

        // Load HTML to Dompdf
        $pdf->loadHtml($html);

        // Set paper size (optional)
        $pdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $pdf->render();

        // Generate a unique filename for the PDF
        $filename = 'invoice_' . $invoice->id . '.pdf';

        // Save the PDF to the storage directory
        // $pdf->save(storage_path('app/public/invoices/' . $filename));

        $pdf->render();

        // Save the PDF to a file
        if (file_exists(public_path('invoice/' . $filename))) {
            unlink(public_path('invoice/' . $filename));
        }
        file_put_contents('invoice/' . $filename, $pdf->output());

        // Provide a download link to the saved PDF
        return redirect()->route('download.invoice', $filename);
    }
    public function downloadInvoice($filename)
    {
        // Provide a download link to the saved PDF
        return response()->download(public_path('invoice/' . $filename))->deleteFileAfterSend();
    }




    public function returnPerchOrder($id): View
    {
        $Order = PerchOrder::findOrFail($id);

        $AdminCustomer = AdminCustomerModels::orderBy('id', 'DESC')->get();
        $Product = Product::where('status', 1)->orderBy('id', 'DESC')->get();
        $purcehseProductShow = PerchProduct::where('orders_id', $id)->get();

        return view('admin-pages/perch-orders-retrun/perch-orders-retrun', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'AdminCustomer' => $AdminCustomer,
            'Product' => $Product,
            'Order' => $Order,
            'purcehseProductShow' => $purcehseProductShow,
            'layout' => 'side-menu'
        ]);
    }

    public function fetchForPerchReturnOrder($id)
    {
        try {
            $return_product = PerchProduct::findOrFail($id);
            return new ReturnPerchOrderResource($return_product);
        } catch (\Exception $e) {
            // Handle the exception, for example, return an error response
            return response()->json(['error' => 'Product not found.'], 404);
        }
    }


    public function perchOrderReturnSubmit(Request $request)
    {

        // dd($request->all());    
        // die;

        // $productId = $request->product;
        //  $subtotal = $request->sub_total;

        // $product = AppOrderCart::find($productId);

        // $productId = $request->input('product');

        // Fetch the new sub_total from the request


        $newSubTotal = $request->sub_total;
        $newTotal = $request->final_amount;


        // Find the AppOrderCart record using the productId
        foreach ($request->product as $customerId) {
            $product = PerchProduct::findOrFail($customerId);
            // dd($product);
            // Check if the product exists
            if ($product) {
                // Calculate the difference between the existing sub_total and the new sub_total
                $difference_SubTotal = $product->sub_total - $newSubTotal;
                $difference_Total = $product->total_amount - $newTotal;

                // Update the sub_total by subtracting the difference
                $product->sub_total = $difference_SubTotal;
                // $product->total_amount = $difference_Total;
                // $product->return_order = "1";

                // Save the changes to the database
                $product->save();
                // $return_product = new ReturnProduct();
                // $return_product->product_id = $productId;
                // $return_product->save();

                // return redirect()->route('returnProductView');
                return redirect()->route('perch.order.list');
                // } else {
                // Handle the case where the product does not exist
                // return response()->json(['error' => 'Product not found'], 404);
            }
        }
    }
}
