<?php

namespace App\Http\Livewire\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public bool $showModal = false;
    public ?Category $category = null;
    public string $name = '';

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:categories,name,' . ($this->category?->id ?? ''),
        ];
    }

    public function create(): void
    {
        $this->category = null;
        $this->name = '';
        $this->showModal = true;
    }

    public function edit(Category $category): void
    {
        $this->category = $category;
        $this->name = $category->name;
        $this->showModal = true;
    }

    public function save(): void
    {
        $this->validate();

        if ($this->category) {
            $this->category->update(['name' => $this->name]);
        } else {
            Category::create(['name' => $this->name]);
        }

        $this->showModal = false;
    }

    public function delete(Category $category): void
    {
        $category->delete();
    }

    public function render()
    {
        return view('livewire.categories.index', [
            'categories' => Category::latest()->paginate(10),
        ]);
    }
}
