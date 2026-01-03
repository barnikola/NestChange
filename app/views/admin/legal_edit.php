<?php
$title = 'Edit ' . htmlspecialchars($doc['title']);
ob_start();
?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <a href="/admin/legal" class="text-indigo-600 hover:text-indigo-900">&larr; Back to Legal Content</a>
    </div>

    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Legal Document</h3>
            
            <form action="/admin/legal/update" method="POST" class="mt-5 space-y-6">
                <!-- CSRF Token if applicable - controller requires verification? base controller checks verifyCsrf() usually if enforced -->
                <!-- Assuming AdminController doesn't enforce strict CSRF on this route yet but good practice -->
                
                <input type="hidden" name="type" value="<?php echo htmlspecialchars($doc['type']); ?>">

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <div class="mt-1">
                        <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($doc['title']); ?>" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" required>
                    </div>
                </div>

                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                    <div class="mt-1">
                        <textarea id="content" name="content" rows="20" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" required><?php echo htmlspecialchars($doc['content']); ?></textarea>
                    </div>
                    <p class="mt-2 text-sm text-gray-500">HTML content is allowed.</p>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require dirname(__DIR__) . '/layouts/main.php';
?>
