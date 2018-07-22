# laravel-multi-language-trait
A simple trait for a multilingual site based on Laravel.

When the client requests / for the first time, it redirects to the language corresponding to the browser language (for example: / en) if it is supported, or to the default application language. The selected language is saved in the cookie. Also, a trait helps to check the validity of the requested locale and its support by the application, and also to remember the locale when switching.

## Usage
1. Copy "LangTrait.php" to "app/Traits"
2. Add array of supported locales ("supported_locales") to config/app.php
3. Configure routes
4. Configure controllers

## Routes example
```
Route::get('/', 'ExampleController@index');
Route::get('/{locale}', 'ExampleController@homePage');
Route::get('/{locale}/{page_url}', 'ExampleController@otherPage');
```

## Controllers example
```
namespace App\Http\Controllers;

use App\Traits\LangTrait;

class ExampleController extends Controller
{
    public function index()
    {
        return $this->initLang();
    }
  
    public function homePage($locale)
    {
        $this->checkLang($locale);
        return view('home');
    }
    
    public function otherPage($locale, $page_url)
    {
        $this->checkLang($locale);
        return view('page');
    }
}
```
