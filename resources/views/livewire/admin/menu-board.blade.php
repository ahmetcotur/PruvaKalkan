<div class="space-y-6">
    <!-- Header with Locale Switcher and Main Categories -->
    <div class="flex items-center justify-between border-b border-gray-200 dark:border-gray-700 pb-px">
        <div class="flex space-x-2">
            @foreach($mainCategories as $mainCat)
                <button 
                    wire:click="selectMainCategory({{ $mainCat->id }})"
                    @class([
                        'px-6 py-3 text-sm font-medium transition-colors border-b-2 -mb-px',
                        'border-primary-500 text-primary-600 dark:text-primary-400' => $selectedMainCategoryId == $mainCat->id,
                        'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300' => $selectedMainCategoryId != $mainCat->id,
                    ])
                >
                    {{ $mainCat->getTranslation('name', $activeLocale) }}
                </button>
            @endforeach
        </div>

        <div class="flex items-center space-x-2 mr-4">
             <button wire:click="$set('activeLocale', 'tr')" @class(['px-2 py-1 text-xs font-bold rounded', 'bg-primary-500 text-white' => $activeLocale == 'tr', 'bg-gray-200 text-gray-700' => $activeLocale != 'tr'])>TR</button>
             <button wire:click="$set('activeLocale', 'en')" @class(['px-2 py-1 text-xs font-bold rounded', 'bg-primary-500 text-white' => $activeLocale == 'en', 'bg-gray-200 text-gray-700' => $activeLocale != 'en'])>EN</button>
        </div>
    </div>

    <!-- Kanban Board -->
    <div class="flex space-x-6 overflow-x-auto pb-6 scrollbar-thin scrollbar-thumb-gray-300 dark:scrollbar-thumb-gray-600">
        <div 
            class="flex space-x-6"
            x-data="{
                init() {
                    new Sortable(this.$el, {
                        animation: 150,
                        handle: '.category-handle',
                        ghostClass: 'opacity-50',
                        onEnd: (evt) => {
                            let categories = Array.from(this.$el.children)
                                .filter(el => el.dataset.id)
                                .map((el, index) => {
                                    return { value: el.dataset.id, order: index + 1 };
                                });
                            $wire.updateCategoryOrder(categories);
                        }
                    });
                }
            }"
        >

            <!-- Direct Items Column (Root Level of selected Main Menu) -->
            @if($directItems->count() > 0 || $categories->count() == 0)
                <div 
                    class="flex-shrink-0 w-80 bg-gray-50 dark:bg-gray-800/50 rounded-xl border border-dashed border-gray-300 dark:border-gray-600 flex flex-col h-full max-h-[calc(100vh-16rem)]"
                >
                    <div class="p-4 flex items-center justify-between border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center space-x-2">
                            <h3 class="font-bold text-gray-500 dark:text-gray-400">
                                {{ __('General Items') }}
                            </h3>
                        </div>
                        <span class="text-xs font-medium px-2 py-0.5 bg-gray-200 dark:bg-gray-700 rounded-full text-gray-500">
                            {{ $directItems->count() }}
                        </span>
                    </div>

                    <div 
                        data-category-id="{{ $selectedMainCategoryId }}"
                        class="items-container p-3 space-y-3 overflow-y-auto flex-grow min-h-[100px]"
                        x-data="{
                            init() {
                                new Sortable(this.$el, {
                                    group: 'menu-items',
                                    animation: 150,
                                    handle: '.item-handle',
                                    ghostClass: 'opacity-50',
                                    onEnd: (evt) => {
                                        let items = [];
                                        document.querySelectorAll('.items-container').forEach(container => {
                                            let cid = container.dataset.categoryId;
                                            Array.from(container.children)
                                                .filter(el => el.dataset.id)
                                                .forEach((el, index) => {
                                                    items.push({ value: el.dataset.id, order: index + 1, category_id: cid });
                                                });
                                        });
                                        $wire.updateItemOrder(items);
                                    }
                                });
                            }
                        }"
                    >
                        @foreach($directItems as $item)
                            <div 
                                wire:key="direct-item-{{ $item->id }}"
                                data-id="{{ $item->id }}"
                                class="p-3 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 hover:border-primary-300 transition-all cursor-pointer group relative"
                                x-on:click="$wire.mountAction('editItem', { id: {{ $item->id }} })"
                            >
                                <div class="flex justify-between items-start mb-1">
                                    <h4 class="font-semibold text-sm text-gray-900 dark:text-white group-hover:text-primary-600">
                                        {{ $item->getTranslation('name', $activeLocale) }}
                                    </h4>
                                    <span class="text-xs font-bold text-primary-600">
                                        {{ $item->price }} ₺
                                    </span>
                                </div>
                                <div class="mt-2 flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <span @class(['w-2 h-2 rounded-full', 'bg-emerald-400' => $item->is_active, 'bg-rose-400' => !$item->is_active])></span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <span class="text-[10px] text-gray-400 font-mono">#{{ $item->id }}</span>
                                        <span title="Drag to reorder" class="item-handle cursor-grab active:cursor-grabbing text-gray-300 hover:text-primary-500 transition-colors" x-on:click.stop>
                                            <x-heroicon-m-arrows-up-down class="w-4 h-4" />
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="p-3 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 rounded-b-xl">
                        <button 
                            x-on:click="$wire.mountAction('createItem', { categoryId: {{ $selectedMainCategoryId }} })"
                            class="w-full py-2 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg text-sm font-medium text-gray-500 hover:text-primary-500 hover:border-primary-500 transition-colors bg-white dark:bg-gray-800"
                        >
                            + Add Item
                        </button>
                    </div>
                </div>
            @endif

            @foreach($categories as $category)
                <div 
                    wire:key="category-{{ $category->id }}"
                    data-id="{{ $category->id }}"
                    class="flex-shrink-0 w-80 bg-gray-50 dark:bg-gray-800/50 rounded-xl border border-gray-200 dark:border-gray-700 flex flex-col h-full max-h-[calc(100vh-16rem)]"
                >
                    <!-- Category Header -->
                    <div class="p-4 flex items-center justify-between border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center space-x-2">
                            <span class="category-handle cursor-grab active:cursor-grabbing text-gray-400 hover:text-gray-600">
                                <x-heroicon-o-bars-3 class="w-5 h-5" />
                            </span>
                            <h3 class="font-bold text-gray-900 dark:text-white truncate max-w-[150px]" title="{{ $category->getTranslation('name', $activeLocale) }}">
                                {{ $category->getTranslation('name', $activeLocale) }}
                            </h3>
                        </div>
                        <div class="flex items-center space-x-2">
                             <button x-on:click="$wire.mountAction('editCategory', { id: {{ $category->id }} })" class="text-gray-400 hover:text-primary-500">
                                <x-heroicon-o-pencil-square class="w-4 h-4" />
                            </button>
                            <span class="text-xs font-medium px-2 py-0.5 bg-gray-200 dark:bg-gray-700 rounded-full text-gray-600 dark:text-gray-400">
                                {{ $category->menuItems->count() }}
                            </span>
                        </div>
                    </div>

                    <!-- Items List -->
                    <div 
                        data-category-id="{{ $category->id }}"
                        class="items-container p-3 space-y-3 overflow-y-auto flex-grow min-h-[100px]"
                        x-data="{
                            init() {
                                new Sortable(this.$el, {
                                    group: 'menu-items',
                                    animation: 150,
                                    handle: '.item-handle',
                                    ghostClass: 'opacity-50',
                                    onEnd: (evt) => {
                                        let items = [];
                                        document.querySelectorAll('.items-container').forEach(container => {
                                            let cid = container.dataset.categoryId;
                                            Array.from(container.children)
                                                .filter(el => el.dataset.id)
                                                .forEach((el, index) => {
                                                    items.push({ value: el.dataset.id, order: index + 1, category_id: cid });
                                                });
                                        });
                                        $wire.updateItemOrder(items);
                                    }
                                });
                            }
                        }"
                    >
                        @foreach($category->menuItems as $item)
                            <div 
                                wire:key="item-{{ $item->id }}"
                                data-id="{{ $item->id }}"
                                class="p-3 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 hover:border-primary-300 dark:hover:border-primary-700 transition-all cursor-pointer group relative"
                                x-on:click="$wire.mountAction('editItem', { id: {{ $item->id }} })"
                            >
                                <div class="flex justify-between items-start mb-1">
                                    <h4 class="font-semibold text-sm text-gray-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">
                                        {{ $item->getTranslation('name', $activeLocale) }}
                                    </h4>
                                    <span class="text-xs font-bold text-primary-600 dark:text-primary-400">
                                        {{ $item->price }} ₺
                                    </span>
                                </div>
                                
                                <p class="text-[10px] text-gray-400 mb-2 truncate">/{{ $item->getTranslation('slug', $activeLocale) }}</p>

                                @if($item->description)
                                    <p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-2 italic mb-2">
                                        "{{ $item->getTranslation('description', $activeLocale) }}"
                                    </p>
                                @endif

                                @if($item->image)
                                    <div class="mt-2 rounded-md overflow-hidden h-24 bg-gray-100 dark:bg-gray-900 relative">
                                        <img src="{{ Storage::url($item->image) }}" class="w-full h-full object-cover">
                                    </div>
                                @endif

                                <div class="mt-2 flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        @if($item->is_featured)
                                            <span class="w-2 h-2 rounded-full bg-amber-400" title="Featured"></span>
                                        @endif
                                        <span @class([
                                            'w-2 h-2 rounded-full',
                                            'bg-emerald-400' => $item->is_active,
                                            'bg-rose-400' => !$item->is_active,
                                        ]) title="{{ $item->is_active ? 'Active' : 'Inactive' }}"></span>
                                        @if($item->is_vegan)
                                            <span class="text-xs" title="Vegan">🌱</span>
                                        @endif
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <span class="text-[10px] text-gray-400 font-mono">#{{ $item->id }}</span>
                                        <span title="Drag to reorder" class="item-handle cursor-grab active:cursor-grabbing text-gray-300 hover:text-primary-500 transition-colors" x-on:click.stop>
                                            <x-heroicon-m-arrows-up-down class="w-4 h-4" />
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="p-3 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 rounded-b-xl">
                        <button 
                            x-on:click="$wire.mountAction('createItem', { categoryId: {{ $category->id }} })"
                            class="w-full py-2 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg text-sm font-medium text-gray-500 hover:text-primary-500 hover:border-primary-500 transition-colors bg-white dark:bg-gray-800"
                        >
                            + Add Item
                        </button>
                    </div>
                </div>
            @endforeach
            
            <!-- Quick Add Category -->
            <button 
                x-on:click="$wire.mountAction('createCategory')"
                class="flex-shrink-0 w-80 h-16 border-2 border-dashed border-gray-300 dark:border-gray-700 rounded-xl flex items-center justify-center text-gray-500 hover:text-primary-500 hover:border-primary-500 transition-all group"
            >
                <x-heroicon-o-plus class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" />
                <span class="text-sm font-medium">Add Category</span>
            </button>
        </div>
    </div>

    <!-- Modals -->
    <x-filament-actions::modals />

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
</div>
