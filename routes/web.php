<?php
use App\Http\Controllers\ReturnController;

Route::middleware(['genuine'])->group(function(){
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('books', 'BookController');
Route::post('books/search', 'BookController@livesearch')->name('searchbook');
Route::get('book/view', 'BookController@viewallbook')->name('viewbook');
Route::get('book/{id}/details', 'BookController@viewallbookDetail')->name('viewbook.detail');
Route::get('book/record', 'BookController@record')->name('record.list');
Route::get('stat', 'RecordController@statistics')->name('stat');
Route::get('/get-authors', 'BookController@getAuthors');
Route::resource('users', 'UserController')->middleware('checkId');
// Route::resource('users', 'UserController');

Route::resource('members', 'MemberController');

Route::post('/save-cropped-image', 'UserController@saveCroppedImage')->name('save-cropped-image');
Route::post('/save-cropped-image1', 'UserController@saveCroppedImage1')->name('save-cropped-image1');
Route::resource('tasks', 'TaskController');
Route::get('users/{user}/profile', 'UserController@profile')->name('profile')->middleware('admin', 'checkId');

//Sync Data Route
Route::get('/list', 'SyncController@list')->name('list');

//Backup Database Route
Route::get('/backup', 'HomeController@backup')->name('backup');
Route::get('/download-backup', 'HomeController@downloadBackup')->name('download-backup');
Route::get('/localbackup', 'HomeController@localbackup')->name('localbackup');
Route::get('/backupredirect', 'HomeController@backupredirect')->name('backupredirect');
Route::get('/downloadCsv', 'SyncController@downloadCsv')->name('downloadCsv');

Route::get('book/import-books', 'HomeController@importBooks')->name('import')->middleware('admin');
Route::get('/export-books', 'BookController@exportBooks')->name('export')->middleware('admin');
Route::post('/upload-books', 'HomeController@uploadBooks')->name('upload')->middleware('admin');
Route::get('/download-format', 'HomeController@downloadFormat')->name('download.format')->middleware('admin');

//Barcode Route
Route::get('/code', 'BarcodeController@index')->name('code');
Route::get('/code/range', 'BarcodeController@range')->name('range');
Route::post('/code/rangeList', 'BarcodeController@rangeList')->name('rangeList');
Route::get('/code/rangeQR', 'BarcodeController@rangeQR')->name('rangeQR');
Route::post('/code/rangeQRList', 'BarcodeController@rangeQRList')->name('rangeQRList');
Route::get('/code/{id}/barcode', 'BarcodeController@barcode')->name('barcode');
Route::get('/code/{id}/barcode/position', 'BarcodeController@barcodeposition')->name('barcodeposition');
Route::post('/code/barcode/barposition', 'BarcodeController@position')->name('barposition');
Route::get('/code/{id}/qrcode', 'BarcodeController@qrcode')->name('qrcode');
Route::get('/code/multibar', 'BarcodeController@multibar')->name('multibar');
Route::get('/code/mutliqr', 'BarcodeController@multiqr')->name('multiqr');
Route::post('/code/mutlibarprint', 'BarcodeController@multibarprint')->name('multibarprint');
Route::post('/code/mutliqrprint', 'BarcodeController@multiqrprint')->name('multiqrprint');

//Members Record Route
Route::get('members/{id}/record', 'MemberController@record')->name('record');
Route::get('members/{id}/notRet', 'MemberController@notReturn')->name('notReturn');
Route::get('rating/{id}/member', 'MemberController@ratings')->name('rating');
Route::get('inactive/{id}/member', 'MemberController@inactive')->name('inactive');
Route::get('activate/{id}/member', 'MemberController@activate')->name('activate');
Route::get('deactivate/member', 'MemberController@deactivate')->name('deactivate');
Route::get('deactivate/{id}/member', 'MemberController@deactivateMember')->name('deactivate.member');
Route::get('validity/{id}', 'MemberController@validity')->name('validity');
Route::put('validity/{id}/update', 'MemberController@updateValidity')->name('update.validity');

//Issue Books Route
Route::get('search', 'IssueController@action')->name('search');
Route::get('search_book', 'IssueController@list')->name('search_book');
Route::get('issue', 'IssueController@index')->name('issue');
Route::post('issue/addissue', 'IssueController@add_issue')->name('add.issue');
Route::get('issue/{id}/member', 'IssueController@issue')->name('issue.member');
Route::get('issue/dynamic-field/{id}/member', 'DynamicFieldController@index')->name('dynamic-field');
Route::post('issue/dynamic-field/insert', 'DynamicFieldController@insert')->name('dynamic-field.insert');

//Return Books Route
Route::get('return', 'ReturnController@index')->name('return');
Route::get('return/books/{id}/member', 'ReturnController@return')->name('returnBooks');
Route::get('return/books/{id}/return', 'ReturnController@retBooks')->name('retBooks');
Route::get('retSearch', 'ReturnController@action')->name('retSearch');
Route::get('retBybook', 'ReturnController@retBybook')->name('retBybook');
Route::get('retSearch1', 'ReturnController@action1')->name('retSearch1');
Route::get('return/booksonly/{id}/return', 'ReturnController@retBooksonly')->name('retBooksonly');
Route::get('return/books/{id}/books', 'ReturnController@returnBook')->name('returnbyBooks');
Route::get('return/allbooks/{encodedIds}', 'ReturnController@returnAllBooks')->name('return.all');

//Receipt print
Route::get('/{id}/invoice', 'ReturnController@receipt')->name('inv');
Route::get('/receipt', 'ReceiptController@index')->name('receipt');

//Generate ID
Route::get('generateid', 'MemberController@generateid')->name('generateid');
Route::get('generateid/{id}/member', 'MemberController@generateidnow')->name('generateidmember');
Route::post('generateid/{id}/image', 'MemberController@image')->name('image');

//Report Route
Route::get('report', 'ReturnreportController@index')->name('report');
Route::get('retreport/{id}/report', 'ReturnreportController@retreport')->name('retreport');

// Caching Route
Route::get('ionicons.css', 'CacheController@ionicons')->name('ionicons.css');
Route::get('google-fonts.css', 'CacheController@google_fonts')->name('google_fonts');
Route::get('google-api.css', 'CacheController@google_api')->name('google_api');
Route::get('material-icons.css', 'CacheController@material_icons')->name('material_icons');
Route::get('dns-prefetch', 'CacheController@dns_prefetch')->name('dns_prefetch');

// Setting Route
Route::group(['middleware' => ['admin']], function(){

    //Author Route
    Route::get('author', 'AuthorController@index')->name('authors.index');
    Route::get('author/create', 'AuthorController@create')->name('authors.create');
    Route::post('author/store', 'AuthorController@store')->name('authors.store');
    Route::get('author/{id}/edit', 'AuthorController@edit')->name('authors.edit');
    Route::post('author/{id}/update', 'AuthorController@update')->name('authors.update');
    Route::delete('author/{id}/destroy', 'AuthorController@destroy')->name('authors.destroy');
    Route::get('/author/import', 'AuthorController@importAuthor')->name('authors.import');
    Route::post('/author/upload', 'AuthorController@uploadAuthor')->name('authors.upload');
    Route::get('/author/export', 'AuthorController@exportAuthor')->name('authors.export');
    Route::get('/author/sync', 'AuthorController@authorSync')->name('authors.sync');

    //Publisher Route
    Route::get('publisher', 'PublisherController@index')->name('publishers.index');
    Route::get('publisher/create', 'PublisherController@create')->name('publishers.create');
    Route::post('publisher/store', 'PublisherController@store')->name('publishers.store');
    Route::get('publisher/{id}/edit', 'PublisherController@edit')->name('publishers.edit');
    Route::post('publisher/{id}/update', 'PublisherController@update')->name('publishers.update');
    Route::delete('publisher/{id}/destroy', 'PublisherController@destroy')->name('publishers.destroy');
    Route::get('/publisher/import', 'PublisherController@importPublisher')->name('publishers.import');
    Route::post('/publisher/upload', 'PublisherController@uploadPublisher')->name('publishers.upload');
    Route::get('/publisher/export', 'PublisherController@exportPublisher')->name('publishers.export');
    Route::get('/publisher/sync', 'PublisherController@publisherSync')->name('publisher.sync');

    Route::get('fines', 'SettingController@fines')->name('settings.fines');
    Route::put('fines/{id}/update', 'SettingController@updateFines')->name('settings.update.fines');

    Route::get('period', 'SettingController@period')->name('settings.period');
    Route::put('period/{id}/update', 'SettingController@updatePeriod')->name('settings.update.period');

    Route::get('user', 'SettingController@user')->name('settings.user');
    Route::post('user/{id}/update', 'SettingController@updateUser')->name('settings.update.user');

    Route::get('idPrefix', 'SettingController@idPrefix')->name('settings.idPrefix');
    Route::post('idPrefix/{id}/update', 'SettingController@updateIdPrefix')->name('settings.update.idPrefix');

    Route::get('printcode', 'SettingController@printCode')->name('settings.printcode');
    Route::put('printcode/{id}/update', 'SettingController@updatePrintCode')->name('settings.update.printcode');
    });
});

Route::view('/', 'welcome');
Route::get('unauthorized', 'CheckController@unauthorzed')->name('error.400');

Auth::routes();

Route::get('software.code', 'CheckController@check')->name('checking');
Route::post('verify', 'CheckController@verify')->name('verifying');

