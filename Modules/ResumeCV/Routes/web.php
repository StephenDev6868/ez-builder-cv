<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('help', 'ResumeCVController@help')->name('help');

Route::get('templates/{id?}', 'ResumecvtemplateController@getAllTemplateThemes')->name('templates');

Route::get('publish/{slug}', 'ResumeCVController@publish')->name('resumecv.publish');
Route::post('get-page-json/{code}', 'ResumeCVController@getPageJson');


Route::middleware('auth')->group(function () {


		Route::get('alltemplates/{id?}', 'ResumecvtemplateController@getAllTemplate')->name('alltemplates');
		
		Route::prefix('resumecv')->group(function() {
			Route::get('download/{item}', 'ResumeCVController@download')->name('resumecv.download');
		    Route::get('/', 'ResumeCVController@index')->name('resumecv.index');
		    Route::get('builder/{code}/{type?}', 'ResumeCVController@builder')->name('resumecv.builder');
			Route::post('save', 'ResumeCVController@save')->name('resumecv.save');
			// Load builder
			Route::post('update-builder/{id}', 'ResumeCVController@updateBuilder')->name('resumecv.updateBuilder');
			Route::get('load-builder/{id}', 'ResumeCVController@loadBuilder')->name('resumecv.loadBuilder');
			Route::post('clone/{item}', 'ResumeCVController@clone')->name('resumecv.clone');
			Route::delete('delete/{item}', 'ResumeCVController@delete')->name('resumecv.delete');

			Route::post('uploadimage', 'ResumeCVController@uploadImage');
	    	Route::post('deleteimage', 'ResumeCVController@deleteImage');
	    	Route::get('setting/{item}', 'ResumeCVController@setting')->name('resumecv.setting');
			Route::post('setting-update/{item}', 'ResumeCVController@settingUpdate')->name('resumecv.settings.update');
		});

		// Saas module
		if (Module::find('Saas')) {
			Route::middleware('Modules\Saas\Http\Middleware\Billing')->group(function () {
				Route::prefix('resumecv')->group(function() {
					Route::get('download/{item}', 'ResumeCVController@download')->name('resumecv.download');
					Route::post('save', 'ResumeCVController@save')->name('resumecv.save');
					Route::post('clone/{item}', 'ResumeCVController@clone')->name('resumecv.clone');
				});
			});
		}

  

	// For admin and user
    Route::post('resumecvtemplate/loadtemplate/{id}', 'ResumecvtemplateController@loadTemplate')->name('loadtemplate');
	Route::post('resumecvtemplate/uploadimage', 'ResumecvtemplateController@uploadImage');
	Route::post('resumecvtemplate/deleteimage', 'ResumecvtemplateController@deleteImage');

	Route::middleware('can:admin')->prefix('settings')->name('settings.')->group(function () {
		
		Route::get('userResumecvs', 'ResumeCVController@userResumecvs')->name('userResumecvs');
		Route::resource('resumecvtemplate', 'ResumecvtemplateController')->except('show');
		Route::resource('resumecvcategories', 'ResumecvcategoryController')->except('show');

		Route::post('resumecvtemplate/uploadimage', 'ResumecvtemplateController@uploadImage')->name('resumecvtemplate.uploadimage');
	    Route::post('resumecvtemplate/deleteimage', 'ResumecvtemplateController@deleteImage')->name('resumecvtemplate.deleteimage');

		Route::post('resumecvtemplate/clone/{id}', 'ResumecvtemplateController@clone')->name('resumecvtemplate.clone');
		// Builder template
		Route::get('resumecvtemplate/builder/{id}/{type?}', 'ResumecvtemplateController@builder')->name('resumecvtemplate.builder');
		
		// Load template builder
		Route::get('resumecvtemplate/load-builder/{id}', 'ResumecvtemplateController@loadBuilder')->name('resumecvtemplate.loadBuilder');

		Route::post('resumecvtemplate/update-builder/{id}', 'ResumecvtemplateController@updateBuilder')->name('resumecvtemplate.updateBuilder');


	});
});