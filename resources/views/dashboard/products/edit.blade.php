<x-layouts.app :title="__('Update Product')">
    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Update Product</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Edit the details below to update this product</p>
        </div>

        @if(session()->has('successMessage'))
            <div class="mb-6 p-4 bg-green-50 dark:bg-green-900 border-l-4 border-green-500 text-green-700 dark:text-green-200 rounded">
                {{ session()->get('successMessage') }}
            </div>
        @elseif(session()->has('errorMessage'))
            <div class="mb-6 p-4 bg-red-50 dark:bg-red-900 border-l-4 border-red-500 text-red-700 dark:text-red-200 rounded">
                {{ session()->get('errorMessage') }}
            </div>
        @endif

        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-lg p-6 transition-all duration-300 hover:shadow-2xl">
            <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <flux:input 
                            label="Product Name" 
                            name="name" 
                            value="{{ $product->name }}"
                            placeholder="Enter product name"
                            class="w-full shadow-sm focus:shadow-md"
                            required
                        />
                    </div>

                    <div>
                        <flux:input 
                            label="Price (Rp)" 
                            name="price" 
                            type="number" 
                            step="0.01" 
                            value="{{ $product->price }}"
                            placeholder="0.00"
                            class="w-full shadow-sm focus:shadow-md"
                            required
                        />
                    </div>

                    <div class="md:col-span-2">
                        <flux:textarea 
                            label="Description" 
                            name="description"
                            class="w-full shadow-sm focus:shadow-md"
                            rows="4"
                        >{{ $product->description }}</flux:textarea>
                    </div>

                    <div>
                        <flux:input 
                            label="Stock Quantity" 
                            name="stock" 
                            type="number" 
                            value="{{ $product->stock }}"
                            placeholder="0"
                            class="w-full shadow-sm focus:shadow-md"
                            required
                        />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Product Image</label>
                        
                        @if($product->image)
                            <div class="relative group mb-3">
                                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" 
                                     class="w-full h-48 object-cover rounded-lg shadow-md">
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                                    <button type="button" onclick="confirmDeleteImage()" 
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-sm font-medium transition-colors duration-200">
                                        Delete Image
                                    </button>
                                </div>
                            </div>
                        @endif

                        <div class="mt-1 flex items-center">
                            <label for="image" class="cursor-pointer w-full">
                                <div class="group relative border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-4 w-full flex justify-center items-center hover:border-blue-500 transition-colors shadow-sm hover:shadow-md">
                                    <div class="text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-blue-500" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                            <span class="font-medium text-blue-600 dark:text-blue-400 group-hover:text-blue-500">
                                                {{ $product->image ? 'Change image' : 'Upload image' }}
                                            </span>
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG up to 2MB</p>
                                    </div>
                                    <input id="image" name="image" type="file" class="sr-only" accept="image/*">
                                </div>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Category</label>
                        <select name="category_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md shadow-sm hover:shadow-md">
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="pt-6 border-t border-gray-200 dark:border-gray-700 flex justify-end space-x-3">
                    <flux:link 
                        href="{{ route('products.index') }}" 
                        variant="ghost" 
                        class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm hover:shadow-md text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-shadow duration-200"
                    >
                        Cancel
                    </flux:link>
                    <flux:button 
                        type="submit" 
                        variant="primary"
                        class="px-4 py-2 border border-transparent rounded-md shadow-md hover:shadow-lg text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-shadow duration-200"
                    >
                        Update Product
                    </flux:button>
                </div>
            </form>

            <!-- Hidden form for image deletion -->
            <form id="delete-image-form" action="{{ route('products.delete-image', $product->id) }}" method="POST" class="hidden">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>

    <script>
        // Confirm image deletion
        function confirmDeleteImage() {
            if (confirm('Are you sure you want to delete this image?')) {
                document.getElementById('delete-image-form').submit();
            }
        }

        // Preview new image before upload
        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const previewContainer = e.target.closest('label').querySelector('.group');
                    previewContainer.innerHTML = `
                        <div class="relative w-full h-48 rounded-lg overflow-hidden shadow-md">
                            <img src="${event.target.result}" alt="Preview" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-20 flex items-center justify-center">
                                <span class="text-white text-sm font-medium">Click to change</span>
                            </div>
                        </div>
                    `;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</x-layouts.app>