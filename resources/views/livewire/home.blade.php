<div>
    <!-- Hero Section -->
    <div class="relative h-screen flex items-center justify-center overflow-hidden">
        <!-- Background Image with Overlay -->
        @if(count($slides) > 1)
            <!-- AlpineJS Crossfade Hero Slider -->
            <div class="absolute inset-0 z-0 bg-brand-dark" x-data="{ currentSlide: 0, total: {{ count($slides) }} }" x-init="setInterval(() => { currentSlide = (currentSlide + 1) % total }, 5000)">
                @foreach($slides as $index => $slide)
                    <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out"
                         x-show="currentSlide === {{ $index }}"
                         x-transition:enter="opacity-0"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                         x-transition:leave="opacity-0"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         style="display: {{ $index === 0 ? 'block' : 'none' }}">
                        <img src="{{ $slide->getImageUrl() }}" 
                             srcset="{{ $slide->getImageUrl('s') }} 400w, {{ $slide->getImageUrl('m') }} 800w, {{ $slide->getImageUrl() }} 1920w"
                             sizes="100vw"
                             class="w-full h-full object-cover origin-center scale-105" alt="{{ $slide->title }}">
                    </div>
                @endforeach
                <div class="absolute inset-0 bg-brand-dark/40 z-10"></div>
            </div>
        @elseif(count($slides) === 1)
            <!-- Single Static Hero Background -->
            @php $slide = $slides[0]; @endphp
            <div class="absolute inset-0 z-0">
                <img src="{{ $slide->getImageUrl() }}" 
                     srcset="{{ $slide->getImageUrl('s') }} 400w, {{ $slide->getImageUrl('m') }} 800w, {{ $slide->getImageUrl() }} 1920w"
                     sizes="100vw"
                     class="w-full h-full object-cover origin-center scale-105" alt="{{ $slide->title }}">
                <div class="absolute inset-0 bg-brand-dark/40 z-10"></div>
            </div>
        @else
            <!-- Fallback to Setting and then to Hardcoded Image -->
            @php
                $settingHeroImages = \App\Models\Setting::getValue('hero_images', []);
                if (!is_array($settingHeroImages)) $settingHeroImages = [$settingHeroImages];
                $fallbackImage = !empty($settingHeroImages) ? $settingHeroImages[0] : asset('images/gallery/DJI_0834-Edit-scaled.jpg');
            @endphp
            <div class="absolute inset-0 z-0">
                <img src="{{ $fallbackImage }}" class="w-full h-full object-cover origin-center scale-105" alt="Pruva Hero">
                <div class="absolute inset-0 bg-brand-dark/40 z-10"></div>
            </div>
        @endif
        
        <!-- Hero Content -->
        <div class="relative z-10 text-center px-4 max-w-5xl mx-auto pt-20">
            @if(count($slides) > 1)
                <div x-data="{ currentSlide: 0, total: {{ count($slides) }} }" x-init="setInterval(() => { currentSlide = (currentSlide + 1) % total }, 5000)">
                    @foreach($slides as $index => $slide)
                        <div x-show="currentSlide === {{ $index }}" 
                             x-transition:enter="transition ease-out duration-1000" 
                             x-transition:enter-start="opacity-0 translate-y-4" 
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-500" 
                             x-transition:leave-start="opacity-100 translate-y-0" 
                             x-transition:leave-end="opacity-0 -translate-y-4"
                             style="display: {{ $index === 0 ? 'block' : 'none' }}">
                            <p class="gsap-fade-in text-brand mb-4 md:mb-6 uppercase tracking-[0.3em] text-sm md:text-base font-medium">{{ $slide->sub_title ?: \App\Models\Setting::getValue('hero_welcome_text', __('Welcome to Pruva')) }}</p>
                            <h1 class="gsap-fade-in text-4xl md:text-6xl lg:text-7xl font-light text-white mb-8 tracking-wide leading-tight">
                                {!! $slide->title ?: \App\Models\Setting::getValue('hero_title', __('Pure Mediterranean Soul,<br><span class="font-normal italic">A Coastal Tale.</span>')) !!}
                            </h1>
                        </div>
                    @endforeach
                </div>
            @elseif(count($slides) === 1)
                 @php $slide = $slides[0]; @endphp
                 <p class="gsap-fade-in text-brand mb-4 md:mb-6 uppercase tracking-[0.3em] text-sm md:text-base font-medium">{{ $slide->sub_title ?: \App\Models\Setting::getValue('hero_welcome_text', __('Welcome to Pruva')) }}</p>
                 <h1 class="gsap-fade-in text-4xl md:text-6xl lg:text-7xl font-light text-white mb-8 tracking-wide leading-tight">
                    {!! $slide->title ?: \App\Models\Setting::getValue('hero_title', __('Pure Mediterranean Soul,<br><span class="font-normal italic">A Coastal Tale.</span>')) !!}
                 </h1>
            @else
                <p class="gsap-fade-in text-brand mb-4 md:mb-6 uppercase tracking-[0.3em] text-sm md:text-base font-medium">{{ \App\Models\Setting::getValue('hero_welcome_text', __('Welcome to Pruva')) }}</p>
                <h1 class="gsap-fade-in text-4xl md:text-6xl lg:text-7xl font-light text-white mb-8 tracking-wide leading-tight">
                    {!! \App\Models\Setting::getValue('hero_title', __('Pure Mediterranean Soul,<br><span class="font-normal italic">A Coastal Tale.</span>')) !!}
                </h1>
            @endif

            <div class="gsap-fade-in flex flex-col sm:flex-row gap-6 justify-center mt-12">
                <a href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale(), 'menu') }}" class="px-8 py-4 bg-brand text-brand-dark hover:bg-white transition-colors duration-300 uppercase tracking-widest text-sm font-medium rounded-full">
                    {{ \App\Models\Setting::getValue('hero_discover_menu_text', __('Discover Menu')) }}
                </a>
                 <a href="tel:{{ str_replace(' ', '', App\Models\Setting::getValue('phone', '905059878900')) }}" class="px-8 py-4 border border-white text-white hover:bg-white hover:text-brand-dark transition-colors duration-300 uppercase tracking-widest text-sm font-medium rounded-full">
                    {{ \App\Models\Setting::getValue('hero_book_table_text', __('Book a Table')) }}
                </a>
            </div>
        </div>
        
        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-10 animate-bounce">
            <svg class="w-6 h-6 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
        </div>
    </div>

    <!-- About Section -->
    <section class="py-24 md:py-32 bg-brand-light text-brand-dark px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-24 items-center">
                <div class="order-2 lg:order-1 relative">
                    <div class="gsap-fade-in aspect-[4/5] overflow-hidden rounded-3xl">
                        <img src="{{ \App\Models\Setting::getValue('story_image', asset('storage/gallery/029A5168.webp')) }}" 
                             srcset="{{ \App\Models\Setting::getValue('story_image', asset('storage/gallery/029A5168.webp'), 's') }} 400w, {{ \App\Models\Setting::getValue('story_image', asset('storage/gallery/029A5168.webp'), 'm') }} 800w, {{ \App\Models\Setting::getValue('story_image', asset('storage/gallery/029A5168.webp')) }} 1920w"
                             sizes="(max-width: 1024px) 100vw, 50vw"
                             class="w-full h-full object-cover hover:scale-105 transition-transform duration-700" alt="Restaurant Atmosphere">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <h2 class="gsap-fade-in text-brand-olive uppercase tracking-[0.2em] text-sm font-semibold mb-6">{{ \App\Models\Setting::getValue('about_welcome_text', __('Our Story')) }}</h2>
                    <h3 class="gsap-fade-in text-3xl md:text-5xl font-light leading-tight mb-8">{!! \App\Models\Setting::getValue('about_title', __('A flavor experience') . '<br><span class="italic text-brand-accent">' . __('away from the city\'s crowd') . '</span>') !!}</h3>
                    <p class="gsap-fade-in text-gray-600 mb-6 leading-relaxed font-light text-lg">
                        {{ \App\Models\Setting::getValue('about_description_1', __('Pruva Restaurant is a Mediterranean dining destination located on the Çukurbağ Peninsula in Kaş, Antalya. It specializes in fresh seafood, traditional Turkish mezze, and local Mediterranean flavors.')) }}
                    </p>
                    <p class="gsap-fade-in text-gray-600 mb-10 leading-relaxed font-light text-lg">
                        {{ \App\Models\Setting::getValue('about_description_2', __('Offering guests a vibrant experience that combines gourmet dining with entertainment and breathtaking sunset sea views.')) }}
                    </p>
                    <a href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale(), 'our-story') }}" class="gsap-fade-in inline-flex items-center text-brand-accent uppercase tracking-widest text-sm font-medium hover:text-brand-dark transition-colors group">
                        {{ \App\Models\Setting::getValue('about_button_text', __('Read Our Story')) }}
                        <svg class="ml-2 w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Experience Section (Parallax visual break) -->
    <section class="relative py-40 overflow-hidden flex items-center justify-center">
        <div class="absolute inset-0 z-0">
            @php
                $parallaxImage = \App\Models\Setting::getValue('parallax_image', asset('storage/gallery/029A5379.webp'));
            @endphp
            <img src="{{ $parallaxImage }}" class="w-full h-full object-cover" alt="Sunset Over Coast">
            <div class="absolute inset-0 bg-brand-dark/50"></div>
        </div>
        <div class="relative z-10 text-center max-w-4xl px-4">
            <h2 class="gsap-fade-in text-4xl md:text-6xl text-white font-light italic mb-8">{{ \App\Models\Setting::getValue('experience_title', __('"Connection Over the Coast"')) }}</h2>
            <p class="gsap-fade-in text-brand text-lg md:text-xl tracking-wide font-light">{{ \App\Models\Setting::getValue('experience_subtitle', __('The peace of the golden hour')) }}</p>
        </div>
    </section>

    <!-- Culinary Excellence -->
    <section class="py-24 md:py-32 bg-white text-brand-dark px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        <!-- SVG Pattern Background -->
        <div class="absolute inset-0 z-0 opacity-[0.03] pointer-events-none mix-blend-multiply" style="background-image: url('data:image/svg+xml,%3Csvg width='120' height='120' viewBox='0 0 120 120' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' stroke='%235B6E4E' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round' opacity='0.1'%3E%3Cpath d='M60 100 C 60 70 45 40 20 20'/%3E%3Cpath d='M60 100 C 65 70 85 40 110 20'/%3E%3Cellipse cx='35' cy='45' rx='10' ry='5' transform='rotate(-35 35 45)' fill='%235B6E4E' fill-opacity='0.2'/%3E%3Cellipse cx='45' cy='75' rx='8' ry='4' transform='rotate(-45 45 75)' fill='%235B6E4E' fill-opacity='0.2'/%3E%3Cellipse cx='85' cy='45' rx='10' ry='5' transform='rotate(35 85 45)' fill='%235B6E4E' fill-opacity='0.2'/%3E%3Cellipse cx='75' cy='75' rx='8' ry='4' transform='rotate(45 75 75)' fill='%235B6E4E' fill-opacity='0.2'/%3E%3Ccircle cx='60' cy='60' r='4' fill='%235B6E4E'/%3E%3Ccircle cx='55' cy='85' r='3.5' fill='%235B6E4E'/%3E%3C/g%3E%3C/svg%3E'); background-size: 120px 120px;"></div>
        
        <div class="max-w-7xl mx-auto text-center relative z-10">
            <h2 class="gsap-fade-in text-brand-olive uppercase tracking-[0.2em] text-sm font-semibold mb-4">{{ \App\Models\Setting::getValue('culinary_welcome_text', __('Culinary Excellence')) }}</h2>
            <h3 class="gsap-fade-in text-3xl md:text-5xl font-light leading-tight mb-16">{{ \App\Models\Setting::getValue('culinary_title', __('Crafted for the Senses')) }}</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
                @php
                    // Get top 3 top-level categories, or fallback to sensible defaults if none found
                    $topCategories = \App\Models\Category::whereNull('parent_id')
                                        ->where('is_active', true)
                                        ->orderBy('order_column')
                                        ->take(3)
                                        ->get();
                @endphp

                @forelse($topCategories as $category)
                    @php
                        $catSlug = $category->getTranslation('slug', app()->getLocale()) ?: $category->getTranslation('slug', 'en') ?: \Illuminate\Support\Str::slug($category->name);
                        
                        $favicon = \App\Models\Setting::getValue('favicon');
                        $faviconUrl = $favicon ? (str_starts_with($favicon, 'http') ? $favicon : \Illuminate\Support\Facades\Storage::url($favicon)) : null;

                        // 1. First choice: Use the category's uploaded image
                        if ($category->image) {
                            $catImgUrl = str_starts_with($category->image, 'http') ? $category->image : \Illuminate\Support\Facades\Storage::url($category->image);
                            $catImageHtml = "<img src=\"{$catImgUrl}\" class=\"absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700\" alt=\"{$category->name}\">";
                        } else {
                            // 2. Fallback to Favicon if no custom image is uploaded
                            if ($faviconUrl) {
                                $catImageHtml = "<div class=\"absolute inset-0 transition-all duration-1000 bg-white/5\">
                                                    <img src=\"{$faviconUrl}\" class=\"w-full h-full object-cover opacity-[0.07] filter grayscale group-hover:opacity-[0.12] group-hover:scale-110 transition-all duration-1000\" alt=\"{$category->name}\">
                                                </div>";
                            } else {
                                $catImageHtml = "<div class=\"absolute inset-0 bg-brand-olive/5 transition-all duration-700\"></div>";
                            }
                        }
                    @endphp
                    <a href="{{ route('menu', ['category' => $catSlug]) }}" wire:navigate class="gsap-fade-in group w-full block relative rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 min-h-[160px] md:min-h-[220px]">
                        {!! $catImageHtml !!}
                        <div class="absolute inset-0 bg-brand-dark/40 group-hover:bg-brand-dark/20 transition-colors duration-500"></div>
                        <div class="absolute inset-0 flex flex-col items-center justify-center p-6 text-center">
                            <h4 class="text-2xl md:text-3xl font-bold text-white tracking-widest uppercase drop-shadow-md">{{ $category->name }}</h4>
                            @if($category->description)
                                <p class="text-white/80 font-light text-sm mt-2 opacity-0 group-hover:opacity-100 transform translate-y-2 group-hover:translate-y-0 transition-all duration-500 hidden md:block">{{ \Illuminate\Support\Str::limit($category->description, 50) }}</p>
                            @endif
                        </div>
                    </a>
                @empty
                    <!-- Fallback if database is completely empty -->
                    <div class="col-span-3 text-center py-10 text-gray-400 italic">{{ __('Menu items are being prepared.') }}</div>
                @endforelse
            </div>
            
            <div class="mt-20">
                <a href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale(), 'menu') }}" class="gsap-fade-in inline-block px-10 py-4 border border-brand-dark text-brand-dark hover:bg-brand-dark hover:text-white transition-colors duration-300 uppercase tracking-widest text-sm rounded-full">
                    {{ \App\Models\Setting::getValue('culinary_button_text', __('View Full Menu')) }}
                </a>
            </div>
        </div>
    </section>

    <!-- Reviews Section -->
    <section class="py-24 md:py-32 bg-brand-light text-brand-dark px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        <!-- SVG Pattern Background (matching Menu section for continuity) -->
        <div class="absolute inset-0 z-0 opacity-[0.03] pointer-events-none mix-blend-multiply" style="background-image: url('data:image/svg+xml,%3Csvg width='120' height='120' viewBox='0 0 120 120' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' stroke='%235B6E4E' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round' opacity='0.1'%3E%3Cpath d='M60 100 C 60 70 45 40 20 20'/%3E%3Cpath d='M60 100 C 65 70 85 40 110 20'/%3E%3Cellipse cx='35' cy='45' rx='10' ry='5' transform='rotate(-35 35 45)' fill='%235B6E4E' fill-opacity='0.2'/%3E%3Cellipse cx='45' cy='75' rx='8' ry='4' transform='rotate(-45 45 75)' fill='%235B6E4E' fill-opacity='0.2'/%3E%3Cellipse cx='85' cy='45' rx='10' ry='5' transform='rotate(35 85 45)' fill='%235B6E4E' fill-opacity='0.2'/%3E%3Cellipse cx='75' cy='75' rx='8' ry='4' transform='rotate(45 75 75)' fill='%235B6E4E' fill-opacity='0.2'/%3E%3Ccircle cx='60' cy='60' r='4' fill='%235B6E4E'/%3E%3Ccircle cx='55' cy='85' r='3.5' fill='%235B6E4E'/%3E%3C/g%3E%3C/svg%3E'); background-size: 120px 120px;"></div>

        <div class="max-w-7xl mx-auto relative z-10 text-center">

            <div class="mt-24 space-y-8">
                <p class="gsap-fade-in text-brand-dark/60 font-medium uppercase tracking-[0.2em] text-sm">{{ \App\Models\Setting::getValue('testimonials_footer_text', __('Bizi ziyaret ettiniz mi?')) }}</p>
                <div class="gsap-fade-in flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ App\Models\Setting::getValue('google_reviews_url', 'https://www.google.com/search?q=Pruva+Restaurant+Kas+reviews#lkt=LocalPoiReviews') }}" target="_blank" class="px-8 py-3 bg-white border border-brand-olive/20 text-brand-olive hover:bg-brand-olive hover:text-white transition-all duration-300 text-xs font-bold uppercase tracking-widest rounded-full flex items-center justify-center gap-3">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                        </svg>
                        {{ \App\Models\Setting::getValue('testimonials_google_button', __('Google\'da Değerlendir')) }}
                    </a>
                    <a href="{{ App\Models\Setting::getValue('tripadvisor_reviews_url', 'https://www.tripadvisor.com.tr/Restaurant_Review-g297965-d27716705-Reviews-Pruva_Restaurant_Kas-Kas_Turkish_Mediterranean_Coast.html') }}" target="_blank" class="px-8 py-3 bg-white border border-brand-olive/20 text-brand-olive hover:bg-brand-olive hover:text-white transition-all duration-300 text-xs font-bold uppercase tracking-widest rounded-full flex items-center justify-center gap-3">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.006 4.295c-2.67 0-5.338.784-7.645 2.353H0l1.963 2.135a5.997 5.997 0 0 0 4.04 10.43 5.976 5.976 0 0 0 4.075-1.6L12 19.705l1.922-2.09a5.972 5.972 0 0 0 4.072 1.598 6 6 0 0 0 6-5.998 5.982 5.982 0 0 0-1.957-4.432L24 6.648h-4.35a13.573 13.573 0 0 0-7.644-2.353zM12 6.255c1.531 0 3.063.303 4.504.903C13.943 8.138 12 10.43 12 13.1c0-2.671-1.942-4.962-4.504-5.942A11.72 11.72 0 0 1 12 6.256zM6.002 9.157a4.059 4.059 0 1 1 0 8.118 4.059 4.059 0 0 1 0-8.118zm11.992.002a4.057 4.057 0 1 1 .003 8.115 4.057 4.057 0 0 1-.003-8.115zm-11.992 1.93a2.128 2.128 0 0 0 0 4.256 2.128 2.128 0 0 0 0-4.256zm11.992 0a2.128 2.128 0 0 0 0 4.256 2.128 2.128 0 0 0 0-4.256z"/>
                        </svg>
                        {{ \App\Models\Setting::getValue('testimonials_tripadvisor_button', __('TripAdvisor\'da Değerlendir')) }}
                    </a>
                </div>

                <!-- Private Feedback Trigger -->
                <livewire:feedback-form />
            </div>
        </div>
    </section>

    <!-- Blog Feed Section -->
    <livewire:blog-feed />
</div>
