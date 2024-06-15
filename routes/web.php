<?php

use App\Http\Controllers\AdminCustomerController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AppOrdersController;
use App\Http\Controllers\BankDetailsController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\ConversionController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\DeliveryController;
use App\Http\Controllers\Frontend\FaqController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\ProfileAddressController;
use App\Http\Controllers\Frontend\WebOrderController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\LedgerController;
use App\Http\Controllers\PerchOrdersController;
use App\Http\Controllers\ProductReturnController;
use App\Http\Controllers\ProfiteAndLossController;
use App\Http\Controllers\RatingProductController;
use App\Http\Controllers\RetrunPerchOrdersController;
use App\Http\Controllers\ReturnOrderController;
use App\Http\Controllers\StockInHandController;
use App\Http\Controllers\WebController;
use App\Models\BankDetails;
use App\Models\RatingProduct;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DarkModeController;
use App\Http\Controllers\ColorSchemeController;
use App\Http\Controllers\Frontend\AddressController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\PolicyController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\inventoryController;
use App\Http\Controllers\manufacturingController;
use App\Http\Controllers\PerchPartyController;
use App\Http\Controllers\RazorpayController;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('migrate', function () {
    // Artisan::call('migrate:refresh --seed');
    Artisan::call('migrate');
    // Artisan::call('db:seed');
    dd('Teble Migrated');
});

route::get('auth/google', [GoogleController::class, 'googlepage'])->name('auth.google.view');
route::get('auth/google/callback', [GoogleController::class, 'handleGmailCallback'])->name('handleGmailCallback');

Route::get('migrate-step-2', function () {
    Artisan::call('migrate:rollback --step=5');
    dd('Tables Migrated step-2');
});

Route::get('cache-clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('optimize:clear');
});

Route::get('/create-order', [RazorpayController::class, 'createOrder']);
Route::post('/payment', [RazorpayController::class, 'payment']);

Route::group(['prefix' => 'wab'], function () {


    Route::controller(\App\Http\Controllers\Frontend\AuthController::class)->group(function () {

        Route::post('/signup', 'registerUser')->name('registerUser');
        Route::post('/login', 'loginUser')->name('loginUser');
        Route::get('/logout', 'logout')->name('logout');
        Route::get('/google/login',  'loginWithGoogle')->name('login.google');
        Route::get('/google/callback', 'callbackFromGoogle')->name('callback.google');

        // Route::post('/signup', 'registerUser')->name('registerUser');
        // Route::post('/login', 'loginUser')->name('loginUser');
        // Route::get('/logout', 'logout')->name('logout');
    });

    Route::controller(PolicyController::class)->group(function () {
        Route::get('/privacy-policy', 'privacyPolicyView')->name('privacyPolicy.view');
    });

    Route::group(['middleware' => ['auth', 'check.user.type']], function () {

        Route::controller(ProfileController::class)->group(function () {
            Route::get('/profile', 'profileView')->name('profile.view');
            Route::post('/profile/update', 'profileUpdate')->name('profile.Update');
        });

        
        Route::controller(WebOrderController::class)->group(function () {
            Route::get('/order', 'orderView')->name('order.view');
            Route::post('/add/to/cart', 'add_to_cart')->name('add_to_cart');
            Route::get('/update_Qty', 'update_Qty')->name('update_Qty');
            Route::post('/delete/cart/{cart_id}/{product_id}', 'delete_cart')->name('delete_cart');
            Route::post('/confirm/order', 'confirm_order')->name('confirm_order');
        });
        Route::controller(RatingProductController::class)->group(function () {
            Route::post('/save/rating', 'saveRating')->name('saveRating');
        });

        Route::controller(AddressController::class)->group(function () {
            Route::get('/address/{type}', 'addressView')->name('address.view');
            Route::post('/address/save', 'saveOrderAddressDetails')->name('saveOrderAddressDetails');
        });

        Route::controller(PaymentController::class)->group(function () {
            Route::get('/payment', 'paymentView')->name('payment.view');
        });

        Route::controller(DeliveryController::class)->group(function () {
            Route::get('/delivery', 'deliveryView')->name('delivery.view');
            Route::post('/check-delivery-availability', 'checkAvailability');
        });



        
        Route::controller(ProfileAddressController::class)->group(function () {
            Route::get('/profile/address/{type}', 'profileaddressView')->name('profile_address.view');
            Route::post('/save/profile/address', 'saveProfileaddress')->name('saveProfileaddress');
            Route::post('/delete/profile/address/{id}', 'delete_profile_address')->name('delete_profile_address');
            Route::get('/fetch-address/{id}', 'fetchAddressData')->name('fetch_address_data');
            Route::get('/edit/profile/address/{id}', 'edit_profile_address')->name('edit_profile_address');
            Route::post('/update/profile/address/{id}', 'update_profile_address')->name('update_profile_address');
        });
    });
    // Route::group(['middleware' => ['check.user.type']], function () {
    //Frontend routes
    Route::controller(IndexController::class)->group(function () {
        Route::get('/', 'indexView')->name('index.view');
        Route::post('/footer/mail/save', 'footer_mail_save')->name('footer_mail_save');
    });

    Route::controller(AboutController::class)->group(function () {
        Route::get('/about', 'aboutView')->name('about.view');
    });
    Route::controller(ContactController::class)->group(function () {
        Route::get('/contact', 'contactView')->name('contact.view');
        Route::post('/contact/save', 'saveContectus')->name('saveContectus');
    });


    Route::controller(ProductController::class)->group(function () {
        Route::get('/product', 'productView')->name('product.view');
    });


    Route::controller(BlogController::class)->group(function () {
        Route::get('/blog/details/{id}', 'blogDetailsView')->name('blog-details.view');
        Route::get('/blog', 'blogView')->name('blog.view');
        Route::post('/blog/leave/replay/mail', 'blogLeavereplayMailSending')->name('blogLeavereplayMailSending');
    });

    Route::controller(FaqController::class)->group(function () {
        Route::get('/faq', 'faqView')->name('faq.view');
    });
    // });
});

// Route::group(['prefix' => 'admin'], function () {
Route::get('dark-mode-switcher', [DarkModeController::class, 'switch'])->name('dark-mode-switcher');
Route::get('color-scheme-switcher/{color_scheme}', [ColorSchemeController::class, 'switch'])->name('color-scheme-switcher');

Route::controller(AuthController::class)->middleware('loggedin')->group(function () {
    Route::get('login', 'loginView')->name('login.index');
    Route::post('login', 'login')->name('login.check');
});

Route::middleware('auth', 'check.admin.type')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::controller(AppOrdersController::class)->group(function () {

        Route::get('app/list/order', 'appOrderList')->name('app.order.list');
        Route::get('app/print/order/{o_id}', 'printOrderReceipt')->name('app.print.order.web');
    });

    Route::controller(AdminCustomerController::class)->group(function () {
        Route::get('addCustomerData', 'addCustomerData')->name('admin.addcustomer');
        Route::post('saveCustomerData', 'saveCustomerData')->name('admin.saveCustomerData');

        Route::get('customerList', 'customerList')->name('admin.customerList');
        
        Route::get('user-list', 'userList')->name('admin.User.List');

        Route::get('customer/{id}', 'customer')->name('admin.customer');
        Route::get('updatecustomer/{id}', 'updatecustomer')->name('admin.updatecustomer');
        Route::post('updateCustomerData/{id}', 'updateCustomerData')->name('admin.updateCustomerData');
    });


    Route::controller(PerchPartyController::class)->group(function () {
        Route::get('add/perch-party', 'addPerchParty')->name('admin.add.perchparty');
        Route::post('save/perch-party', 'savePerchParty')->name('admin.save.perchparty');
        Route::get('perch-party-list', 'PerchPartyList')->name('admin.perchparty.list');
        Route::get('edit/perch-party/{id}', 'editPerchParty')->name('admin.edit.perchparty');
        Route::post('update/perch-party/{id}', 'updatePerchParty')->name('admin.update.perchparty');
        Route::get('/entry/reports/{id}', 'showEntry')->name('admin.show.entry');
    });

    Route::controller(AdminOrderController::class)->group(function () {
        Route::get('admin/order/list', 'adminOrderList')->name('amin.order.list');

        Route::post('save/new/admin/order', 'saveAdminOrder')->name('save.new.amin.order');
        Route::get('new/admin/order', 'newAdminOrder')->name('new.amin.order');

        Route::get('update/admin/order/status/{id}', 'updateStatusAdminOrder')->name('update.status.amin.order');

        Route::get('edit/new/admin/order/{id}', 'editAdminOrder')->name('edit.new.amin.order');
        Route::post('update/admin/order/{id}', 'updateAdminOrder')->name('update.amin.order');

        Route::get('fetchproduct/{id}', 'fetchProduct')->name('fetchproduct');

        Route::get('download/invoice/{id}', 'generateInvoicePDF')->name('downloadInvoice');
        Route::get('/invoices/download/{filename}', [AdminOrderController::class, 'downloadInvoice'])->name('download.invoice');
        Route::get('returnAdminOrder/{id}', 'returnAdminOrder')->name('returnAdminOrder');
        Route::post('orderReturnSubmit', 'orderReturnSubmit')->name('orderReturnSubmit');
        Route::get('whatsapp-message/{order}', 'sendWhatsAppMessage')->name('sendWhatsAppMessage');
    });

    Route::controller(PerchOrdersController::class)->group(function () {
        Route::get('perch/order/list', 'perchOrderList')->name('perch.order.list');

        Route::get('new/perch/order', 'newOrder')->name('perch.order');
        Route::post('save/new/perch/order', 'saveOrder')->name('save.perch.order');

        Route::get('update/perch/order/status/{id}', 'updateStatus')->name('update.status.perch.order');

        Route::get('edit/new/perch/order/{id}', 'editOrder')->name('edit.perch.order');
        Route::get('editIngredientOrder/{id}', 'editIngredientOrder')->name('editIngredientOrder');

        Route::post('newIngredientOrder', 'newIngredientOrder')->name('newIngredientOrder');
        Route::post('saveIngredientOrder', 'saveIngredientOrder')->name('saveIngredientOrder');

        Route::post('update/perch/order/{id}', 'updateOrder')->name('update.perch.order');
        Route::post('updateIngredientOrder/{id}', 'updateIngredientOrder')->name('updateIngredientOrder');

        Route::get('party/fetchproduct/{id}', 'fetchProduct')->name('party.fetchproduct');
        Route::get('download/party/invoice/{id}', 'generateInvoicePDF')->name('party.downloadInvoice');

        Route::get('returnPerchOrder/{id}', 'returnPerchOrder')->name('returnPerchOrder');

        Route::get('/fetchForPerchReturnOrder/{id}', 'fetchForPerchReturnOrder')->name('fetchForPerchReturnOrder');
        Route::post('perchOrderReturnSubmit', 'perchOrderReturnSubmit')->name('perchOrderReturnSubmit');
    });
    Route::controller(ConversionController::class)->group(function () {
        Route::get('/conversionList', 'conversionList')->name('conversionList.list');
        Route::get('/add/conversion', 'addConversion')->name('add.conversion');
        Route::post('/save/conversion', 'saveConversion')->name('save.conversion');
        Route::get('/edit/editConversion/{id}', 'editConversion')->name('edit.conversion');
        Route::post('/update/conversion/{id}', 'updateConversion')->name('update.conversion');
    });
    Route::controller(manufacturingController::class)->group(function () {
        Route::get('/manufacturingList', 'manufacturingList')->name('manufacturingList.list');
        Route::get('/automationhistoryList', 'automationHistoryList')->name('automationhistoryList.list');

        Route::get('/addManufacturing', 'addManufacturing')->name('add.addManufacturing');
        Route::POST('/savemanufacturing', 'savemanufacturing')->name('savemanufacturing');
    });

    Route::controller(IngredientController::class)->group(function () {
        Route::get('/many-to-one', 'ManyToOneList')->name('ManyToOneList');
        Route::get('add/many-to-one/product', 'productAddIngredient')->name('productAddIngredient');
        Route::get('/productEditIngredient/{id}', 'productEditIngredient')->name('productEditIngredient');
    });
    Route::controller(inventoryController::class)->group(function () {
        Route::get('/addOpeningStock', 'addOpeningStock')->name('addOpeningStock');
        Route::post('/saveOpeingStockData', 'saveOpeingStockData')->name('saveOpeingStockData');
    });



    //product-return 
    Route::controller(ProductReturnController::class)->group(function () {
        Route::get('/return-product', 'returnProductView')->name('returnProductView');
        Route::get('/return-product-add/{id}', 'returnProductAdd')->name('returnProductAdd');
        Route::get('/fetchProductForReturnOrder/{id}', 'fetchProductForReturnOrder')->name('fetchProductForReturnOrder');
        Route::post('/ProdcutReturnSubmit', 'ProdcutReturnSubmit')->name('save.ProdcutReturnSubmit');
    });


    // Order Return
    Route::controller(ReturnOrderController::class)->group(function () {
        Route::get('/return-Order', 'returnOrderView')->name('returnOrderView');
        Route::get('/return-Order-add', 'returnOrderAdd')->name('returnOrderAdd');
        Route::get('/fetchForReturnOrder/{id}', 'fetchForReturnOrder')->name('fetchForReturnOrder');
    });


    Route::controller(IngredientController::class)->group(function () {
        Route::get('/add/ingredient', 'addIngredient')->name('add.ingredient');
        Route::post('/save/ingredient', 'saveIngredient')->name('save.ingredient');
        Route::get('/edit/ingredient/{id}', 'editIngredient')->name('edit.ingredient');
        Route::post('/update/ingredient/{id}', 'updateIngredient')->name('update.ingredient');
        Route::get('/ingredient', 'IngredientList')->name('ingredient.list');


        Route::get('fetchingredient/{id}', 'fetchingredient');

        Route::POST('saveIngredientData', 'saveIngredientData')->name('add.saveIngredientData');
        Route::POST('updateIngredientData/{id}', 'updateIngredientData')->name('updateIngredientData');
    });
    Route::controller(PageController::class)->group(function () {

        // Route::get('/add/categorie', 'addCategorie')->name('add.categorie');
        // Route::post('/save/categorie', 'saveCategorie')->name('save.categorie');
        // Route::get('/edit/categorie/{id}', 'editCategorie')->name('edit.categorie');
        // Route::post('/update/categorie/{id}', 'updateCategorie')->name('update.categorie');
        // Route::get('/categorie', 'categorieList')->name('categorie.list');

        Route::get('/add/categorie', 'addSubCategorie')->name('add.subcategorie');
        Route::post('/save/categorie', 'saveSubCategorie')->name('save.subCategorie');
        Route::get('/edit/categorie/{id}', 'editSubCategorie')->name('edit.subCategorie');
        Route::post('/update/categorie/{id}', 'updateSubCategorie')->name('update.subCategorie');
        Route::get('/categorie', 'subCategorieList')->name('subCategorie.list');

        Route::get('/add/gst', 'addGst')->name('add.gst');
        Route::post('/save/gst', 'saveGst')->name('save.gst');
        Route::get('/edit/gst/{id}', 'editGst')->name('edit.gst');
        Route::post('/update/gst/{id}', 'updateGst')->name('update.gst');
        Route::get('/gst', 'gstList')->name('gst.list');

        Route::get('/add/firm', 'addFirm')->name('add.firm');
        Route::post('/save/firm', 'saveFirm')->name('save.firm');
        Route::get('/edit/firm/{id}', 'editFirm')->name('edit.firm');
        Route::post('/update/firm/{id}', 'updateFirm')->name('update.firm');
        Route::get('/firm', 'firmList')->name('firm.list');

        Route::post('/get/firm', 'getFirm')->name('get.firm');

        Route::get('/add/product', 'addNewProduct')->name('add.NewProduct');
        Route::post('/save/product', 'saveNewProduct')->name('save.NewProduct');
        Route::get('/get-subcategories', 'getSubcategories')->name('get.subcategories');
        Route::get('/edit/product/{id}', 'editProduct')->name('edit.product');
        Route::post('/update/product/{id}', 'updateProduct')->name('update.product');
        Route::get('/product', 'productsList')->name('products.list');
        Route::get('change-status/{id}', 'status')->name('products.status');
        Route::get('change-populer/{id}', 'populer_status')->name('populer.status');
        Route::post('perch/import', 'perchImport')->name('perch.import');


        Route::get('/inventory', 'productsInventory')->name('inventory.list');

        Route::get('/add/inventory', 'addProductsInventory')->name('add.inventory');
        Route::post('/save/inventory', 'saveProductsInventory')->name('save.inventory');

        Route::get('add/customer', 'addCustomer')->name('customer.add');
        Route::post('save/customer', 'saveCustomer')->name('customer.save');
        Route::get('list/customer', 'customerList')->name('customer.list');
        Route::get('edit/customer/{id}', 'editCustomer')->name('customer.edit');
        Route::post('/update/customer/{id}', 'updateCustomer')->name('customer.update');


        Route::get('add/employee', 'addEmployee')->name('employee.add');
        Route::post('save/employee', 'saveEmployee')->name('employee.save');
        Route::get('list/employee', 'employeeList')->name('employee.list');
        Route::get('edit/employee/{id}', 'editEmployee')->name('employee.edit');
        Route::post('/update/employee/{id}', 'updateEmployee')->name('employee.update');
        Route::get('change-activeStatus/{id}', 'employeeStatus')->name('employee.activeStatus');


        Route::get('/', 'dashboardOverview1')->name('dashboard-overview-1');
        Route::get('dashboard-overview-2-page', 'dashboardOverview2')->name('dashboard-overview-2');
        Route::get('dashboard-overview-3-page', 'dashboardOverview3')->name('dashboard-overview-3');
        Route::get('dashboard-overview-4-page', 'dashboardOverview4')->name('dashboard-overview-4');
        Route::get('categories-page', 'categories')->name('categories');
        Route::get('add-product-page', 'addProduct')->name('add-product');
        Route::get('product-list-page', 'productList')->name('product-list');
        Route::get('product-grid-page', 'productGrid')->name('product-grid');
        Route::get('transaction-list-page', 'transactionList')->name('transaction-list');
        Route::get('transaction-detail-page', 'transactionDetail')->name('transaction-detail');
        Route::get('seller-list-page', 'sellerList')->name('seller-list');
        Route::get('seller-detail-page', 'sellerDetail')->name('seller-detail');
        Route::get('reviews-page', 'reviews')->name('reviews');
        Route::get('inbox-page', 'inbox')->name('inbox');
        Route::get('file-manager-page', 'fileManager')->name('file-manager');
        Route::get('point-of-sale-page', 'pointOfSale')->name('point-of-sale');
        Route::get('chat-page', 'chat')->name('chat');
        Route::get('post-page', 'post')->name('post');
        Route::get('calendar-page', 'calendar')->name('calendar');
        Route::get('crud-data-list-page', 'crudDataList')->name('crud-data-list');
        Route::get('crud-form-page', 'crudForm')->name('crud-form');
        Route::get('users-layout-1-page', 'usersLayout1')->name('users-layout-1');
        Route::get('users-layout-2-page', 'usersLayout2')->name('users-layout-2');
        Route::get('users-layout-3-page', 'usersLayout3')->name('users-layout-3');
        Route::get('profile-overview-1-page', 'profileOverview1')->name('profile-overview-1');
        Route::get('profile-overview-2-page', 'profileOverview2')->name('profile-overview-2');
        Route::get('profile-overview-3-page', 'profileOverview3')->name('profile-overview-3');
        Route::get('wizard-layout-1-page', 'wizardLayout1')->name('wizard-layout-1');
        Route::get('wizard-layout-2-page', 'wizardLayout2')->name('wizard-layout-2');
        Route::get('wizard-layout-3-page', 'wizardLayout3')->name('wizard-layout-3');
        Route::get('blog-layout-1-page', 'blogLayout1')->name('blog-layout-1');
        Route::get('blog-layout-2-page', 'blogLayout2')->name('blog-layout-2');
        Route::get('blog-layout-3-page', 'blogLayout3')->name('blog-layout-3');
        Route::get('pricing-layout-1-page', 'pricingLayout1')->name('pricing-layout-1');
        Route::get('pricing-layout-2-page', 'pricingLayout2')->name('pricing-layout-2');
        Route::get('invoice-layout-1-page', 'invoiceLayout1')->name('invoice-layout-1');
        Route::get('invoice-layout-2-page', 'invoiceLayout2')->name('invoice-layout-2');
        Route::get('faq-layout-1-page', 'faqLayout1')->name('faq-layout-1');
        Route::get('faq-layout-2-page', 'faqLayout2')->name('faq-layout-2');
        Route::get('faq-layout-3-page', 'faqLayout3')->name('faq-layout-3');
        Route::get('login-page', 'login')->name('login');
        Route::get('register-page', 'register')->name('register');
        Route::get('error-page-page', 'errorPage')->name('error-page');
        Route::get('update-profile-page', 'updateProfile')->name('update-profile');
        Route::get('change-password-page', 'changePassword')->name('change-password');
        Route::get('regular-table-page', 'regularTable')->name('regular-table');
        Route::get('tabulator-page', 'tabulator')->name('tabulator');
        Route::get('modal-page', 'modal')->name('modal');
        Route::get('slide-over-page', 'slideOver')->name('slide-over');
        Route::get('notification-page', 'notification')->name('notification');
        Route::get('tab-page', 'tab')->name('tab');
        Route::get('accordion-page', 'accordion')->name('accordion');
        Route::get('button-page', 'button')->name('button');
        Route::get('alert-page', 'alert')->name('alert');
        Route::get('progress-bar-page', 'progressBar')->name('progress-bar');
        Route::get('tooltip-page', 'tooltip')->name('tooltip');
        Route::get('dropdown-page', 'dropdown')->name('dropdown');
        Route::get('typography-page', 'typography')->name('typography');
        Route::get('icon-page', 'icon')->name('icon');
        Route::get('loading-icon-page', 'loadingIcon')->name('loading-icon');
        Route::get('regular-form-page', 'regularForm')->name('regular-form');
        Route::get('datepicker-page', 'datepicker')->name('datepicker');
        Route::get('tom-select-page', 'tomSelect')->name('tom-select');
        Route::get('file-upload-page', 'fileUpload')->name('file-upload');
        Route::get('wysiwyg-editor-classic-page', 'wysiwygEditorClassic')->name('wysiwyg-editor-classic');
        Route::get('wysiwyg-editor-inline-page', 'wysiwygEditorInline')->name('wysiwyg-editor-inline');
        Route::get('wysiwyg-editor-balloon-page', 'wysiwygEditorBalloon')->name('wysiwyg-editor-balloon');
        Route::get('wysiwyg-editor-balloon-block-page', 'wysiwygEditorBalloonBlock')->name('wysiwyg-editor-balloon-block');
        Route::get('wysiwyg-editor-document-page', 'wysiwygEditorDocument')->name('wysiwyg-editor-document');
        Route::get('validation-page', 'validation')->name('validation');
        Route::get('chart-page', 'chart')->name('chart');
        Route::get('slider-page', 'slider')->name('slider');
        Route::get('image-zoom-page', 'imageZoom')->name('image-zoom');
    });


    Route::controller(LedgerController::class)->group(function () {
        Route::get('/ledgerlist', 'ledgerlist')->name('ledgers.list');
        Route::get('/ledgers', 'ledgers')->name('ledgers');
        Route::get('/edit/ledger/{id}', 'edit')->name('ledger.edit');
        Route::get('/add/ledger', 'ledgeradd')->name('add.ledger');
        Route::post('/save/ledger', 'saveLedger')->name('save.ledger');
        Route::post('/update/ledger/{id}', 'updateLedger')->name('ledger.update');
    });

    Route::controller(EntryController::class)->group(function () {
        Route::get('/app/sale/report', 'SaleReport')->name('sale.report.list');
        Route::get('/entry/list/{id}', 'entrylist')->name('entry.list');
        Route::get('/ledger/list', 'ledgerlist')->name('ledger.list');
        Route::get('/edit/entry/{id}', 'edit')->name('entry.edit');
        Route::get('/add/entry/{id}', 'entryadd')->name('add.entry');
        Route::post('/save/entry', 'saveEntry')->name('save.entry');
        Route::post('/update/entry/{id}', 'updateEntry')->name('entry.update');
        Route::get('/get-orders/{partyId}', 'getOrders');
        Route::get('/get-rupee/{perchId}', 'getRupee')->name('get-rupee');
        Route::get('/entry/reports/balance/{id}', 'ShowEntryBalance')->name('admin.show.entry.balance');
        Route::get('/reports/{id}', 'Report')->name('show.entry.report');
    });

    Route::controller(BankDetailsController::class)->group(function () {
        Route::get('/bank/list', 'bankDetailsList')->name('bank.list');
        Route::get('/edit/bank/{id}', 'editBankDetails')->name('bank.edit');
        Route::get('/add/bank', 'addBankDetails')->name('add.bank');
        Route::post('/save/bank', 'saveBankDetails')->name('save.bank');
        Route::post('/update/bank/{id}', 'updateBankDetails')->name('bank.update');
    });


    Route::controller(StockInHandController::class)->group(function () {
        Route::get('/stock-in-hand/list', 'stock_in_handList')->name('stock-in-hand.list');
        Route::get('/edit/stock-in-hand/{id}', 'editStock_in_hand')->name('stock-in-hand.edit');
        Route::get('/add/stock-in-hand', 'addStock_in_hand')->name('add.stock-in-hand');
        Route::post('/save/stock-in-hand', 'saveStock_in_hand')->name('save.stock-in-hand');
        Route::post('/update/stock-in-hand/{id}', 'updateStock_in_hand')->name('stock-in-hand.update');
        Route::get('stock-in-hand-change-status/{id}', 'status')->name('stock-in-hand.status');
    });



    Route::controller(ProfiteAndLossController::class)->group(function () {
        Route::get('/profite/loss/list', 'Profile_lossList')->name('profite-loss.list');
        Route::get('/edit/profite/loss/{id}', 'editProfile_loss')->name('profite-loss.edit');
        Route::get('/add/profite/loss', 'addProfile_loss')->name('add.profite-loss');
        Route::post('/save/profite/loss', 'saveProfile_loss')->name('save.profite-loss');
        Route::post('/update/profite/loss/{id}', 'updateProfile_loss')->name('profite-loss.update');
        Route::get('profite/loss/change/status/{id}', 'status')->name('profite-loss.status');
    });

    Route::controller(ContactUsController::class)->group(function () {
        Route::get('/contect/us/list', 'contect_usList')->name('contect_us.list');
    });

    Route::controller(\App\Http\Controllers\BlogController::class)->group(function () {
        Route::get('/blog/list', 'blogList')->name('blog.list');
        Route::get('/edit/blog/{id}', 'editBlog')->name('blog.edit');
        Route::get('/add/blog', 'addBlog')->name('add.blog');
        Route::post('/save/blog', 'saveBlog')->name('save.blog');
        Route::post('/update/blog/{id}', 'updateBlog')->name('blog.update');
        Route::post('/delete/blog/{id}', 'deleteblog')->name('blog.delete');
    });


    Route::controller(\App\Http\Controllers\FronteImageController::class)->group(function () {
        Route::get('/front/image/list', 'front_imageList')->name('front_image.list');
        Route::get('/edit/front/image/{id}', 'edit_front_image')->name('front_image.edit');
        Route::get('/add/front/image', 'addFront_image')->name('add.front_image');
        Route::post('/save/front/image', 'save_front_image')->name('save.front_image');
        Route::post('/update/front/image/{id}', 'update_front_image')->name('front_image.update');
        Route::post('/delete/front/image/{id}', 'delete_front_image')->name('front_image.delete');
    });

    Route::controller(\App\Http\Controllers\FounderManageController::class)->group(function () {
        Route::get('/founder/mange/list', 'founder_mange_list')->name('founder_mange.list');
        Route::get('/edit/founder/mange/{id}', 'edit_founder_mange')->name('founder_mange.edit');
        Route::get('/add/founder/mange', 'add_founder_mange')->name('add.founder_mange');
        Route::post('/save/founder/mange', 'save_founder_mange')->name('save.founder_mange');
        Route::post('/update/founder/mange/{id}', 'update_founder_mange')->name('founder_mange.update');
        Route::post('/delete/founder/mange/{id}', 'delete_founder_mange')->name('founder_mange.delete');
    });


    Route::controller(\App\Http\Controllers\OrderPincodeController::class)->group(function () {
        Route::get('/order/pincode/list', 'order_pincode_list')->name('order_pincode.list');
        Route::get('/edit/order/pincode/{id}', 'edit_order_pincode')->name('order_pincode.edit');
        Route::get('/add/order/pincode', 'add_order_pincode')->name('add.order_pincode');
        Route::post('/save/order/pincode', 'save_order_pincode')->name('save.order_pincode');
        Route::post('/update/order/pincode/{id}', 'update_order_pincode')->name('order_pincode.update');
        Route::post('/delete/order/pincode/{id}', 'delete_order_pincode')->name('order_pincode.delete');
    });





    Route::controller(WebController::class)->group(function () {
        Route::get('/web/order/list', 'webOrder')->name('weborder.list');
        Route::get('/edit/web/order/{id}', 'editWeborder')->name('weborder.edit');
        Route::post('/update//web/order/{id}', 'updateWeborder')->name('weborder.update');
    

     

    });

    Route::controller(RatingProductController::class)->group(function () {
        Route::get('/list/rating', 'admin_show_review')->name('review.list');
    });
});



// });