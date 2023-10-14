<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <title>Add Category</title>
</head>

<body>

    <form action="{{ route('createCategory') }}" method="POST" class="w-3/6 block mx-auto my-6">
        @csrf
        <h1 class="my-6 font-bold">Create a new category</h1>
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="mb-4">
            <label for="category_name" class="block text-gray-600">Category Name</label>
            <input type="text" id="category_name" name="category_name"
                class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-indigo-200 focus:outline-none" required>
        </div>

        <div class="mb-4">
            <label for="category_description" class="block text-gray-600">Category Description</label>
            <textarea id="category_description" name="category_description"
                class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-indigo-200 focus:outline-none" required></textarea>
        </div>

        <div class="mb-4">
            <label for="category_status" class="block text-gray-600">Category Status</label>
            <select id="category_status" name="category_status"
                class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-indigo-200 focus:outline-none" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

        <button type="submit"
            class="w-full bg-indigo-500 text-white py-2 rounded-md hover:bg-indigo-600 transition duration-300">Add
            Category</button>
    </form>

</body>

</html>
