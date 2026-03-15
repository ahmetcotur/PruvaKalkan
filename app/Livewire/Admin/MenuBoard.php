<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\MenuItem;
use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;

class MenuBoard extends Component implements HasForms, HasActions
{
    use InteractsWithForms;
    use InteractsWithActions;

    public $mainCategories;
    public $selectedMainCategoryId;
    public $categories;
    public $directItems;
    public $activeLocale = 'tr';

    public function mount()
    {
        $this->mainCategories = Category::whereNull('parent_id')
            ->orderBy('order_column')
            ->get();
        
        $this->selectedMainCategoryId = $this->mainCategories->first()?->id;
        $this->loadCategories();
    }

    public function loadCategories()
    {
        if ($this->selectedMainCategoryId) {
            $this->categories = Category::where('parent_id', $this->selectedMainCategoryId)
                ->with(['menuItems' => fn($q) => $q->orderBy('order_column')])
                ->orderBy('order_column')
                ->get();
                
            $this->directItems = MenuItem::where('category_id', $this->selectedMainCategoryId)
                ->orderBy('order_column')
                ->get();
        } else {
            $this->categories = collect();
            $this->directItems = collect();
        }
    }

    public function selectMainCategory($id)
    {
        $this->selectedMainCategoryId = $id;
        $this->loadCategories();
    }

    public function updatedActiveLocale()
    {
        $this->loadCategories();
    }

    public function updateItemOrder($items)
    {
        foreach ($items as $item) {
            if (isset($item['value']) && $item['value']) {
                MenuItem::where('id', $item['value'])->update([
                    'order_column' => $item['order'],
                    'category_id' => $item['category_id']
                ]);
            }
        }

        Notification::make()
            ->title('Order updated')
            ->success()
            ->send();
            
        $this->loadCategories();
    }

    public function updateCategoryOrder($categories)
    {
        foreach ($categories as $cat) {
            if (isset($cat['value']) && $cat['value']) {
                Category::where('id', $cat['value'])->update([
                    'order_column' => $cat['order']
                ]);
            }
        }

        Notification::make()
            ->title('Categories reordered')
            ->success()
            ->send();

        $this->loadCategories();
    }

    public function editItemAction(): Action
    {
        return Action::make('editItem')
            ->form([
                TextInput::make('name')
                    ->label('Name (' . strtoupper($this->activeLocale) . ')')
                    ->required(),
                TextInput::make('slug')
                    ->label('Slug (' . strtoupper($this->activeLocale) . ')')
                    ->required(),
                TextInput::make('price')
                    ->numeric()
                    ->prefix('₺')
                    ->required(),
                Textarea::make('description')
                    ->label('Description (' . strtoupper($this->activeLocale) . ')')
                    ->rows(3),
                FileUpload::make('image')
                    ->image()
                    ->directory('menu-items')
                    ->disk('public'),
                Toggle::make('is_active')
                    ->label('Active on Site')
                    ->default(true),
                Toggle::make('is_featured')
                    ->label('Featured Item')
                    ->default(false),
                Toggle::make('is_vegan')
                    ->label('Vegan / Vegetarian'),
                TextInput::make('allergen_info')
                    ->label('Allergen Info (' . strtoupper($this->activeLocale) . ')')
                    ->placeholder('e.g. Nuts, Dairy, Gluten'),
                TextInput::make('likes_count')
                    ->label('Likes Count')
                    ->numeric()
                    ->default(0),
            ])
            ->fillForm(function (array $arguments) {
                $item = MenuItem::find($arguments['id']);
                return [
                    'name' => $item->getTranslation('name', $this->activeLocale),
                    'slug' => $item->getTranslation('slug', $this->activeLocale),
                    'price' => $item->price,
                    'description' => $item->getTranslation('description', $this->activeLocale),
                    'image' => $item->image,
                    'is_active' => $item->is_active,
                    'is_featured' => $item->is_featured,
                    'is_vegan' => $item->is_vegan,
                    'allergen_info' => $item->getTranslation('allergen_info', $this->activeLocale),
                    'likes_count' => $item->likes_count ?? 0,
                ];
            })
            ->action(function (array $data, array $arguments): void {
                $item = MenuItem::find($arguments['id']);
                
                // Update localized fields
                $item->setTranslation('name', $this->activeLocale, $data['name']);
                $item->setTranslation('slug', $this->activeLocale, $data['slug']);
                $item->setTranslation('description', $this->activeLocale, $data['description']);
                if (isset($data['allergen_info'])) {
                    $item->setTranslation('allergen_info', $this->activeLocale, $data['allergen_info']);
                } else {
                    // if empty, remove translation
                    $item->setTranslation('allergen_info', $this->activeLocale, null);
                }
                
                // Update normal fields
                $item->price = $data['price'];
                $item->image = $data['image'];
                $item->is_active = $data['is_active'];
                $item->is_featured = $data['is_featured'];
                $item->is_vegan = $data['is_vegan'];
                $item->likes_count = $data['likes_count'] ?? 0;
                
                $item->save();
                
                Notification::make()
                    ->title('Item updated')
                    ->success()
                    ->send();
                    
                $this->loadCategories();
            });
    }

    public function editCategoryAction(): Action
    {
        return Action::make('editCategory')
            ->form([
                TextInput::make('name')
                    ->label('Category Name (' . strtoupper($this->activeLocale) . ')')
                    ->required(),
                TextInput::make('slug')
                    ->label('Slug (' . strtoupper($this->activeLocale) . ')')
                    ->required(),
                Textarea::make('description')
                    ->label('Description (' . strtoupper($this->activeLocale) . ')')
                    ->rows(2),
                Toggle::make('is_active')
                    ->default(true),
            ])
            ->fillForm(function (array $arguments) {
                $cat = Category::find($arguments['id']);
                return [
                    'name' => $cat->getTranslation('name', $this->activeLocale),
                    'slug' => $cat->getTranslation('slug', $this->activeLocale),
                    'description' => $cat->getTranslation('description', $this->activeLocale),
                    'is_active' => $cat->is_active,
                ];
            })
            ->action(function (array $data, array $arguments): void {
                $cat = Category::find($arguments['id']);
                $cat->setTranslation('name', $this->activeLocale, $data['name']);
                $cat->setTranslation('slug', $this->activeLocale, $data['slug']);
                $cat->setTranslation('description', $this->activeLocale, $data['description']);
                $cat->is_active = $data['is_active'];
                $cat->save();
                
                Notification::make()
                    ->title('Category updated')
                    ->success()
                    ->send();
                    
                $this->loadCategories();
            });
    }

    public function createCategoryAction(): Action
    {
        return Action::make('createCategory')
            ->form([
                TextInput::make('name')
                    ->required(),
                Toggle::make('is_active')
                    ->default(true),
            ])
            ->action(function (array $data): void {
                $cat = new Category();
                $cat->parent_id = $this->selectedMainCategoryId;
                $cat->setTranslation('name', $this->activeLocale, $data['name']);
                $cat->setTranslation('slug', $this->activeLocale, \Illuminate\Support\Str::slug($data['name']));
                $cat->is_active = $data['is_active'];
                $cat->order_column = Category::where('parent_id', $this->selectedMainCategoryId)->max('order_column') + 1;
                $cat->save();
                
                Notification::make()
                    ->title('Category created')
                    ->success()
                    ->send();
                    
                $this->loadCategories();
            });
    }

    public function createItemAction(): Action
    {
        return Action::make('createItem')
            ->form([
                TextInput::make('name')
                    ->label('Name (' . strtoupper($this->activeLocale) . ')')
                    ->required(),
                TextInput::make('price')
                    ->numeric()
                    ->prefix('₺')
                    ->required(),
                TextInput::make('allergen_info')
                    ->label('Allergen Info (' . strtoupper($this->activeLocale) . ')')
                    ->placeholder('e.g. Nuts, Dairy, Gluten'),
                Toggle::make('is_active')
                    ->label('Active on Site')
                    ->default(true),
                TextInput::make('likes_count')
                    ->label('Likes Count')
                    ->numeric()
                    ->default(0),
            ])
            ->action(function (array $data, array $arguments): void {
                $item = new MenuItem();
                $item->category_id = $arguments['categoryId'];
                $item->setTranslation('name', $this->activeLocale, $data['name']);
                $item->setTranslation('slug', $this->activeLocale, \Illuminate\Support\Str::slug($data['name']));
                if (isset($data['allergen_info'])) {
                    $item->setTranslation('allergen_info', $this->activeLocale, $data['allergen_info']);
                }
                $item->price = $data['price'];
                $item->is_active = $data['is_active'];
                $item->likes_count = $data['likes_count'] ?? 0;
                
                $maxOrder = MenuItem::where('category_id', $arguments['categoryId'])->max('order_column');
                $item->order_column = $maxOrder + 1;
                
                $item->save();
                
                Notification::make()
                    ->title('Item created')
                    ->success()
                    ->send();
                    
                $this->loadCategories();
            });
    }

    public function render()
    {
        return view('livewire.admin.menu-board');
    }
}
