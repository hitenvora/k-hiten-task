<?php

namespace App\Http\Controllers;

use App\Models\Ledger;
use App\Models\PerchParty;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LedgerController extends Controller
{
    public function ledgerlist(): View
    {
        $Ledgers = Ledger::orderBy('id', 'DESC')->get();

        return view('admin-pages/ledger/add-modal', [
            'Ledgers' => $Ledgers,
            'layout' => 'side-menu'
        ]);
    }

    public function ledgers(Request $request): View
    {
        // dd($request->all());
        $Ledgers = Ledger::where('type',$request->type)->orderBy('id', 'DESC')->get();

        return view('admin-pages/ledger/list', [
            'type' => $request->type,
            'Ledgers' => $Ledgers,
            'layout' => 'side-menu'
        ]);
    }

    public function ledgeradd(Request $request): View
    {
        $customerData = PerchParty::all();
        return view('admin-pages/ledger/add', [

            'layout' => 'side-menu',
            'type' => $request->type,
            'customerData' => $customerData
        ]);
    }

    public function edit($id): View
    {
        // $Ledgers = Ledger::orderBy('id', $id)->first();
        $Ledgers = Ledger::findOrFail($id);
        $customerData = PerchParty::all();
        return view('admin-pages/ledger/edit', [
            'Ledgers' => $Ledgers,
            'customerData' => $customerData,
            'layout' => 'side-menu',
            // 'type' => $request->type
        ]);
    }

    public function saveLedger(Request $request)
    {

        // dd($request->all());
        try {
            $validate = $request->validate([
                'name' => 'required',
                'pin_code' => 'required',
                'email' => 'required',
                'phone_no' => 'required',
                'balancing_method' => 'required',
                'mail_to' => 'required',
                'gst_heading' => 'required',
                'note' => 'required',
                'ledger_category' => 'required',
                // 'type' => 'required',
                // 'gst_no' => 'required',
                // 'state' => 'required',
                // 'address' => 'required',
                // 'contact_person' => 'required',
                // 'designation' => 'required',
                // 'country' => 'required',
                // 'pan_no' => 'required',
            ]);

            $Ledgers = new Ledger();
            $Ledgers->name = $request->name;
            $Ledgers->pin_code = $request->pin_code;
            $Ledgers->email = $request->email;
            $Ledgers->phone_no = $request->phone_no;
            $Ledgers->balancing_method = $request->balancing_method;
            $Ledgers->mail_to = $request->mail_to;
            $Ledgers->gst_heading = $request->gst_heading;
            $Ledgers->note = $request->note;
            $Ledgers->ledger_category = $request->ledger_category;
            $Ledgers->gst_no = $request->gst_no;
            $Ledgers->state = $request->state;
            $Ledgers->address = $request->address;
            $Ledgers->contact_person = $request->contact_person;
            $Ledgers->designation = $request->designation;
            $Ledgers->country = $request->country;
            $Ledgers->pan_no = $request->pan_no;
            $Ledgers->type = $request->type;
            $Ledgers->save();

            return redirect()->route('ledgers.list')->with('success', 'Ledger Add Successfully!');
        } catch (ValidationException $e) {
            // dd($e);
            return back()->withInput()->withErrors(['error' => 'Validation error. Please check your inputs and try again.']);
        } catch (\Exception $e) {
            // dd($e);
            return back()->withInput()->withErrors(['error' => 'An error occurred while processing your request. Please try again.']);
        }
    }

    public function updateLedger(Request $request,$id)
    {
        try {
            $validate = $request->validate([
                'name' => 'required',
                'pin_code' => 'required',
                'email' => 'required',
                'phone_no' => 'required',
                'balancing_method' => 'required',
                'mail_to' => 'required',
                'gst_heading' => 'required',
                'note' => 'required',
                'ledger_category' => 'required',
                // 'gst_no' => 'required',
                // 'state' => 'required',
                // 'address' => 'required',
                // 'contact_person' => 'required',
                // 'designation' => 'required',
                // 'country' => 'required',
                // 'pan_no' => 'required',
            ]);
            

            // $Ledgers = Ledger::orderBy('id', $id)->first();
            // if($Ledgers == null){
            //     $Ledgers = new Ledger();
            // }

            $Ledgers = Ledger::findOrFail($id);

            $Ledgers->name = $request->name;
            $Ledgers->pin_code = $request->pin_code;
            $Ledgers->email = $request->email;
            $Ledgers->phone_no = $request->phone_no;
            $Ledgers->balancing_method = $request->balancing_method;
            $Ledgers->mail_to = $request->mail_to;
            $Ledgers->gst_heading = $request->gst_heading;
            $Ledgers->note = $request->note;
            $Ledgers->ledger_category = $request->ledger_category;
            $Ledgers->gst_no = $request->gst_no;
            $Ledgers->state = $request->state;
            $Ledgers->address = $request->address;
            $Ledgers->contact_person = $request->contact_person;
            $Ledgers->designation = $request->designation;
            $Ledgers->country = $request->country;
            $Ledgers->pan_no = $request->pan_no;
            $Ledgers->save();

            return redirect()->route('ledgers.list')->with('success', 'Ledger Update Successfully!');
        } catch (ValidationException $e) {
            return back()->withInput()->withErrors(['error' => 'Validation error. Please check your inputs and try again.']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'An error occurred while processing your request. Please try again.']);
        }
    }
}
