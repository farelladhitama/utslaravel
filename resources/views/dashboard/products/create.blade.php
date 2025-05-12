<x-layouts.app :title="__('Add Product')">
    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Add New Product</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Fill in the details below to add a new product to your inventory</p>
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
            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <flux:input 
                            label="Product Name" 
                            name="name" 
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
                            placeholder="0.00"
                            class="w-full shadow-sm focus:shadow-md"
                            required
                        />
                    </div>

                    <div class="md:col-span-2">
                        <flux:textarea 
                            label="Description" 
                            name="description" 
                            placeholder="Enter product description"
                            rows="4"
                            class="w-full shadow-sm focus:shadow-md"
                        />
                    </div>

                    <div>
                        <flux:input 
                            label="Stock Quantity" 
                            name="stock" 
                            type="number" 
                            placeholder="0"
                            class="w-full shadow-sm focus:shadow-md"
                            required
                        />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Product Image</label>
                        <div class="mt-1 flex items-center">
                            <label for="image" class="cursor-pointer w-full">
                                <div class="group relative border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-4 w-full flex justify-center items-center hover:border-blue-500 transition-colors shadow-sm hover:shadow-md">
                                    <div class="text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-blue-500" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                            <span class="font-medium text-blue-600 dark:text-blue-400 group-hover:text-blue-500">Upload a file</span>
                                            or drag and drop
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
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                        Save Product
                    </flux:button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Preview image before upload
        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const previewContainer = e.target.closest('label').querySelector('.group');
                    previewContainer.innerHTML = `
                        <div class="relative w-full h-40 rounded-lg overflow-hidden shadow-md">
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