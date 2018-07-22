<?php

namespace App\Traits;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

trait LangTrait 
{
	public function initLang()
	{
		// Get app lang data
		$app_locale = config('app.locale');
		$app_supported_locales = config('app.supported_locales');
	
		// Get client's lang data
		$browser_lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
		$cookie_lang = Cookie::get('lang');
	
		// If lang cookie set
		if (!empty($cookie_lang) && in_array($cookie_lang, $app_supported_locales)) 
		{
			return redirect('/' . $cookie_lang);
		}
	
		// If lang cookie unset, check browser
		if (in_array($browser_lang, $app_supported_locales)) 
		{
			return redirect('/' . $browser_lang);
		}
	
		// Default redirect to main lang
		return redirect('/' . $app_locale);
	}
	
	public function checkLang($locale)
	{
		// Checking requested locale support
		if (in_array($locale, config('app.supported_locales'))) 
		{	
			// If supported, set app locale
			App::setLocale($locale);
			Cookie::queue('lang', $locale, 60*24*30);
		} else {
			// If locale not supported, 404 error
			abort('404');
		}
	}
}
