<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <title>Add Product</title>
</head>

<body>
    <form action="{{ route('addProduct') }}" method="POST" enctype="multipart/form-data" class="w-3/6 block mx-auto my-6">
        @csrf
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="mb-4">
            <label for="product_name" class="block text-gray-600">Product Name</label>
            <input type="text" id="product_name" name="product_name"
                class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-indigo-200 focus:outline-none" required>
        </div>

        <div class="mb-4">
            <label for="product_images" class="block text-gray-600">Product Images (multiple)</label>
            <input type="file" id="product_images" name="product_images[]"
                class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-indigo-200 focus:outline-none" multiple
                required>
        </div>

        <div class="mb-4">
            <label for="category" class="block text-gray-600">Category</label>
            <select id="category" name="category"
                class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-indigo-200 focus:outline-none" required>
                @foreach ($categories as $category)
                    <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="product_price" class="block text-gray-600">Price</label>
            <input type="text" id="product_price" name="product_price"
                class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-indigo-200 focus:outline-none" required>
        </div>

        <div class="mb-4">
            <label for="main_image" class="block text-gray-600">Main Image</label>
            <input type="file" id="main_image" name="main_image"
                class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-indigo-200 focus:outline-none" required>
        </div>

        <div class="mb-4">
            <label for="product_description" class="block text-gray-600">Product Description</label>
            <textarea id="product_description" name="product_description"
                class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-indigo-200 focus:outline-none" required></textarea>
        </div>

        <button type="submit"
            class="w-full bg-indigo-500 text-white py-2 rounded-md hover:bg-indigo-600 transition duration-300">Add
            Product</button>
    </form>

</body>

</html>
