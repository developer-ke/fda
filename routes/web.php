<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\Auth\ProviderController;
use App\Http\Controllers\CarouselOneController;
use App\Http\Controllers\CarouselTwoController;
use App\Http\Controllers\claimedDocumentController;
use App\Http\Controllers\clientsDrawerController;
use App\Http\Controllers\ContactUSController;
use App\Http\Controllers\correspondentController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\DocumentTypeController;
use App\Http\Controllers\DrawersController;
use App\Http\Controllers\FoundDocumentsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\jsonController;
use App\Http\Controllers\LostDocumentsController;
use App\Http\Controllers\MatchedDocumentsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\subscriberController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PartnersController;
use App\Http\Controllers\SmsController;

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

Route::get('/', [HomeController::class, 'welcome'])->name('welcome');
Auth::routes();
Auth::routes(['verify' => true]);
// third paty authentications with laravel socialite
Route::get('/auth/{provider}/redirect', [ProviderController::class, 'redirect'])->name('auth.redirect');
Route::get('/auth/{provider}/callback', [ProviderController::class, 'callback'])->name('auth.callback');

Route::post('/report/lost/document', [LostDocumentsController::class, 'store'])->name('report_lost_document');
Route::post('/report/found/document', [FoundDocumentsController::class, 'store'])->name('report_found_document');

// contact us routes
Route::post('/contact-us', [ContactUSController::class, 'store'])->name('contact-us');


Route::middleware(['auth', 'access', 'notifications', 'profile', 'verified'])->group(function () {

    // root route
    Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('authenticated');
    // profile routes
    Route::prefix('/profile')->group(function () {
        Route::get('/complete', [ProfileController::class, 'index'])->name('profile.complete');
        Route::post('/complete/store', [ProfileController::class, 'store'])->name('profile.complete.store');
        Route::get('/change/profile/picture', [ProfileController::class, 'picture'])->name('profile.change.picture');
        Route::put('/upload/profile/picture', [ProfileController::class, 'uploadPhoto'])->name('profile.update.picture');
        Route::post('/delete/account', [ProfileController::class, 'destroy'])->name('profile.delete');
    });
    // json data routes
    Route::get('/json/data', [jsonController::class, 'index']);
    Route::get('/user/json/data', [jsonController::class, 'users']);

    // admin routes
    Route::prefix('/admin')->middleware('admin')->group(function () {
        //  clear cache
        Route::get('/clear-cache', function () {
            Artisan::call('cache:clear');
            Artisan::call('route:clear');
            Artisan::call('config:clear');
            Artisan::call('view:clear');
            echo 'cleared successfully';
        });

        Route::get('/', [adminController::class, 'index'])->name('admin');
        // profile info
        Route::get('/profile', [adminController::class, 'profile'])->name('admin.profile');
        Route::get('/profile/edit', [adminController::class, 'EditProfile'])->name('admin.profile.edit');
        Route::put('/profile/update', [adminController::class, 'UpdateProfile'])->name('admin.profile.update');

        // countries
        Route::get('/countries', [CountriesController::class, 'index'])->name('admin.countries');
        Route::get('/countries/create', [CountriesController::class, 'create'])->name('admin.countries.create');
        Route::post('/countries/store', [CountriesController::class, 'store'])->name('admin.countries.store');
        Route::get('/countries/{countryId}/edit', [CountriesController::class, 'edit'])->name('admin.countries.edit');
        Route::put('/countries/{countryId}/update', [CountriesController::class, 'update'])->name('admin.countries.update');
        Route::delete('/countries/{countryId}/delete', [CountriesController::class, 'destroy'])->name('admin.countries.destroy');

        // user management routes
        Route::get('/users', [UsersController::class, 'index'])->name('admin.users');
        Route::get('/users/create', [UsersController::class, 'create'])->name('admin.users.create');
        Route::post('/users/store', [UsersController::class, 'store'])->name('admin.users.store');
        Route::put('/users/{user_id}/delete', [UsersController::class, 'destroy'])->name('admin.users.destroy');
        Route::put('/users/{user_id}/denyAccess', [UsersController::class, 'denyAccess'])->name('admin.users.denyAccess');
        Route::put('/users/{user_id}/grantAccess', [UsersController::class, 'grantAccess'])->name('admin.users.grantAccess');
        Route::get('/users/{user_id}/profile', [UsersController::class, 'profile'])->name('admin.users.profile');
        Route::get('/users/{user_id}/edit/profile', [UsersController::class, 'EditUserProfile'])->name('admin.users.profile.edit');
        Route::put('/users/{user_id}/update/profile', [UsersController::class, 'updateUserProfile'])->name('admin.users.profile.update');
        Route::put('/users/{user_id}/role/1', [UsersController::class, 'role_1'])->name('admin.users.role.one');
        Route::put('/users/{user_id}/role/2', [UsersController::class, 'role_2'])->name('admin.users.role.two');
        Route::put('/users/{user_id}/role/3', [UsersController::class, 'role_3'])->name('admin.users.role.three');
        Route::put('/users/all/grant/access', [UsersController::class, 'GrantAllAccess'])->name('admin.users.grantAllAccess');
        Route::put('/users/all/deny/access', [UsersController::class, 'DenyAllAccess'])->name('admin.users.denyAllAccess');
        Route::delete('/users/delete/all', [UsersController::class, 'DeleteAll'])->name('admin.users.delete.all');
        Route::get('/users/fetch', [UsersController::class, 'fetchUsers'])->name('admin.users.fetch');

        // client support routes
        Route::get('client/support', [ContactUSController::class, 'index'])->name('admin.contact-us');
        Route::get('client/{client_id}/reply/message', [ContactUSController::class, 'reply'])->name('admin.contact-us.reply');
        Route::post('client/{contact_id}/send/message', [ContactUSController::class, 'send'])->name('admin.contact-us.send');
        Route::put('client/{contact_id}/support/read', [ContactUSController::class, 'read'])->name('admin.contact-us.read');
        Route::put('client/support/read/all', [ContactUSController::class, 'readAll'])->name('admin.contact-us.read.all');
        Route::put('client/{contact_id}/support/unread', [ContactUSController::class, 'unread'])->name('admin.contact-us.unread');
        Route::put('client/support/unread/all', [ContactUSController::class, 'unreadAll'])->name('admin.contact-us.unread.all');
        Route::put('client/{contact_id}/support/delete', [ContactUSController::class, 'delete'])->name('admin.contact-us.delete');
        Route::put('client/support/delete/all', [ContactUSController::class, 'deleteAll'])->name('admin.contact-us.delete.all');
        Route::put('client/restore/all/messages', [ContactUSController::class, 'restoreAll'])->name('admin.contact-us.restore.all');
        Route::put('client/{contact_id}/restore/message', [ContactUSController::class, 'restoreMessage'])->name('admin.contact-us.restore.message');
        Route::delete('client/{contact_id}/empty/trash', [ContactUSController::class, 'deleteTrash'])->name('admin.contact-us.empty.message');
        Route::delete('client/empty/all/trash', [ContactUSController::class, 'emptyTrash'])->name('admin.contact-us.empty.trash');

        // cms part 1
        Route::get('/first/carousel', [CarouselOneController::class, 'index'])->name('admin.cms1');
        Route::get('/first/carousel/create', [CarouselOneController::class, 'create'])->name('admin.cms1.create');
        Route::post('/first/carousel/store', [CarouselOneController::class, 'store'])->name('admin.cms1.store');
        Route::get('/first/{advert_id}/carousel/edit', [CarouselOneController::class, 'edit'])->name('admin.cms1.edit');
        Route::put('/first/{advert_id}/carousel/update', [CarouselOneController::class, 'update'])->name('admin.cms1.update');
        Route::get('/first/{advert_id}/carousel/show', [CarouselOneController::class, 'show'])->name('admin.cms1.view');
        Route::put('/first/{advert_id}/enable', [CarouselOneController::class, 'enable'])->name('admin.cms1.enable');
        Route::put('/first/{advert_id}/disable', [CarouselOneController::class, 'disable'])->name('admin.cms1.disable');
        Route::delete('/first/{advert_id}/destroy', [CarouselOneController::class, 'destroy'])->name('admin.cms1.destroy');
        Route::put('/first/advert/enable/all', [CarouselOneController::class, 'enableAll'])->name('admin.cms1.enableAll');
        Route::put('/first/advert/disable/all', [CarouselOneController::class, 'disableAll'])->name('admin.cms1.disableAll');
        Route::delete('/first/advert/delete/all', [CarouselOneController::class, 'deleteAll'])->name('admin.cms1.deleteAll');

        // cms part 2
        Route::get('/second/carousel', [CarouselTwoController::class, 'index'])->name('admin.cms2');
        Route::get('/second/carousel/create', [CarouselTwoController::class, 'create'])->name('admin.cms2.create');
        Route::post('/second/carousel/store', [CarouselTwoController::class, 'store'])->name('admin.cms2.store');
        Route::get('/second/{advert_id}/carousel/edit', [CarouselTwoController::class, 'edit'])->name('admin.cms2.edit');
        Route::put('/second/{advert_id}/carousel/update', [CarouselTwoController::class, 'update'])->name('admin.cms2.update');
        Route::get('/second/{advert_id}/carousel/view', [CarouselTwoController::class, 'show'])->name('admin.cms2.view');
        Route::put('/second/{advert_id}/enable', [CarouselTwoController::class, 'enable'])->name('admin.cms2.enable');
        Route::put('/second/{advert_id}/disable', [CarouselTwoController::class, 'disable'])->name('admin.cms2.disable');
        Route::delete('/second/{advert_id}/destroy', [CarouselTwoController::class, 'destroy'])->name('admin.cms2.destroy');
        Route::put('/second/advert/enable/all', [CarouselTwoController::class, 'enableAll'])->name('admin.cms2.enableAll');
        Route::put('/second/advert/disable/all', [CarouselTwoController::class, 'disableAll'])->name('admin.cms2.disableAll');
        Route::delete('/second/advert/delete/all', [CarouselTwoController::class, 'deleteAll'])->name('admin.cms2.deleteAll');

        // Partnership
        Route::get('/cms/partners', [PartnersController::class, 'index'])->name('admin.partner');
        Route::get('/cms/partners/create', [PartnersController::class, 'create'])->name('admin.partner.create');
        Route::post('/cms/partners/store', [PartnersController::class, 'store'])->name('admin.partner.store');
        Route::get('/cms/partners/{partner_id}/edit', [PartnersController::class, 'edit'])->name('admin.partner.edit');
        Route::put('/cms/partners/{partner_id}/update', [PartnersController::class, 'update'])->name('admin.partner.update');
        Route::put('/cms/partners/{partner_id}/enable', [PartnersController::class, 'enable'])->name('admin.partner.enable');
        Route::put('/cms/partners/{partner_id}/disable', [PartnersController::class, 'disable'])->name('admin.partner.disable');
        Route::delete('/cms/partners/{partner_id}/destroy', [PartnersController::class, 'destroy'])->name('admin.partner.destroy');

        // institutions
        Route::get('/institutions', [InstitutionController::class, 'index'])->name('admin.institutions');
        Route::get('/institutions/create', [InstitutionController::class, 'create'])->name('admin.institutions.create');
        Route::post('/institutions/store', [InstitutionController::class, 'store'])->name('admin.institutions.store');
        Route::get('/institutions/{institution_id}/edit', [InstitutionController::class, 'edit'])->name('admin.institutions.edit');
        Route::get('/institutions/{institution_id}/view', [InstitutionController::class, 'show'])->name('admin.institutions.view');
        Route::put('/institutions/{institution_id}/update', [InstitutionController::class, 'update'])->name('admin.institutions.update');
        Route::delete('/institutions/{institution_id}/destroy', [InstitutionController::class, 'destroy'])->name('admin.institutions.delete');
        Route::put('/institutions/{institution_id}/activate', [InstitutionController::class, 'activate'])->name('admin.institutions.activate');
        Route::put('/institutions/{institution_id}/deactivate', [InstitutionController::class, 'deactivate'])->name('admin.institutions.deactivate');

        // document types
        Route::get('/document/types', [DocumentTypeController::class, 'index'])->name('admin.documentTypes');
        Route::get('/document/types/create', [DocumentTypeController::class, 'create'])->name('admin.documentTypes.create');
        Route::post('/document/types/store', [DocumentTypeController::class, 'store'])->name('admin.documentTypes.store');
        Route::get('/document/types/{document_id}/edit', [DocumentTypeController::class, 'edit'])->name('admin.documentTypes.edit');
        Route::put('/document/types/{document_id}/update', [DocumentTypeController::class, 'update'])->name('admin.documentTypes.update');
        Route::delete('/document/types/{document_id}/delete', [DocumentTypeController::class, 'delete'])->name('admin.documentTypes.delete');

        // myDrawer
        Route::get('/mydrawer', [DrawersController::class, 'index'])->name('admin.myDrawer');
        Route::get('/mydrawer/create', [DrawersController::class, 'create'])->name('admin.myDrawer.create');
        Route::post('/mydrawer/store', [DrawersController::class, 'store'])->name('admin.myDrawer.store');
        Route::get('/mydrawer/{drawer_id}/view', [DrawersController::class, 'show'])->name('admin.myDrawer.view');
        Route::get('/mydrawer/{drawer_id}/edit', [DrawersController::class, 'edit'])->name('admin.myDrawer.edit');
        Route::put('/mydrawer/{drawer_id}/update', [DrawersController::class, 'update'])->name('admin.myDrawer.update');
        Route::delete('/mydrawer/{drawer_id}/destroy', [DrawersController::class, 'destroy'])->name('admin.myDrawer.destroy');
        Route::put('/mydrawer/{drawer_id}/lost', [DrawersController::class, 'lost'])->name('admin.myDrawer.lost');
        Route::put('/mydrawer/{drawer_id}/found', [DrawersController::class, 'found'])->name('admin.myDrawer.found');

        // clients drawer
        Route::get('/clients/Drawer', [clientsDrawerController::class, 'index'])->name('admin.clientsDrawer');
        Route::get('/clients/Drawer/{drawer_id}/view', [clientsDrawerController::class, 'show'])->name('admin.clientsDrawer.view');
        Route::get('/clients/Drawer/{drawer_id}/edit', [clientsDrawerController::class, 'edit'])->name('admin.clientsDrawer.edit');
        Route::put('/clients/Drawer/{drawer_id}/update', [clientsDrawerController::class, 'update'])->name('admin.clientsDrawer.update');
        Route::delete('/clients/Drawer/{drawer_id}/destroy', [clientsDrawerController::class, 'destroy'])->name('admin.clientsDrawer.destroy');
        Route::put('/clients/Drawer/{drawer_id}/lost', [clientsDrawerController::class, 'lost'])->name('admin.clientsDrawer.lost');
        Route::put('/clients/Drawer/{drawer_id}/found', [clientsDrawerController::class, 'found'])->name('admin.clientsDrawer.found');

        // lost docuements
        Route::get('/lost/documents', [LostDocumentsController::class, 'index'])->name('admin.lostDocuments');
        Route::get('/lost/documents/create', [LostDocumentsController::class, 'create'])->name('admin.lostDocuments.create');
        Route::get('/lost/{document_id}/documents/view', [LostDocumentsController::class, 'show'])->name('admin.lostDocuments.view');
        Route::get('/lost/{document_id}/documents/edit', [LostDocumentsController::class, 'edit'])->name('admin.lostDocuments.edit');
        Route::put('/lost/{document_id}/documents/update', [LostDocumentsController::class, 'update'])->name('admin.lostDocuments.update');
        Route::put('/lost/{document_id}/documents/matched', [LostDocumentsController::class, 'match'])->name('admin.lostDocuments.match');
        Route::put('/lost/{document_id}/documents/claimed', [LostDocumentsController::class, 'claimed'])->name('admin.lostDocuments.claim');
        Route::delete('/lost/{document_id}/documents/destroy', [LostDocumentsController::class, 'destroy'])->name('admin.lostDocuments.destroy');

        // found documents routes
        Route::get('/found/documents', [FoundDocumentsController::class, 'index'])->name('admin.foundDocuments');
        Route::get('/found/{document_id}/documents/view', [FoundDocumentsController::class, 'show'])->name('admin.foundDocuments.view');
        Route::get('/found/document/create', [FoundDocumentsController::class, 'create'])->name('admin.foundDocuments.create');
        Route::get('/found/{document_id}/document/create', [FoundDocumentsController::class, 'edit'])->name('admin.foundDocuments.edit');
        Route::put('/found/{document_id}/document/update', [FoundDocumentsController::class, 'update'])->name('admin.foundDocuments.update');
        Route::put('/found/{document_id}/document/match', [FoundDocumentsController::class, 'match'])->name('admin.foundDocuments.match');
        Route::put('/found/{document_id}/document/claim', [FoundDocumentsController::class, 'claim'])->name('admin.foundDocuments.claim');
        Route::delete('/found/{document_id}/document/claim', [FoundDocumentsController::class, 'destroy'])->name('admin.foundDocuments.destroy');

        // matched documents charactarized by the status of 1 in both
        Route::get('/matched/documents', [MatchedDocumentsController::class, 'index'])->name('admin.matchedDocuments');
        Route::get('/matched/{document_id}/documents/view', [MatchedDocumentsController::class, 'show'])->name('admin.matchedDocuments.show');
        Route::delete('/matched/{document_id}/documents/destroy', [MatchedDocumentsController::class, 'destroy'])->name('admin.matchedDocuments.destroy');
        Route::put('/matched/{document_id}/documents/claim', [MatchedDocumentsController::class, 'claimed'])->name('admin.matchedDocuments.claim');

        // claimed documents characterized by status of 2
        Route::get('/claimed/documents', [claimedDocumentController::class, 'index'])->name('admin.claimedDocuments');
        Route::get('/claimed/{document_id}/documents/view', [claimedDocumentController::class, 'show'])->name('admin.claimedDocuments.show');
        Route::delete('/claimed/{document_id}/documents/destroy', [claimedDocumentController::class, 'destroy'])->name('admin.claimedDocuments.destroy');
    });

    // correspondent routes
    Route::prefix('/correspondent')->middleware('correspondent')->group(function () {
        Route::get('/', [correspondentController::class, 'index'])->name('correspondent');

        // profile routes
        Route::get('/profile', [correspondentController::class, 'profile'])->name('correspondent.profile');
        Route::get('/profile/edit', [correspondentController::class, 'EditProfile'])->name('correspondent.profile.edit');
        Route::put('/profile/update', [correspondentController::class, 'UpdateProfile'])->name('correspondent.profile.update');

        // drawers
        Route::get('/drawer', [DrawersController::class, 'index'])->name('correspondent.drawer');
        Route::get('/drawer/create', [DrawersController::class, 'create'])->name('correspondent.drawer.create');
        Route::post('/drawer/store', [DrawersController::class, 'store'])->name('correspondent.drawer.store');
        Route::get('/drawer/{drawer_id}/edit', [DrawersController::class, 'edit'])->name('correspondent.drawer.edit');
        Route::put('/drawer/{drawer_id}/update', [DrawersController::class, 'update'])->name('correspondent.drawer.update');
        Route::get('/drawer/{drawer_id}/view', [DrawersController::class, 'show'])->name('correspondent.drawer.show');
        Route::put('/drawer/{drawer_id}/report/lost', [DrawersController::class, 'lost'])->name('correspondent.drawer.lost');
        Route::put('/drawer/{drawer_id}/report/found', [DrawersController::class, 'found'])->name('correspondent.drawer.found');
        Route::delete('/drawer/{drawer_id}/destroy', [DrawersController::class, 'destroy'])->name('correspondent.drawer.destroy');

        // clients drawer
        Route::get('/clients/Drawer', [clientsDrawerController::class, 'index'])->name('correspondent.clientsDrawer');
        Route::get('/clients/Drawer/{drawer_id}/view', [clientsDrawerController::class, 'show'])->name('correspondent.clientsDrawer.view');
        Route::get('/clients/Drawer/{drawer_id}/edit', [clientsDrawerController::class, 'edit'])->name('correspondent.clientsDrawer.edit');

        // lost docuements
        Route::get('/lost/documents', [LostDocumentsController::class, 'index'])->name('correspondent.lostDocuments');
        Route::get('/lost/documents/create', [LostDocumentsController::class, 'create'])->name('correspondent.lostDocuments.create');
        Route::get('/lost/{document_id}/documents/view', [LostDocumentsController::class, 'show'])->name('correspondent.lostDocuments.view');
        Route::get('/lost/{document_id}/documents/edit', [LostDocumentsController::class, 'edit'])->name('correspondent.lostDocuments.edit');
        Route::put('/lost/{document_id}/documents/update', [LostDocumentsController::class, 'update'])->name('correspondent.lostDocuments.update');
        Route::delete('/lost/{document_id}/documents/destroy', [LostDocumentsController::class, 'destroy'])->name('correspondent.lostDocuments.destroy');

        // found documents routes
        Route::get('/found/documents', [FoundDocumentsController::class, 'index'])->name('correspondent.foundDocuments');
        Route::get('/found/{document_id}/documents/view', [FoundDocumentsController::class, 'show'])->name('correspondent.foundDocuments.view');
        Route::get('/found/document/create', [FoundDocumentsController::class, 'create'])->name('correspondent.foundDocuments.create');
        Route::get('/found/{document_id}/document/edit', [FoundDocumentsController::class, 'edit'])->name('correspondent.foundDocuments.edit');
        Route::put('/found/{document_id}/document/update', [FoundDocumentsController::class, 'update'])->name('correspondent.foundDocuments.update');
        Route::delete('/found/{document_id}/document/claim', [FoundDocumentsController::class, 'destroy'])->name('correspondent.foundDocuments.destroy');
    });

    // subscriber routes
    Route::prefix('/subscriber')->middleware('subscriber')->group(function () {
        Route::get('/', [subscriberController::class, 'index'])->name('subscriber');

        // profile routes
        Route::get('/profile', [subscriberController::class, 'profile'])->name('subscriber.profile');
        Route::get('/profile/edit', [subscriberController::class, 'EditProfile'])->name('subscriber.profile.edit');
        Route::put('/profile/update', [subscriberController::class, 'UpdateProfile'])->name('subscriber.profile.update');

        // drawers
        Route::get('/drawer', [DrawersController::class, 'index'])->name('subscriber.drawer');
        Route::get('/drawer/create', [DrawersController::class, 'create'])->name('subscriber.drawer.create');
        Route::post('/drawer/store', [DrawersController::class, 'store'])->name('subscriber.drawer.store');
        Route::get('/drawer/{drawer_id}/edit', [DrawersController::class, 'edit'])->name('subscriber.drawer.edit');
        Route::put('/drawer/{drawer_id}/update', [DrawersController::class, 'update'])->name('subscriber.drawer.update');
        Route::get('/drawer/{drawer_id}/view', [DrawersController::class, 'show'])->name('subscriber.drawer.show');
        Route::put('/drawer/{drawer_id}/report/lost', [DrawersController::class, 'lost'])->name('subscriber.drawer.lost');
        Route::put('/drawer/{drawer_id}/report/found', [DrawersController::class, 'found'])->name('subscriber.drawer.found');
        Route::delete('/mydrawer/{drawer_id}/destroy', [DrawersController::class, 'destroy'])->name('subscriber.drawer.destroy');

        // lost docuements
        Route::get('/lost/documents', [LostDocumentsController::class, 'index'])->name('subscriber.lostDocuments');
        Route::get('/lost/documents/create', [LostDocumentsController::class, 'create'])->name('subscriber.lostDocuments.create');
        Route::get('/lost/{document_id}/documents/view', [LostDocumentsController::class, 'show'])->name('subscriber.lostDocuments.view');
        Route::get('/lost/{document_id}/documents/edit', [LostDocumentsController::class, 'edit'])->name('subscriber.lostDocuments.edit');
        Route::put('/lost/{document_id}/documents/update', [LostDocumentsController::class, 'update'])->name('subscriber.lostDocuments.update');
        Route::delete('/lost/{document_id}/documents/destroy', [LostDocumentsController::class, 'destroy'])->name('subscriber.lostDocuments.destroy');

        // found documents routes
        Route::get('/found/documents', [FoundDocumentsController::class, 'index'])->name('subscriber.foundDocuments');
        Route::get('/found/{document_id}/documents/view', [FoundDocumentsController::class, 'show'])->name('subscriber.foundDocuments.view');
        Route::get('/found/document/create', [FoundDocumentsController::class, 'create'])->name('subscriber.foundDocuments.create');
        Route::get('/found/{document_id}/document/create', [FoundDocumentsController::class, 'edit'])->name('subscriber.foundDocuments.edit');
        Route::put('/found/{document_id}/document/update', [FoundDocumentsController::class, 'update'])->name('subscriber.foundDocuments.update');
        Route::delete('/found/{document_id}/document/claim', [FoundDocumentsController::class, 'destroy'])->name('subscriber.foundDocuments.destroy');
    });
});

// apollo sms api route
Route::post('/send-sms', [SmsController::class, 'sendSms']);
