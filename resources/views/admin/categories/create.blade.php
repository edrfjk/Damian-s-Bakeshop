@extends('layouts.admin')
@section('title', 'Add New Category')

@section('content')
<div class="p-8 max-w-3xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-4">
            <a href="{{ route('admin.categories.index') }}" class="p-2 rounded-lg hover:bg-cream-parchment transition duration-200">
                <svg class="w-5 h-5" style="color: var(--chocolate);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-display font-bold" style="color: var(--chocolate);">Add New Category</h1>
                <p class="text-sm mt-1" style="color: var(--chocolate-light);">Create a menu category</p>
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

    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Basic Info -->
        <div class="card p-6 shadow rounded-xl bg-white">
            <h3 class="font-display text-xl font-bold mb-6" style="color: var(--chocolate);">Basic Information</h3>
            
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-semibold mb-2" style="color: var(--chocolate);">Category Name *</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="input border border-gray-300 rounded-lg focus:ring-2 focus:ring-golden w-full" placeholder="e.g., Breads, Cakes, Pastries" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2" style="color: var(--chocolate);">Description</label>
                    <textarea name="description" rows="3" class="input border border-gray-300 rounded-lg focus:ring-2 focus:ring-golden w-full" placeholder="Brief description of this category...">{{ old('description') }}</textarea>
                </div>
            </div>
        </div>

        <!-- Image -->
        <div class="card p-6 shadow rounded-xl bg-white">
            <h3 class="font-display text-xl font-bold mb-6" style="color: var(--chocolate);">Category Image</h3>
            
            <div>
                <label class="block text-sm font-semibold mb-2" style="color: var(--chocolate);">Image (Optional)</label>
                <input type="file" name="image" class="input border border-gray-300 rounded-lg focus:ring-2 focus:ring-golden w-full" accept="image/*" onchange="previewCategoryImage(event)">
                <p class="text-xs mt-2" style="color: var(--chocolate-light);">Max 2MB. Recommended: 800x450px (16:9 ratio)</p>
                <img id="categoryImagePreview" class="mt-4 rounded-lg shadow-sm hidden max-h-64" alt="Preview">
            </div>
        </div>

        <!-- Settings -->
        <div class="card p-6 shadow rounded-xl bg-white">
            <h3 class="font-display text-xl font-bold mb-6" style="color: var(--chocolate);">Settings</h3>
            
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold mb-2" style="color: var(--chocolate);">Sort Order *</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="input border border-gray-300 rounded-lg focus:ring-2 focus:ring-golden w-full" min="0" required>
                    <p class="text-xs mt-1" style="color: var(--chocolate-light);">Lower numbers appear first</p>
                </div>

                <div>
                    <label class="flex items-center gap-3 cursor-pointer pt-8">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="w-5 h-5 rounded" style="accent-color: var(--golden);">
                        <div>
                            <p class="font-bold text-sm" style="color: var(--chocolate);">Active</p>
                            <p class="text-xs" style="color: var(--chocolate-light);">Visible to customers</p>
                        </div>
                    </label>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex gap-4 mt-4">
            <button type="submit" class="btn btn-primary px-8 py-3 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Create Category
            </button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-ghost px-8 py-3">Cancel</a>
        </div>
    </form>
</div>

<script>
function previewCategoryImage(event) {
    const input = event.target;
    const preview = document.getElementById('categoryImagePreview');
    if(input.files && input.files[0]){
        preview.src = URL.createObjectURL(input.files[0]);
        preview.classList.remove('hidden');
    }
}
</script>
@endsection