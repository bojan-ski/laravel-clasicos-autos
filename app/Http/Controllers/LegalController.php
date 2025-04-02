<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class LegalController extends Controller
{
     /**
     * Display privacy policy page
     */
    public function privacyPolicy(): View{
        return view('legal.privacy_policy');
    }

     /**
     * Display terms & conditions page
     */
    public function termsAndConditions(): View{
        return view('legal.terms_and_conditions');
    }
}
