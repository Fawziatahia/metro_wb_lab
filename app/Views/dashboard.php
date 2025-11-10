<?php
$title = 'Dashboard | AuthBoard';
ob_start();
?>

<div class="space-y-6">
    
    <!-- Welcome Header -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl shadow-xl p-8 text-white">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold mb-2">
                    Welcome back, <?php echo htmlspecialchars($user['name']) ?>! 👋
                </h1>
                <p class="text-blue-100 text-lg">
                    Great to see you again. Here's what's happening today.
                </p>
            </div>
            <div class="mt-4 md:mt-0">
                <div class="bg-white/20 backdrop-blur-sm rounded-lg px-4 py-2 inline-block">
                    <p class="text-sm text-blue-100">Member since</p>
                    <p class="text-lg font-semibold"><?= date('F Y', strtotime($user['created_at'] ?? 'now')) ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- Total Posts Card -->
        <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Posts</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">24</p>
                    <p class="text-sm text-green-600 mt-2">
                        <span class="font-semibold">↑ 12%</span> from last month
                    </p>
                </div>
                <div class="bg-blue-100 rounded-full p-3">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Followers Card -->
        <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Followers</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">128</p>
                    <p class="text-sm text-green-600 mt-2">
                        <span class="font-semibold">↑ 8%</span> from last week
                    </p>
                </div>
                <div class="bg-purple-100 rounded-full p-3">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Likes Card -->
        <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Likes</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">456</p>
                    <p class="text-sm text-green-600 mt-2">
                        <span class="font-semibold">↑ 18%</span> from last month
                    </p>
                </div>
                <div class="bg-pink-100 rounded-full p-3">
                    <svg class="w-8 h-8 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Views Card -->
        <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Profile Views</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">1.2K</p>
                    <p class="text-sm text-green-600 mt-2">
                        <span class="font-semibold">↑ 24%</span> from last week
                    </p>
                </div>
                <div class="bg-green-100 rounded-full p-3">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </div>
            </div>
        </div>

    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- User Profile Card -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Your Profile</h3>
                
                <div class="flex flex-col items-center text-center">
                    <!-- Avatar -->
                    <div class="relative">
                        <div class="w-24 h-24 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center text-white text-3xl font-bold">
                            <?= strtoupper(substr($user['name'], 0, 1)) ?>
                        </div>
                        <div class="absolute bottom-0 right-0 w-6 h-6 bg-green-500 border-4 border-white rounded-full"></div>
                    </div>
                    
                    <!-- User Info -->
                    <h4 class="mt-4 text-xl font-bold text-gray-900">
                        <?= htmlspecialchars($user['name']) ?>
                    </h4>
                    <p class="text-sm text-gray-600 mt-1">
                        <?= htmlspecialchars($user['email']) ?>
                    </p>
                    
                    <!-- Profile Actions -->
                    <div class="mt-6 w-full space-y-2">
                        <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                            Edit Profile
                        </button>
                        <button class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 px-4 rounded-lg transition-colors">
                            Settings
                        </button>
                    </div>
                </div>

                <!-- Profile Stats -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="grid grid-cols-3 gap-4 text-center">
                        <div>
                            <p class="text-2xl font-bold text-gray-900">24</p>
                            <p class="text-xs text-gray-600 mt-1">Posts</p>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">128</p>
                            <p class="text-xs text-gray-600 mt-1">Followers</p>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">89</p>
                            <p class="text-xs text-gray-600 mt-1">Following</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions & Recent Activity -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                <div class="grid grid-cols-2 gap-4">
                    <a href="/posts" class="flex items-center space-x-3 p-4 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors group">
                        <div class="bg-blue-600 p-2 rounded-lg group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Create Post</p>
                            <p class="text-xs text-gray-600">Share your thoughts</p>
                        </div>
                    </a>
                    
                    <a href="/posts" class="flex items-center space-x-3 p-4 bg-purple-50 hover:bg-purple-100 rounded-lg transition-colors group">
                        <div class="bg-purple-600 p-2 rounded-lg group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">View All Posts</p>
                            <p class="text-xs text-gray-600">Browse the feed</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Activity</h3>
                <div class="space-y-4">
                    
                    <!-- Activity Item -->
                    <div class="flex items-start space-x-3 pb-4 border-b border-gray-100">
                        <div class="bg-blue-100 p-2 rounded-lg">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-900">
                                You created a new post: <span class="font-semibold">"My thoughts on web development"</span>
                            </p>
                            <p class="text-xs text-gray-500 mt-1">2 hours ago</p>
                        </div>
                    </div>

                    <!-- Activity Item -->
                    <div class="flex items-start space-x-3 pb-4 border-b border-gray-100">
                        <div class="bg-pink-100 p-2 rounded-lg">
                            <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-900">
                                <span class="font-semibold">Sarah Johnson</span> liked your post
                            </p>
                            <p class="text-xs text-gray-500 mt-1">5 hours ago</p>
                        </div>
                    </div>

                    <!-- Activity Item -->
                    <div class="flex items-start space-x-3">
                        <div class="bg-green-100 p-2 rounded-lg">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-900">
                                <span class="font-semibold">Mike Chen</span> started following you
                            </p>
                            <p class="text-xs text-gray-500 mt-1">1 day ago</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
