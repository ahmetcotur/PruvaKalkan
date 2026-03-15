<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? App\Models\Setting::getValue('meta_title', __('Pruva Restaurant Kaş | The New Address of Flavor and Entertainment!')) }}</title>
        <meta name="description" content="{{ $description ?? App\Models\Setting::getValue('meta_description', __('Pruva Restaurant in Kaş, Antalya. Fresh Mediterranean seafood, traditional Turkish mezze, and unforgettable sunset views.')) }}">
        <meta property="og:title" content="{{ $title ?? App\Models\Setting::getValue('meta_title', __('Pruva Restaurant Kaş | The New Address of Flavor and Entertainment!')) }}">
        <meta property="og:description" content="{{ $description ?? App\Models\Setting::getValue('meta_description', __('Pruva Restaurant in Kaş, Antalya. Fresh Mediterranean seafood, traditional Turkish mezze, and unforgettable sunset views.')) }}">
        <meta property="og:image" content="{{ App\Models\Setting::getValue('logo', asset('images/logo.png')) }}">
        <link rel="icon" type="image/png" href="{{ App\Models\Setting::getValue('favicon', asset('favicon.png')) }}">
        
        <style>
            :root {
                --color-brand-olive: {{ App\Models\Setting::getValue('brand_olive', '#5c6448') }};
                --color-brand-light: {{ App\Models\Setting::getValue('brand_light', '#f5f1e6') }};
                --color-brand-dark: {{ App\Models\Setting::getValue('brand_dark', '#2c2e27') }};
            }
        </style>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans">
        <livewire:navbar />
        
        <main class="min-h-screen">
            {{ $slot }}
        </main>
        
        <livewire:footer />

        <!-- Cookie Consent Banner -->
        <div x-data="{ 
                showCookieConsent: false,
                init() {
                    if (!localStorage.getItem('cookie_consent')) {
                        setTimeout(() => this.showCookieConsent = true, 1000);
                    }
                },
                accept() {
                    localStorage.setItem('cookie_consent', 'true');
                    this.showCookieConsent = false;
                }
             }" 
             x-show="showCookieConsent" 
             x-transition:enter="transition ease-out duration-500"
             x-transition:enter-start="opacity-0 translate-y-10"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 translate-y-10"
             class="fixed bottom-4 left-4 right-4 md:left-auto md:right-8 md:bottom-8 md:max-w-sm bg-brand-light border border-brand-dark/10 shadow-2xl z-[100] rounded-lg p-5 flex flex-col gap-4 text-brand-dark"
             style="display: none;">
             
             <div>
                 <h4 class="text-xs font-semibold tracking-wider text-brand-olive uppercase mb-2">{{ __('Cookie Settings') }}</h4>
                 <p class="text-xs font-light text-gray-600 leading-relaxed">
                     {{ __('We use cookies to enhance your experience, analyze site traffic, and serve tailored content. By continuing to browse, you agree to our use of cookies.') }}
                 </p>
             </div>
             
             <div class="flex items-center justify-end space-x-4 mt-2 border-t border-brand-dark/5 pt-4">
                 <a href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale(), 'privacy-policy') }}" class="text-[10px] uppercase font-medium tracking-widest text-gray-500 hover:text-brand-dark transition-colors">{{ __('Privacy Policy') }}</a>
                 <button @click="accept()" class="px-5 py-2.5 bg-brand-olive text-white hover:bg-brand-dark transition-colors duration-300 text-[10px] uppercase tracking-widest font-medium rounded-sm">
                     {{ __('Accept') }}
                 </button>
             </div>
        </div>
    </body>
</html>
