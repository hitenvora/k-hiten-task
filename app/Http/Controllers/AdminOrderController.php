<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\AdminCustomerModels;
use App\Models\AdminOrderCart;
use App\Models\AppOrder;
use App\Models\AppOrderCart;
use App\Models\AppOrders;
use App\Models\Entry;
use App\Models\Inventory;
use App\Models\PaymentLog;
use App\Models\Product;
use Dompdf\Dompdf;
use Dotenv\Exception\ValidationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use PhpParser\Node\Stmt\Foreach_;
use Twilio\Rest\Client;

class AdminOrderController extends Controller
{
    public function newAdminOrder(): View
    {
        $AdminCustomer = AdminCustomerModels::orderBy('id', 'DESC')->get();
        $Product = Product::where('status', 1)->orderBy('id', 'DESC')->get();

        return view('admin-pages/admin-order/add', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'AdminCustomer' => $AdminCustomer,
            'Product' => $Product,
            'layout' => 'side-menu'
        ]);
    }


    public function sendWhatsAppMessage($order)
    {
    $twilioSID = env('TWILIO_SID');
    $twilioToken = env('TWILIO_AUTH_TOKEN');
    $twilioWhatsAppNumber = env('TWILIO_WHATSAPP_NUMBER');
        $adminPhoneNumber = '+919687431212'; // Admin's WhatsApp phone number


    $client = new Client($twilioSID, $twilioToken);

    $message = "New order received:\n";
    $message .= "Customer: " . $order->admin_client_id . "\n";
    $message .= "total Text: " . $order->total_text . "\n";
    $message .= "Bill Due Date: " . $order->bill_due_date . "\n";
    $message .= "Discount: " . $order->discount . "\n";
    $message .= "Total: " . $order->total . "\n";
    $message .= "SubTotal: " . $order->sub_total . "\n";
    $message .= "Discount In Percentage: " . $order->discount_in_percentage . "\n";


        // $client->messages->create("whatsapp:$adminPhoneNumber", [
        // "from" => "whatsapp:$twilioWhatsAppNumber",
        // "body" => $message
        // ]);
        $client->messages("whatsapp:$adminPhoneNumber", [
        "from" => "whatsapp:$twilioWhatsAppNumber",
        "body" => $message
        ]);
        // dd($check);
    
    }



    public function saveAdminOrder(Request $request)
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

            $order = new AppOrders();
        
            $order->total_text = $request->t_tax;
            $order->discount = $request->t_discount;
            $order->sub_total = $request->sub_total;
            $order->total = $request->final_amount;
            $order->discount_in_percentage = $request->discount;
            $order->admin_client_id = $request->customer;
            $order->type = 2;
            $order->bill_due_date = $request->bill_due_date;
            $order->status = 3;
            $order->save();

            $this->sendWhatsAppMessage($order);
      

            $customer = AdminCustomerModels::findOrFail($request->customer);

            $PaymentLog = new PaymentLog();
            $PaymentLog->perch_id = $order->id;
            $PaymentLog->note = "Rs ".$order->total." credited from the bill number ".$order->id ." and debited from the ". $customer->first_name . $customer->last_name ;
            // $PaymentLog->note = "Rs " . $order->total . " credited from the bill number " . $order->id;
            $PaymentLog->rupee = $order->total;
            $PaymentLog->credit_debit = 0;
            $PaymentLog->payment_type = 0;
            $PaymentLog->save();

            $Entry = new Entry();
            $Entry->order_id = $order->id;
            $Entry->narration = "Rs ".$order->total." credited from the bill number ".$order->id." and debited from the ". $customer->first_name . $customer->last_name ;
            // $Entry->narration = "Rs " . $order->total . " credited from the bill number " . $order->id;
            $Entry->rupee = $order->total;
            $Entry->credit_debit = 0;
            $order->payment_type = 0;
            $Entry->save();

            foreach ($request->product as $key => $value) {
                # code...
                $cart = new AdminOrderCart();
                $cart->app_orders_id = $order->id;
                $cart->Client_id = $request->customer;
                $cart->product_id = $value;
                $cart->product_price = $request->price[$key];
                $cart->product_quntity = $request->quantity[$key];
                $cart->taxes = $request->taxes[$key];
                $cart->sub_total = $request->tbAmount[$key];
                $cart->save();

                $product_idInventory = Inventory::where('product_id', $cart->product_id)->first();
                if ($product_idInventory == null) {
                    $product_idInventory = new Inventory();
                    $product_idInventory->product_id = $cart->product_id;
                    $product_idInventory->save();
                    return redirect()->back()->with('err');
                }
                $product_idInventory->inventorie = $product_idInventory->inventorie - $cart->product_quntity;
                $product_idInventory->save();

              
            }
            return redirect()->route('amin.order.list')->with('success', 'Bulk Order Added Successfully!');
        } catch (ValidationException $e) {
            return back()->withInput()->withErrors(['error' => 'Validation error. Please check your inputs and try again.']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'An error occurred while processing your request. Please try again.']);
        }
    }

    public function editAdminOrder($id): View
    {
        $Order = AppOrder::findOrFail($id);
        $AdminCustomer = AdminCustomerModels::orderBy('id', 'DESC')->get();
        $Product = Product::where('status', 1)->orderBy('id', 'DESC')->get();

        return view('admin-pages/admin-order/edit', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'AdminCustomer' => $AdminCustomer,
            'Product' => $Product,
            'Order' => $Order,
            'layout' => 'side-menu'
        ]);
    }

    public function updateStatusAdminOrder($id)
    {
        $AppOrder = AppOrder::findOrFail($id);
        if ($AppOrder->status == '1') {
            $AppOrder->status = '2';
            $AppOrder->save();
            return redirect()->back();
        }
        if ($AppOrder->status == '2') {
            $AppOrder->status = '3';
            $AppOrder->save();
            return redirect()->back();
        }
        if ($AppOrder->status == '3') {
            $AppOrder->status = '1';
            $AppOrder->save();
            return redirect()->back();
        }

        return redirect()->back();
    }
    public function updateAdminOrder(Request $request, $id)
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

            foreach ($request->product as $key => $value) {
                $product_idInventory = Inventory::where('product_id', $value)->first();
                if ((int) $request->quantity[$key] > ((int) $product_idInventory->inventorie ? (int) $product_idInventory->inventorie : 0)) {
                    $product = product::where('id', $value)->first();
                    $msg = $product->product_name . ' not available';
                    return redirect()->back()->with('errorMessage', $msg);
                }
            }
            $AppOrder = AppOrder::findOrFail($id);

            $order = new AppOrders();
            $order->total_text = $request->t_tax;
            $order->discount = $request->t_discount;
            $order->sub_total = $request->sub_total;
            $order->admin_client_id = $request->customer;
            $order->total = $request->final_amount;
            $order->discount_in_percentage = $request->discount;
            $order->type = 2;
            $order->bill_due_date = $request->bill_due_date;
            $order->status = $AppOrder->status;
            $order->save();

            $AppOrderCart = AdminOrderCart::where('app_orders_id', $AppOrder->id)->get();
            foreach ($AppOrderCart as $value) {
                $product_idInventory = Inventory::where('product_id', $value->product_id)->first();
                if ($product_idInventory == null) {
                    $product_idInventory = new Inventory();
                    $product_idInventory->product_id = $value->product_id;
                    $product_idInventory->save();
                    return redirect()->back()->with('errorMessage', 'errorMessage');
                }
                $product_idInventory->inventorie = $product_idInventory->inventorie + $value->product_quntity;
                $product_idInventory->save();
                $value->delete();
            }
            $AppOrder->delete();
            foreach ($request->product as $key => $value) {
                # code...
                $cart = new AdminOrderCart();
                $cart->app_orders_id = $order->id;
                $cart->Client_id = $request->customer;
                $cart->product_id = $value;
                $cart->product_price = $request->price[$key];
                $cart->product_quntity = $request->quantity[$key];
                $cart->taxes = $request->taxes[$key];
                $cart->sub_total = $request->tbAmount[$key];
                $cart->save();

                $product_idInventory = Inventory::where('product_id', $cart->product_id)->first();
                if ($product_idInventory == null) {
                    $product_idInventory = new Inventory();
                    $product_idInventory->product_id = $cart->product_id;
                    $product_idInventory->save();
                    return redirect()->back()->with('err');
                }
                $product_idInventory->inventorie = $product_idInventory->inventorie - $cart->product_quntity;
                $product_idInventory->save();
            }

            // return redirect()->route('amin.order.list');
            return redirect()->route('amin.order.list')->with('success', 'Bulk Order Updated Successfully!');
        } catch (ValidationException $e) {
            return back()->withInput()->withErrors(['error' => 'Validation error. Please check your inputs and try again.']);
        } catch (\Exception $e) {
            // dd($e);
            return back()->withInput()->withErrors(['error' => 'An error occurred while processing your request. Please try again.']);
        }
    }

    public function adminOrderList(): View
    {
        $orders = AppOrder::where('type', 2)->orderBy('id', 'DESC')->get();

        return view('admin-pages/admin-order/list', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'orders' => $orders,
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
        // $invoice = AppOrder::findOrFail($invoiceId);
        $invoice = AppOrder::with('Customer')->findOrFail($invoiceId);

        // $orders = AdminOrderCart::where('app_orders_id', $invoice->id)->get();
        $orders = AdminOrderCart::with('Product', 'Customer')
            ->where('app_orders_id', $invoice->id)
            ->get();
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



    public function returnAdminOrder($id): View
    {
        $Order = AppOrder::findOrFail($id);

        $AdminCustomer = AdminCustomerModels::orderBy('id', 'DESC')->get();
        $Product = Product::where('status', 1)->orderBy('id', 'DESC')->get();
        $purcehseProductShow = AdminOrderCart::where('app_orders_id', $id)->get();

        return view('admin-pages/order-return/order-return', [
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



    public function orderReturnSubmit(Request $request)
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
            $product = AdminOrderCart::findOrFail($customerId);
            // dd($product);
            // Check if the product exists
            if ($product) {
                // Calculate the difference between the existing sub_total and the new sub_total
                $difference_SubTotal = $product->sub_total - $newSubTotal;
                $difference_Total = $product->total_amount - $newTotal;

                // Update the sub_total by subtracting the difference
                $product->sub_total = $difference_SubTotal;
                $product->total_amount = $difference_Total;
                $product->return_order = "1";

                // Save the changes to the database
                $product->save();
                // $return_product = new ReturnProduct();
                // $return_product->product_id = $productId;
                // $return_product->save();

                // return redirect()->route('returnProductView');
                return redirect()->route('amin.order.list');
                // } else {
                // Handle the case where the product does not exist
                // return response()->json(['error' => 'Product not found'], 404);
            }
        }
    }
}
