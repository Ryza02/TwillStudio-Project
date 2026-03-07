<?php

namespace App\Controllers;

class LanguageController extends BaseController
{
    public function switch($locale)
    {
        $session = session();
        
        // Cek apakah bahasa yang di-request didukung oleh sistem
        $supportedLocales = config('App')->supportedLocales;
        
        if (in_array($locale, $supportedLocales)) {
            $session->set('lang', $locale);
        }

        // Redirect kembali ke halaman asal pengguna menekan tombol
        return redirect()->back();
    }
}