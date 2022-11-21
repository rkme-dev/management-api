<?php

namespace Routes;

use App\Events\MessageEvent;
use App\Http\Controllers\API\Ability\AbilityCreateController;
use App\Http\Controllers\API\Ability\AbilityDeleteController;
use App\Http\Controllers\API\Ability\AbilityListController;
use App\Http\Controllers\API\Ability\AbilityShowController;
use App\Http\Controllers\API\Ability\AbilityUpdateController;
use App\Http\Controllers\API\AccessLevel\AccessLevelCreateController;
use App\Http\Controllers\API\AccessLevel\AccessLevelDeleteController;
use App\Http\Controllers\API\AccessLevel\AccessLevelListController;
use App\Http\Controllers\API\AccessLevel\AccessLevelShowController;
use App\Http\Controllers\API\AccessLevel\AccessLevelUpdateController;
use App\Http\Controllers\API\AccountReceivablesReport\CustomerSubsidiaryLedgerController;
use App\Http\Controllers\API\AccountReceivablesReport\CustomerAgingController;
use App\Http\Controllers\API\AccountReceivablesReport\CustomerAgingTransactionController;
use App\Http\Controllers\API\Accounts\CreateAccountController;
use App\Http\Controllers\API\Accounts\DeleteAccountsController;
use App\Http\Controllers\API\Accounts\ListAccountController;
use App\Http\Controllers\API\Accounts\ShowAccountsController;
use App\Http\Controllers\API\Accounts\UpdateAccountsController;
use App\Http\Controllers\API\Authentication\LoginController;
use App\Http\Controllers\API\Authentication\LogoutController;
use App\Http\Controllers\API\Authentication\UserUpdatePasswordController;
use App\Http\Controllers\API\BouncedDeposits\CreateBouncedDepositController;
use App\Http\Controllers\API\BouncedDeposits\ListBouncedDepositController;
use App\Http\Controllers\API\BouncedDeposits\ListDepositChecksController;
use App\Http\Controllers\API\BouncedDeposits\PostBouncedDepositController;
use App\Http\Controllers\API\BouncedDeposits\ShowBouncedDepositController;
use App\Http\Controllers\API\BouncedDeposits\UnpostBouncedDepositController;
use App\Http\Controllers\API\BouncedDeposits\UpdateBouncedDepositController;
use App\Http\Controllers\API\Collections\CreateCollectionController;
use App\Http\Controllers\API\Collections\ListCollectionsController;
use App\Http\Controllers\API\Collections\PostCollectionController;
use App\Http\Controllers\API\Collections\ShowCollectionController;
use App\Http\Controllers\API\Collections\UnPostCollectionController;
use App\Http\Controllers\API\Collections\UpdateCollectionController;
use App\Http\Controllers\API\Customer\CustomerCreateController;
use App\Http\Controllers\API\Customer\CustomerDeleteController;
use App\Http\Controllers\API\Customer\CustomerListController;
use App\Http\Controllers\API\Customer\CustomerShowController;
use App\Http\Controllers\API\Customer\CustomerUpdateController;
use App\Http\Controllers\API\Department\DepartmentAbilitiesController;
use App\Http\Controllers\API\Department\DepartmentCreateController;
use App\Http\Controllers\API\Department\DepartmentDeleteController;
use App\Http\Controllers\API\Department\DepartmentListController;
use App\Http\Controllers\API\Department\DepartmentRolesController;
use App\Http\Controllers\API\Department\DepartmentShowController;
use App\Http\Controllers\API\Department\DepartmentUpdateController;
use App\Http\Controllers\API\Deposits\CreateDepositController;
use App\Http\Controllers\API\Deposits\ListCheckPaymentController;
use App\Http\Controllers\API\Deposits\ListDepositController;
use App\Http\Controllers\API\Deposits\PostDepositController;
use App\Http\Controllers\API\Deposits\ShowDepositController;
use App\Http\Controllers\API\Deposits\UnPostDepositController;
use App\Http\Controllers\API\Deposits\UpdateDepositController;
use App\Http\Controllers\API\Documents\CreateDocumentController;
use App\Http\Controllers\API\Documents\DeleteDocumentController;
use App\Http\Controllers\API\Documents\ListDocumentController;
use App\Http\Controllers\API\Documents\ShowDocumentController;
use App\Http\Controllers\API\Documents\UpdateDocumentController;
use App\Http\Controllers\API\FinishProducts\AddUnitAndPackingToProductController;
use App\Http\Controllers\API\FinishProducts\CreateFinishProductController;
use App\Http\Controllers\API\FinishProducts\ListFinishProductController;
use App\Http\Controllers\API\FinishProducts\RemoveUnitAndPackingToProductController;
use App\Http\Controllers\API\FinishProducts\ShowFinishProductController;
use App\Http\Controllers\API\FinishProducts\UpdateFinishProductController;
use App\Http\Controllers\API\Line\CreateLineController;
use App\Http\Controllers\API\Line\DeleteLineController;
use App\Http\Controllers\API\Line\ListLineController;
use App\Http\Controllers\API\Line\ShowLineController;
use App\Http\Controllers\API\Line\UpdateLineController;
use App\Http\Controllers\API\Locations\CreateLocationController;
use App\Http\Controllers\API\Locations\DeleteLocationController;
use App\Http\Controllers\API\Locations\ListLocationController;
use App\Http\Controllers\API\Locations\ShowLocationController;
use App\Http\Controllers\API\Locations\UpdateLocationController;
use App\Http\Controllers\API\Module\ModuleListController;
use App\Http\Controllers\API\PhysicalCount\CreatePhysicalCountController;
use App\Http\Controllers\API\PhysicalCount\ListPhysicalCountController;
use App\Http\Controllers\API\PhysicalCount\ShowPhysicalCountController;
use App\Http\Controllers\API\PhysicalCount\UpdatePhysicalCountController;
use App\Http\Controllers\API\PhysicalCount\PostPhysicalCountController;
use App\Http\Controllers\API\PhysicalCount\UnpostPhysicalCountController;
use App\Http\Controllers\API\Product\ProductCreateController;
use App\Http\Controllers\API\Product\ProductDeleteController;
use App\Http\Controllers\API\Product\ProductListController;
use App\Http\Controllers\API\Product\ProductShowController;
use App\Http\Controllers\API\Product\ProductSupplierListController;
use App\Http\Controllers\API\Product\ProductUpdateController;
use App\Http\Controllers\API\ProductionProcedure\CreateProductionProcedureController;
use App\Http\Controllers\API\ProductionProcedure\CreateProductionProcedureRequestController;
use App\Http\Controllers\API\ProductionProcedure\ListProductionProcedureController;
use App\Http\Controllers\API\ProductPackageType\CreateProductPackageTypeController;
use App\Http\Controllers\API\PurchaseOrder\PurchaseOrderApproveController;
use App\Http\Controllers\API\PurchaseOrder\PurchaseOrderCreateController;
use App\Http\Controllers\API\PurchaseOrder\PurchaseOrderInTransitController;
use App\Http\Controllers\API\PurchaseOrder\PurchaseOrderListController;
use App\Http\Controllers\API\PurchaseOrder\PurchaseOrderLogShowController;
use App\Http\Controllers\API\PurchaseOrder\PurchaseOrderPaymentLogShowController;
use App\Http\Controllers\API\PurchaseOrder\PurchaseOrderPierToWarehouseController;
use App\Http\Controllers\API\PurchaseOrder\PurchaseOrderShowController;
use App\Http\Controllers\API\PurchaseOrder\PurchaseOrderStockArrivalController;
use App\Http\Controllers\API\RawMaterial\AddUnitAndPackingToRawMaterialController;
use App\Http\Controllers\API\RawMaterial\CreateRawMaterialController;
use App\Http\Controllers\API\RawMaterial\ListRawMaterialController;
use App\Http\Controllers\API\RawMaterial\RawMaterialsListController;
use App\Http\Controllers\API\RawMaterial\RemoveUnitAndPackingToRawMaterialController;
use App\Http\Controllers\API\RawMaterial\ShowRawMaterialController;
use App\Http\Controllers\API\RawMaterial\UpdateRawMaterialController;
use App\Http\Controllers\API\ReleaseOrder\ReleaseOrderCreateController;
use App\Http\Controllers\API\ReleaseOrder\ReleaseOrderListController;
use App\Http\Controllers\API\ReleaseOrder\ReleaseOrderShowController;
use App\Http\Controllers\API\ReleaseOrder\ReleaseOrderUpdateController;
use App\Http\Controllers\API\Role\RoleCreateController;
use App\Http\Controllers\API\Role\RoleDeleteController;
use App\Http\Controllers\API\Role\RoleListController;
use App\Http\Controllers\API\Role\RoleShowController;
use App\Http\Controllers\API\Role\RoleUpdateController;
use App\Http\Controllers\API\SalesDrs\AreaListBySalesDRController;
use App\Http\Controllers\API\SalesDrs\CreateSalesDrController;
use App\Http\Controllers\API\SalesDrs\ListDrByCustomerController;
use App\Http\Controllers\API\SalesDrs\ListSalesDrController;
use App\Http\Controllers\API\SalesDrs\ListSalesDrItemsController;
use App\Http\Controllers\API\SalesDrs\PostSalesDrController;
use App\Http\Controllers\API\SalesDrs\ShowSalesDrController;
use App\Http\Controllers\API\SalesDrs\UnlinkSalesDrItemsController;
use App\Http\Controllers\API\SalesDrs\UnpaidSalesDrListController;
use App\Http\Controllers\API\SalesDrs\UnpostSalesDrController;
use App\Http\Controllers\API\SalesDrs\UpdateSalesDrController;
use App\Http\Controllers\API\Salesmans\CreateSalesmanController;
use App\Http\Controllers\API\Salesmans\DeleteSalesmanController;
use App\Http\Controllers\API\Salesmans\ListSalesmanController;
use App\Http\Controllers\API\Salesmans\ShowSalesmanController;
use App\Http\Controllers\API\Salesmans\UpdateSalesmanController;
use App\Http\Controllers\API\SalesOrders\CreateSalesOrderController;
use App\Http\Controllers\API\SalesOrders\ListSalesOrderController;
use App\Http\Controllers\API\SalesOrders\ListSalesOrderItemsController;
use App\Http\Controllers\API\SalesOrders\SalesOrderItemsByCustomerController;
use App\Http\Controllers\API\SalesOrders\PostSalesOrderController;
use App\Http\Controllers\API\SalesOrders\ShowSalesOrderController;
use App\Http\Controllers\API\SalesOrders\UnpostSalesOrderController;
use App\Http\Controllers\API\SalesOrders\UpdateSalesOrderController;
use App\Http\Controllers\API\StockCard\StockCardReportController;
use App\Http\Controllers\API\Supplier\SupplierCreateController;
use App\Http\Controllers\API\Supplier\SupplierDeleteController;
use App\Http\Controllers\API\Supplier\SupplierListController;
use App\Http\Controllers\API\Supplier\SupplierShowController;
use App\Http\Controllers\API\Supplier\SupplierUpdateController;
use App\Http\Controllers\API\Terms\CreateTermController;
use App\Http\Controllers\API\Terms\DeleteTermController;
use App\Http\Controllers\API\Terms\ListTermController;
use App\Http\Controllers\API\Terms\ShowTermController;
use App\Http\Controllers\API\Terms\UpdateTermController;
use App\Http\Controllers\API\TripTickets\CreateTripTicketController;
use App\Http\Controllers\API\TripTickets\ListTripTicketsController;
use App\Http\Controllers\API\TripTickets\UpdateTripTicketController;
use App\Http\Controllers\API\TripTickets\UpdateTripTicketStatusController;
use App\Http\Controllers\API\UnitPackings\CreateUnitPackingController;
use App\Http\Controllers\API\UnitPackings\ListUnitPackingController;
use App\Http\Controllers\API\UnitPackings\ShowUnitPackingController;
use App\Http\Controllers\API\UnitPackings\UpdateUnitPackingController;
use App\Http\Controllers\API\User\UserCreateController;
use App\Http\Controllers\API\User\UserEditController;
use App\Http\Controllers\API\User\UserListController;
use App\Http\Controllers\API\User\UserShowController;
use App\Http\Controllers\API\User\UserUploadProfilePhotoController;
use App\Http\Controllers\API\User\UserUploadValidIdController;
use App\Http\Controllers\API\Vats\CreateVatController;
use App\Http\Controllers\API\Vats\DeleteVatController;
use App\Http\Controllers\API\Vats\ListVatController;
use App\Http\Controllers\API\Vats\ShowVatController;
use App\Http\Controllers\API\Vats\UpdateVatController;
use App\Http\Controllers\API\Warehouse\CreateWarehouseController;
use App\Http\Controllers\API\Warehouse\DeleteWarehouseController;
use App\Http\Controllers\API\Warehouse\ListWarehouseController;
use App\Http\Controllers\API\Warehouse\ShowWarehouseController;
use App\Http\Controllers\API\Warehouse\UpdateWarehouseController;
use App\Http\Controllers\MessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/fireEvent', function (Request $request) {
    MessageEvent::dispatch($request->get('message'));
})->name('fire.public.event');

Route::post('/login', [
    'as' => 'login',
    'uses' => LoginController::class,
]);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'auth:sanctum',
    'as' => 'enco.api.v1.',
    'prefix' => '',
], function () {

    Route::post('/logout', [
        'as' => 'logout',
        'uses' => LogoutController::class,
    ]);

    Route::get('/modules', [
        'as' => 'modules.list',
        'uses' => ModuleListController::class,
    ]);

    Route::group([
        'as' => 'abilities.',
        'prefix' => '',
    ], function () {
        Route::post('/abilities', [
            'as' => 'create',
            'uses' => AbilityCreateController::class,
        ]);
        Route::get('/abilities', [
            'as' => 'list',
            'uses' => AbilityListController::class,
        ]);
        Route::put('/abilities/{id}', [
            'as' => 'update',
            'uses' => AbilityUpdateController::class,
        ]);
        Route::get('/abilities/{id}', [
            'as' => 'show',
            'uses' => AbilityShowController::class,
        ]);
        Route::delete('/abilities/{id}', [
            'as' => 'delete',
            'uses' => AbilityDeleteController::class,
        ]);
    });

    Route::group([
        'as' => 'roles.',
        'prefix' => '',
    ], function () {
        Route::get('/roles', [
            'as' => 'list',
            'uses' => RoleListController::class,
        ]);
        Route::post('/roles', [
            'as' => 'create',
            'uses' => RoleCreateController::class,
        ]);
        Route::put('/roles/{id}', [
            'as' => 'put',
            'uses' => RoleUpdateController::class,
        ]);
        Route::get('/roles/{id}', [
            'as' => 'show',
            'uses' => RoleShowController::class,
        ]);
        Route::delete('/roles/{id}', [
            'as' => 'delete',
            'uses' => RoleDeleteController::class,
        ]);
    });

    // sales routes
    Route::group([
        'as' => 'sales.',
        'prefix' => '/sales',
    ], function () {
        Route::group([
            'as' => 'sales.customer',
            'prefix' => '/customer'
        ], function () {
            Route::get('/{id}', [
                'as' => 'show',
                'uses' => CustomerShowController::class
            ]);

            Route::post('/update/{id}', [
                'as' => 'update',
                'uses' => CustomerUpdateController::class,
            ]);

            Route::post('/create', [
                'as' => 'create',
                'uses' => CustomerCreateController::class,
            ]);

            Route::delete('/delete/{id}', [
                'as' => 'delete',
                'uses' => CustomerDeleteController::class,
            ]);
        });

        Route::group([
            'as' => 'sales.customers',
            'prefix' => '/customers'
        ], function () {
            Route::get('/', [
                'as' => 'list',
                'uses' => CustomerListController::class,
            ]);
        });
    });

    // products routes
    Route::group([
        'as' => 'products.',
        'prefix' => '/',
    ], function () {
        Route::group([
            'as' => 'product',
            'prefix' => '/product'
        ], function () {
            Route::get('/{id}', [
                'as' => 'show',
                'uses' => ProductShowController::class
            ]);

            Route::put('/update/{id}', [
                'as' => 'update',
                'uses' => ProductUpdateController::class,
            ]);

            Route::post('/create', [
                'as' => 'create',
                'uses' => ProductCreateController::class,
            ]);

            Route::delete('/delete/{id}', [
                'as' => 'delete',
                'uses' => ProductDeleteController::class,
            ]);
        });



        Route::group([
            'as' => 'products',
            'prefix' => '/products'
        ], function () {
            Route::get('/', [
                'as' => 'list',
                'uses' => ProductListController::class,
            ]);

            Route::get('/list-by-supplier/{id}', [
                'as' => 'list-by-supplier',
                'uses' => ProductSupplierListController::class,
            ]);

            Route::post('/{id}/package-types', [
                'as' => 'create-package-type',
                'uses' => CreateProductPackageTypeController::class,
            ]);
        });

        Route::group([
            'as' => 'raw-materials',
            'prefix' => '/raw-materials'
        ], function () {
            Route::get('/', [
                'as' => 'list',
                'uses' =>
                    RawMaterialsListController::class,
            ]);
        });
    });

    // suppliers routes
    Route::group([
        'as' => 'suppliers.',
        'prefix' => '/',
    ], function () {
        Route::group([
            'as' => 'supplier',
            'prefix' => '/supplier'
        ], function () {
            Route::get('/{id}', [
                'as' => 'show',
                'uses' => SupplierShowController::class
            ]);

            Route::put('/update/{id}', [
                'as' => 'update',
                'uses' => SupplierUpdateController::class,
            ]);

            Route::post('/create', [
                'as' => 'create',
                'uses' => SupplierCreateController::class,
            ]);

            Route::delete('/delete/{id}', [
                'as' => 'delete',
                'uses' => SupplierDeleteController::class,
            ]);
        });

        Route::group([
            'as' => 'suppliers',
            'prefix' => '/suppliers'
        ], function () {
            Route::get('/', [
                'as' => 'list',
                'uses' => SupplierListController::class,
            ]);
        });
    });

    // purchase order routes
    Route::group([
        'as' => 'orders.',
        'prefix' => '/',
    ], function () {
        Route::group([
            'as' => 'purchase-order',
            'prefix' => '/purchase-order'
        ], function () {
            Route::get('/{id}', [
                'as' => 'show',
                'uses' => PurchaseOrderShowController::class
            ]);
            Route::get('/order-logs/{id}', [
                'as' => 'show-order-logs',
                'uses' => PurchaseOrderLogShowController::class
            ]);
            Route::get('/payment-logs/{id}', [
                'as' => 'show-payment-logs',
                'uses' => PurchaseOrderPaymentLogShowController::class
            ]);
//
//            Route::post('/update/{id}', [
//                'as' => 'update',
//                'uses' => SupplierUpdateController::class,
//            ]);

            Route::post('/create', [
                'as' => 'create',
                'uses' => PurchaseOrderCreateController::class,
            ]);

            Route::put('/approve/{id}', [
                'as' => 'approve',
                'uses' => PurchaseOrderApproveController::class,
            ]);

            Route::put('/in-transit/{id}', [
                'as' => 'in-transit',
                'uses' => PurchaseOrderInTransitController::class,
            ]);

            Route::put('/pier-to-warehouse/{id}', [
                'as' => 'pier-to-warehouse',
                'uses' => PurchaseOrderPierToWarehouseController::class,
            ]);

            Route::put('/arrival/{id}', [
                'as' => 'arrival',
                'uses' => PurchaseOrderStockArrivalController::class,
            ]);

//            Route::delete('/delete/{id}', [
//                'as' => 'delete',
//                'uses' => SupplierDeleteController::class,
//            ]);
        });

        Route::group([
            'as' => 'purchase-orders',
            'prefix' => '/purchase-orders'
        ], function () {
            Route::get('/', [
                'as' => 'list',
                'uses' => PurchaseOrderListController::class,
            ]);
        });
    });

    Route::group([
        'as' => 'users.',
        'prefix' => '',
    ], function () {
        Route::post('/users', [
            'as' => 'create',
            'uses' => UserCreateController::class,
        ]);
        Route::get('/users', [
            'as' => 'list',
            'uses' => UserListController::class,
        ]);
        Route::put('/users/{id}', [
            'as' => 'update',
            'uses' => UserEditController::class,
        ]);
        Route::get('/users/{id}', [
            'as' => 'show',
            'uses' => UserShowController::class,
        ]);
        Route::put('/users/{id}/update-password', [
            'as' => 'update-password',
            'uses' => UserUpdatePasswordController::class,
        ]);
//        Route::delete('/users/{id}', [
//            'as' => 'delete',
//            'uses' => UserDeleteController::class,
//        ]);
        Route::post('/users/{id}/upload-profile', [
            'as' => 'upload-profile',
            'uses' => UserUploadProfilePhotoController::class,
        ]);

        Route::post('/users/{id}/upload-valid-id', [
            'as' => 'upload-valid-id',
            'uses' => UserUploadValidIdController::class,
        ]);
    });

    Route::group([
        'as' => 'departments.',
        'prefix' => '',
    ], function () {
        Route::post('/departments', [
            'as' => 'create',
            'uses' => DepartmentCreateController::class,
        ]);
        Route::get('/departments', [
            'as' => 'list',
            'uses' => DepartmentListController::class,
        ]);
        Route::put('/departments/{id}', [
            'as' => 'update',
            'uses' => DepartmentUpdateController::class,
        ]);
        Route::get('/departments/{id}', [
            'as' => 'show',
            'uses' => DepartmentShowController::class,
        ]);
        Route::get('/departments/{id}/roles', [
            'as' => 'show.roles',
            'uses' => DepartmentRolesController::class,
        ]);
        Route::get('/departments/{id}/abilities', [
            'as' => 'show.abilities',
            'uses' => DepartmentAbilitiesController::class,
        ]);
        Route::delete('/departments/{id}', [
            'as' => 'delete',
            'uses' => DepartmentDeleteController::class,
        ]);
    });

    Route::group([
        'as' => 'access_levels.',
        'prefix' => '',
    ], function () {
        Route::post('/access-levels', [
            'as' => 'create',
            'uses' => AccessLevelCreateController::class,
        ]);
        Route::get('/access-levels', [
            'as' => 'list',
            'uses' => AccessLevelListController::class,
        ]);
        Route::put('/access-levels/{id}', [
            'as' => 'update',
            'uses' => AccessLevelUpdateController::class,
        ]);
        Route::get('/access-levels/{id}', [
            'as' => 'show',
            'uses' => AccessLevelShowController::class,
        ]);
        Route::delete('/access-levels/{id}', [
            'as' => 'delete',
            'uses' => AccessLevelDeleteController::class,
        ]);
    });

    Route::group([
        'as' => 'raw-materials.',
        'prefix' => '',
    ], function () {
//        Route::post('/raw-materials/release-orders', [
//            'as' => 'create',
//            'uses' => ReleaseOrderCreateController::class,
//        ]);
//
//        Route::get('/raw-materials/release-orders', [
//            'as' => 'list',
//            'uses' => ReleaseOrderListController::class,
//        ]);
//
//        Route::get('/raw-materials/release-orders/{id}', [
//            'as' => 'show',
//            'uses' => ReleaseOrderShowController::class,
//        ]);
//
//        Route::put('/raw-materials/release-orders/{id}', [
//            'as' => 'update',
//            'uses' => ReleaseOrderUpdateController::class,
//        ]);
    });


    Route::group([
        'as' => 'production-procedures.',
        'prefix' => '',
    ], function () {
        Route::post('/production-procedures', [
            'as' => 'create',
            'uses' => CreateProductionProcedureController::class,
        ]);

        Route::get('/production-procedures', [
            'as' => 'list',
            'uses' => ListProductionProcedureController::class,
        ]);

        Route::post('/production-procedures/{id}/requests', [
            'as' => 'create.requests',
            'uses' => CreateProductionProcedureRequestController::class,
        ]);
    });


    Route::group([
        'as' => 'lines.',
        'prefix' => '',
    ], function () {
        Route::post('/lines', [
            'as' => 'create',
            'uses' => CreateLineController::class,
        ]);
        Route::get('/lines', [
            'as' => 'list',
            'uses' => ListLineController::class,
        ]);
        Route::put('/lines/{id}', [
            'as' => 'update',
            'uses' => UpdateLineController::class,
        ]);
        Route::get('/lines/{id}', [
            'as' => 'show',
            'uses' => ShowLineController::class,
        ]);
        Route::delete('/lines/{id}', [
            'as' => 'delete',
            'uses' => DeleteLineController::class,
        ]);
    });

    Route::group([
        'as' => 'warehouses.',
        'prefix' => '',
    ], function () {
        Route::post('/warehouses', [
            'as' => 'create',
            'uses' => CreateWarehouseController::class,
        ]);
        Route::get('/warehouses', [
            'as' => 'list',
            'uses' => ListWarehouseController::class,
        ]);
        Route::put('/warehouses/{id}', [
            'as' => 'update',
            'uses' => UpdateWarehouseController::class,
        ]);
        Route::get('/warehouses/{id}', [
            'as' => 'show',
            'uses' => ShowWarehouseController::class,
        ]);
        Route::delete('/warehouses/{id}', [
            'as' => 'delete',
            'uses' => DeleteWarehouseController::class,
        ]);
    });

    Route::group([
        'as' => 'terms.',
        'prefix' => '',
    ], function () {
        Route::post('/terms', [
            'as' => 'create',
            'uses' => CreateTermController::class,
        ]);
        Route::get('/terms', [
            'as' => 'list',
            'uses' => ListTermController::class,
        ]);
        Route::get('/terms/{id}', [
            'as' => 'show',
            'uses' => ShowTermController::class,
        ]);
        Route::put('/terms/{id}', [
            'as' => 'update',
            'uses' => UpdateTermController::class,
        ]);
        Route::delete('/terms/{id}', [
            'as' => 'delete',
            'uses' => DeleteTermController::class,
        ]);
    });

    Route::group([
        'as' => 'documents.',
        'prefix' => '',
    ], function () {
        Route::post('/documents', [
            'as' => 'create',
            'uses' => CreateDocumentController::class,
        ]);
        Route::get('/documents', [
            'as' => 'list',
            'uses' => ListDocumentController::class,
        ]);
        Route::get('/documents/{id}', [
            'as' => 'show',
            'uses' => ShowDocumentController::class,
        ]);
        Route::put('/documents/{id}', [
            'as' => 'update',
            'uses' => UpdateDocumentController::class,
        ]);
        Route::delete('/documents/{id}', [
            'as' => 'delete',
            'uses' => DeleteDocumentController::class,
        ]);
    });

    Route::group([
        'as' => 'customers.',
        'prefix' => '',
    ], function () {
        Route::post('/customers', [
            'as' => 'create',
            'uses' => CustomerCreateController::class,
        ]);
        Route::get('/customers', [
            'as' => 'list',
            'uses' => CustomerListController::class,
        ]);
        Route::get('/customers/aging', [
            'as' => 'aging',
            'uses' => CustomerAgingController::class,
        ]);
        Route::get('/customers/aging-transaction/{id}', [
            'as' => 'aging-transaction',
            'uses' => CustomerAgingTransactionController::class,
        ]);
        Route::get('/customers/{id}', [
            'as' => 'show',
            'uses' => CustomerShowController::class,
        ]);
        Route::put('/customers/{id}', [
            'as' => 'update',
            'uses' => CustomerUpdateController::class,
        ]);
        Route::delete('/customers/{id}', [
            'as' => 'delete',
            'uses' => CustomerDeleteController::class,
        ]);
    });

    Route::group([
        'as' => 'vats.',
        'prefix' => '',
    ], function () {
        Route::post('/vats', [
            'as' => 'create',
            'uses' => CreateVatController::class,
        ]);
        Route::get('/vats', [
            'as' => 'list',
            'uses' => ListVatController::class,
        ]);
        Route::get('/vats/{id}', [
            'as' => 'show',
            'uses' => ShowVatController::class,
        ]);
        Route::put('/vats/{id}', [
            'as' => 'update',
            'uses' => UpdateVatController::class,
        ]);
        Route::delete('/vats/{id}', [
            'as' => 'delete',
            'uses' => DeleteVatController::class,
        ]);
    });

    Route::group([
        'as' => 'salesmans.',
        'prefix' => '',
    ], function () {
        Route::post('/salesmans', [
            'as' => 'create',
            'uses' => CreateSalesmanController::class,
        ]);
        Route::get('/salesmans', [
            'as' => 'list',
            'uses' => ListSalesmanController::class,
        ]);
        Route::get('/salesmans/{id}', [
            'as' => 'show',
            'uses' => ShowSalesmanController::class,
        ]);
        Route::put('/salesmans/{id}', [
            'as' => 'update',
            'uses' => UpdateSalesmanController::class,
        ]);
        Route::delete('/salesmans/{id}', [
            'as' => 'delete',
            'uses' => DeleteSalesmanController::class,
        ]);
    });

    Route::group([
        'as' => 'accounts.',
        'prefix' => '',
    ], function () {
        Route::post('/accounts', [
            'as' => 'create',
            'uses' => CreateAccountController::class,
        ]);
        Route::get('/accounts', [
            'as' => 'list',
            'uses' => ListAccountController::class,
        ]);
        Route::get('/accounts/{id}', [
            'as' => 'show',
            'uses' => ShowAccountsController::class,
        ]);
        Route::put('/accounts/{id}', [
            'as' => 'update',
            'uses' => UpdateAccountsController::class,
        ]);
        Route::delete('/accounts/{id}', [
            'as' => 'delete',
            'uses' => DeleteAccountsController::class,
        ]);
    });

    Route::group([
        'as' => 'locations.',
        'prefix' => '',
    ], function () {
        Route::post('/locations', [
            'as' => 'create',
            'uses' => CreateLocationController::class,
        ]);
        Route::get('/locations', [
            'as' => 'list',
            'uses' => ListLocationController::class,
        ]);
        Route::get('/locations/{id}', [
            'as' => 'show',
            'uses' => ShowLocationController::class,
        ]);
        Route::put('/locations/{id}', [
            'as' => 'update',
            'uses' => UpdateLocationController::class,
        ]);
        Route::delete('/locations/{id}', [
            'as' => 'delete',
            'uses' => DeleteLocationController::class,
        ]);
    });

    Route::group([
        'as' => 'sales-orders.',
        'prefix' => '',
    ], function () {
        Route::post('/sales-orders', [
            'as' => 'create',
            'uses' => CreateSalesOrderController::class,
        ]);

        Route::get('/sales-orders', [
            'as' => 'list',
            'uses' => ListSalesOrderController::class,
        ]);
        Route::get('/sales-orders/{id}', [
            'as' => 'show',
            'uses' => ShowSalesOrderController::class,
        ]);
        Route::put('/sales-orders/{id}', [
            'as' => 'update',
            'uses' => UpdateSalesOrderController::class,
        ]);
        Route::put('/sales-orders/{id}/post', [
            'as' => 'post',
            'uses' => PostSalesOrderController::class,
        ]);
        Route::put('/sales-orders/{id}/unpost', [
            'as' => 'unpost',
            'uses' => UnpostSalesOrderController::class,
        ]);
        Route::get('/customers/{id}/sales-orders-items', [
            'as' => 'items',
            'uses' => SalesOrderItemsByCustomerController::class,
        ]);
        Route::get('sales-orders-items', [
            'as' => 'order-items',
            'uses' => ListSalesOrderItemsController::class,
        ]);
    });

    Route::group([
        'as' => 'unit-packing.',
        'prefix' => '',
    ], function () {
        Route::post('/unit-packing', [
            'as' => 'create',
            'uses' => CreateUnitPackingController::class,
        ]);
        Route::get('/unit-packing', [
            'as' => 'list',
            'uses' => ListUnitPackingController::class,
        ]);
        Route::get('/unit-packing/{id}', [
            'as' => 'show',
            'uses' => ShowUnitPackingController::class,
        ]);
        Route::put('/unit-packing/{id}', [
            'as' => 'update',
            'uses' => UpdateUnitPackingController::class,
        ]);
    });

    Route::group([
        'as' => 'finish-products.',
        'prefix' => '',
    ], function () {
        Route::post('/finish-products', [
            'as' => 'create',
            'uses' => CreateFinishProductController::class,
        ]);
        Route::get('/finish-products', [
            'as' => 'list',
            'uses' => ListFinishProductController::class,
        ]);
        Route::get('/finish-products/{id}', [
            'as' => 'show',
            'uses' => ShowFinishProductController::class,
        ]);
        Route::put('/finish-products/{id}', [
            'as' => 'update',
            'uses' => UpdateFinishProductController::class,
        ]);
        Route::post('/finish-products/{id}/unit-packing', [
            'as' => 'add-unit-packing',
            'uses' => AddUnitAndPackingToProductController::class,
        ]);
        Route::put('/finish-products/{id}/unit-packing', [
            'as' => 'remove-unit-packing',
            'uses' => RemoveUnitAndPackingToProductController::class,
        ]);
    });

    Route::group([
        'as' => 'raw-materials.',
        'prefix' => '',
    ], function () {
        Route::post('/raw-materials', [
            'as' => 'create',
            'uses' => CreateRawMaterialController::class,
        ]);
        Route::get('/raw-materials', [
            'as' => 'list',
            'uses' => ListRawMaterialController::class,
        ]);
        Route::get('/raw-materials/{id}', [
            'as' => 'show',
            'uses' => ShowRawMaterialController::class,
        ]);
        Route::put('/raw-materials/{id}', [
            'as' => 'update',
            'uses' => UpdateRawMaterialController::class,
        ]);
        Route::post('/raw-materials/{id}/unit-packing', [
            'as' => 'add-unit-packing',
            'uses' => AddUnitAndPackingToRawMaterialController::class,
        ]);
        Route::put('/raw-materials/{id}/unit-packing', [
            'as' => 'remove-unit-packing',
            'uses' => RemoveUnitAndPackingToRawMaterialController::class,
        ]);
    });


    Route::group([
        'as' => 'sales-drs.',
        'prefix' => '',
    ], function () {
        Route::post('/sales-drs', [
            'as' => 'create',
            'uses' => CreateSalesDrController::class,
        ]);
        Route::get('/sales-drs', [
            'as' => 'list',
            'uses' => ListSalesDrController::class,
        ]);
        Route::put('/sales-drs/{id}/post', [
            'as' => 'post',
            'uses' => PostSalesDrController::class,
        ]);
        Route::put('/sales-drs/{id}/unpost', [
            'as' => 'unpost',
            'uses' => UnpostSalesDrController::class,
        ]);
        Route::get('/sales-drs/areas', [
            'as' => 'areas',
            'uses' => AreaListBySalesDRController::class,
        ]);
        Route::get('/sales-drs/unpaid', [
            'as' => 'unpaid-list',
            'uses' => UnpaidSalesDrListController::class,
        ]);
        Route::put('/sales-drs/{id}', [
            'as' => 'update',
            'uses' => UpdateSalesDrController::class,
        ]);
        Route::get('/sales-drs/unlink-items/', [
            'as' => 'unlink-dr-items',
            'uses' => UnlinkSalesDrItemsController::class,
        ]);

        Route::get('/customers/{id}/sales-dr-items', [
            'as' => 'items',
            'uses' => ListSalesDrItemsController::class,
        ]);
        Route::get('/customers/{id}/sales-dr', [
            'as' => 'dr-by-customer-id',
            'uses' => ListDrByCustomerController::class,
        ]);

        Route::get('/customers/{id}/ledger-report', [
            'as' => 'ledger-report',
            'uses' => CustomerSubsidiaryLedgerController::class,
        ]);
        Route::get('/sales-drs/{id}', [
            'as' => 'show',
            'uses' => ShowSalesDrController::class,
        ]);


    });

    Route::group([
        'as' => 'collections.',
        'prefix' => '',
    ], function () {
        Route::post('/collections', [
            'as' => 'create',
            'uses' => CreateCollectionController::class,
        ]);
        Route::put('/collections/{id}', [
            'as' => 'update',
            'uses' => UpdateCollectionController::class,
        ]);
        Route::get('/collections/{id}', [
            'as' => 'show',
            'uses' => ShowCollectionController::class,
        ]);
        Route::put('/collections/{id}/post', [
            'as' => 'post',
            'uses' => PostCollectionController::class,
        ]);
        Route::put('/collections/{id}/unpost', [
            'as' => 'unpost',
            'uses' => UnPostCollectionController::class,
        ]);
        Route::get('/collections', [
            'as' => 'list',
            'uses' => ListCollectionsController::class,
        ]);
    });

    Route::group([
        'as' => 'trip-tickets.',
        'prefix' => '',
    ], function () {
        Route::post('/trip-tickets', [
            'as' => 'create',
            'uses' => CreateTripTicketController::class,
        ]);
        Route::get('/trip-tickets', [
            'as' => 'list',
            'uses' => ListTripTicketsController::class,
        ]);
        Route::put('/trip-tickets/{id}', [
            'as' => 'update',
            'uses' => UpdateTripTicketController::class,
        ]);

        Route::put('/trip-tickets/{id}/status', [
            'as' => 'update-status',
            'uses' => UpdateTripTicketStatusController::class,
        ]);
    });

    Route::group([
        'as' => 'physical-counts.',
        'prefix' => '',
    ], function () {
        Route::post('/physical-counts', [
            'as' => 'create',
            'uses' => CreatePhysicalCountController::class,
        ]);
        Route::get('/physical-counts', [
            'as' => 'list',
            'uses' => ListPhysicalCountController::class,
        ]);
        Route::get('/physical-counts/{physical_count}', [
            'as' => 'show',
            'uses' => ShowPhysicalCountController::class,
        ]);
        Route::put('/physical-counts/{physical_count}', [
            'as' => 'update',
            'uses' => UpdatePhysicalCountController::class,
        ]);
        Route::put('/physical-counts/{physical_count}/post', [
            'as' => 'post',
            'uses' => PostPhysicalCountController::class,
        ]);
        Route::put('/physical-counts/{physical_count}/unpost', [
            'as' => 'unpost',
            'uses' => UnpostPhysicalCountController::class,
        ]);
    });

    Route::group([
        'as' => 'deposits.',
        'prefix' => '',
    ], function () {
        Route::post('/deposits', [
            'as' => 'create',
            'uses' => CreateDepositController::class,
        ]);
        Route::get('/deposits', [
            'as' => 'list',
            'uses' => ListDepositController::class,
        ]);
        Route::get('/deposits/{id}', [
            'as' => 'show',
            'uses' => ShowDepositController::class,
        ]);
        Route::put('/deposits/{id}', [
            'as' => 'update',
            'uses' => UpdateDepositController::class,
        ]);

        Route::get('/check-payments', [
            'as' => 'list-check-payments',
            'uses' => ListCheckPaymentController::class,
        ]);
        Route::put('/deposits/{id}/post', [
            'as' => 'post-deposit',
            'uses' => PostDepositController::class,
        ]);
        Route::put('/deposits/{id}/unpost', [
            'as' => 'unpost-deposit',
            'uses' => UnPostDepositController::class,
        ]);
    });

    Route::group([
        'as' => 'bounced-deposits.',
        'prefix' => '',
    ], function () {
        Route::post('/bounced-deposits', [
            'as' => 'create',
            'uses' => CreateBouncedDepositController::class,
        ]);
        Route::get('/bounced-deposits', [
            'as' => 'list',
            'uses' => ListBouncedDepositController::class,
        ]);
        Route::get('/bounced-deposits/{id}', [
            'as' => 'show',
            'uses' => ShowBouncedDepositController::class,
        ]);
        Route::put('/bounced-deposits/{id}', [
            'as' => 'update',
            'uses' => UpdateBouncedDepositController::class,
        ]);
        Route::get('/deposit-check-payments', [
            'as' => 'list-deposit-check-payments',
            'uses' => ListDepositChecksController::class,
        ]);
        Route::put('/bounced-deposits/{id}/post', [
            'as' => 'post-bounced-deposit',
            'uses' => PostBouncedDepositController::class,
        ]);
        Route::put('/bounced-deposits/{id}/unpost', [
            'as' => 'unpost-bounced-deposit',
            'uses' => UnpostBouncedDepositController::class,
        ]);
    });

    Route::group([
        'as' => '',
        'prefix' => ''
    ], function () {
        Route::get('/products/{product}/stockcard-report/', [
            'as' => 'stockcard-report',
            'uses' => StockCardReportController::class,
        ]);
    });
});

Route::post('/message', [MessageController::class, 'create']);


