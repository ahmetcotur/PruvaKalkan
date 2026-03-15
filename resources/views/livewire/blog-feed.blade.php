<section class="py-24 md:py-32 bg-brand-light text-brand-dark px-4 sm:px-6 lg:px-8 border-t border-brand-dark/10 relative overflow-hidden">
    <!-- SVG Pattern Background -->
    <div class="absolute inset-0 z-0 opacity-[0.03] pointer-events-none mix-blend-multiply" style="background-image: url('data:image/svg+xml,%3Csvg width='120' height='120' viewBox='0 0 120 120' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' stroke='%235B6E4E' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round' opacity='0.1'%3E%3Cpath d='M60 100 C 60 70 45 40 20 20'/%3E%3Cpath d='M60 100 C 65 70 85 40 110 20'/%3E%3Cellipse cx='35' cy='45' rx='10' ry='5' transform='rotate(-35 35 45)' fill='%235B6E4E' fill-opacity='0.2'/%3E%3Cellipse cx='45' cy='75' rx='8' ry='4' transform='rotate(-45 45 75)' fill='%235B6E4E' fill-opacity='0.2'/%3E%3Cellipse cx='85' cy='45' rx='10' ry='5' transform='rotate(35 85 45)' fill='%235B6E4E' fill-opacity='0.2'/%3E%3Cellipse cx='75' cy='75' rx='8' ry='4' transform='rotate(45 75 75)' fill='%235B6E4E' fill-opacity='0.2'/%3E%3Ccircle cx='60' cy='60' r='4' fill='%235B6E4E'/%3E%3Ccircle cx='55' cy='85' r='3.5' fill='%235B6E4E'/%3E%3C/g%3E%3C/svg%3E'); background-size: 120px 120px;"></div>

    <div class="max-w-7xl mx-auto relative z-10">
        <div class="text-center mb-16">
            <h2 class="gsap-fade-in text-brand-olive uppercase tracking-[0.2em] text-sm font-semibold mb-4">{{ __('Journal & Stories') }}</h2>
            <h3 class="gsap-fade-in text-3xl md:text-5xl font-light leading-tight text-brand-dark">{{ __('Latest Articles') }}</h3>
        </div>

        @if($error)
            <div class="text-center py-12 text-gray-500 font-light italic">
                {{ __('Curently unable to load the latest stories. Please check our') }} <a href="https://pruvakas.com.tr/blog" class="text-brand-olive hover:underline" target="_blank">{{ __('blog page') }}</a>.
            </div>
        @elseif(empty($posts))
            <div class="text-center py-12 text-gray-500 font-light italic">
                Loading stories...
            </div>
        @else
            <!-- Horizontal Scrollable Container -->
            <div class="flex flex-nowrap overflow-x-auto gap-6 pb-12 pt-4 items-stretch snap-x snap-mandatory hide-scrollbar -mx-4 px-4 sm:mx-0 sm:px-0">
                @foreach($posts as $post)
                    <a href="{{ $post['link'] }}" class="snap-start flex-none w-[85vw] sm:w-[320px] md:w-[350px] group flex flex-col bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-shadow duration-500 border border-brand-dark/5">
                        
                        <!-- Image Container with aspect ratio -->
                        <div class="aspect-video w-full overflow-hidden relative flex-shrink-0 bg-brand-light">
                            @php
                                $imgSrc = trim((string)$post['image']);
                                if (empty($imgSrc) || str_contains($imgSrc, '/plugins/')) {
                                    $blogPlaceholders = ['029A0982.jpg', '029A0973.jpg', '029A5151.jpg', '029A5168.jpg', '029A1008.jpg'];
                                    $randomBlogPh = $blogPlaceholders[array_rand($blogPlaceholders)];
                                    $finalImg = asset('images/gallery/' . $randomBlogPh);
                                } else {
                                    $finalImg = asset('images/' . $imgSrc);
                                }
                            @endphp
                            <img src="{{ $finalImg }}" alt="{{ $post['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                            <div class="absolute inset-0 bg-brand-dark/10 group-hover:bg-transparent transition-colors duration-500"></div>
                        </div>
                        
                        <!-- Content -->
                        <div class="p-6 flex flex-col flex-grow justify-between">
                            <div>
                                <span class="text-[10px] text-brand-olive uppercase tracking-widest font-semibold mb-2 block">{{ $post['date'] }}</span>
                                <h4 class="text-lg font-medium text-brand-dark mb-3 leading-snug group-hover:text-brand-olive transition-colors">{{ \Illuminate\Support\Str::limit($post['title'], 50) }}</h4>
                                <p class="text-gray-500 font-light text-xs leading-relaxed">{{ \Illuminate\Support\Str::limit($post['description'], 90) }}</p>
                            </div>
                            
                            <div class="mt-6 pt-4 border-t border-brand-dark/5 flex items-center justify-between text-[10px] text-brand-dark uppercase tracking-widest font-medium group-hover:text-brand-olive transition-colors">
                                <span>Read More</span>
                                <svg class="w-3 h-3 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            
            <style>
                .hide-scrollbar::-webkit-scrollbar {
                    display: none;
                }
                .hide-scrollbar {
                    -ms-overflow-style: none;
                    scrollbar-width: none;
                }
            </style>
        @endif
        
        <div class="mt-16 text-center">
            <a href="/blog" class="gsap-fade-in inline-block px-10 py-4 border border-brand-dark text-brand-dark hover:bg-brand-dark hover:text-white transition-colors duration-300 uppercase tracking-widest text-xs font-medium rounded-full">{{ __('View All Stories') }}</a>
        </div>
    </div>
</section>
