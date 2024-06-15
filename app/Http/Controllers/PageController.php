<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\FirmRequest;
use App\Http\Requests\GstAndTextCategoryRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\SubCategoryRequest;
use App\Models\AdminCustomerModels;
use App\Models\AppOrder;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Firm;
use App\Models\GstAndTextCategory;
use App\Models\Inventory;
use App\Models\manufacturing;
use App\Models\Product;
use App\Models\productIngredient;
use App\Models\SubCategory;
use App\Models\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class PageController extends Controller
{

    public function categorieList(): View
    {
        $categories = Category::orderBy('id', 'DESC')->get();

        return view('admin-pages/categorie/list', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'categories' => $categories,
            'layout' => 'side-menu'
        ]);
    }

    public function addCategorie(): View
    {
        return view('admin-pages/categorie/add', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'

            'layout' => 'side-menu'
        ]);
    }

    public function editCategorie($id): View
    {
        $category = Category::findOrFail($id);
        return view('admin-pages/categorie/edit', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'category' => $category,
            'layout' => 'side-menu'
        ]);
    }

    public function saveCategorie(CategoryRequest $request)
    {
        $category = new Category;
        $category->name = $request->input('name');
        $category->save();

        return redirect()->route('categorie.list');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCategorie(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->input('name');
        $category->save();

        return redirect()->route('categorie.list');
    }


    public function customerList(): View
    {
        // $customer = Customer::where('name', '!=', 'null')->where('contact_no', '!=', 'null')->orderBy('id', 'DESC')->get();
        $customer = AdminCustomerModels::orderBy('id', 'DESC')->get();

        return view('admin-pages/customer/list', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'customer' => $customer,
            'layout' => 'side-menu'
        ]);
    }

    public function addcustomer(): View
    {
        return view('admin-pages/customer/add', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'

            'layout' => 'side-menu'
        ]);
    }
    public function saveCustomer(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|max:255',
            'contact_no' => 'required|max:255'
        ]);
        // $customer = new Customer;
        $customer = new AdminCustomerModels();
        // $customer->name = $request->input('name');
        $customer->first_name = $request->input('name');
        // $customer->contact_no = $request->input('contact_no');
        $customer->contact_number = $request->input('contact_no');

        $customer->type = 1;
        $customer->save();

        return redirect()->route('customer.list');
    }

    public function editCustomer($id): View
    {
        $customer = AdminCustomerModels::findOrFail($id);
        return view('admin-pages/customer/edit', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'customer' => $customer,
            'layout' => 'side-menu'
        ]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCustomer(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'contact_no' => 'required|max:255'
        ]);

        // $customer = Customer::findOrFail($id);
        $customer = AdminCustomerModels::findOrFail($id);
        // $customer->name = $request->input('name');
        $customer->first_name = $request->input('name');
        // $customer->contact_no = $request->input('contact_no');
        $customer->contact_number = $request->input('contact_no');
        $customer->type = 1;
        $customer->save();

        return redirect()->route('customer.list');
    }





    public function employeeList(): View
    {
        $employee = User::orderBy('id', 'DESC')->get();

        return view('admin-pages/employee/list', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'employee' => $employee,
            'layout' => 'side-menu'
        ]);
    }

    public function addEmployee(): View
    {
        return view('admin-pages/employee/add', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'

            'layout' => 'side-menu'
        ]);
    }

    public function editEmployee($id): View
    {
        $employee = User::findOrFail($id);
        return view('admin-pages/employee/edit', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'employee' => $employee,
            'layout' => 'side-menu'
        ]);
    }

    public function saveEmployee(Request $request)
    {
        // dd($request->all());
        try {

            $validatedData = $request->validate([
                'name' => 'required|min:2|max:200',
                'email' => 'required|email|min:2|max:200',
                'password' => 'required|min:2|max:200',
                'address' => 'required|min:2|max:200',
                'aadhar_card_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'contact_number' => 'required|digits_between:2,15',
                'date_of_birth' => 'required|date',
            ]);

            $employee = new User;
            $employee->name = $request->input('name');
            $employee->email = $request->input('email');
            $employee->password =  bcrypt($request['password']);
            $employee->gender = $request->input('gender');
            $employee->date_of_birth = $request->input('date_of_birth');
            $employee->contact_number = $request->input('contact_number');
            $employee->address = $request->input('address');
            $employee->active = '1';
            $employee->status = '1';


            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $ext = $file->getClientOriginalExtension();
                $filename = 'image-' . time() . '_' . generateString() . '.' . $ext;
                $filepath = 'upload/' . $filename;
                $file->move('upload/', $filename);
                $employee->photo = $filepath;
            }

            if ($request->hasFile('aadhar_card_photo')) {
                $file = $request->file('aadhar_card_photo');
                $ext = $file->getClientOriginalExtension();
                $filename = 'image-' . time() . '_' . generateString() . '.' . $ext;
                $filepath = 'upload/' . $filename;
                $file->move('upload/', $filename);
                $employee->aadhar_card_photo = $filepath;
            }

            $employee->save();

            return redirect()->route('employee.list')->with('success', 'Employee Added Successfullly!');
        } catch (ValidationException $e) {
            return back()->withInput()->withErrors(['error' => 'Validation error. Please check your inputs and try again.']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'An error occurred while processing your request. Please try again.']);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateEmployee(Request $request, $id)
    {
        try {

            $employee = User::findOrFail($id);
            $employee->name = $request->input('name');
            $employee->email = $request->input('email');
            $employee->password =  bcrypt($request['password']);
            $employee->gender = $request->input('gender');
            $employee->date_of_birth = $request->input('date_of_birth');
            $employee->contact_number = $request->input('contact_number');
            $employee->address = $request->input('address');
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $ext = $file->getClientOriginalExtension();
                $filename = 'image-' . time() . '_' . generateString() . '.' . $ext;
                $filepath = 'upload/' . $filename;
                $file->move('upload/', $filename);
                $employee->photo = $filepath;
            }
            if ($request->hasFile('aadhar_card_photo')) {
                $file = $request->file('aadhar_card_photo');
                $ext = $file->getClientOriginalExtension();
                $filename = 'image-' . time() . '_' . generateString() . '.' . $ext;
                $filepath = 'upload/' . $filename;
                $file->move('upload/', $filename);
                $employee->aadhar_card_photo = $filepath;
            }

            $employee->save();

            // return redirect()->route('employee.list');
            return redirect()->route('employee.list')->with('success', 'Employee Details Updated Successfullly!');
        } catch (ValidationException $e) {
            return back()->withInput()->withErrors(['error' => 'Validation error. Please check your inputs and try again.']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'An error occurred while processing your request. Please try again.']);
        }
    }

    public function employeeStatus($id)
    {
        $employee = User::findOrFail($id);
        $employee->active = $employee->active;
        if ($employee->active == '0') {
            $employee->active = '1';
        } elseif ($employee->active == '1') {
            $employee->active = '0';
        }
        $employee->save();
        return redirect()->route('employee.list');
    }




    // SubCategories function

    public function addSubCategorie(): View
    {
        $cate = Category::where('name', '!=', '')->orderBy('id', 'DESC')->get();
        return view('admin-pages/subcategorie/addsubcat', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'cate' => $cate,
            'layout' => 'side-menu'
        ]);
    }

    public function saveSubCategorie(CategoryRequest $request)
    {
        // dd($request->all());
        try {
            $category = new SubCategory();
            $category->categorieid = 1;
            $category->name = $request->input('name');
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $ext = $file->getClientOriginalExtension();
                $filename = 'image-' . time() . '_' . generateString() . '.' . $ext;
                $filepath = 'upload/' . $filename;
                $file->move('upload/', $filename);
                $category->image = $filepath;
            }
            $category->save();
            // session()->flash('success', 'Subcategory added successfully.');
            // return redirect()->route('subCategorie.list');
            return redirect()->route('subCategorie.list')->with('success', 'Subcategory added successfully!');
        } catch (ValidationException $e) {
            return back()->withInput()->withErrors(['error' => 'Validation error. Please check your inputs and try again.']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'An error occurred while processing your request. Please try again.']);
        }
    }

    public function editSubCategorie($id): View
    {
        $cate = Category::where('name', '!=', '')->orderBy('id', 'DESC')->get();

        $SubCategory = SubCategory::findOrFail($id);
        return view('admin-pages/subcategorie/edit', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'cate' => $cate,
            'SubCategory' => $SubCategory,
            'layout' => 'side-menu'
        ]);
    }

    public function updateSubCategorie(SubCategoryRequest $request, $id)
    {
        try {
            $subcategory = SubCategory::findOrFail($id);
            $subcategory->categorieid = 1;
            $subcategory->name = $request->input('name');
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $ext = $file->getClientOriginalExtension();
                $filename = 'image-' . time() . '_' . generateString() . '.' . $ext;
                $filepath = 'upload/' . $filename;
                $file->move('upload/', $filename);
                $subcategory->image = $filepath;
            }
            $subcategory->save();

            // return redirect()->route('subCategorie.list');
            return redirect()->route('subCategorie.list')->with('success', 'Subcategory Update successfully!');
        } catch (ValidationException $e) {
            return back()->withInput()->withErrors(['error' => 'Validation error. Please check your inputs and try again.']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'An error occurred while processing your request. Please try again.']);
        }
    }

    public function subCategorieList(): View
    {
        $subcategories = SubCategory::orderBy('id', 'DESC')->get();

        return view('admin-pages/subcategorie/list', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'subcategories' => $subcategories,
            'layout' => 'side-menu'
        ]);
    }

    // gsts function

    public function addGst(): View
    {
        return view('admin-pages/gst/add', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'layout' => 'side-menu'
        ]);
    }

    public function saveGst(GstAndTextCategoryRequest $request)
    {
        $category = new GstAndTextCategory();
        $category->category_name = $request->input('category_name');
        $category->save();

        $gsts = GstAndTextCategory::orderBy('id', 'DESC')->pluck('id')->toArray();
        $firm = Firm::findOrFail(1);
        $firm->gst_text = implode(',', $gsts);
        $firm->save();

        return redirect()->route('gst.list');
    }

    public function editGst($id): View
    {
        $GstAndTextCategory = GstAndTextCategory::findOrFail($id);
        return view('admin-pages/gst/edit', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'GstAndTextCategory' => $GstAndTextCategory,
            'layout' => 'side-menu'
        ]);
    }
    
    public function updateGst(Request $request, $id)
    {
        $GstAndTextCategory = GstAndTextCategory::findOrFail($id);
        $GstAndTextCategory->category_name = $request->input('category_name');
        $GstAndTextCategory->save();

        return redirect()->route('gst.list');
    }

    public function gstList(): View
    {
        $gsts = GstAndTextCategory::orderBy('id', 'DESC')->get();

        return view('admin-pages/gst/list', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'gsts' => $gsts,
            'layout' => 'side-menu'
        ]);
    }

    // gsts function

    public function addFirm(): View
    {
        $gsts = GstAndTextCategory::where('category_name', '!=', '')->orderBy('id', 'DESC')->get();

        return view('admin-pages/firm/add', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'gsts' => $gsts,
            'layout' => 'side-menu'
        ]);
    }

    public function saveFirm(FirmRequest $request)
    {
        $category = new Firm();
        $category->name = $request->input('name');
        $category->gst_text = implode(',', $request->input('gst_text'));
        $category->save();
        return redirect()->route('firm.list');
    }

    public function editFirm($id): View
    {
        $firm = Firm::findOrFail($id);
        $gsts = GstAndTextCategory::where('category_name', '!=', '')->orderBy('id', 'DESC')->get();
        return view('admin-pages/firm/edit', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'firm' => $firm,
            'gsts' => $gsts,
            'layout' => 'side-menu'
        ]);
    }

    public function updateFirm(Request $request, $id)
    {
        $firm = Firm::findOrFail($id);
        $firm->name = $request->input('name');

        // Ensure $request->input('gst_text') is treated as an array
        $gstText = (array)$request->input('gst_text');
        $firm->gst_text = implode(',', $gstText);

        $firm->save();

        return redirect()->route('firm.list');
    }


    public function firmList(): View
    {
        $firms = Firm::orderBy('id', 'DESC')->get();
        $gsts = GstAndTextCategory::where('category_name', '!=', '')->orderBy('id', 'DESC')->get();

        return view('admin-pages/firm/list', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'gsts' => $gsts,
            'firms' => $firms,
            'layout' => 'side-menu'
        ]);
    }

    // product function

    public function getSubcategories(Request $request)
    {
        $category_id = $request->input('category_id');
        $subcategories = Subcategory::where('categorieid', $category_id)->orderBy('id', 'DESC')->get();

        return response()->json($subcategories);
    }

    public function GetFirm(Request $request)
    {
        $firm = Firm::findOrFail($request->categorieId);
        $ids = explode(',', $firm->gst_text);
        $records = GstAndTextCategory::whereIn('id', $ids)->pluck('category_name');
        $html_code = '';
        foreach ($records as $key => $value) {
            # code...
            $html_code .= '<div class="flex mt-2">
                            <input type="text" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" name="gst[][' . $value . ']" aria-label="' . $value . '"
                                aria-describedby="input-group-price" placeholder="' . $value . '"
                                required class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 [&amp;[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 rounded-none [&amp;:not(:first-child)]:border-l-transparent first:rounded-l last:rounded-r z-10" />
                            <div id="input-group-price"
                                class="py-2 px-3 bg-slate-100 border shadow-sm border-slate-200 text-slate-600 dark:bg-darkmode-900/20 dark:border-darkmode-900/20 dark:text-slate-400 rounded-none [&amp;:not(:first-child)]:border-l-transparent first:rounded-l last:rounded-r">
                                ' . $value . '
                            </div>
                          </div>
                          <label  class="is-invalid"></label>';
        }

        return response()->json($html_code);
    }

    public function addNewProduct(): View
    {

        // $generator = new BarcodeGeneratorPNG();
        // file_put_contents(public_path('barcode.png'), $generator->getBarcode('081231723897', $generator::TYPE_CODE_128, 3, 50, $redColor));
        $SubCategory = SubCategory::where('name', '!=', '')->orderBy('id', 'DESC')->get();

        $firm = Firm::where('gst_text', '!=', '')->orderBy('id', 'DESC')->get();
        $Category = Category::where('name', '!=', '')->orderBy('id', 'DESC')->get();
        $gstList = GstAndTextCategory::pluck('category_name');

        return view('admin-pages/product/add', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'firm' => $firm,
            'Category' => $Category,
            'gstList' => $gstList,
            'SubCategory' => $SubCategory,
            'layout' => 'side-menu'
        ]);
    }

    public function saveNewProduct(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'product_name' => 'required|string|max:255|unique:products,product_name',
                // 'description' => 'required|string|max:455',
                'firm_id' => 'required|string|max:455',
                // "meta_title" =>  'required|string|max:255',
                // "meta_description" => 'required|string|max:455',
                // "category" => 'required|string|max:255',
                "sub_category" => 'required|string|max:255',
                "per_kg_price" => 'required|string|max:255',
                "volume" => 'required|string|max:255',

                "barcode_number" => 'required|string|max:255',
                // "firm_id" => 'required|string|max:255',
                "mrp" => 'required|string|max:255',
                // "inventory" => 'required|string|max:255',
                "hsn_cod" => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
                'gst' => 'required',
            ]);


            // $this->validate($request, $validator);

            if ($validator->fails()) {
                $response = [
                    'success' => false,
                    'message' => $validator->errors(),
                ];
                return back()->withInput()->withErrors(['error' => 'Validation error. Please check your inputs and try again.']);
            }

            // $this->validate($request, $validator);

            $data = new Product();
            $data->product_name = $request->product_name;
            $data->description = $request->description;
            $data->meta_title = $request->meta_title;
            $data->volume = $request->volume;
            $data->meta_description = $request->meta_description;
            $data->category = 1;
            $data->sub_category = $request->sub_category;
            $data->per_kg_price = $request->per_kg_price;
            $data->per_gram_price =  $request->per_kg_price / 1000;
            $data->barcodenumber = $request->barcode_number;
            $data->firm_id = $request->firm_id;
            $data->mrp = $request->mrp;
            $data->hsn_cod = $request->hsn_cod;
            $data->discount = $request->discount ?? 0;
            $data->barcode_img = $request->barcode_number . '.png';
            $data->gst = json_encode($request->gst);
            $data->lush = $request->lush ? 1 : 0;
            $data->popular = $request->popular ? 1 : 0;
            $data->decimal = $request->decimal ? 1 : 0;
            $data->web = $request->web ? 1 : 0;
            
            $data->price_1 = $request->price_1 ?? 0;
            $data->price_2 = $request->price_2 ?? 0;
            $data->price_3 = $request->price_3 ?? 0;
            $data->price_4 = $request->price_4 ?? 0;
            $data->kg_1 = $request->kg_1 ?? 0;
            $data->kg_2 = $request->kg_2 ?? 0;
            $data->kg_3 = $request->kg_3 ?? 0;
            $data->kg_4 = $request->kg_4 ?? 0;
            $data->status = '1';

            $gst = '';
            foreach ($request->gst as $list) {
                try {
                    $gst = (float)$gst + (float)reset($list);
                } catch (\Throwable $th) {
                }
            }
            $text_prize = round((float)$data->per_kg_price / (($gst / 100) + 1), 3);
            $data->text_prize =  $text_prize;

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                // foreach ($request->file('image') as $file) {
                $ext = $file->getClientOriginalExtension();
                $filename = 'image-' . time() . '_' . generateString() . '.' . $ext;
                $filepath = 'upload/' . $filename;
                $file->move('upload/', $filename);
                $data->image = $filepath;
                // }
            }

            $Color = [0, 0, 0];
            $generator = new BarcodeGeneratorPNG();
            file_put_contents(public_path($request->barcode_number . '.png'), $generator->getBarcode($request->barcode_number, $generator::TYPE_CODE_128, 3, 50, $Color));

            $data->save();

            $Inventory = new Inventory();
            $Inventory->product_id = $data->id;
            // $Inventory->inventorie = $request->inventory;
            $Inventory->save();

            if ($request->add_ingredient == 0) {
                return redirect()->route('products.list')->with('success', 'Product added successfully!');
            }

            return redirect()->route('productEditIngredient', $data->id);
            // return redirect()->route('productEditIngredient', $data->id)->with('success', 'Product added successfully!');
        } catch (ValidationException $e) {
            // dd($e);
            return back()->withInput()->withErrors(['error' => 'Validation error. Please check your inputs and try again.']);
        } catch (\Exception $e) {
            // dd($e);
            return back()->withInput()->withErrors(['error' => 'An error occurred while processing your request. Please try again.']);
        }
    }


    public function editProduct($id): View
    {
        $Product = Product::findOrFail($id);
        $gsts = GstAndTextCategory::where('category_name', '!=', '')->orderBy('id', 'DESC')->get();
        $firm = Firm::where('gst_text', '!=', '')->orderBy('id', 'DESC')->get();
        $Category = Category::where('name', '!=', '')->orderBy('id', 'DESC')->get();
        $SubCategory = SubCategory::where('name', '!=', '')->orderBy('id', 'DESC')->get();
        return view('admin-pages/product/edit', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'Product' => $Product,
            'firm' => $firm,
            'Category' => $Category,
            'gsts' => $gsts,
            'layout' => 'side-menu',
            'SubCategory' => $SubCategory,
        ]);
    }

    public function updateProduct(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'product_name' => 'required|string|max:255|unique:products,product_name, . $id',
                // 'description' => 'required|string|max:455',
                'firm_id' => 'required|string|max:455',
                // "meta_title" =>  'required|string|max:255',
                "volume" =>  'required|string|max:255',
                // "meta_description" => 'required|string|max:455',
                // "category" => 'required|string|max:255',
                "sub_category" => 'required|string|max:255',
                "per_kg_price" => 'required|string|max:255',
                "barcode_number" => 'required|string|max:255',
                // "firm_id" => 'required|string|max:255',
                "mrp" => 'required|string|max:255',
                "hsn_cod" => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
                'gst' => 'required',

            ]);

            $Product = Product::findOrFail($id);
            $Product->product_name = $request->product_name;
            $Product->description = $request->description;
            $Product->meta_title = $request->meta_title;
            $Product->volume = $request->volume;
            $Product->meta_description = $request->meta_description;
            $Product->category = 1;
            $Product->sub_category = $request->sub_category;
            $Product->per_kg_price = $request->per_kg_price;
            $Product->per_gram_price =  $request->per_kg_price / 1000;
            $Product->barcodenumber = $request->barcode_number;
            $Product->firm_id = $request->firm_id;

            $Product->mrp = $request->mrp;
            $Product->hsn_cod = $request->hsn_cod;

            $Product->discount = $request->discount ?? 0;
            $Product->barcode_img = $request->barcode_number . '.png';
            $Product->gst = json_encode($request->gst);
            $Product->lush = $request->lush ? 1 : 0;
            $Product->popular = $request->popular ? 1 : 0;
            $Product->decimal = $request->decimal ? 1 : 0;
            $Product->web = $request->web ? 1 : 0;

            $Product->price_1 = $request->price_1 ?? 0;
            $Product->price_2 = $request->price_2 ?? 0;
            $Product->price_3 = $request->price_3 ?? 0;
            $Product->price_4 = $request->price_4 ?? 0;
            $Product->kg_1 = $request->kg_1 ?? 0;
            $Product->kg_2 = $request->kg_2 ?? 0;
            $Product->kg_3 = $request->kg_3 ?? 0;
            $Product->kg_4 = $request->kg_4 ?? 0;
            $Product->image = $Product->image;

            $gst = '';
            foreach ($request->gst as $list) {
                try {
                    $gst = (float)$gst + (float)reset($list);
                } catch (\Throwable $th) {
                }
            }
            $text_prize = round((float)$Product->per_kg_price / (($gst / 100) + 1), 3);
            $Product->text_prize =  $text_prize;

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                // foreach ($request->file('image') as $file) {
                $ext = $file->getClientOriginalExtension();
                $filename = 'image-' . time() . '_' . generateString() . '.' . $ext;
                $filepath = 'upload/' . $filename;
                $file->move('upload/', $filename);
                $Product->image = $filepath;
                // }
            }
            if ($Product->barcodenumber != $request->barcode_number) {
                $Color = [0, 0, 0];
                $generator = new BarcodeGeneratorPNG();
                file_put_contents(public_path($request->barcode_number . '.png'), $generator->getBarcode($request->barcode_number, $generator::TYPE_CODE_128, 3, 50, $Color));
            }
            $Product->save();

            if ($request->add_ingredient == 0) {
                return redirect()->route('products.list')->with('success', 'Product Updated successfully!');;
            }
            return redirect()->route('productEditIngredient', $Product->id)->with('Product Updated successfully');
        } catch (ValidationException $e) {

            return back()->withInput()->withErrors(['error' => 'Validation error. Please check your inputs and try again.']);
        } catch (\Exception $e) {
            dd( $e);
            return back()->withInput()->withErrors(['error' => 'An error occurred while processing your request. Please try again.']);
        }
    }



    public function productsList(): View
    {
        $firms = Product::orderBy('product_name', 'ASC')->get();
        $gsts = GstAndTextCategory::where('category_name', '!=', '')->orderBy('id', 'DESC')->get();

        return view('admin-pages/product/list', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'gsts' => $gsts,
            'firms' => $firms,
            'layout' => 'side-menu'
        ]);
    }


    public function productsInventory(): View
    {
        $firms = Product::orderBy('product_name', 'ASC')->get();
        $gsts = GstAndTextCategory::where('category_name', '!=', '')->orderBy('id', 'DESC')->get();

        return view('admin-pages/inventory/inventory-list', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'gsts' => $gsts,
            'firms' => $firms,
            'layout' => 'side-menu'
        ]);
    }

    public function addProductsInventory(): View
    {
        $Product = productIngredient::select('product_ingredien.*', 'products.product_name as product_name')
            ->leftJoin('products', 'product_ingredien.product_id', '=', 'products.id')
            ->orderBy('product_ingredien.id', 'DESC')
            ->get()
            ->groupBy('product_id');
        // $Product = Product::orderBy('id', 'DESC')->get();
        return view('admin-pages/product/add-inventorie', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'Product' => $Product,
            'layout' => 'side-menu'
        ]);
    }
    public function saveProductsInventory(Request $request)
    {
        $Inventory = Inventory::where('product_id', $request->product_id)->first();
        if ($Inventory == null) {
            $Inventory = new Inventory();
            $Inventory->product_id = $request->product_id;
            $Inventory->inventorie = $request->inventorie;
            $Inventory->save();
            $Product = Product::where('id', $request->product_id)->first();
            foreach ($Product->getProductIngredient as $ProductIngredient) {
                $Ingredients = Inventory::where('product_id', $ProductIngredient->ingredient_id)->first();
                if ($Ingredients == null) {
                    $Ingredients = new Inventory();
                    $Ingredients->product_id = $ProductIngredient->ingredient_id;
                }
                $Ingredients->inventorie = $Ingredients->inventorie - ($ProductIngredient->qty * $request->inventory);
                $Ingredients->save();
                // dd($Ingredients,$Ingredients->inventorie - ($ProductIngredient->qty * $request->inventorie));
            }
            return redirect()->route('inventory.list');
        }
        $Inventory->product_id = $request->product_id;
        $Inventory->inventorie = $Inventory->inventorie + $request->inventorie;
        $Inventory->save();
        $Product = Product::where('id', $request->product_id)->first();
        foreach ($Product->getProductIngredient as $ProductIngredient) {
            $Ingredients = Inventory::where('product_id', $ProductIngredient->ingredient_id)->first();
            if ($Ingredients == null) {
                $Ingredients = new Inventory();
                $Ingredients->product_id = $ProductIngredient->ingredient_id;
            }
            $Ingredients->inventorie = $Ingredients->inventorie - ($ProductIngredient->qty * (int)$request->inventory);
            $Ingredients->save();
        }
        $manufacturing = new manufacturing();
        // $manufacturing->conversion_id = $conversion->id;
        $manufacturing->product_one_id = $Product->id;
        // $manufacturing->product_two_id = $conversion->product_two_id;
        $manufacturing->qty = (int)$request->inventory;
        $manufacturing->type = 1;
        $manufacturing->save();
        return redirect()->route('inventory.list');
    }
    public function status($id)
    {
        $Product = Product::findOrFail($id);

        $Product->status = $Product->status;
        if ($Product->status == '0') {
            $Product->status = '1';
        } elseif ($Product->status == '1') {
            $Product->status = '0';
        }
        $Product->save();
        return redirect()->route('products.list');
    }


    public function populer_status($id)
    {
        $Product = SubCategory::findOrFail($id);

        $Product->popular = $Product->popular;
        if ($Product->popular == '0') {
            $Product->popular = '1';
        } elseif ($Product->popular == '1') {
            $Product->popular = '0';
        }
        $Product->save();
        return redirect()->route('subCategorie.list');
    }

    public function perchImport(Request $request)
    {
        $file = $request->file('file');
        $fileContents = file($file->getPathname());

        foreach ($fileContents as $key => $line) {
            $data = str_getcsv($line);
            if ($key != 0 && $data[0] != '') {
                $Product = new Product();
                // Product::create([
                $Product->product_name = $data[0];
                $Product->sub_category = $data[1];
                $Product->per_kg_price = $data[2];
                $Product->mrp = $data[3];
                $Product->volume = $data[4];
                $Product->popular = $data[5];
                $Product->lush = $data[6];
                $Product->decimal = $data[7];
                $Product->barcodenumber = (int)$data[8];
                $Product->hsn_cod = $data[9];
                $Product->gst = $data[10];

                $Product->barcode_img = (int)$data[8] . '.png';

                // $Color = [0, 0, 0];
                // $generator = new BarcodeGeneratorPNG();
                // file_put_contents(public_path((int)$Product->barcode_number . '.png'), $generator->getBarcode((int)$Product->barcode_number, $generator::TYPE_CODE_128, 3, 50, $Color));

                $Product->firm_id = 1;
                $Product->per_gram_price = (int)$data[2] / 1000;
                $Product->category = 1;

                // $Product->gst = '[{"GST":"0"},{"CESS":"0"}]';

                $gst = '';
                $gstList = json_decode($Product->gst);
                foreach ($gstList as $list) {
                    try {
                        $gst = (float)$gst + (float)reset($list);
                    } catch (\Throwable $th) {
                    }
                }
                if ($gst != 0) {
                    $text_prize = round((float)$Product->per_kg_price / (($gst / 100) + 1), 3);
                    $Product->text_prize =  $text_prize;
                } else {
                    $Product->text_prize =  0;
                } 

                // $Product->text_prize = 0;

                $Product->status = 1;

                $Product->save();

                $Inventory = new Inventory();
                $Inventory->product_id = $Product->id;
                $Inventory->inventorie = 0;
                $Inventory->save();


                // Add more fields as needed
                // ]);
            }
        }

        return redirect()->back()->with('success', 'CSV file imported successfully.');
    }


    /**
     * Show specified view.
     *
     */
    public function dashboardOverview1(): View
    {
        $appOrders = AppOrder::where('type',0)->get();
        $appOrder = $appOrders->count();
        $Ecom_Orders = AppOrder::where('type',1)->get();
        $Ecom_Order = $Ecom_Orders->count();
        $Admin_Bulk_Orders = AppOrder::where('type',2)->get();
        $Admin_Bulk_Order = $Admin_Bulk_Orders->count();
        $Products = Product::get();
        $Product = $Products->count();
        
        return view('pages/dashboard-overview-1', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'appOrder' => $appOrder,
            'Ecom_Order' => $Ecom_Order,
            'Admin_Bulk_Order' => $Admin_Bulk_Order,
            'Product' => $Product,
            // 'layout' => 'side-menu'
        ]);
    }

    /**
     * Show specified view.
     *
     */
    public function dashboardOverview2(): View
    {
        return view('pages/dashboard-overview-2');
    }

    /**
     * Show specified view.
     *
     */
    public function dashboardOverview3(): View
    {
        return view('pages/dashboard-overview-3');
    }

    /**
     * Show specified view.
     *
     */
    public function dashboardOverview4(): View
    {
        return view('pages/dashboard-overview-4');
    }

    /**
     * Show specified view.
     *
     */
    public function inbox(): View
    {
        return view('pages/inbox');
    }

    /**
     * Show specified view.
     *
     */
    public function categories(): View
    {
        return view('pages/categories');
    }

    /**
     * Show specified view.
     *
     */
    public function addProduct(): View
    {
        return view('pages/add-product');
    }

    /**
     * Show specified view.
     *
     */
    public function productList(): View
    {
        return view('pages/product-list');
    }

    /**
     * Show specified view.
     *
     */
    public function productGrid(): View
    {
        return view('pages/product-grid');
    }

    /**
     * Show specified view.
     *
     */
    public function transactionList(): View
    {
        return view('pages/transaction-list');
    }

    /**
     * Show specified view.
     *
     */
    public function transactionDetail(): View
    {
        return view('pages/transaction-detail');
    }

    /**
     * Show specified view.
     *
     */
    public function sellerList(): View
    {
        return view('pages/seller-list');
    }

    /**
     * Show specified view.
     *
     */
    public function sellerDetail(): View
    {
        return view('pages/seller-detail');
    }

    /**
     * Show specified view.
     *
     */
    public function reviews(): View
    {
        return view('pages/reviews');
    }

    /**
     * Show specified view.
     *
     */
    public function fileManager(): View
    {
        return view('pages/file-manager');
    }

    /**
     * Show specified view.
     *
     */
    public function pointOfSale(): View
    {
        return view('pages/point-of-sale');
    }

    /**
     * Show specified view.
     *
     */
    public function chat(): View
    {
        return view('pages/chat');
    }

    /**
     * Show specified view.
     *
     */
    public function post(): View
    {
        return view('pages/post');
    }

    /**
     * Show specified view.
     *
     */
    public function calendar(): View
    {
        return view('pages/calendar');
    }

    /**
     * Show specified view.
     *
     */
    public function crudDataList(): View
    {
        return view('pages/crud-data-list');
    }

    /**
     * Show specified view.
     *
     */
    public function crudForm(): View
    {
        return view('pages/crud-form');
    }

    /**
     * Show specified view.
     *
     */
    public function usersLayout1(): View
    {
        return view('pages/users-layout-1');
    }

    /**
     * Show specified view.
     *
     */
    public function usersLayout2(): View
    {
        return view('pages/users-layout-2');
    }

    /**
     * Show specified view.
     *
     */
    public function usersLayout3(): View
    {
        return view('pages/users-layout-3');
    }

    /**
     * Show specified view.
     *
     */
    public function profileOverview1(): View
    {
        return view('pages/profile-overview-1');
    }

    /**
     * Show specified view.
     *
     */
    public function profileOverview2(): View
    {
        return view('pages/profile-overview-2');
    }

    /**
     * Show specified view.
     *
     */
    public function profileOverview3(): View
    {
        return view('pages/profile-overview-3');
    }

    /**
     * Show specified view.
     *
     */
    public function wizardLayout1(): View
    {
        return view('pages/wizard-layout-1');
    }

    /**
     * Show specified view.
     *
     */
    public function wizardLayout2(): View
    {
        return view('pages/wizard-layout-2');
    }

    /**
     * Show specified view.
     *
     */
    public function wizardLayout3(): View
    {
        return view('pages/wizard-layout-3');
    }

    /**
     * Show specified view.
     *
     */
    public function blogLayout1(): View
    {
        return view('pages/blog-layout-1');
    }

    /**
     * Show specified view.
     *
     */
    public function blogLayout2(): View
    {
        return view('pages/blog-layout-2');
    }

    /**
     * Show specified view.
     *
     */
    public function blogLayout3(): View
    {
        return view('pages/blog-layout-3');
    }

    /**
     * Show specified view.
     *
     */
    public function pricingLayout1(): View
    {
        return view('pages/pricing-layout-1');
    }

    /**
     * Show specified view.
     *
     */
    public function pricingLayout2(): View
    {
        return view('pages/pricing-layout-2');
    }

    /**
     * Show specified view.
     *
     */
    public function invoiceLayout1(): View
    {
        return view('pages/invoice-layout-1');
    }

    /**
     * Show specified view.
     *
     */
    public function invoiceLayout2(): View
    {
        return view('pages/invoice-layout-2');
    }

    /**
     * Show specified view.
     *
     */
    public function faqLayout1(): View
    {
        return view('pages/faq-layout-1');
    }

    /**
     * Show specified view.
     *
     */
    public function faqLayout2(): View
    {
        return view('pages/faq-layout-2');
    }

    /**
     * Show specified view.
     *
     */
    public function faqLayout3(): View
    {
        return view('pages/faq-layout-3');
    }

    /**
     * Show specified view.
     *
     */
    public function login(): View
    {
        return view('pages/login');
    }

    /**
     * Show specified view.
     *
     */
    public function register(): View
    {
        return view('pages/register');
    }

    /**
     * Show specified view.
     *
     */
    public function errorPage(): View
    {
        return view('pages/error-page');
    }

    /**
     * Show specified view.
     *
     */
    public function updateProfile(): View
    {
        return view('pages/update-profile');
    }

    /**
     * Show specified view.
     *
     */
    public function changePassword(): View
    {
        return view('pages/change-password');
    }

    /**
     * Show specified view.
     *
     */
    public function regularTable(): View
    {
        return view('pages/regular-table');
    }

    /**
     * Show specified view.
     *
     */
    public function tabulator(): View
    {
        return view('pages/tabulator');
    }

    /**
     * Show specified view.
     *
     */
    public function modal(): View
    {
        return view('pages/modal');
    }

    /**
     * Show specified view.
     *
     */
    public function slideOver(): View
    {
        return view('pages/slide-over');
    }

    /**
     * Show specified view.
     *
     */
    public function notification(): View
    {
        return view('pages/notification');
    }

    /**
     * Show specified view.
     *
     */
    public function tab(): View
    {
        return view('pages/tab');
    }

    /**
     * Show specified view.
     *
     */
    public function accordion(): View
    {
        return view('pages/accordion');
    }

    /**
     * Show specified view.
     *
     */
    public function button(): View
    {
        return view('pages/button');
    }

    /**
     * Show specified view.
     *
     */
    public function alert(): View
    {
        return view('pages/alert');
    }

    /**
     * Show specified view.
     *
     */
    public function progressBar(): View
    {
        return view('pages/progress-bar');
    }

    /**
     * Show specified view.
     *
     */
    public function tooltip(): View
    {
        return view('pages/tooltip');
    }

    /**
     * Show specified view.
     *
     */
    public function dropdown(): View
    {
        return view('pages/dropdown');
    }

    /**
     * Show specified view.
     *
     */
    public function typography(): View
    {
        return view('pages/typography');
    }

    /**
     * Show specified view.
     *
     */
    public function icon(): View
    {
        return view('pages/icon');
    }

    /**
     * Show specified view.
     *
     */
    public function loadingIcon(): View
    {
        return view('pages/loading-icon');
    }

    /**
     * Show specified view.
     *
     */
    public function regularForm(): View
    {
        return view('pages/regular-form');
    }

    /**
     * Show specified view.
     *
     */
    public function datepicker(): View
    {
        return view('pages/datepicker');
    }

    /**
     * Show specified view.
     *
     */
    public function tomSelect(): View
    {
        return view('pages/tom-select');
    }

    /**
     * Show specified view.
     *
     */
    public function fileUpload(): View
    {
        return view('pages/file-upload');
    }

    /**
     * Show specified view.
     *
     */
    public function wysiwygEditorClassic(): View
    {
        return view('pages/wysiwyg-editor-classic');
    }

    /**
     * Show specified view.
     *
     */
    public function wysiwygEditorInline(): View
    {
        return view('pages/wysiwyg-editor-inline');
    }

    /**
     * Show specified view.
     *
     */
    public function wysiwygEditorBalloon(): View
    {
        return view('pages/wysiwyg-editor-balloon');
    }

    /**
     * Show specified view.
     *
     */
    public function wysiwygEditorBalloonBlock(): View
    {
        return view('pages/wysiwyg-editor-balloon-block');
    }

    /**
     * Show specified view.
     *
     */
    public function wysiwygEditorDocument(): View
    {
        return view('pages/wysiwyg-editor-document');
    }

    /**
     * Show specified view.
     *
     */
    public function validation(): View
    {
        return view('pages/validation');
    }

    /**
     * Show specified view.
     *
     */
    public function chart(): View
    {
        return view('pages/chart');
    }

    /**
     * Show specified view.
     *
     */
    public function slider(): View
    {
        return view('pages/slider');
    }

    /**
     * Show specified view.
     *
     */
    public function imageZoom(): View
    {
        return view('pages/image-zoom');
    }
}
