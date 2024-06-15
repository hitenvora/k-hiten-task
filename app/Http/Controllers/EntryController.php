<?php

namespace App\Http\Controllers;

use App\Models\BankDetails;
use App\Models\Entry;
use App\Models\Ledger;
use App\Models\PerchOrder;
use App\Models\PerchParty;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class EntryController extends Controller
{

    public function SaleReport(): View
    {
        $Entry = Entry::where('type', 0)->orderBy('id', 'DESC')->get();

        return view('admin-pages/entry/SaleReport', [
            'Entry' => $Entry,
            'layout' => 'side-menu'
        ]);
    }


    public function ledgerlist(): View
    {
        $Entry = Entry::orderBy('id', 'DESC')->get();
        $SaleEntry = Entry::where('type', 0)->orderBy('id', 'DESC')->get();
        $PurchaseEntry = Entry::where('type', 2)->orderBy('id', 'DESC')->get();

        return view('admin-pages/entry/ledgerlist', [
            'Entry' => $Entry,
            'SaleEntry' => $SaleEntry,
            'PurchaseEntry' => $PurchaseEntry,
            'layout' => 'side-menu'
        ]);
    }

    public function entrylist($id, Request $request): View
    {
        // $Entry = Entry::where('type', 2)->orderBy('id', 'DESC')->get();
        // dd($request->all());
        // dd($id);
        $Entry = Entry::where('ledgers_id', $id)->orderBy('id', 'DESC')->get();
        // dd($Entry);

        return view('admin-pages/entry/list', [
            'Entry' => $Entry,
            'id' => $id,
            'layout' => 'side-menu'
        ]);
    }

    public function entryadd($id, Request $request): View
    {

        $bank_list = BankDetails::all();
        // $customerData = PerchParty::all();
        $purchse_id = PerchOrder::where('status', '!=', 1)->get();
        $Entry = Entry::where('ledgers_id', $id)->orderBy('id', 'DESC')->get();
        // dd($request->type);
        return view('admin-pages/entry/add', [

            'layout' => 'side-menu',
            // 'type' => $request->type,
            // 'customerData' => $customerData,
            'id' => $id,
            'bank_list' => $bank_list,
            'purchse_id' => $purchse_id,
            'type' => $request->type,
            'Entry' => $request->Entry,
        ]);
    }

    public function edit($id): View
    {
        $purchse_id = PerchOrder::all();
        // $Entry = Ledger::orderBy('id', $id)->first();
        $Entry = Entry::findOrFail($id);
        $AdminCustomer = PerchParty::where('id', $Entry->partie_id)->first();


        //   $array = explode(',', $AdminCustomer->products);
        // $Product = Product::whereIn('id', $array)->orderBy('id', 'DESC')->get();

        return view('admin-pages/entry/edit', [
            'Entry' => $Entry,
            'layout' => 'side-menu',
            // 'customerData' => $customerData,
            'purchse_id' => $purchse_id,
            'AdminCustomer' => $AdminCustomer
        ]);
    }


    public function getOrders($partyId)
    {
        // Fetch orders associated with the provided party ID
        $orders = PerchOrder::where('partie_id', $partyId)->get();

        // Return the orders as JSON
        return response()->json($orders);
    }


    public function saveEntry(Request $request)
    {

        // dd($request->all());
        try {
            $validate = $request->validate([
                'partie_id' => 'required',
                'perch_id' => 'required',
                'credit_debit' => 'required',
                'payment_type' => 'required',
                'narration' => 'required',
                'rupee' => 'required',

            ]);

            $Entry = new Entry();
            $Entry->partie_id = $request->partie_id;
            $Entry->perch_id = $request->perch_id;
            $Entry->credit_debit = $request->credit_debit;
            $Entry->payment_type = $request->payment_type;
            $Entry->narration = $request->narration;
            $Entry->check_no = $request->check_no;
            $Entry->rtgs_no = $request->rtgs_no;
            $Entry->type = 2;
            $Entry->rupee = $request->rupee;
            $Entry->bank_id = $request->bank_id;
            $Entry->ledgers_id = $request->partie_id;

            $Entry->save();

            $PerchOrder = PerchOrder::findOrFail($Entry->perch_id);
            $PerchOrder->status = 1;
            $PerchOrder->save();

            return redirect()->route('ledger.list')->with('success', 'Entry Add Successfully!');
        } catch (ValidationException $e) {
            // dd($e);
            return back()->withInput()->withErrors(['error' => 'Validation error. Please check your inputs and try again.']);
        } catch (\Exception $e) {
            // dd($e);
            return back()->withInput()->withErrors(['error' => 'An error occurred while processing your request. Please try again.']);
        }
    }



    public function updateEntry(Request $request, $id)
    {
        try {
            $validate = $request->validate([
                'partie_id' => 'required',
                'perch_id' => 'required',
                'credit_debit' => 'required',
                'payment_type' => 'required',
                'narration' => 'required',
                'rupee' => 'required',

            ]);


            $Entry = Entry::findOrFail($id);
            $Entry->partie_id = $request->partie_id;
            $Entry->perch_id = $request->perch_id;
            $Entry->credit_debit = $request->credit_debit;
            $Entry->payment_type = $request->payment_type;
            $Entry->narration = $request->narration;
            $Entry->check_no = $request->check_no;
            $Entry->rtgs_no = $request->rtgs_no;
            $Entry->type = 2;
            $Entry->rupee = $request->rupee;
            $Entry->save();

            return redirect()->route('ledger.list')->with('success', 'Ledger Update Successfully!');
        } catch (ValidationException $e) {
            return back()->withInput()->withErrors(['error' => 'Validation error. Please check your inputs and try again.']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'An error occurred while processing your request. Please try again.']);
        }
    }


    public function getRupee($perchId)
    {
        $rupee = PerchOrder::where('id', $perchId)->value('total');
        return response()->json(['rupee' => $rupee]);
    }



    public function ShowEntryBalance($id)
    {
        // Retrieve all entries for the given party ID
        $entries = Entry::where('bank_id', $id)->get();

        // Calculate cumulative balances for each party ID
        $cumulativeBalances = [];
        $cumulativeBalance = 0;
        foreach ($entries as $entry) {
            $cumulativeBalance += $entry->rupee;
            $cumulativeBalances[$entry->id] = $cumulativeBalance;
        }

        // Pass data to the view
        return view('admin-pages/entry/entry-report', [
            'entries' => $entries,
            'cumulativeBalances' => $cumulativeBalances,
            'layout' => 'side-menu'
        ]);
    }

    public function Report($id)
    {
        // Retrieve all entries for the given party ID
        $entries = Entry::where('partie_id', $id)->get();

        // Calculate cumulative balances for each party ID
        $cumulativeBalances = [];
        $cumulativeBalance = 0;
        foreach ($entries as $entry) {
            $cumulativeBalance += $entry->rupee;
            $cumulativeBalances[$entry->id] = $cumulativeBalance;
        }

        // Pass data to the view
        return view('admin-pages/entry/report', [
            'entries' => $entries,
            'cumulativeBalances' => $cumulativeBalances,
            'layout' => 'side-menu'
        ]);
    }

}












