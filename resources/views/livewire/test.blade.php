<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donezo - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }
        .chart-container {
            position: relative;
            height: 200px;
            width: 100%;
        }
        .donut-chart {
            position: relative;
            width: 120px;
            height: 120px;
        }
        .donut-chart::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: conic-gradient(#10b981 0deg 147.6deg, #e5e7eb 147.6deg 360deg);
        }
        .donut-chart::after {
            content: '';
            position: absolute;
            top: 20px;
            left: 20px;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: white;
        }
        
        /* Enhanced Modern Styles */
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .hover-lift {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .smooth-transition {
            transition: all 0.3s ease;
        }
        
        .modern-card {
            background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
            border: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        .modern-card:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            transform: translateY(-2px);
        }
        
        .gradient-button {
            background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
            border: none;
            color: white;
            transition: all 0.3s ease;
        }
        
        .gradient-button:hover {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .pulse-glow {
            animation: pulse-glow 2s infinite;
        }
        
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 0 0 rgba(102, 126, 234, 0.4); }
            50% { box-shadow: 0 0 0 10px rgba(102, 126, 234, 0); }
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 glass-effect rounded-3xl m-4 shadow-2xl border border-white/20">
            <!-- Logo -->
            <div class="p-8">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-video text-white text-lg"></i>
                    </div>
                    <div>
                        <span class="text-2xl font-bold gradient-text">B-Roll</span>
                        <p class="text-xs text-gray-500 font-medium">Creative Studio</p>
                    </div>
                </div>
            </div>

            <!-- Menu -->
            <div class="px-8">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-6">PROJECTS</h3>
                <nav class="space-y-3">
                    <a href="#" class="flex items-center space-x-4 px-4 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl shadow-lg hover-lift smooth-transition">
                        <i class="fas fa-th-large text-lg"></i>
                        <span class="font-medium">Project 1</span>
                        <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                    </a>
                    <a href="#" class="flex items-center space-x-4 px-4 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-gray-50 hover:to-gray-100 rounded-xl smooth-transition hover-lift">
                        <i class="fas fa-tasks text-lg"></i>
                        <span class="font-medium">Project 2</span>
                    </a>
                    <a href="#" class="flex items-center space-x-4 px-4 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-gray-50 hover:to-gray-100 rounded-xl smooth-transition hover-lift">
                        <i class="fas fa-calendar text-lg"></i>
                        <span class="font-medium">Project 3</span>
                    </a>
                    <a href="#" class="flex items-center space-x-4 px-4 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-gray-50 hover:to-gray-100 rounded-xl smooth-transition hover-lift">
                        <i class="fas fa-chart-bar text-lg"></i>
                        <span class="font-medium">Project 4</span>
                    </a>
                    <a href="#" class="flex items-center space-x-4 px-4 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-gray-50 hover:to-gray-100 rounded-xl smooth-transition hover-lift">
                        <i class="fas fa-users text-lg"></i>
                        <span class="font-medium">Project 5</span>
                    </a>
                </nav>
            </div>

            <!-- General -->
            <div class="px-8 mt-10">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-6">GENERAL</h3>
                <nav class="space-y-3">
                    <a href="#" class="flex items-center space-x-4 px-4 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-gray-50 hover:to-gray-100 rounded-xl smooth-transition hover-lift">
                        <i class="fas fa-cog text-lg"></i>
                        <span class="font-medium">Settings</span>
                    </a>
                    
                    <a href="#" class="flex items-center space-x-4 px-4 py-3 text-red-600 hover:bg-gradient-to-r hover:from-red-50 hover:to-red-100 rounded-xl smooth-transition hover-lift">
                        <i class="fas fa-sign-out-alt text-lg"></i>
                        <span class="font-medium">Logout</span>
                    </a>
                </nav>
            </div>

            <!-- Mobile App Card -->
            
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="glass-effect mr-4 shadow-2xl my-4 rounded-3xl border border-white/20 px-8 py-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-6">
                        <div class="relative">
                            <input type="text" placeholder="Search your b-roll library..." class="w-96 pl-12 pr-6 py-4 border border-gray-200 rounded-2xl focus:outline-none focus:ring-4 focus:ring-purple-500/20 focus:border-purple-500 bg-white/80 backdrop-blur-sm shadow-lg smooth-transition">
                            <i class="fas fa-search absolute left-4 top-5 text-gray-400 text-lg"></i>
                        </div>
                        <button id="searchShortcut" class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-6 py-4 rounded-2xl text-sm font-medium shadow-lg hover-lift smooth-transition">
                            <i class="fas fa-keyboard mr-2"></i><span id="shortcutText">⌘F</span>
                        </button>
                    </div>
                    <div class="flex items-center space-x-6">
                        <div class="flex items-center space-x-4">
                            <div class="relative">
                                <div class="w-3 h-3 bg-green-500 rounded-full absolute -top-1 -right-1 animate-pulse"></div>
                                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=48&h=48&fit=crop&crop=face" alt="Profile" class="w-12 h-12 rounded-2xl shadow-lg border-2 border-white">
                            </div>
                            <div>
                                <p class="font-bold text-gray-800 text-lg">Totok Michael</p>
                                <p class="text-sm text-gray-500 font-medium">Creative Director</p>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <main class="flex-1 p-8 overflow-y-auto glass-effect rounded-3xl shadow-2xl my-4 border border-white/20">
                <!-- Dashboard Header -->
                <div class="flex items-center justify-between mb-12">
                    <div>
                        <h1 class="text-4xl font-bold gradient-text mb-3">B-Roll Library</h1>
                        <p class="text-gray-600 text-lg font-medium">Generate, search, and discover amazing b-roll content for your projects.</p>
                    </div>
                    <div class="flex space-x-4">
                        <button class="gradient-button px-8 py-4 rounded-2xl font-semibold flex items-center space-x-3 shadow-xl hover-lift" onclick="openAddProjectModal()">
                            <i class="fas fa-plus text-lg"></i>
                            <span>Create Project</span>
                        </button>
                        <button class="bg-gradient-to-r from-slate-500 to-slate-600 hover:from-slate-600 hover:to-slate-700 text-white px-8 py-4 rounded-2xl font-semibold shadow-xl hover-lift smooth-transition">
                            <i class="fas fa-upload mr-3"></i>
                            Import Media
                        </button>
                    </div>
                </div>

                <!-- Project Summary Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                    <!-- Total Projects -->
                    <div class="modern-card rounded-3xl p-8 hover-lift">
                        <div class="flex items-center justify-between mb-6">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg">
                                <i class="fas fa-folder text-white text-xl"></i>
                            </div>
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-arrow-up text-green-500 text-lg"></i>
                                <span class="text-green-500 font-semibold text-sm">+5</span>
                            </div>
                        </div>
                        <div class="text-5xl font-bold gradient-text mb-3">24</div>
                        <h3 class="text-gray-600 font-semibold text-lg mb-4">Active Projects</h3>
                        <div class="bg-gradient-to-r from-green-500 to-emerald-500 text-white text-sm px-4 py-2 rounded-full inline-flex items-center shadow-lg">
                            <i class="fas fa-arrow-up mr-2"></i>
                            Growing this month
                        </div>
                    </div>

                    <!-- Photos -->
                    <div class="modern-card rounded-3xl p-8 hover-lift">
                        <div class="flex items-center justify-between mb-6">
                            <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg">
                                <i class="fas fa-image text-white text-xl"></i>
                            </div>
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-arrow-up text-purple-500 text-lg"></i>
                                <span class="text-purple-500 font-semibold text-sm">+6</span>
                            </div>
                        </div>
                        <div class="text-5xl font-bold text-purple-600 mb-3">10</div>
                        <h3 class="text-gray-600 font-semibold text-lg mb-4">Photos</h3>
                        <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white text-sm px-4 py-2 rounded-full inline-flex items-center shadow-lg">
                            <i class="fas fa-arrow-up mr-2"></i>
                            New additions
                        </div>
                    </div>

                    <!-- Videos -->
                    <div class="modern-card rounded-3xl p-8 hover-lift">
                        <div class="flex items-center justify-between mb-6">
                            <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center shadow-lg">
                                <i class="fas fa-video text-white text-xl"></i>
                            </div>
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-arrow-up text-orange-500 text-lg"></i>
                                <span class="text-orange-500 font-semibold text-sm">+2</span>
                            </div>
                        </div>
                        <div class="text-5xl font-bold text-orange-600 mb-3">12</div>
                        <h3 class="text-gray-600 font-semibold text-lg mb-4">Videos</h3>
                        <div class="bg-gradient-to-r from-orange-500 to-orange-600 text-white text-sm px-4 py-2 rounded-full inline-flex items-center shadow-lg">
                            <i class="fas fa-arrow-up mr-2"></i>
                            Fresh content
                        </div>
                    </div>

                    <!-- Pending -->
                    <div class="modern-card rounded-3xl p-8 hover-lift">
                        <div class="flex items-center justify-between mb-6">
                            <div class="w-12 h-12 bg-gradient-to-br from-slate-500 to-slate-600 rounded-2xl flex items-center justify-center shadow-lg">
                                <i class="fas fa-clock text-white text-xl"></i>
                            </div>
                            <div class="w-3 h-3 bg-yellow-500 rounded-full animate-pulse"></div>
                        </div>
                        <div class="text-5xl font-bold text-slate-600 mb-3">2</div>
                        <h3 class="text-gray-600 font-semibold text-lg mb-4">In Review</h3>
                        <div class="bg-gradient-to-r from-yellow-500 to-orange-500 text-white text-sm px-4 py-2 rounded-full inline-flex items-center shadow-lg">
                            <i class="fas fa-hourglass-half mr-2"></i>
                            Processing
                        </div>
                    </div>
                </div>

                <!-- Video & Photo Library -->
                <div class="mb-12">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h2 class="text-3xl font-bold gradient-text mb-2">Media Library</h2>
                            <p class="text-gray-600 text-lg">Browse and manage your creative assets</p>
                        </div>
                    </div>

                    <!-- Media Gallery -->
                    <div class="modern-card rounded-3xl shadow-2xl p-8">
                        <div class="flex items-center justify-between mb-8">
                            <div class="flex space-x-4">
                                <button class="filter-btn px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white text-sm rounded-2xl font-semibold shadow-lg hover-lift smooth-transition" data-filter="all">
                                    <i class="fas fa-th mr-2"></i>All Media
                                </button>
                                <button class="filter-btn px-6 py-3 bg-gray-100 hover:bg-gradient-to-r hover:from-orange-500 hover:to-orange-600 hover:text-white text-gray-600 text-sm rounded-2xl font-semibold smooth-transition hover-lift" data-filter="videos">
                                    <i class="fas fa-video mr-2"></i>Videos
                                </button>
                                <button class="filter-btn px-6 py-3 bg-gray-100 hover:bg-gradient-to-r hover:from-purple-500 hover:to-purple-600 hover:text-white text-gray-600 text-sm rounded-2xl font-semibold smooth-transition hover-lift" data-filter="photos">
                                    <i class="fas fa-image mr-2"></i>Photos
                                </button>
                            </div>
                        </div>
                        
                        <!-- Video Grid -->
                        <div class="mb-12 media-section" data-type="videos">
                            <h4 class="text-xl font-bold text-gray-800 mb-8 flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center mr-3 shadow-lg">
                                    <i class="fas fa-video text-white"></i>
                                </div>
                                Video Collection
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                                <div class="relative group cursor-pointer hover-lift">
                                    <div class="aspect-video bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl flex items-center justify-center shadow-xl overflow-hidden">
                                        <i class="fas fa-play text-white text-5xl group-hover:scale-110 smooth-transition"></i>
                                    </div>
                                    <div class="absolute bottom-3 right-3 bg-black/80 backdrop-blur-sm text-white text-sm px-3 py-1 rounded-xl font-medium">
                                        2:34
                                    </div>
                                    <div class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-gray-800 text-xs px-3 py-1 rounded-xl font-medium">
                                        HD
                                    </div>
                                    <p class="text-lg font-semibold text-gray-800 mt-4">Project Demo</p>
                                    <p class="text-sm text-gray-500">MP4 • 2.3 MB</p>
                                </div>
                                
                                <div class="relative group cursor-pointer hover-lift">
                                    <div class="aspect-video bg-gradient-to-br from-green-400 to-green-600 rounded-2xl flex items-center justify-center shadow-xl overflow-hidden">
                                        <i class="fas fa-play text-white text-5xl group-hover:scale-110 smooth-transition"></i>
                                    </div>
                                    <div class="absolute bottom-3 right-3 bg-black/80 backdrop-blur-sm text-white text-sm px-3 py-1 rounded-xl font-medium">
                                        1:45
                                    </div>
                                    <div class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-gray-800 text-xs px-3 py-1 rounded-xl font-medium">
                                        4K
                                    </div>
                                    <p class="text-lg font-semibold text-gray-800 mt-4">Team Meeting</p>
                                    <p class="text-sm text-gray-500">MOV • 5.7 MB</p>
                                </div>
                                
                                <div class="relative group cursor-pointer hover-lift">
                                    <div class="aspect-video bg-gradient-to-br from-purple-400 to-purple-600 rounded-2xl flex items-center justify-center shadow-xl overflow-hidden">
                                        <i class="fas fa-play text-white text-5xl group-hover:scale-110 smooth-transition"></i>
                                    </div>
                                    <div class="absolute bottom-3 right-3 bg-black/80 backdrop-blur-sm text-white text-sm px-3 py-1 rounded-xl font-medium">
                                        3:12
                                    </div>
                                    <div class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-gray-800 text-xs px-3 py-1 rounded-xl font-medium">
                                        HD
                                    </div>
                                    <p class="text-lg font-semibold text-gray-800 mt-4">Tutorial Guide</p>
                                    <p class="text-sm text-gray-500">MP4 • 8.1 MB</p>
                                </div>
                                
                                <div class="relative group cursor-pointer hover-lift">
                                    <div class="aspect-video bg-gradient-to-br from-red-400 to-red-600 rounded-2xl flex items-center justify-center shadow-xl overflow-hidden">
                                        <i class="fas fa-play text-white text-5xl group-hover:scale-110 smooth-transition"></i>
                                    </div>
                                    <div class="absolute bottom-3 right-3 bg-black/80 backdrop-blur-sm text-white text-sm px-3 py-1 rounded-xl font-medium">
                                        4:28
                                    </div>
                                    <div class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-gray-800 text-xs px-3 py-1 rounded-xl font-medium">
                                        HD
                                    </div>
                                    <p class="text-lg font-semibold text-gray-800 mt-4">Presentation</p>
                                    <p class="text-sm text-gray-500">MP4 • 12.3 MB</p>
                                </div>
                                
                                <div class="relative group cursor-pointer hover-lift">
                                    <div class="aspect-video bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-2xl flex items-center justify-center shadow-xl overflow-hidden">
                                        <i class="fas fa-play text-white text-5xl group-hover:scale-110 smooth-transition"></i>
                                    </div>
                                    <div class="absolute bottom-3 right-3 bg-black/80 backdrop-blur-sm text-white text-sm px-3 py-1 rounded-xl font-medium">
                                        1:56
                                    </div>
                                    <div class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-gray-800 text-xs px-3 py-1 rounded-xl font-medium">
                                        HD
                                    </div>
                                    <p class="text-lg font-semibold text-gray-800 mt-4">Quick Tips</p>
                                    <p class="text-sm text-gray-500">MP4 • 3.2 MB</p>
                                </div>
                                
                                <div class="relative group cursor-pointer hover-lift">
                                    <div class="aspect-video bg-gradient-to-br from-indigo-400 to-indigo-600 rounded-2xl flex items-center justify-center shadow-xl overflow-hidden">
                                        <i class="fas fa-play text-white text-5xl group-hover:scale-110 smooth-transition"></i>
                                    </div>
                                    <div class="absolute bottom-3 right-3 bg-black/80 backdrop-blur-sm text-white text-sm px-3 py-1 rounded-xl font-medium">
                                        2:18
                                    </div>
                                    <div class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-gray-800 text-xs px-3 py-1 rounded-xl font-medium">
                                        HD
                                    </div>
                                    <p class="text-lg font-semibold text-gray-800 mt-4">Review Session</p>
                                    <p class="text-sm text-gray-500">MP4 • 6.8 MB</p>
                                </div>
                            </div>
                        </div>

                        <!-- Photo Grid -->
                        <div class="media-section" data-type="photos">
                            <h4 class="text-xl font-bold text-gray-800 mb-8 flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mr-3 shadow-lg">
                                    <i class="fas fa-image text-white"></i>
                                </div>
                                Photo Gallery
                            </h4>
                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                                <div class="relative group cursor-pointer hover-lift">
                                    <div class="aspect-square bg-gradient-to-br from-pink-400 to-pink-600 rounded-2xl flex items-center justify-center shadow-xl overflow-hidden">
                                        <i class="fas fa-image text-white text-4xl group-hover:scale-110 smooth-transition"></i>
                                    </div>
                                    <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm text-gray-800 text-xs px-2 py-1 rounded-lg font-medium">
                                        PNG
                                    </div>
                                    <p class="text-lg font-semibold text-gray-800 mt-3">Screenshot</p>
                                    <p class="text-sm text-gray-500">1.2 MB</p>
                                </div>
                                
                                <div class="relative group cursor-pointer hover-lift">
                                    <div class="aspect-square bg-gradient-to-br from-cyan-400 to-cyan-600 rounded-2xl flex items-center justify-center shadow-xl overflow-hidden">
                                        <i class="fas fa-image text-white text-4xl group-hover:scale-110 smooth-transition"></i>
                                    </div>
                                    <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm text-gray-800 text-xs px-2 py-1 rounded-lg font-medium">
                                        JPG
                                    </div>
                                    <p class="text-lg font-semibold text-gray-800 mt-3">Design</p>
                                    <p class="text-sm text-gray-500">2.8 MB</p>
                                </div>
                                
                                <div class="relative group cursor-pointer hover-lift">
                                    <div class="aspect-square bg-gradient-to-br from-orange-400 to-orange-600 rounded-2xl flex items-center justify-center shadow-xl overflow-hidden">
                                        <i class="fas fa-image text-white text-4xl group-hover:scale-110 smooth-transition"></i>
                                    </div>
                                    <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm text-gray-800 text-xs px-2 py-1 rounded-lg font-medium">
                                        PNG
                                    </div>
                                    <p class="text-lg font-semibold text-gray-800 mt-3">Mockup</p>
                                    <p class="text-sm text-gray-500">3.1 MB</p>
                                </div>
                                
                                <div class="relative group cursor-pointer hover-lift">
                                    <div class="aspect-square bg-gradient-to-br from-teal-400 to-teal-600 rounded-2xl flex items-center justify-center shadow-xl overflow-hidden">
                                        <i class="fas fa-image text-white text-4xl group-hover:scale-110 smooth-transition"></i>
                                    </div>
                                    <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm text-gray-800 text-xs px-2 py-1 rounded-lg font-medium">
                                        SVG
                                    </div>
                                    <p class="text-lg font-semibold text-gray-800 mt-3">Logo</p>
                                    <p class="text-sm text-gray-500">0.8 MB</p>
                                </div>
                                
                                <div class="relative group cursor-pointer hover-lift">
                                    <div class="aspect-square bg-gradient-to-br from-rose-400 to-rose-600 rounded-2xl flex items-center justify-center shadow-xl overflow-hidden">
                                        <i class="fas fa-image text-white text-4xl group-hover:scale-110 smooth-transition"></i>
                                    </div>
                                    <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm text-gray-800 text-xs px-2 py-1 rounded-lg font-medium">
                                        JPG
                                    </div>
                                    <p class="text-lg font-semibold text-gray-800 mt-3">Banner</p>
                                    <p class="text-sm text-gray-500">4.2 MB</p>
                                </div>
                                
                                <div class="relative group cursor-pointer hover-lift">
                                    <div class="aspect-square bg-gradient-to-br from-violet-400 to-violet-600 rounded-2xl flex items-center justify-center shadow-xl overflow-hidden">
                                        <i class="fas fa-image text-white text-4xl group-hover:scale-110 smooth-transition"></i>
                                    </div>
                                    <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm text-gray-800 text-xs px-2 py-1 rounded-lg font-medium">
                                        PNG
                                    </div>
                                    <p class="text-lg font-semibold text-gray-800 mt-3">Icon</p>
                                    <p class="text-sm text-gray-500">0.5 MB</p>
                                </div>
                                
                                <div class="relative group cursor-pointer hover-lift">
                                    <div class="aspect-square bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-2xl flex items-center justify-center shadow-xl overflow-hidden">
                                        <i class="fas fa-image text-white text-4xl group-hover:scale-110 smooth-transition"></i>
                                    </div>
                                    <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm text-gray-800 text-xs px-2 py-1 rounded-lg font-medium">
                                        PNG
                                    </div>
                                    <p class="text-lg font-semibold text-gray-800 mt-3">Chart</p>
                                    <p class="text-sm text-gray-500">1.9 MB</p>
                                </div>
                                
                                <div class="relative group cursor-pointer hover-lift">
                                    <div class="aspect-square bg-gradient-to-br from-amber-400 to-amber-600 rounded-2xl flex items-center justify-center shadow-xl overflow-hidden">
                                        <i class="fas fa-image text-white text-4xl group-hover:scale-110 smooth-transition"></i>
                                    </div>
                                    <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm text-gray-800 text-xs px-2 py-1 rounded-lg font-medium">
                                        JPG
                                    </div>
                                    <p class="text-lg font-semibold text-gray-800 mt-3">Graph</p>
                                    <p class="text-sm text-gray-500">2.4 MB</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts and Analytics Row -->
                

                <!-- Bottom Row -->
                
            </main>
        </div>
    </div>

    <script>
        // Filter Button Functionality (Run First)
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, setting up buttons...');
            
            // Get all filter buttons
            const buttons = document.querySelectorAll('.filter-btn');
            const mediaSections = document.querySelectorAll('.media-section');
            
            console.log('Found buttons:', buttons.length);
            console.log('Found sections:', mediaSections.length);
            
            // Add click listener to each button
            buttons.forEach((button, index) => {
                console.log('Adding click listener to button', index, button.textContent);
                
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('Button clicked!', this.textContent);
                    
                    // Remove green from all buttons
                    buttons.forEach(btn => {
                        btn.classList.remove('bg-green-500', 'text-white');
                        btn.classList.add('bg-gray-100', 'text-gray-600');
                    });
                    
                    // Add green to clicked button
                    this.classList.remove('bg-gray-100', 'text-gray-600');
                    this.classList.add('bg-green-500', 'text-white');
                    
                    console.log('Button styles updated');
                    
                    // Get the filter type
                    const filter = this.getAttribute('data-filter');
                    console.log('Filter type:', filter);
                    
                    // Show/hide content based on filter
                    mediaSections.forEach(section => {
                        const sectionType = section.getAttribute('data-type');
                        console.log('Processing section:', sectionType);
                        
                        if (filter === 'all') {
                            section.style.display = 'block';
                            console.log('Showing section:', sectionType);
                        } else if (filter === sectionType) {
                            section.style.display = 'block';
                            console.log('Showing section:', sectionType);
                        } else {
                            section.style.display = 'none';
                            console.log('Hiding section:', sectionType);
                        }
                    });
                });
            });
            
            console.log('Button setup complete');
        });

        // Project Analytics Chart (Run After Buttons)
        document.addEventListener('DOMContentLoaded', function() {
            try {
                const ctx = document.getElementById('analyticsChart');
                if (ctx) {
                    const chartCtx = ctx.getContext('2d');
                    new Chart(chartCtx, {
                        type: 'bar',
                        data: {
                            labels: ['S', 'M', 'T', 'W', 'T', 'F', 'S'],
                            datasets: [{
                                data: [20, 80, 74, 85, 30, 25, 35],
                                backgroundColor: [
                                    '#e5e7eb',
                                    '#10b981',
                                    '#10b981',
                                    '#10b981',
                                    '#e5e7eb',
                                    '#e5e7eb',
                                    '#e5e7eb'
                                ],
                                borderWidth: 0,
                                borderRadius: 4
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    display: false
                                },
                                x: {
                                    display: true,
                                    grid: {
                                        display: false
                                    }
                                }
                            }
                        }
                    });
                }
            } catch (error) {
                console.log('Chart error (non-critical):', error);
            }
        });

        // Add Project Modal Functions
        function openAddProjectModal() {
            document.getElementById('addProjectModal').classList.remove('hidden');
        }

        function closeAddProjectModal() {
            document.getElementById('addProjectModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.addEventListener('click', function(e) {
            const modal = document.getElementById('addProjectModal');
            if (e.target === modal) {
                closeAddProjectModal();
            }
        });
    </script>
</body>
</html>

<!-- Add Project Modal -->
<div id="addProjectModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl max-w-5xl w-full mx-4 max-h-[95vh] overflow-y-auto border border-gray-100">
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-8 border-b border-gray-100 bg-gradient-to-r from-green-50 to-blue-50 rounded-t-2xl">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-plus text-white text-xl"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Add New Project</h2>
                    <p class="text-sm text-gray-600">Create a new b-roll generation project</p>
                </div>
            </div>
            <button onclick="closeAddProjectModal()" class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 p-2 rounded-lg transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="p-8">
            <form class="space-y-8">
                <!-- Project Name -->
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-100">
                    <label class="block text-sm font-semibold text-gray-800 mb-3 flex items-center">
                        <i class="fas fa-folder text-green-500 mr-2"></i>
                        Project Name
                    </label>
                    <input type="text" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 bg-white shadow-sm" placeholder="Enter your project name">
                </div>

                <!-- Aspect Ratio -->
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-100">
                    <label class="block text-sm font-semibold text-gray-800 mb-3 flex items-center">
                        <i class="fas fa-expand-arrows-alt text-blue-500 mr-2"></i>
                        Aspect Ratio
                    </label>
                    <select class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 bg-white shadow-sm">
                        <option>16:9 (Widescreen)</option>
                        <option>9:16 (Vertical/Portrait)</option>
                        <option>1:1 (Square)</option>
                        <option>4:3 (Standard)</option>
                        <option>21:9 (Ultrawide)</option>
                        <option>3:2 (Photo Standard)</option>
                    </select>
                </div>

                <!-- AI Models -->
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl p-6 border border-purple-100">
                    <h3 class="text-lg font-semibold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-robot text-purple-500 mr-2"></i>
                        AI Models
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-800 mb-3 flex items-center">
                                <i class="fas fa-video text-purple-500 mr-2"></i>
                                Video AI Model
                            </label>
                            <select class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-white shadow-sm">
                                <option>Seedance v1.0 lite</option>
                                
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-800 mb-3 flex items-center">
                                <i class="fas fa-image text-pink-500 mr-2"></i>
                                Photo AI Model
                            </label>
                            <select class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-200 bg-white shadow-sm">
                                <option>Seedream 4.0</option>
                                
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Video Duration & Target Audience -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-blue-50 rounded-xl p-6 border border-blue-100">
                        <label class="block text-sm font-semibold text-gray-800 mb-3 flex items-center">
                            <i class="fas fa-clock text-blue-500 mr-2"></i>
                            Video Duration
                        </label>
                        <select class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white shadow-sm">
                            <option>3 seconds</option>
                         
                        </select>
                    </div>
                    <div class="bg-orange-50 rounded-xl p-6 border border-orange-100">
                        <label class="block text-sm font-semibold text-gray-800 mb-3 flex items-center">
                            <i class="fas fa-users text-orange-500 mr-2"></i>
                            Target Audience
                        </label>
                        <input type="text" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 bg-white shadow-sm" placeholder="Describe your target audience (e.g., young professionals, families with children, tech enthusiasts, etc.)">
                    </div>
                </div>

                <!-- Script Section (Most Important) -->
                <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-8 border-2 border-green-200 shadow-lg">
                    <div class="flex items-center justify-between mb-6">
                        <label class="block text-lg font-bold text-gray-800 flex items-center">
                            <i class="fas fa-file-text text-green-500 mr-3 text-xl"></i>
                            Script / Content
                            <span class="ml-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full">REQUIRED</span>
                        </label>
                        
                    </div>
                    
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-green-100 to-emerald-100 rounded-xl opacity-20"></div>
                        <textarea 
                            class="relative w-full h-80 px-6 py-4 border-2 border-green-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-green-500 focus:border-transparent resize-none bg-white shadow-inner transition-all duration-200 text-gray-700" 
                            placeholder="Paste or write your script here... This is the most important part for generating relevant b-roll content.

📝 Include:
• Scene descriptions
• Dialogue or narration  
• Key moments to capture
• Visual requirements
• Any specific shots needed

💡 Example:
Scene 1: Opening shot of busy city street
- Wide establishing shot
- People walking quickly
- Traffic moving
- Urban atmosphere

Scene 2: Close-up of hands typing
- Focus on keyboard
- Quick, precise movements
- Professional setting"
                        ></textarea>
                    </div>
                    
                    <div class="mt-4 flex items-start space-x-3">
                        <div class="flex-shrink-0">
                            <i class="fas fa-lightbulb text-yellow-500 text-lg"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 font-medium">
                                Pro Tip: The more detailed your script, the better we can match b-roll content to your needs.
                            </p>
                            <p class="text-xs text-gray-500 mt-1">
                                Include specific visual descriptions, camera angles, and mood requirements for best results.
                            </p>
                        </div>
                    </div>
                </div>

            </form>
        </div>

        <!-- Modal Footer -->
        <div class="flex items-center justify-between p-8 border-t border-gray-100 bg-gradient-to-r from-gray-50 to-gray-100 rounded-b-2xl">
            <div class="flex items-center text-sm text-gray-500">
                <i class="fas fa-info-circle mr-2"></i>
                All fields are required for optimal b-roll generation
            </div>
            <div class="flex items-center space-x-4">
                <button onclick="closeAddProjectModal()" class="px-6 py-3 text-gray-600 hover:text-gray-800 font-medium hover:bg-gray-200 rounded-xl transition-all duration-200">
                    <i class="fas fa-times mr-2"></i>
                    Cancel
                </button>
                <button class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-8 py-3 rounded-xl font-semibold flex items-center space-x-2 shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                    <i class="fas fa-magic"></i>
                    <span>Generate B-Roll</span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Detect operating system
    const isMac = navigator.platform.toUpperCase().indexOf('MAC') >= 0;
    const isWindows = navigator.platform.toUpperCase().indexOf('WIN') >= 0;
    
    // Update shortcut text based on OS
    const shortcutText = document.getElementById('shortcutText');
    if (isMac) {
        shortcutText.textContent = '⌘F';
    } else if (isWindows) {
        shortcutText.textContent = 'Ctrl+F';
    } else {
        shortcutText.textContent = 'Ctrl+F';
    }
    
    // Get search input
    const searchInput = document.querySelector('input[placeholder="Search task"]');
    
    // Handle keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Check for Cmd+F (Mac) or Ctrl+F (Windows/Linux)
        if ((isMac && e.metaKey && e.key === 'f') || 
            (!isMac && e.ctrlKey && e.key === 'f')) {
            e.preventDefault();
            searchInput.focus();
            searchInput.select();
        }
    });
    
    // Handle button click
    document.getElementById('searchShortcut').addEventListener('click', function() {
        searchInput.focus();
        searchInput.select();
    });
});
</script>
