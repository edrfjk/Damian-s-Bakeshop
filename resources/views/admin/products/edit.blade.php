@extends('layouts.admin')
@section('title', 'Edit Product')

@section('content')
<div class="p-8 max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-4">
            <a href="{{ route('admin.products.index') }}" class="p-2 rounded-lg hover:bg-cream-parchment transition duration-200">
                <svg class="w-5 h-5" style="color: var(--chocolate);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-display font-bold" style="color: var(--chocolate);">Edit Product</h1>
                <p class="text-sm mt-1" style="color: var(--chocolate-light);">{{ $product->name }}</p>
            </div>
        </div>
    </div>

    <!-- Validation Errors -->
    @if($errors->any())
        <div class="mb-6 p-4 rounded-xl border-l-4 text-sm shadow-sm" style="background: #fff5f5; border-color: var(--rose); color: #a03028;">
            <p class="font-bold mb-2">Please fix the following errors:</p>
            <ul class="list-disc pl-5 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Basic Info Card -->
        <div class="card p-6 shadow rounded-xl bg-white">
            <h3 class="font-display text-xl font-bold mb-6" style="color: var(--chocolate);">Basic Information</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold mb-2" style="color: var(--chocolate);">Product Name *</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" class="input border border-gray-300 rounded-lg focus:ring-2 focus:ring-golden w-full" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2" style="color: var(--chocolate);">Category *</label>
                    <select name="category_id" class="input border border-gray-300 rounded-lg focus:ring-2 focus:ring-golden w-full" required>
                        @foreach(\App\Models\Category::orderBy('name')->get() as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2" style="color: var(--chocolate);">SKU</label>
                    <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" class="input border border-gray-300 rounded-lg w-full" readonly>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold mb-2" style="color: var(--chocolate);">Short Description</label>
                    <input type="text" name="short_description" value="{{ old('short_description', $product->short_description) }}" class="input border border-gray-300 rounded-lg focus:ring-2 focus:ring-golden w-full" maxlength="120">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold mb-2" style="color: var(--chocolate);">Full Description</label>
                    <textarea name="description" rows="4" class="input border border-gray-300 rounded-lg focus:ring-2 focus:ring-golden w-full">{{ old('description', $product->description) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Pricing Card -->
        <div class="card p-6 shadow rounded-xl bg-white">
            <h3 class="font-display text-xl font-bold mb-6" style="color: var(--chocolate);">Pricing</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold mb-2" style="color: var(--chocolate);">Price *</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 font-bold" style="color: var(--golden);">₱</span>
                        <input type="number" name="price" value="{{ old('price', $product->price) }}" class="input pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-golden w-full" step="0.01" min="0" required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2" style="color: var(--chocolate);">Compare at Price (Optional)</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 font-bold" style="color: var(--chocolate-light);">₱</span>
                        <input type="number" name="compare_price" value="{{ old('compare_price', $product->compare_price) }}" class="input pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-golden w-full" step="0.01" min="0">
                    </div>
                </div>
            </div>
        </div>

        <!-- Inventory Card -->
        <div class="card p-6 shadow rounded-xl bg-white">
            <h3 class="font-display text-xl font-bold mb-6" style="color: var(--chocolate);">Inventory</h3>
            
            <div>
                <label class="block text-sm font-semibold mb-2" style="color: var(--chocolate);">Stock Quantity *</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="input border border-gray-300 rounded-lg focus:ring-2 focus:ring-golden w-full" min="0" required>
            </div>
        </div>

        <!-- Image Card -->
        <div class="card p-6 shadow rounded-xl bg-white">
            <h3 class="font-display text-xl font-bold mb-6" style="color: var(--chocolate);">Product Image</h3>
            
            <div>
                <div class="mb-4">
                    <p class="text-sm font-semibold mb-3" style="color: var(--chocolate);">Current Image:</p>
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-48 h-48 rounded-xl object-cover shadow-md">
                </div>

                <label class="block text-sm font-semibold mb-2" style="color: var(--chocolate);">Replace Image (Optional)</label>
                <input type="file" name="image" class="input border border-gray-300 rounded-lg focus:ring-2 focus:ring-golden w-full" accept="image/*" onchange="previewImage(event)">
                <p class="text-xs mt-2" style="color: var(--chocolate-light);">Leave empty to keep current image. Max 2MB.</p>
                <img id="imagePreview" class="mt-4 rounded-lg shadow-sm hidden max-h-64" alt="Preview">
            </div>
        </div>

        <!-- Settings Card -->
        <div class="card p-6 shadow rounded-xl bg-white">
            <h3 class="font-display text-xl font-bold mb-6" style="color: var(--chocolate);">Settings</h3>
            
            <div class="space-y-4">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }} class="w-5 h-5 rounded" style="accent-color: var(--golden);">
                    <div>
                        <p class="font-bold text-sm" style="color: var(--chocolate);">Featured Product</p>
                        <p class="text-xs" style="color: var(--chocolate-light);">Show on homepage</p>
                    </div>
                </label>

                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }} class="w-5 h-5 rounded" style="accent-color: var(--golden);">
                    <div>
                        <p class="font-bold text-sm" style="color: var(--chocolate);">Active</p>
                        <p class="text-xs" style="color: var(--chocolate-light);">Product is visible to customers</p>
                    </div>
                </label>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex gap-4 mt-4">
            <button type="submit" class="btn btn-primary px-8 py-3 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Save Changes
            </button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-ghost px-8 py-3">Cancel</a>
        </div>
    </form>
</div>

<script>
function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('imagePreview');
    if(input.files && input.files[0]){
        preview.src = URL.createObjectURL(input.files[0]);
        preview.classList.remove('hidden');
    }
}
</script>
@endsection