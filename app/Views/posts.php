<?php
$title = 'Posts | AuthBoard';
ob_start();
?>

<div class="max-w-4xl mx-auto space-y-6">
    
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Community Feed</h1>
            <p class="text-gray-600 mt-1">Share your thoughts with the community</p>
        </div>
    </div>

    <!-- Create Post Card -->
    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Create a Post</h2>
        
        <form method="POST" action="/posts/create" enctype="multipart/form-data" class="space-y-4">
            
            <!-- Post Content -->
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                    What's on your mind, <?= htmlspecialchars($_SESSION['user']['name']) ?>?
                </label>
                <textarea 
                    id="content" 
                    name="content" 
                    rows="4" 
                    required
                    placeholder="Share your thoughts, ideas, or updates..."
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none"
                ></textarea>
                <p class="text-xs text-gray-500 mt-1">
                    <span id="charCount">0</span> / 500 characters
                </p>
            </div>

            <!-- Image Upload -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Add an image (optional)
                </label>
                <div class="flex items-center space-x-4">
                    <label for="image" class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                        <svg class="w-5 h-5 text-gray-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="text-sm font-medium text-gray-700">Choose Image</span>
                        <input 
                            type="file" 
                            id="image" 
                            name="image" 
                            accept="image/*"
                            class="hidden"
                            onchange="previewImage(event)"
                        />
                    </label>
                    <span id="fileName" class="text-sm text-gray-600"></span>
                </div>
                
                <!-- Image Preview -->
                <div id="imagePreview" class="mt-4 hidden">
                    <div class="relative inline-block">
                        <img id="preview" src="" alt="Preview" class="max-w-xs rounded-lg border border-gray-300" />
                        <button 
                            type="button" 
                            onclick="removeImage()"
                            class="absolute top-2 right-2 bg-red-500 hover:bg-red-600 text-white rounded-full p-1 shadow-lg"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Post Button -->
            <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                <div class="flex items-center space-x-4 text-sm text-gray-600">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-1 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Public
                    </span>
                </div>
                <button 
                    type="submit"
                    class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold px-6 py-2 rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200"
                >
                    Post
                </button>
            </div>

        </form>
    </div>

    <!-- Filter & Sort -->
    <div class="flex items-center justify-between bg-white rounded-lg shadow-sm p-4 border border-gray-100">
        <div class="flex items-center space-x-2">
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
            </svg>
            <span class="text-sm font-medium text-gray-700">Filter:</span>
            <select class="text-sm border border-gray-300 rounded-lg px-3 py-1 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option>All Posts</option>
                <option>My Posts</option>
                <option>Trending</option>
            </select>
        </div>
        <div class="text-sm text-gray-600">
            <span class="font-semibold"><?= count($posts ?? []) ?></span> posts
        </div>
    </div>

    <!-- Posts Feed -->
    <div class="space-y-6">
        
        <?php if (empty($posts)): ?>
            <!-- Empty State -->
            <div class="bg-white rounded-xl shadow-md p-12 text-center border border-gray-100">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">No posts yet</h3>
                <p class="text-gray-600">Be the first to share something with the community!</p>
            </div>
        <?php else: ?>
            
            <?php foreach ($posts as $post): ?>
                <!-- Post Card -->
                <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden hover:shadow-lg transition-shadow">
                    
                    <!-- Post Header -->
                    <div class="p-6 pb-4">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center space-x-3">
                                <!-- User Avatar -->
                                <div class="w-12 h-12 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center text-white font-bold">
                                    <?= strtoupper(substr($post['user_name'] ?? 'U', 0, 1)) ?>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900">
                                        <?= htmlspecialchars($post['user_name'] ?? 'Unknown User') ?>
                                    </h3>
                                    <p class="text-sm text-gray-600">
                                        <?= date('F j, Y \a\t g:i A', strtotime($post['created_at'] ?? 'now')) ?>
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Post Menu -->
                            <button class="text-gray-400 hover:text-gray-600 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Post Content -->
                    <div class="px-6 pb-4">
                        <p class="text-gray-800 leading-relaxed">
                            <?= nl2br(htmlspecialchars($post['content'] ?? '')) ?>
                        </p>
                    </div>

                    <!-- Post Image (if exists) -->
                    <?php if (!empty($post['image_path'])): ?>
                        <div class="px-6 pb-4">
                            <img 
                                src="<?= htmlspecialchars($post['image_path']) ?>" 
                                alt="Post image" 
                                class="w-full rounded-lg border border-gray-200 cursor-pointer hover:opacity-95 transition-opacity"
                                onclick="openImageModal(this.src)"
                            />
                        </div>
                    <?php endif; ?>

                    <!-- Post Actions -->
                    <div class="px-6 py-4 border-t border-gray-100">
                        <div class="flex items-center justify-between">
                            
                            <!-- Like, Comment, Share -->
                            <div class="flex items-center space-x-6">
                                <button class="flex items-center space-x-2 text-gray-600 hover:text-red-500 transition-colors group">
                                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                    <span class="text-sm font-medium"><?= $post['likes'] ?? 0 ?></span>
                                </button>

                                <button class="flex items-center space-x-2 text-gray-600 hover:text-blue-500 transition-colors group">
                                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                    <span class="text-sm font-medium"><?= $post['comments'] ?? 0 ?></span>
                                </button>

                                <button class="flex items-center space-x-2 text-gray-600 hover:text-green-500 transition-colors group">
                                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                                    </svg>
                                    <span class="text-sm font-medium">Share</span>
                                </button>
                            </div>

                            <!-- Bookmark -->
                            <button class="text-gray-600 hover:text-yellow-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>

        <?php endif; ?>

    </div>

    <!-- Load More Button -->
    <?php if (!empty($posts) && count($posts) >= 10): ?>
        <div class="text-center">
            <button class="bg-white hover:bg-gray-50 text-gray-700 font-medium px-6 py-3 rounded-lg border border-gray-300 shadow-sm transition-colors">
                Load More Posts
            </button>
        </div>
    <?php endif; ?>

</div>

<!-- JavaScript for Image Preview & Character Count -->
<script>
    // Character counter
    const textarea = document.getElementById('content');
    const charCount = document.getElementById('charCount');
    
    textarea.addEventListener('input', function() {
        const count = this.value.length;
        charCount.textContent = count;
        
        if (count > 500) {
            charCount.classList.add('text-red-600');
            charCount.classList.remove('text-gray-500');
        } else {
            charCount.classList.add('text-gray-500');
            charCount.classList.remove('text-red-600');
        }
    });

    // Image preview
    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
                document.getElementById('imagePreview').classList.remove('hidden');
                document.getElementById('fileName').textContent = file.name;
            };
            reader.readAsDataURL(file);
        }
    }

    function removeImage() {
        document.getElementById('image').value = '';
        document.getElementById('imagePreview').classList.add('hidden');
        document.getElementById('fileName').textContent = '';
    }

    function openImageModal(src) {
        // You can implement a modal to view full-size image
        window.open(src, '_blank');
    }
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';