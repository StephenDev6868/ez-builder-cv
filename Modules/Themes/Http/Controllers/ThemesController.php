<?php

namespace Modules\Themes\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\User\Entities\User;
use Illuminate\Support\Facades\App;
use JoeDixon\Translation\Drivers\Translation;
use Module;
use Modules\ResumeCV\Entities\Resumecvtemplate;
use Modules\ResumeCV\Entities\Resumecvcategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Blogs\Entities\Blog;
use Modules\Blogs\Entities\Category;
use Modules\Contacts\Entities\Contact;

use Modules\Location\Entities\City;
use Modules\Tracklink\Entities\Tracklink;

class ThemesController extends Controller
{
    public function __construct(Translation $translation)
    {
        $this->translation = $translation;
    }
    
    public function getLandingPage(Request $request)
    {
        return redirect()->to('login');
        $skin            = config('app.SITE_LANDING');
        $currency_symbol         = config('app.CURRENCY_SYMBOL');
        $currency_code   = config('app.CURRENCY_CODE');
        $user            = $request->user();
        return view('themes::' . $skin . '.home', compact(
            'user','currency_symbol','currency_code'
        ));

    }
    
    public function localize($locale)
    {
        
        $languages = $this->translation->allLanguages();
        $locale = $languages->has($locale) ? $locale : config('app.fallback_locale');

        App::setLocale($locale);

        session()->put('locale', $locale);

        return redirect()->back();
    }
}
