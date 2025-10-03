<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        <div class="w-56 glass-effect rounded-2xl m-3 shadow-xl border border-white/20">
            <!-- Logo -->
            <div class="p-5">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-video text-white text-sm"></i>
                    </div>
                    <div>
                        <span class="text-xl font-bold gradient-text">GoldenTree</span>
                        <p class="text-xs text-gray-500 font-medium">AI Studio</p>
                    </div>
                </div>
            </div>

            <!-- Menu -->
            <div class="px-5">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">PROJECTS</h3>
                <nav class="space-y-2">
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg shadow-lg hover-lift smooth-transition">
                        <i class="fas fa-th-large text-sm"></i>
                        <span class="font-medium text-sm">Project 1</span>
                        <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                    </a>
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 text-gray-700 hover:bg-gradient-to-r hover:from-gray-50 hover:to-gray-100 rounded-lg smooth-transition hover-lift">
                        <i class="fas fa-tasks text-sm"></i>
                        <span class="font-medium text-sm">Project 2</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 text-gray-700 hover:bg-gradient-to-r hover:from-gray-50 hover:to-gray-100 rounded-lg smooth-transition hover-lift">
                        <i class="fas fa-calendar text-sm"></i>
                        <span class="font-medium text-sm">Project 3</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 text-gray-700 hover:bg-gradient-to-r hover:from-gray-50 hover:to-gray-100 rounded-lg smooth-transition hover-lift">
                        <i class="fas fa-chart-bar text-sm"></i>
                        <span class="font-medium text-sm">Project 4</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 text-gray-700 hover:bg-gradient-to-r hover:from-gray-50 hover:to-gray-100 rounded-lg smooth-transition hover-lift">
                        <i class="fas fa-users text-sm"></i>
                        <span class="font-medium text-sm">Project 5</span>
                    </a>
                </nav>
            </div>

            <!-- General -->
            <div class="px-5 mt-6">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">GENERAL</h3>
                <nav class="space-y-2">
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 text-gray-700 hover:bg-gradient-to-r hover:from-gray-50 hover:to-gray-100 rounded-lg smooth-transition hover-lift">
                        <i class="fas fa-cog text-sm"></i>
                        <span class="font-medium text-sm">Settings</span>
                    </a>
                    
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 text-red-600 hover:bg-gradient-to-r hover:from-red-50 hover:to-red-100 rounded-lg smooth-transition hover-lift">
                        <i class="fas fa-sign-out-alt text-sm"></i>
                        <span class="font-medium text-sm">Logout</span>
                    </a>
                </nav>
            </div>

            <!-- Mobile App Card -->
            
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="glass-effect mr-3 shadow-xl my-3 rounded-2xl border border-white/20 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <input type="text" placeholder="Search your b-roll library..." class="w-80 pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 bg-white/80 backdrop-blur-sm shadow-lg smooth-transition">
                            <i class="fas fa-search absolute left-3 top-4 text-gray-400 text-sm"></i>
                        </div>
                        <button id="searchShortcut" class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-4 py-3 rounded-xl text-sm font-medium shadow-lg hover-lift smooth-transition">
                            <i class="fas fa-keyboard mr-1"></i><span id="shortcutText">⌘F</span>
                        </button>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-3">
                            <div class="relative">
                                <div class="w-2 h-2 bg-green-500 rounded-full absolute -top-1 -right-1 animate-pulse"></div>
                                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=40&h=40&fit=crop&crop=face" alt="Profile" class="w-10 h-10 rounded-xl shadow-lg border-2 border-white">
                            </div>
                            <div>
                                <p class="font-bold text-gray-800">Totok Michael</p>
                                <p class="text-xs text-gray-500 font-medium">Creative Director</p>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <main class="flex-1 p-6 overflow-y-auto glass-effect rounded-2xl shadow-xl my-3 border border-white/20">
                <!-- Dashboard Header -->
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h1 class="text-3xl font-bold gradient-text mb-2">B-Roll Library</h1>
                        <p class="text-gray-600 font-medium">Generate, search, and discover amazing b-roll content for your projects.</p>
                    </div>
                    <div class="flex space-x-3">
                        <button class="gradient-button px-6 py-3 rounded-xl font-semibold flex items-center space-x-2 shadow-lg hover-lift" onclick="openAddProjectModal()">
                            <i class="fas fa-plus"></i>
                            <span>Create Project</span>
                        </button>
                        <button onclick="openImportMediaModal()" class="bg-gradient-to-r from-slate-500 to-slate-600 hover:from-slate-600 hover:to-slate-700 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover-lift smooth-transition">
                            <i class="fas fa-upload mr-2"></i>
                            Import Media
                        </button>
                    </div>
                </div>

                <!-- Project Summary Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Last Project -->
                    <div class="modern-card rounded-2xl overflow-hidden hover-lift">
                        <div class="relative aspect-video">
                            <img src="https://images.unsplash.com/photo-1551650975-87deedd944c3?w=200&h=120&fit=crop" alt="Project 1" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                            <div class="absolute bottom-3 left-3 right-3">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="text-white font-bold text-lg">Project Alpha</div>
                                        <div class="text-white/80 text-sm">Creative Campaign</div>
                                    </div>
                                    <div class="bg-green-500/90 backdrop-blur-sm text-white text-xs px-2 py-1 rounded-full font-medium">
                                        <i class="fas fa-check mr-1"></i>
                                        Done
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-5 bg-gradient-to-r from-blue-50 to-purple-50">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="text-xs text-gray-500 font-medium uppercase tracking-wide">Last Project</div>
                                   
                                </div>
                                <div class="flex items-center space-x-2">
                                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                                    <span class="text-xs text-gray-500">Active</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total API Cost -->
                    <div class="modern-card rounded-2xl p-6 hover-lift">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                                <i class="fas fa-dollar-sign text-white text-sm"></i>
                            </div>
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-arrow-up text-blue-500 text-sm"></i>
                                <span class="text-blue-500 font-semibold text-xs">+$12</span>
                            </div>
                        </div>
                        <div class="text-4xl font-bold text-blue-600 mb-2">$247</div>
                        <h3 class="text-gray-600 font-semibold mb-3">API Cost</h3>
                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white text-xs px-3 py-1 rounded-full inline-flex items-center shadow-lg">
                            <i class="fas fa-chart-line mr-1"></i>
                            This month
                        </div>
                    </div>

                    <!-- All Photos -->
                    <div class="modern-card rounded-2xl p-6 hover-lift">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-slate-500 to-slate-600 rounded-xl flex items-center justify-center shadow-lg">
                                <i class="fas fa-image text-white text-sm"></i>
                            </div>
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-arrow-up text-slate-500 text-sm"></i>
                                <span class="text-slate-500 font-semibold text-xs">+24</span>
                            </div>
                        </div>
                        <div class="text-4xl font-bold text-slate-600 mb-2">1,247</div>
                        <h3 class="text-gray-600 font-semibold mb-3">All Photos</h3>
                        <div class="bg-gradient-to-r from-slate-500 to-slate-600 text-white text-xs px-3 py-1 rounded-full inline-flex items-center shadow-lg">
                            <i class="fas fa-images mr-1"></i>
                            Total collection
                        </div>
                    </div>

                    <!-- All Videos -->
                    <div class="modern-card rounded-2xl p-6 hover-lift">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-xl flex items-center justify-center shadow-lg">
                                <i class="fas fa-video text-white text-sm"></i>
                            </div>
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-arrow-up text-cyan-500 text-sm"></i>
                                <span class="text-cyan-500 font-semibold text-xs">+8</span>
                            </div>
                        </div>
                        <div class="text-4xl font-bold text-cyan-600 mb-2">456</div>
                        <h3 class="text-gray-600 font-semibold mb-3">All Videos</h3>
                        <div class="bg-gradient-to-r from-cyan-500 to-cyan-600 text-white text-xs px-3 py-1 rounded-full inline-flex items-center shadow-lg">
                            <i class="fas fa-video mr-1"></i>
                            Total collection
                        </div>
                    </div>
                </div>

                <!-- Video & Photo Library -->
                <div class="mb-12">
                    

                    <!-- Media Gallery -->
                    <div class="modern-card rounded-3xl shadow-2xl p-8">
                        <div class="flex items-center justify-between mb-8">
                            <div class="flex space-x-4">
                                <button class="filter-btn px-6 py-3 bg-gradient-to-r from-slate-500 to-slate-600 text-white text-sm rounded-2xl font-semibold shadow-lg hover-lift smooth-transition" data-filter="all">
                                    <i class="fas fa-th mr-2"></i>All Media
                                </button>
                                <button class="filter-btn px-6 py-3 bg-gray-100  text-gray-600 text-sm rounded-2xl font-semibold smooth-transition hover-lift" data-filter="videos">
                                    <i class="fas fa-video mr-2"></i>Videos
                                </button>
                                <button class="filter-btn px-6 py-3 bg-gray-100  text-gray-600 text-sm rounded-2xl font-semibold smooth-transition hover-lift" data-filter="photos">
                                    <i class="fas fa-image mr-2"></i>Photos
                                </button>
                            </div>
                        </div>
                        
                        <!-- Video Grid -->
                        <div class="mb-12 media-section" data-type="videos">
                            <h4 class="text-xl font-bold text-gray-800 mb-8 flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-gray-500 to-gray-800 rounded-full flex items-center justify-center mr-3 shadow-lg">
                                    <i class="fas fa-video text-white text-sm"></i>
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
                                <div class="w-8 h-8 bg-gradient-to-br from-gray-500 to-gray-800 rounded-full flex items-center justify-center mr-3 shadow-lg">
                                    <i class="fas fa-image text-white text-sm"></i>
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
                    
                    // Reset all buttons to inactive state
                    buttons.forEach(btn => {
                        btn.classList.remove('bg-gradient-to-r', 'from-slate-500', 'to-slate-600', 'text-white', 'shadow-lg');
                        btn.classList.add('bg-gray-100', 'text-gray-600');
                    });
                    
                    // Set clicked button to active state
                    this.classList.remove('bg-gray-100', 'text-gray-600');
                    this.classList.add('bg-gradient-to-r', 'from-slate-500', 'to-slate-600', 'text-white', 'shadow-lg');
                    
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

        // Import Media Modal Functions
        function openImportMediaModal() {
            document.getElementById('importMediaModal').classList.remove('hidden');
        }

        function closeImportMediaModal() {
            document.getElementById('importMediaModal').classList.add('hidden');
        }

        let currentScriptId = null;
        let currentStep = 0;
        const steps = ['sentences', 'shotlist', 'prompts', 'images'];
        
        async function submitScript() {
            const scriptText = document.getElementById('scriptTextarea').value;
            
            if (!scriptText.trim()) {
                alert('Please enter a script/content before generating b-roll.');
                return;
            }
            
            // Start the automatic flow
            startAutomaticFlow(scriptText);
        }
        
        async function startAutomaticFlow(scriptText) {
            showStepLoading('Generating B-Roll', 'Processing your script automatically...');
            
            try {
                // Step 1: Split into sentences
                const formData = new FormData();
                formData.append('script', scriptText);
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                
                const response = await fetch('/script-processor', {
                    method: 'POST',
                    body: formData
                });
                
                const data = await response.json();
                
                if (data.success && data.script_id) {
                    currentScriptId = data.script_id;
                    
                    // Wait for sentences to be created
                    await waitForSentences();
                    
                    // Step 2: Generate shotlists
                    await generateShotlists();
                    
                    // Step 3: Enhance image prompts
                    await enhanceImagePrompts();
                    
                    // Step 4: Enhance video prompts
                    await enhanceVideoPrompts();
                    
                    // Show final results
                    showFinalResults();
                } else {
                    alert('Error processing script. Please try again.');
                    showFormState();
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Error processing script. Please try again.');
                showFormState();
            }
        }
        
        async function waitForSentences() {
            return new Promise((resolve, reject) => {
                const checkSentences = async () => {
                    try {
                        const response = await fetch(`/debug-script/${currentScriptId}`);
                        const data = await response.json();
                        
                        if (data.sentences_count > 0) {
                            resolve();
                        } else {
                            setTimeout(checkSentences, 1000);
                        }
                    } catch (error) {
                        reject(error);
                    }
                };
                checkSentences();
            });
        }
        
        async function generateShotlists() {
            const response = await fetch(`/script-processor/generate-shotlists/${currentScriptId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });
            
            // Wait for shotlists to be generated
            return new Promise((resolve) => {
                const checkShotlists = async () => {
                    try {
                        const response = await fetch(`/debug-script/${currentScriptId}`);
                        const data = await response.json();
                        
                        const allHaveShotlists = data.sentences.every(sentence => sentence.shotlist);
                        if (allHaveShotlists) {
                            resolve();
                        } else {
                            setTimeout(checkShotlists, 2000);
                        }
                    } catch (error) {
                        resolve(); // Continue even if check fails
                    }
                };
                setTimeout(checkShotlists, 2000);
            });
        }
        
        async function enhanceImagePrompts() {
            const response = await fetch(`/script-processor/enhance-image-prompts/${currentScriptId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });
            
            // Wait a bit for processing
            return new Promise(resolve => setTimeout(resolve, 3000));
        }
        
        async function enhanceVideoPrompts() {
            const response = await fetch(`/script-processor/enhance-video-prompts/${currentScriptId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });
            
            // Wait a bit for processing
            return new Promise(resolve => setTimeout(resolve, 3000));
        }
        
        async function showFinalResults() {
            try {
                const response = await fetch(`/debug-script/${currentScriptId}`);
                const data = await response.json();
                
                let html = `
                    <div class="min-h-screen bg-gray-50">
                        <!-- Header -->
                        <div class="bg-white shadow-sm border-b border-gray-200 px-8 py-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-6">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                            <i class="fas fa-check text-green-600 text-xl"></i>
                                        </div>
                                        <div>
                                            <h1 class="text-3xl font-bold text-gray-900">B-Roll Generation Complete!</h1>
                                            <p class="text-gray-600 mt-1">Successfully processed ${data.sentences_count} sentences with enhanced prompts</p>
                                        </div>
                                    </div>
                                    <button onclick="refreshFinalResults()" class="flex items-center space-x-2 px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition-colors shadow-sm">
                                        <i class="fas fa-sync-alt"></i>
                                        <span>Refresh</span>
                                    </button>
                                </div>
                                <button onclick="showFormState()" class="flex items-center space-x-2 px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                                    <i class="fas fa-arrow-left"></i>
                                    <span>Back to Form</span>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Content -->
                        <div class="px-8 py-8">
                            <div class="max-w-7xl mx-auto">
                                <div class="space-y-8">
                `;
                
                data.sentences.forEach((sentence, index) => {
                    if (sentence.shotlist) {
                        const shotlistData = JSON.parse(sentence.shotlist);
                        html += `
                            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                                <!-- Sentence Header (Always Visible) -->
                                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-8 py-6 cursor-pointer" onclick="toggleSentence(${index})">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-4">
                                            <div class="w-12 h-12 bg-white bg-opacity-20 backdrop-blur-sm rounded-full flex items-center justify-center text-white font-bold text-lg">
                                                ${index + 1}
                                            </div>
                                            <div>
                                                <h2 class="text-2xl font-bold text-white">Sentence ${index + 1}</h2>
                                                <p class="text-blue-100 mt-1 text-lg">${sentence.content.length > 80 ? sentence.content.substring(0, 80) + '...' : sentence.content}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-3">
                                            <span class="text-blue-100 text-sm">${shotlistData.length} shots</span>
                                            <i id="arrow-${index}" class="fas fa-chevron-down text-white transition-transform duration-200"></i>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Collapsible Shots Content -->
                                <div id="content-${index}" class="hidden">
                                    <div class="p-8">
                                        <div class="mb-6">
                                            <p class="text-gray-700 text-lg leading-relaxed bg-gray-50 p-6 rounded-2xl border border-gray-200">
                                                "${sentence.content}"
                                            </p>
                                        </div>
                                        <div class="grid gap-6">
                        `;
                        
                        shotlistData.forEach((shot, shotIndex) => {
                            html += `
                                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200 hover:shadow-md transition-shadow">
                                    <div class="flex items-start space-x-6">
                                        <!-- Shot Number -->
                                        <div class="flex-shrink-0">
                                            <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center text-sm font-bold text-gray-700">
                                                ${shot.second || shotIndex}
                                            </div>
                                        </div>
                                        
                                        <!-- Content -->
                                        <div class="flex-1 min-w-0">
                                            <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
                                                <!-- Left Column - Script and Prompts -->
                                                <div class="space-y-6">
                                                    <!-- Script Text -->
                                                    <div class="bg-white rounded-lg p-4 border border-gray-200">
                                                        <h3 class="text-sm font-semibold text-gray-800 mb-2 flex items-center">
                                                            <i class="fas fa-file-text text-gray-500 mr-2"></i>
                                                            Script Text
                                                        </h3>
                                                        <p class="text-gray-700 font-medium">"${shot.script || 'N/A'}"</p>
                                                    </div>
                                                    
                                                    <!-- Original Shot -->
                                                    <div class="bg-white rounded-lg p-4 border border-gray-200">
                                                        <h3 class="text-sm font-semibold text-gray-800 mb-2 flex items-center">
                                                            <i class="fas fa-eye text-gray-500 mr-2"></i>
                                                            Visual Description
                                                        </h3>
                                                        <p class="text-gray-600">${shot.shot || 'N/A'}</p>
                                                    </div>
                                                    
                                                    <!-- Image Prompt -->
                                                    ${shot.image_prompt ? `
                                                        <div class="bg-blue-50 border-2 border-blue-200 rounded-lg p-5">
                                                            <div class="flex items-center mb-3">
                                                                <i class="fas fa-palette text-blue-600 mr-3 text-lg"></i>
                                                                <h3 class="text-lg font-semibold text-blue-800">Enhanced Image Prompt</h3>
                                                            </div>
                                                            <p class="text-gray-700 leading-relaxed text-sm">${shot.image_prompt}</p>
                                                        </div>
                                                    ` : ''}
                                                    
                                                </div>
                                                
                                                <!-- Right Column - Image Placeholder -->
                                                <div class="flex justify-center xl:justify-end">
                                                    <div class="w-48 h-48 bg-gradient-to-br from-gray-100 to-gray-200 border-2 border-gray-300 rounded-xl flex items-center justify-center shadow-inner">
                                                        <div class="text-center">
                                                            <i class="fas fa-image text-gray-400 text-4xl mb-3"></i>
                                                            <p class="text-sm text-gray-500 font-medium">Ready for Image Generation</p>
                                                            <p class="text-xs text-gray-400 mt-1">Click "Generate Images" to create</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                        });
                        
                        html += `
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    }
                });
                
                html += `
                                </div>
                            </div>
                        </div>
                        
                        <!-- Footer -->
                        <div class="bg-white border-t border-gray-200 px-8 py-6">
                            <div class="max-w-7xl mx-auto flex justify-center">
                                <button onclick="generateImages()" class="bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white px-12 py-4 rounded-xl font-semibold text-lg shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105 flex items-center space-x-3">
                                    <i class="fas fa-magic"></i>
                                    <span>Generate Images</span>
                                    <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                
                const modalContent = document.querySelector('#addProjectModal .bg-white');
                modalContent.innerHTML = html;
            } catch (error) {
                console.error('Error showing results:', error);
                alert('Error loading results. Please try again.');
                showFormState();
            }
        }
        
        function refreshFinalResults() {
            // Get the current script ID from the global variable
            const scriptId = currentScriptId;
            if (scriptId) {
                // Show loading state
                const refreshButton = document.querySelector('button[onclick="refreshFinalResults()"]');
                const originalContent = refreshButton.innerHTML;
                refreshButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span>Refreshing...</span>';
                refreshButton.disabled = true;
                
                // Fetch updated results
                fetch(`/debug-script/${scriptId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Update the results display by calling the function directly
                        updateFinalResultsDisplay(data);
                        
                        // Restore button
                        refreshButton.innerHTML = originalContent;
                        refreshButton.disabled = false;
                    })
                    .catch(error => {
                        console.error('Error refreshing results:', error);
                        
                        // Restore button on error
                        refreshButton.innerHTML = originalContent;
                        refreshButton.disabled = false;
                    });
            } else {
                console.error('No script ID available for refresh');
            }
        }
        
        function updateFinalResultsDisplay(data) {
            let html = `
                <div class="min-h-screen bg-gray-50">
                    <!-- Header -->
                    <div class="bg-white shadow-sm border-b border-gray-200 px-8 py-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-6">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-check text-green-600 text-xl"></i>
                                    </div>
                                    <div>
                                        <h1 class="text-3xl font-bold text-gray-900">B-Roll Generation Complete!</h1>
                                        <p class="text-gray-600 mt-1">Successfully processed ${data.sentences_count} sentences with enhanced prompts</p>
                                    </div>
                                </div>
                                <button onclick="refreshFinalResults()" class="flex items-center space-x-2 px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition-colors shadow-sm">
                                    <i class="fas fa-sync-alt"></i>
                                    <span>Refresh</span>
                                </button>
                            </div>
                            <button onclick="showFormState()" class="flex items-center space-x-2 px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                                <i class="fas fa-arrow-left"></i>
                                <span>Back to Form</span>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Content -->
                    <div class="px-8 py-8">
                        <div class="max-w-7xl mx-auto">
                            <div class="space-y-4">
            `;
            
            data.sentences.forEach((sentence, index) => {
                if (sentence.shotlist) {
                    const shotlistData = JSON.parse(sentence.shotlist);
                    const shotsCount = shotlistData.length;
                    
                    html += `
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                            <!-- Sentence Header (Always Visible) -->
                            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-6 py-4 cursor-pointer hover:from-blue-600 hover:to-indigo-700 transition-all duration-200" onclick="toggleSentence(${index})">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-10 h-10 bg-white bg-opacity-20 backdrop-blur-sm rounded-full flex items-center justify-center text-white font-bold text-lg">
                                            ${index + 1}
                                        </div>
                                        <div>
                                            <h2 class="text-xl font-bold text-white">Sentence ${index + 1}</h2>
                                            <p class="text-blue-100 mt-1">"${sentence.content}"</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <div class="text-white text-sm">
                                            <span class="font-medium">${shotsCount} shots</span>
                                        </div>
                                        <div class="transform transition-transform duration-200" id="arrow-${index}">
                                            <i class="fas fa-chevron-down text-white text-lg"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Collapsible Content -->
                            <div class="hidden" id="content-${index}" style="display: none;">
                                <div class="p-6">
                                    <div class="grid gap-6">
                    `;
                    
                    shotlistData.forEach((shot, shotIndex) => {
                        html += `
                            <div class="bg-gray-50 rounded-xl p-6 border border-gray-200 hover:shadow-md transition-shadow">
                                <div class="flex items-start space-x-6">
                                    <!-- Shot Number -->
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center text-sm font-bold text-gray-700">
                                            ${shot.second || shotIndex}
                                        </div>
                                    </div>
                                    
                                    <!-- Content -->
                                    <div class="flex-1 min-w-0">
                                        <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
                                            <!-- Left Column - Script and Prompts -->
                                            <div class="space-y-6">
                                                <!-- Script Text -->
                                                <div class="bg-white rounded-lg p-4 border border-gray-200">
                                                    <h3 class="text-sm font-semibold text-gray-800 mb-2 flex items-center">
                                                        <i class="fas fa-file-text text-gray-500 mr-2"></i>
                                                        Script Text
                                                    </h3>
                                                    <p class="text-gray-700 font-medium">"${shot.script || 'N/A'}"</p>
                                                </div>
                                                
                                                <!-- Original Shot -->
                                                <div class="bg-white rounded-lg p-4 border border-gray-200">
                                                    <h3 class="text-sm font-semibold text-gray-800 mb-2 flex items-center">
                                                        <i class="fas fa-eye text-gray-500 mr-2"></i>
                                                        Visual Description
                                                    </h3>
                                                    <p class="text-gray-600">${shot.shot || 'N/A'}</p>
                                                </div>
                                                
                                                <!-- Image Prompt -->
                                                ${shot.image_prompt ? `
                                                    <div class="bg-blue-50 border-2 border-blue-200 rounded-lg p-5">
                                                        <div class="flex items-center mb-3">
                                                            <i class="fas fa-palette text-blue-600 mr-3 text-lg"></i>
                                                            <h3 class="text-lg font-semibold text-blue-800">Enhanced Image Prompt</h3>
                                                        </div>
                                                        <p class="text-gray-700 leading-relaxed text-sm">${shot.image_prompt}</p>
                                                    </div>
                                                ` : ''}
                                                
                                            </div>
                                            
                                            <!-- Right Column - Image Placeholder -->
                                            <div class="flex justify-center xl:justify-end">
                                                <div class="w-48 h-48 bg-gradient-to-br from-gray-100 to-gray-200 border-2 border-gray-300 rounded-xl flex items-center justify-center shadow-inner">
                                                    <div class="text-center">
                                                        <i class="fas fa-image text-gray-400 text-4xl mb-3"></i>
                                                        <p class="text-sm text-gray-500 font-medium">Ready for Image Generation</p>
                                                        <p class="text-xs text-gray-400 mt-1">Click "Generate Images" to create</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                    
                    html += `
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                }
            });
            
            html += `
                            </div>
                        </div>
                    </div>
                    
                    <!-- Footer -->
                    <div class="bg-white border-t border-gray-200 px-8 py-6">
                        <div class="max-w-7xl mx-auto flex justify-center">
                            <button onclick="generateImages()" class="bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white px-12 py-4 rounded-xl font-semibold text-lg shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105 flex items-center space-x-3">
                                <i class="fas fa-magic"></i>
                                <span>Generate Images</span>
                                <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
            
            // Update the modal content
            const modalContent = document.querySelector('#addProjectModal .bg-white');
            modalContent.innerHTML = html;
        }
        
        function toggleSentence(index) {
            const content = document.getElementById(`content-${index}`);
            const arrow = document.getElementById(`arrow-${index}`);
            
            if (content.style.display === 'none' || content.classList.contains('hidden')) {
                content.style.display = 'block';
                content.classList.remove('hidden');
                arrow.style.transform = 'rotate(180deg)';
            } else {
                content.style.display = 'none';
                content.classList.add('hidden');
                arrow.style.transform = 'rotate(0deg)';
            }
        }
        
        async function generateImages() {
            showStepLoading('Generating Images', 'Creating images for all shots...');
            
            try {
                const response = await fetch(`/script-processor/generate-images/${currentScriptId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
                
                const data = await response.json();
                if (data.success) {
                    // Show results immediately, just like we do with prompts
                    showImageResultsImmediately();
                } else {
                    alert('Error generating images. Please try again.');
                    showFormState();
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Error generating images. Please try again.');
                showFormState();
            }
        }
        
        async function showImageResultsImmediately() {
            try {
                // Fetch current script data with assets
                const response = await fetch(`/debug-script/${currentScriptId}`);
                const data = await response.json();
                
                if (data.sentences) {
                    showImageResults({ sentences: data.sentences });
                    // Start polling to update images automatically
                    console.log('Starting image polling...');
                    startImagePolling();
                } else {
                    alert('Error loading script data. Please try again.');
                    showFormState();
                }
            } catch (error) {
                console.error('Error loading script data:', error);
                alert('Error loading script data. Please try again.');
                showFormState();
            }
        }
        
        let imagePollingInterval = null;
        
        function startImagePolling() {
            // Clear any existing polling
            if (imagePollingInterval) {
                clearInterval(imagePollingInterval);
            }
            
            console.log('Image polling started, will check every 3 seconds...');
            
            // Poll every 3 seconds to update images
            imagePollingInterval = setInterval(async () => {
                console.log('Polling for image updates...');
                try {
                    const response = await fetch(`/debug-script/${currentScriptId}`);
                    const data = await response.json();
                    
                    console.log('Polling response:', data);
                    console.log('First sentence structure:', data.sentences?.[0]);
                    console.log('First sentence assets:', data.sentences?.[0]?.assets);
                    
                    if (data.sentences) {
                        updateImagesInTable(data.sentences);
                    }
                } catch (error) {
                    console.error('Error polling for images:', error);
                }
            }, 3000);
        }
        
        function updateImagesInTable(sentences) {
            console.log('updateImagesInTable called with:', sentences);
            
            // Update each sentence's images in the table
            sentences.forEach((sentence, sentenceIndex) => {
                console.log(`Processing sentence ${sentenceIndex}:`, sentence);
                
                if (sentence.shotlist) {
                    const shotlistData = JSON.parse(sentence.shotlist);
                    
                    shotlistData.forEach((shot, shotIndex) => {
                        const imageAsset = sentence.assets ? sentence.assets.find(asset => 
                            asset.type === 'image' && 
                            asset.metadata && 
                            asset.metadata.shot_index === shotIndex
                        ) : null;
                        
                        console.log(`Shot ${shotIndex} image asset:`, imageAsset);
                        console.log(`All assets for sentence ${sentenceIndex}:`, sentence.assets);
                        if (sentence.assets && sentence.assets.length > 0) {
                            console.log(`First asset structure:`, sentence.assets[0]);
                            console.log(`First asset metadata:`, sentence.assets[0].metadata);
                            console.log(`First asset shot_index:`, sentence.assets[0].metadata?.shot_index);
                        }
                        
                        // Find the image container in the new gallery layout and update it
                        const imageContainer = document.querySelector(`[data-sentence="${sentenceIndex}"][data-shot="${shotIndex}"] .aspect-video`);
                        console.log(`Image container for sentence ${sentenceIndex}, shot ${shotIndex}:`, imageContainer);
                        
                        if (imageContainer) {
                            if (imageAsset && imageAsset.url) {
                                console.log(`Updating image for sentence ${sentenceIndex}, shot ${shotIndex} with URL: ${imageAsset.url}`);
                                imageContainer.innerHTML = `
                                    <img src="${imageAsset.url}" alt="Generated image for shot ${shotIndex + 1}" class="w-full h-full object-cover">
                                    <div class="absolute top-3 right-3 bg-white bg-opacity-90 backdrop-blur-sm rounded-full px-3 py-1 shadow-md">
                                        <span class="text-xs font-semibold text-gray-700">Shot ${shotIndex + 1}</span>
                                    </div>
                                `;
                            } else {
                                console.log(`No image asset found for sentence ${sentenceIndex}, shot ${shotIndex}`);
                            }
                        } else {
                            console.log(`Image cell not found for sentence ${sentenceIndex}, shot ${shotIndex}`);
                        }
                    });
                }
            });
        }
        
        let retryCount = 0;
        const maxRetries = 10;
        let pollCount = 0;
        const maxPolls = 30; // 30 polls = 1 minute of polling
        
        async function pollForImageCompletion() {
            pollCount++;
            console.log(`Polling attempt ${pollCount}/${maxPolls}`);
            
            try {
                const response = await fetch(`/script-processor/status/${currentScriptId}`);
                
                if (!response.ok) {
                    console.error('HTTP error:', response.status, response.statusText);
                    retryCount++;
                    if (retryCount < maxRetries) {
                        // Retry after a delay instead of showing error immediately
                        setTimeout(() => pollForImageCompletion(), 5000);
                        return;
                    } else {
                        alert('Error checking image generation status. Please try again.');
                        showFormState();
                        return;
                    }
                }
                
                const data = await response.json();
                console.log('Status check response:', data);
                console.log('Sentences with assets:', data.sentences?.map(s => ({
                    id: s.id,
                    assets_count: s.assets?.length || 0,
                    image_assets: s.assets?.filter(a => a.type === 'image').length || 0
                })));
                
                if (data.success) {
                    // Show results if we have any images, regardless of completion status
                    const hasImages = data.sentences && data.sentences.some(sentence => 
                        sentence.assets && sentence.assets.some(asset => asset.type === 'image')
                    );
                    
                    console.log('Has images:', hasImages, 'Completed:', data.completed);
                    
                    if (hasImages || data.completed || pollCount >= maxPolls) {
                        console.log('Showing image results...');
                        showImageResults(data);
                    } else {
                        console.log('Still processing...', data.message || 'No message');
                        setTimeout(() => pollForImageCompletion(), 2000);
                    }
                } else {
                    console.log('Still processing...', data.message || 'No message');
                    setTimeout(() => pollForImageCompletion(), 2000);
                }
            } catch (error) {
                console.error('Error polling image completion:', error);
                retryCount++;
                if (retryCount < maxRetries) {
                    // Instead of showing error immediately, retry a few times
                    console.log('Retrying status check in 5 seconds...');
                    setTimeout(() => pollForImageCompletion(), 5000);
                } else {
                    alert('Error checking image generation status. Please try again.');
                    showFormState();
                }
            }
        }
        
        function showImageResults(data) {
            let html = `
                <div class="flex items-center justify-between mb-8 px-6 py-8">
                    <div class="flex items-center space-x-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-images text-white text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-3xl font-bold text-gray-800">📸 Generated Images</h3>
                            <p class="text-gray-600 mt-1">Your AI-generated b-roll images are ready!</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <button onclick="refreshImageResults()" class="flex items-center space-x-2 px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition-colors shadow-sm text-sm">
                            <i class="fas fa-sync-alt"></i>
                            <span>Refresh</span>
                        </button>
                        <button onclick="showFormState()" class="flex items-center space-x-3 px-6 py-3 bg-gradient-to-r from-gray-100 to-gray-200 hover:from-gray-200 hover:to-gray-300 text-gray-700 rounded-xl font-semibold transition-all duration-200 shadow-md hover:shadow-lg">
                            <i class="fas fa-arrow-left"></i>
                            <span>Back to Form</span>
                        </button>
                    </div>
                </div>
            `;
            
            data.sentences.forEach((sentence, index) => {
                if (sentence.shotlist) {
                    const shotlistData = JSON.parse(sentence.shotlist);
                    
                    html += `
                        <div class="mb-12 bg-gradient-to-br from-white to-gray-50 rounded-3xl p-8 shadow-xl border border-gray-100">
                            <div class="mb-8">
                                <div class="flex items-center space-x-3 mb-4">
                                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center text-white font-bold text-lg">
                                        ${index + 1}
                                    </div>
                                    <h4 class="text-xl font-bold text-gray-800">Sentence ${index + 1}</h4>
                                </div>
                                <p class="text-gray-700 text-lg leading-relaxed bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
                                    "${sentence.content}"
                                </p>
                            </div>
                            
                            <!-- Image Gallery -->
                            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-8 mb-8">
                    `;
                    
                    shotlistData.forEach((shot, shotIndex) => {
                        const imageAsset = sentence.assets ? sentence.assets.find(asset => 
                            asset.type === 'image' && 
                            asset.metadata && 
                            asset.metadata.shot_index === shotIndex
                        ) : null;
                        
                        html += `
                            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 image-card cursor-pointer" data-sentence="${index}" data-shot="${shotIndex}" onclick="selectImage(this, ${index}, ${shotIndex})">
                                <!-- Image Container -->
                                <div class="relative aspect-video bg-gradient-to-br from-gray-100 to-gray-200">
                                    ${imageAsset ? `
                                        <img src="${imageAsset.url}" alt="Generated image for shot ${shotIndex + 1}" class="w-full h-full object-cover">
                                        <div class="absolute top-3 right-3 bg-white bg-opacity-90 backdrop-blur-sm rounded-full px-3 py-1 shadow-md">
                                            <span class="text-xs font-semibold text-gray-700">Shot ${shotIndex + 1}</span>
                                        </div>
                                    ` : `
                                        <div class="w-full h-full flex items-center justify-center">
                                            <div class="text-center">
                                                <div class="w-16 h-16 bg-gray-200 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                                    <i class="fas fa-spinner fa-spin text-gray-400 text-2xl"></i>
                                                </div>
                                                <p class="text-sm text-gray-500 font-medium">Generating...</p>
                                            </div>
                                        </div>
                                    `}
                                    <!-- Selection Overlay -->
                                    <div class="absolute inset-0 bg-blue-500 bg-opacity-0 transition-all duration-200 selection-overlay">
                                        <div class="absolute top-3 left-3 w-6 h-6 bg-white rounded-full flex items-center justify-center shadow-lg opacity-0 selection-check">
                                            <i class="fas fa-check text-blue-600 text-sm"></i>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Content Section -->
                                <div class="p-6">
                                    <!-- Script Part -->
                                    <div class="mb-4">
                                        <h5 class="text-sm font-semibold text-gray-600 mb-2 flex items-center">
                                            <i class="fas fa-file-text text-blue-500 mr-2"></i>
                                            Script Part
                                        </h5>
                                        <p class="text-gray-800 font-medium">${shot.script || 'N/A'}</p>
                                    </div>
                                    
                                    <!-- Visual Description -->
                                    <div class="mb-4">
                                        <h5 class="text-sm font-semibold text-gray-600 mb-2 flex items-center">
                                            <i class="fas fa-eye text-green-500 mr-2"></i>
                                            Visual Description
                                        </h5>
                                        <p class="text-gray-700 text-sm leading-relaxed">${shot.shot || 'N/A'}</p>
                                    </div>
                                    
                                    <!-- Image Prompt -->
                                    ${shot.image_prompt ? `
                                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-4">
                                            <h5 class="text-sm font-semibold text-blue-700 mb-2 flex items-center">
                                                <i class="fas fa-palette text-blue-600 mr-2"></i>
                                                Enhanced Image Prompt
                                            </h5>
                                            <p class="text-gray-700 text-sm leading-relaxed">${shot.image_prompt}</p>
                                        </div>
                                    ` : ''}
                                </div>
                            </div>
                        `;
                    });
                    
                    html += `
                            </div>
                        </div>
                    `;
                }
            });
            
            html += `
                <!-- Selection Counter -->
                <div class="mt-12 text-center">
                    <div class="inline-flex items-center space-x-2 bg-white rounded-full px-6 py-3 shadow-md border border-gray-200">
                        <i class="fas fa-check-circle text-blue-500"></i>
                        <span class="text-gray-700 font-semibold">
                            <span id="selected-count">0</span> images selected
                        </span>
                    </div>
                </div>
                
                <div class="mt-8 text-center bg-gradient-to-r from-purple-50 to-pink-50 rounded-3xl p-8 border border-purple-100">
                    <div class="mb-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-check text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">Images Generated Successfully!</h3>
                        <p class="text-gray-600">Your b-roll images are ready for your video project.</p>
                    </div>
                    <button onclick="showFormState()" class="bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white px-10 py-4 rounded-2xl font-bold text-lg shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105 flex items-center space-x-3 mx-auto">
                        <i class="fas fa-plus"></i>
                        <span>Create New Project</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            `;
            
            const modalContent = document.querySelector('#addProjectModal .bg-white');
            modalContent.innerHTML = html;
            
            // Restore selection state after modal is rendered
            setTimeout(() => {
                restoreSelectionState();
                console.log('selectImage function available?', typeof window.selectImage);
                console.log('Available image cards:', document.querySelectorAll('.image-card').length);
            }, 100);
        }
        
        // Development refresh function
        async function refreshImageResults() {
            if (!currentScriptId) {
                alert('No script ID available for refresh');
                return;
            }
            
            try {
                // Store current selection state before refresh
                const currentSelections = new Set(selectedImages);
                
                const response = await fetch(`/debug-script/${currentScriptId}`);
                const data = await response.json();
                
                if (data.sentences) {
                    showImageResults({ sentences: data.sentences });
                    
                    // Restore selection state after a short delay
                    setTimeout(() => {
                        selectedImages = currentSelections;
                        restoreSelectionState();
                    }, 150);
                    
                    console.log('Image results refreshed successfully');
                } else {
                    alert('Error loading script data for refresh');
                }
            } catch (error) {
                console.error('Error refreshing image results:', error);
                alert('Error refreshing results. Please try again.');
            }
        }
        
        // Restore selection state after modal refresh
        function restoreSelectionState() {
            selectedImages.forEach(selectionKey => {
                const [sentenceIndex, shotIndex] = selectionKey.split('-').map(Number);
                const imageCard = document.querySelector(`[data-sentence="${sentenceIndex}"][data-shot="${shotIndex}"]`);
                
                if (imageCard) {
                    imageCard.classList.add('ring-4', 'ring-blue-500', 'ring-opacity-50');
                    const overlay = imageCard.querySelector('.selection-overlay');
                    const check = imageCard.querySelector('.selection-check');
                    
                    if (overlay) overlay.classList.add('bg-opacity-20');
                    if (check) check.classList.remove('opacity-0');
                }
            });
            
            updateSelectionUI();
        }
        
        // Simple image selection
        let selectedImages = new Set();
        
        function selectImage(element, sentenceIndex, shotIndex) {
            const selectionKey = `${sentenceIndex}-${shotIndex}`;
            
            if (selectedImages.has(selectionKey)) {
                // Deselect
                selectedImages.delete(selectionKey);
                element.classList.remove('ring-4', 'ring-blue-500', 'ring-opacity-50');
                const overlay = element.querySelector('.selection-overlay');
                const check = element.querySelector('.selection-check');
                if (overlay) overlay.classList.remove('bg-opacity-20');
                if (check) check.classList.add('opacity-0');
            } else {
                // Select
                selectedImages.add(selectionKey);
                element.classList.add('ring-4', 'ring-blue-500', 'ring-opacity-50');
                const overlay = element.querySelector('.selection-overlay');
                const check = element.querySelector('.selection-check');
                if (overlay) overlay.classList.add('bg-opacity-20');
                if (check) check.classList.remove('opacity-0');
            }
            
            updateSelectionCounter();
        }
        
        function updateSelectionCounter() {
            const countElement = document.getElementById('selected-count');
            if (countElement) {
                countElement.textContent = selectedImages.size;
            }
        }
        
        async function showStep1(scriptText) {
            showStepLoading('Step 1: Splitting Script into Sentences', 'Breaking down your script into individual sentences...');
            
            try {
                const formData = new FormData();
                formData.append('script', scriptText);
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                
                const response = await fetch('/script-processor', {
                    method: 'POST',
                    body: formData
                });
                
                const data = await response.json();
                
                if (data.success && data.script_id) {
                    currentScriptId = data.script_id;
                    // Wait for sentences to be created
                    pollForSentences();
                } else {
                    alert('Error processing script. Please try again.');
                    showFormState();
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Error processing script. Please try again.');
                showFormState();
            }
        }
        
        async function pollForSentences() {
            try {
                const response = await fetch(`/debug-script/${currentScriptId}`);
                const data = await response.json();
                
                if (data.sentences_count > 0) {
                    showStep1Results(data);
                } else {
                    setTimeout(() => pollForSentences(), 1000);
                }
            } catch (error) {
                console.error('Error polling sentences:', error);
                alert('Error checking sentences. Please try again.');
                showFormState();
            }
        }
        
        function showStep1Results(data) {
            let html = `
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-bold text-gray-800">✅ Step 1 Complete: Sentences Split</h3>
                    <button onclick="showFormState()" class="flex items-center space-x-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                        <i class="fas fa-arrow-left"></i>
                        <span>Back to Form</span>
                    </button>
                </div>
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                    <p class="text-green-800 font-medium">Successfully split script into ${data.sentences_count} sentences!</p>
                </div>
            `;
            
            data.sentences.forEach((sentence, index) => {
                html += `
                    <div class="mb-4 p-4 bg-white border border-gray-200 rounded-lg">
                        <div class="flex items-start">
                            <div class="w-8 h-8 bg-blue-500 text-white rounded-full flex items-center justify-center font-bold text-sm mr-3 mt-1">${index + 1}</div>
                            <div class="flex-1">
                                <p class="text-gray-700">${sentence.content}</p>
                            </div>
                        </div>
                    </div>
                `;
            });
            
            html += `
                <div class="mt-6 text-center">
                    <button onclick="startStep2()" class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold transition-colors">
                        Next: Generate Shotlists →
                    </button>
                </div>
            `;
            
            const modalContent = document.querySelector('#addProjectModal .bg-white');
            modalContent.innerHTML = html;
        }
        
        async function startStep2() {
            showStepLoading('Step 2: Generating Shotlists', 'Creating detailed shotlists for each sentence...');
            
            try {
                const response = await fetch(`/script-processor/generate-shotlists/${currentScriptId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
                
                const data = await response.json();
                if (data.success) {
                    pollForShotlists();
                } else {
                    alert('Error starting shotlist generation. Please try again.');
                    showFormState();
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Error starting shotlist generation. Please try again.');
                showFormState();
            }
        }
        
        async function pollForShotlists() {
            try {
                const response = await fetch(`/debug-script/${currentScriptId}`);
                const data = await response.json();
                
                const sentencesWithShotlists = data.sentences.filter(s => s.shotlist);
                
                if (sentencesWithShotlists.length === data.sentences.length) {
                    showStep2Results(data);
                } else {
                    setTimeout(() => pollForShotlists(), 2000);
                }
            } catch (error) {
                console.error('Error polling shotlists:', error);
                alert('Error checking shotlists. Please try again.');
                showFormState();
            }
        }
        
        function showStep2Results(data) {
            let html = `
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-bold text-gray-800">✅ Step 2 Complete: Shotlists Generated</h3>
                    <button onclick="showFormState()" class="flex items-center space-x-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                        <i class="fas fa-arrow-left"></i>
                        <span>Back to Form</span>
                    </button>
                </div>
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                    <p class="text-green-800 font-medium">Successfully generated shotlists for all sentences!</p>
                </div>
            `;
            
            data.sentences.forEach((sentence, index) => {
                if (sentence.shotlist) {
                    const shotlistData = JSON.parse(sentence.shotlist);
                    html += `
                        <div class="mb-6 p-4 bg-white border border-gray-200 rounded-lg">
                            <h4 class="font-semibold text-gray-800 mb-3">Sentence ${index + 1}: ${sentence.content.substring(0, 50)}...</h4>
                            <div class="space-y-2">
                    `;
                    
                    shotlistData.forEach((shot, shotIndex) => {
                        html += `
                            <div class="p-3 bg-gray-50 rounded border">
                                <div class="text-sm font-medium text-gray-700">Shot ${shotIndex + 1}: ${shot.script}</div>
                                <div class="text-sm text-gray-600 mt-1">${shot.shot}</div>
                            </div>
                        `;
                    });
                    
                    html += `
                            </div>
                        </div>
                    `;
                }
            });
            
            html += `
                <div class="mt-6 text-center">
                    <button onclick="startStep3()" class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold transition-colors">
                        Next: Enhance Image Prompts →
                    </button>
                </div>
            `;
            
            const modalContent = document.querySelector('#addProjectModal .bg-white');
            modalContent.innerHTML = html;
        }
        
        async function startStep3() {
            showStepLoading('Step 3: Enhancing Image Prompts', 'Enhancing image prompts using AI...');
            
            try {
                const response = await fetch(`/script-processor/enhance-image-prompts/${currentScriptId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
                
                const data = await response.json();
                if (data.success) {
                    showStep3Results();
                } else {
                    alert('Error enhancing image prompts. Please try again.');
                    showFormState();
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Error enhancing image prompts. Please try again.');
                showFormState();
            }
        }
        
        async function showStep3Results() {
            try {
                const response = await fetch(`/debug-script/${currentScriptId}`);
                const data = await response.json();
                
                let html = `
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-2xl font-bold text-gray-800">✅ Step 3 Complete: Image Prompts Enhanced</h3>
                        <button onclick="showFormState()" class="flex items-center space-x-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                            <i class="fas fa-arrow-left"></i>
                            <span>Back to Form</span>
                        </button>
                    </div>
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <p class="text-green-800 font-medium">Successfully enhanced image prompts for all shots!</p>
                    </div>
                `;
                
                data.sentences.forEach((sentence, index) => {
                    if (sentence.shotlist) {
                        const shotlistData = JSON.parse(sentence.shotlist);
                        html += `
                            <div class="mb-6 p-4 bg-white border border-gray-200 rounded-lg">
                                <h4 class="font-semibold text-gray-800 mb-3">Sentence ${index + 1}: ${sentence.content.substring(0, 50)}...</h4>
                                <div class="space-y-2">
                        `;
                        
                        shotlistData.forEach((shot, shotIndex) => {
                            html += `
                                <div class="p-3 bg-blue-50 rounded border border-blue-200">
                                    <div class="text-sm font-medium text-gray-700">Shot ${shotIndex + 1}: ${shot.script}</div>
                                    <div class="text-sm text-gray-600 mt-1">Original: ${shot.shot}</div>
                                    <div class="text-sm text-blue-600 mt-1 font-medium">Enhanced: ${shot.image_prompt || 'Not enhanced'}</div>
                                </div>
                            `;
                        });
                        
                        html += `
                                </div>
                            </div>
                        `;
                    }
                });
                
                html += `
                    <div class="mt-6 text-center">
                        <button onclick="startStep4()" class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold transition-colors">
                            Next: Enhance Video Prompts →
                        </button>
                    </div>
                `;
                
                const modalContent = document.querySelector('#addProjectModal .bg-white');
                modalContent.innerHTML = html;
            } catch (error) {
                console.error('Error:', error);
                alert('Error loading results. Please try again.');
                showFormState();
            }
        }
        
        async function startStep4() {
            showStepLoading('Step 4: Enhancing Video Prompts', 'Enhancing video prompts using AI...');
            
            try {
                const response = await fetch(`/script-processor/enhance-video-prompts/${currentScriptId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
                
                const data = await response.json();
                if (data.success) {
                    showStep4Results();
                } else {
                    alert('Error enhancing video prompts. Please try again.');
                    showFormState();
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Error enhancing video prompts. Please try again.');
                showFormState();
            }
        }
        
        async function showStep4Results() {
            try {
                const response = await fetch(`/debug-script/${currentScriptId}`);
                const data = await response.json();
                
                let html = `
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-2xl font-bold text-gray-800">✅ Step 4 Complete: Video Prompts Enhanced</h3>
                        <button onclick="showFormState()" class="flex items-center space-x-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                            <i class="fas fa-arrow-left"></i>
                            <span>Back to Form</span>
                        </button>
                    </div>
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <p class="text-green-800 font-medium">Successfully enhanced video prompts for all shots!</p>
                    </div>
                `;
                
                data.sentences.forEach((sentence, index) => {
                    if (sentence.shotlist) {
                        const shotlistData = JSON.parse(sentence.shotlist);
                        html += `
                            <div class="mb-6 p-4 bg-white border border-gray-200 rounded-lg">
                                <h4 class="font-semibold text-gray-800 mb-3">Sentence ${index + 1}: ${sentence.content.substring(0, 50)}...</h4>
                                <div class="space-y-2">
                        `;
                        
                        shotlistData.forEach((shot, shotIndex) => {
                            html += `
                                <div class="p-3 bg-green-50 rounded border border-green-200">
                                    <div class="text-sm font-medium text-gray-700">Shot ${shotIndex + 1}: ${shot.script}</div>
                                    <div class="text-sm text-gray-600 mt-1">Original: ${shot.shot}</div>
                                </div>
                            `;
                        });
                        
                        html += `
                                </div>
                            </div>
                        `;
                    }
                });
                
                html += `
                    <div class="mt-6 text-center">
                        <button onclick="startStep5()" class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold transition-colors">
                            Next: Generate Images →
                        </button>
                    </div>
                `;
                
                const modalContent = document.querySelector('#addProjectModal .bg-white');
                modalContent.innerHTML = html;
            } catch (error) {
                console.error('Error:', error);
                alert('Error loading results. Please try again.');
                showFormState();
            }
        }
        
        async function startStep5() {
            showStepLoading('Step 5: Generating Images', 'Creating images for each shot using Seedream...');
            
            try {
                const response = await fetch(`/script-processor/generate-images/${currentScriptId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
                
                const data = await response.json();
                if (data.success) {
                    pollForImages();
                } else {
                    alert('Error starting image generation. Please try again.');
                    showFormState();
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Error starting image generation. Please try again.');
                showFormState();
            }
        }
        
        async function pollForImages() {
            try {
                const response = await fetch(`/debug-script/${currentScriptId}`);
                const data = await response.json();
                
                const totalImages = data.sentences.reduce((sum, sentence) => sum + sentence.image_assets, 0);
                const totalExpected = data.sentences.reduce((sum, sentence) => {
                    if (sentence.shotlist) {
                        const shotlistData = JSON.parse(sentence.shotlist);
                        return sum + shotlistData.length;
                    }
                    return sum;
                }, 0);
                
                if (totalImages >= totalExpected && totalExpected > 0) {
                    showStep3Results(data);
                } else {
                    // Update progress
                    updateStepProgress(`Generating images... ${totalImages}/${totalExpected} completed`);
                    setTimeout(() => pollForImages(), 2000);
                }
            } catch (error) {
                console.error('Error polling images:', error);
                alert('Error checking images. Please try again.');
                showFormState();
            }
        }
        
        function showStep3Results(data) {
            let html = `
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-bold text-gray-800">🎉 All Steps Complete!</h3>
                    <button onclick="showFormState()" class="flex items-center space-x-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                        <i class="fas fa-arrow-left"></i>
                        <span>Back to Form</span>
                    </button>
                </div>
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                    <p class="text-green-800 font-medium">Successfully generated all images and completed the process!</p>
                </div>
            `;
            
            // Show final results with all data
            data.sentences.forEach((sentence, index) => {
                if (sentence.shotlist) {
                    const shotlistData = JSON.parse(sentence.shotlist);
                    html += `
                        <div class="mb-8 p-6 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl border border-blue-200 shadow-sm">
                            <div class="flex items-center mb-4">
                                <div class="w-8 h-8 bg-blue-500 text-white rounded-full flex items-center justify-center font-bold text-sm mr-3">${index + 1}</div>
                                <h4 class="text-lg font-semibold text-gray-800">Sentence ${index + 1}</h4>
                            </div>
                            <p class="text-gray-700 mb-4 p-4 bg-white rounded-lg border border-blue-100 shadow-sm">${sentence.content}</p>
                    `;
                    
                    if (shotlistData.length > 0) {
                        html += `<div class="overflow-x-auto">`;
                        html += `<table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">`;
                        html += `<thead class="bg-gradient-to-r from-gray-50 to-gray-100">`;
                        html += `<tr>`;
                        html += `<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Script Part</th>`;
                        html += `<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Original Shot</th>`;
                        html += `<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image Prompt</th>`;
                        html += `<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Video Prompt</th>`;
                        html += `<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Generated Image</th>`;
                        html += `</tr>`;
                        html += `</thead>`;
                        html += `<tbody class="divide-y divide-gray-200">`;
                        
                        shotlistData.forEach((shot, shotIndex) => {
                            const generatedImage = sentence.assets.find(asset => 
                                asset.type === 'image' && 
                                asset.metadata && 
                                asset.metadata.shot_index === shotIndex
                            );
                            
                            html += `<tr class="hover:bg-gray-50 transition-colors">`;
                            html += `<td class="px-4 py-3 text-sm text-gray-700 font-medium">${shot.script || 'N/A'}</td>`;
                            html += `<td class="px-4 py-3 text-sm text-gray-600">${shot.shot || 'N/A'}</td>`;
                            html += `<td class="px-4 py-3 text-sm text-gray-600">`;
                            if (shot.image_prompt) {
                                html += `<div class="bg-blue-50 border border-blue-200 rounded p-3 shadow-sm">`;
                                html += `<span class="text-xs text-blue-600 font-medium">🎨 Image:</span>`;
                                html += `<p class="text-xs text-gray-700 mt-1 leading-relaxed">${shot.image_prompt}</p>`;
                                html += `</div>`;
                            } else {
                                html += `<span class="text-gray-400">Not enhanced</span>`;
                            }
                            html += `</td>`;
                            html += `<td class="px-4 py-3 text-sm text-gray-600">`;
                            html += `<span class="text-gray-400">Video prompts hidden</span>`;
                            html += `</td>`;
                            html += `<td class="px-4 py-3 text-sm text-gray-600">`;
                            if (generatedImage && generatedImage.url) {
                                html += `<div class="relative group">`;
                                html += `<img src="${generatedImage.url}" alt="Generated image for shot ${shotIndex + 1}" class="w-24 h-24 object-cover rounded-lg border-2 border-gray-200 shadow-sm hover:shadow-md transition-shadow cursor-pointer">`;
                                html += `<div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 rounded-lg transition-all duration-200 flex items-center justify-center">`;
                                html += `<i class="fas fa-expand text-white opacity-0 group-hover:opacity-100 transition-opacity"></i>`;
                                html += `</div>`;
                                html += `</div>`;
                            } else {
                                html += `<div class="w-24 h-24 bg-gray-100 border-2 border-gray-200 rounded-lg flex items-center justify-center">`;
                                html += `<span class="text-xs text-gray-400">Generating...</span>`;
                                html += `</div>`;
                            }
                            html += `</td>`;
                            html += `</tr>`;
                        });
                        
                        html += `</tbody>`;
                        html += `</table>`;
                        html += `</div>`;
                    }
                    
                    html += `</div>`;
                }
            });
            
            const modalContent = document.querySelector('#addProjectModal .bg-white');
            modalContent.innerHTML = html;
        }
        
        async function pollForCompletion(scriptId) {
            try {
                const response = await fetch(`/script-processor/status/${scriptId}`);
                const data = await response.json();
                
                if (data.success && data.completed) {
                    // All processing is complete, show results
                    showResults(data);
                } else {
                    // Update progress if available
                    if (data.progress) {
                        updateLoadingProgress(data.progress);
                    }
                    // Still processing, poll again in 2 seconds
                    setTimeout(() => pollForCompletion(scriptId), 2000);
                }
            } catch (error) {
                console.error('Error polling status:', error);
                alert('Error checking processing status. Please try again.');
                showFormState();
            }
        }
        
        function showStepLoading(title, description) {
            const modalContent = document.querySelector('#addProjectModal .bg-white');
            modalContent.innerHTML = `
                <div class="flex flex-col items-center justify-center py-16">
                    <div class="animate-spin rounded-full h-16 w-16 border-b-2 border-blue-500 mb-6"></div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">${title}</h3>
                    <p class="text-gray-600 text-center max-w-md mb-4">
                        ${description}
                    </p>
                    <div class="w-full max-w-md">
                        <div class="bg-gray-200 rounded-full h-3 mb-2">
                            <div id="progressBar" class="bg-blue-500 h-3 rounded-full transition-all duration-500" style="width: 0%"></div>
                        </div>
                        <p id="progressText" class="text-sm text-gray-600 text-center">Starting...</p>
                    </div>
                </div>
            `;
        }
        
        function updateStepProgress(message) {
            const progressText = document.getElementById('progressText');
            if (progressText) {
                progressText.textContent = message;
            }
        }
        
        function showFormState() {
            // Stop image polling when going back to form
            if (imagePollingInterval) {
                clearInterval(imagePollingInterval);
                imagePollingInterval = null;
            }
            // Reload the page to show the original form
            window.location.reload();
        }
        
        function showResults(data) {
            // Create results HTML with back button
            let resultsHTML = `
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-bold text-gray-800">🎬 Generated B-Roll Content</h3>
                    <button onclick="showFormState()" class="flex items-center space-x-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                        <i class="fas fa-arrow-left"></i>
                        <span>Back to Form</span>
                    </button>
                </div>
            `;
            
            data.sentences.forEach((sentence, index) => {
                resultsHTML += `<div class="mb-8 p-6 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl border border-blue-200 shadow-sm">`;
                resultsHTML += `<div class="flex items-center mb-4">`;
                resultsHTML += `<div class="w-8 h-8 bg-blue-500 text-white rounded-full flex items-center justify-center font-bold text-sm mr-3">${index + 1}</div>`;
                resultsHTML += `<h4 class="text-lg font-semibold text-gray-800">Sentence ${index + 1}</h4>`;
                resultsHTML += `</div>`;
                resultsHTML += `<p class="text-gray-700 mb-4 p-4 bg-white rounded-lg border border-blue-100 shadow-sm">${sentence.content}</p>`;
                
                if (sentence.shotlist && sentence.shotlist.length > 0) {
                    resultsHTML += `<div class="overflow-x-auto">`;
                    resultsHTML += `<table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">`;
                    resultsHTML += `<thead class="bg-gradient-to-r from-gray-50 to-gray-100">`;
                    resultsHTML += `<tr>`;
                    resultsHTML += `<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Script Part</th>`;
                    resultsHTML += `<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Original Shot</th>`;
                    resultsHTML += `<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image Prompt</th>`;
                    resultsHTML += `<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Video Prompt</th>`;
                    resultsHTML += `<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Generated Image</th>`;
                    resultsHTML += `</tr>`;
                    resultsHTML += `</thead>`;
                    resultsHTML += `<tbody class="divide-y divide-gray-200">`;
                    
                    sentence.shotlist.forEach((shot, shotIndex) => {
                        const generatedImage = sentence.assets.find(asset => 
                            asset.type === 'image' && 
                            asset.metadata && 
                            asset.metadata.shot_index === shotIndex
                        );
                        
                        resultsHTML += `<tr class="hover:bg-gray-50 transition-colors">`;
                        resultsHTML += `<td class="px-4 py-3 text-sm text-gray-700 font-medium">${shot.script || 'N/A'}</td>`;
                        resultsHTML += `<td class="px-4 py-3 text-sm text-gray-600">${shot.shot || 'N/A'}</td>`;
                        resultsHTML += `<td class="px-4 py-3 text-sm text-gray-600">`;
                        if (shot.image_prompt) {
                            resultsHTML += `<div class="bg-blue-50 border border-blue-200 rounded p-3 shadow-sm">`;
                            resultsHTML += `<span class="text-xs text-blue-600 font-medium">🎨 Image:</span>`;
                            resultsHTML += `<p class="text-xs text-gray-700 mt-1 leading-relaxed">${shot.image_prompt}</p>`;
                            resultsHTML += `</div>`;
                        } else {
                            resultsHTML += `<span class="text-gray-400">Not enhanced</span>`;
                        }
                        resultsHTML += `</td>`;
                        resultsHTML += `<td class="px-4 py-3 text-sm text-gray-600">`;
                        resultsHTML += `<span class="text-gray-400">Video prompts hidden</span>`;
                        resultsHTML += `</td>`;
                        resultsHTML += `<td class="px-4 py-3 text-sm text-gray-600">`;
                        if (generatedImage && generatedImage.url) {
                            resultsHTML += `<div class="relative group">`;
                            resultsHTML += `<img src="${generatedImage.url}" alt="Generated image for shot ${shotIndex + 1}" class="w-24 h-24 object-cover rounded-lg border-2 border-gray-200 shadow-sm hover:shadow-md transition-shadow cursor-pointer">`;
                            resultsHTML += `<div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 rounded-lg transition-all duration-200 flex items-center justify-center">`;
                            resultsHTML += `<i class="fas fa-expand text-white opacity-0 group-hover:opacity-100 transition-opacity"></i>`;
                            resultsHTML += `</div>`;
                            resultsHTML += `</div>`;
                        } else {
                            resultsHTML += `<div class="w-24 h-24 bg-gray-100 border-2 border-gray-200 rounded-lg flex items-center justify-center">`;
                            resultsHTML += `<span class="text-xs text-gray-400">Generating...</span>`;
                            resultsHTML += `</div>`;
                        }
                        resultsHTML += `</td>`;
                        resultsHTML += `</tr>`;
                    });
                    
                    resultsHTML += `</tbody>`;
                    resultsHTML += `</table>`;
                    resultsHTML += `</div>`;
                }
                
                resultsHTML += `</div>`;
            });
            
            // Replace modal content with results
            const modalContent = document.querySelector('#addProjectModal .bg-white');
            modalContent.innerHTML = resultsHTML;
        }

        // Close modal when clicking outside
        document.addEventListener('click', function(e) {
            const addProjectModal = document.getElementById('addProjectModal');
            const importMediaModal = document.getElementById('importMediaModal');
            
            if (e.target === addProjectModal) {
                closeAddProjectModal();
            }
            if (e.target === importMediaModal) {
                closeImportMediaModal();
            }
        });
    </script>
</body>
</html>

<!-- Add Project Modal -->
<div id="addProjectModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 backdrop-blur-sm p-4">
    <div class="bg-white rounded-3xl shadow-2xl max-w-7xl w-full mx-4 max-h-[98vh] overflow-y-auto border border-gray-100">
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
        <div class="p-12">
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
                            id="scriptTextarea"
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
                <button onclick="submitScript()" class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-8 py-3 rounded-xl font-semibold flex items-center space-x-2 shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                    <i class="fas fa-magic"></i>
                    <span>Generate B-Roll</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Import Media Modal -->
<div id="importMediaModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full mx-4 max-h-[95vh] overflow-y-auto border border-gray-100">
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-8 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-purple-50 rounded-t-2xl">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-upload text-white text-xl"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Import Media</h2>
                    <p class="text-sm text-gray-600">Upload videos and photos to your b-roll library</p>
                </div>
            </div>
            <button onclick="closeImportMediaModal()" class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 p-2 rounded-lg transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="p-8">
            <form class="space-y-8">
                <!-- Description and AI Processing Options -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Manual Description -->
                    <div class="bg-blue-50 rounded-xl p-6 border border-blue-100">
                        <label class="block text-sm font-semibold text-gray-800 mb-3 flex items-center">
                            <i class="fas fa-edit text-blue-500 mr-2"></i>
                            Manual Description
                        </label>
                        <textarea class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white shadow-sm resize-none" rows="3" placeholder="Write a description for your media..."></textarea>
                        <p class="text-xs text-gray-500 mt-2">Describe your media manually or leave empty to use AI</p>
                    </div>
                    
                    <!-- AI Auto-Generate -->
                    <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-6 border border-green-100">
                        <label class="block text-sm font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-magic text-green-500 mr-2"></i>
                            AI Auto-Generate
                        </label>
                        <div class="flex items-center justify-between p-4 bg-white rounded-lg border border-green-200">
                            <div class="flex items-center">
                                <i class="fas fa-robot text-green-500 mr-3"></i>
                                <div>
                                    <span class="text-sm font-medium text-gray-800">Auto-generate descriptions</span>
                                    <p class="text-xs text-gray-500">Let AI create descriptions for your media</p>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" checked>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500"></div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- File Upload Area -->
                <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-xl p-8 border-2 border-dashed border-blue-200">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-cloud-upload-alt text-white text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Drop files here or click to browse</h3>
                        <p class="text-sm text-gray-600 mb-6">Support for MP4, MOV, AVI, JPG, PNG, and more</p>
                        
                        <input type="file" id="mediaFiles" multiple accept="video/*,image/*" class="hidden">
                        <button type="button" onclick="document.getElementById('mediaFiles').click()" class="bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover-lift smooth-transition">
                            <i class="fas fa-plus mr-2"></i>
                            Choose Files
                        </button>
                    </div>
                    
                    <!-- File Preview Area -->
                    <div id="filePreview" class="mt-6 hidden">
                        <h4 class="text-sm font-semibold text-gray-700 mb-3">Selected Files:</h4>
                        <div id="fileList" class="space-y-2"></div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="flex items-center justify-between p-8 border-t border-gray-100 bg-gradient-to-r from-gray-50 to-gray-100 rounded-b-2xl">
            <div class="flex items-center text-sm text-gray-500">
                <i class="fas fa-info-circle mr-2"></i>
                Files will be processed and added to your library
            </div>
            <div class="flex items-center space-x-4">
                <button onclick="closeImportMediaModal()" class="px-6 py-3 text-gray-600 hover:text-gray-800 font-medium hover:bg-gray-200 rounded-xl transition-all duration-200">
                    <i class="fas fa-times mr-2"></i>
                    Cancel
                </button>
                <button class="bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white px-8 py-3 rounded-xl font-semibold flex items-center space-x-2 shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                    <i class="fas fa-upload"></i>
                    <span>Import Media</span>
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
    const searchInput = document.querySelector('input[placeholder="Search your b-roll library..."]');
    
    // Handle keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Check for Cmd+F (Mac) or Ctrl+F (Windows/Linux)
        if ((isMac && e.metaKey && e.key === 'f') || 
            (!isMac && e.ctrlKey && e.key === 'f')) {
            e.preventDefault();
            e.stopPropagation();
            
            // Focus and select the search input
            searchInput.focus();
            searchInput.select();
            
            // Add a subtle highlight effect
            searchInput.style.boxShadow = '0 0 0 3px rgba(59, 130, 246, 0.3)';
            setTimeout(() => {
                searchInput.style.boxShadow = '';
            }, 1000);
        }
    });
    
    // Handle button click
    document.getElementById('searchShortcut').addEventListener('click', function() {
        searchInput.focus();
        searchInput.select();
        
        // Add a subtle highlight effect
        searchInput.style.boxShadow = '0 0 0 3px rgba(59, 130, 246, 0.3)';
        setTimeout(() => {
            searchInput.style.boxShadow = '';
        }, 1000);
    });
    
    // Add visual feedback when search input is focused
    searchInput.addEventListener('focus', function() {
        this.style.transform = 'scale(1.02)';
        this.style.transition = 'all 0.2s ease';
    });
    
    searchInput.addEventListener('blur', function() {
        this.style.transform = 'scale(1)';
    });
    
    // Search functionality for media library
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();
        const mediaItems = document.querySelectorAll('.media-section [class*="cursor-pointer"]');
        const projectSummaryCards = document.querySelector('.grid.grid-cols-1.md\\:grid-cols-2.lg\\:grid-cols-4.gap-6.mb-8');
        
        if (searchTerm === '') {
            // Show all items if search is empty
            mediaItems.forEach(item => {
                item.style.display = 'block';
            });
            // Show project summary cards
            if (projectSummaryCards) {
                projectSummaryCards.style.display = 'grid';
            }
        } else {
            // Hide project summary cards when searching
            if (projectSummaryCards) {
                projectSummaryCards.style.display = 'none';
            }
            
            // Filter items based on search term - hide non-matching items completely
            mediaItems.forEach(item => {
                const itemText = item.textContent.toLowerCase();
                const itemTitle = item.querySelector('p:first-of-type')?.textContent.toLowerCase() || '';
                const itemDescription = item.querySelector('p:last-of-type')?.textContent.toLowerCase() || '';
                
                if (itemText.includes(searchTerm) || itemTitle.includes(searchTerm) || itemDescription.includes(searchTerm)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }
    });
    
    // Clear search functionality
    const clearSearch = () => {
        searchInput.value = '';
        searchInput.dispatchEvent(new Event('input'));
    };
    
    // Add clear button functionality (optional)
    searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            clearSearch();
        }
    });
    
    // File upload preview functionality
    const mediaFilesInput = document.getElementById('mediaFiles');
    const filePreview = document.getElementById('filePreview');
    const fileList = document.getElementById('fileList');
    
    if (mediaFilesInput) {
        mediaFilesInput.addEventListener('change', function(e) {
            const files = Array.from(e.target.files);
            
            if (files.length > 0) {
                filePreview.classList.remove('hidden');
                fileList.innerHTML = '';
                
                files.forEach((file, index) => {
                    const fileItem = document.createElement('div');
                    fileItem.className = 'flex items-center justify-between p-3 bg-white rounded-lg border border-gray-200';
                    
                    const fileInfo = document.createElement('div');
                    fileInfo.className = 'flex items-center space-x-3';
                    
                    const icon = document.createElement('i');
                    icon.className = file.type.startsWith('video/') ? 'fas fa-video text-blue-500' : 'fas fa-image text-purple-500';
                    
                    const fileName = document.createElement('span');
                    fileName.className = 'text-sm font-medium text-gray-700';
                    fileName.textContent = file.name;
                    
                    const fileSize = document.createElement('span');
                    fileSize.className = 'text-xs text-gray-500';
                    fileSize.textContent = formatFileSize(file.size);
                    
                    fileInfo.appendChild(icon);
                    fileInfo.appendChild(fileName);
                    fileInfo.appendChild(fileSize);
                    
                    const removeBtn = document.createElement('button');
                    removeBtn.className = 'text-red-500 hover:text-red-700 p-1';
                    removeBtn.innerHTML = '<i class="fas fa-times"></i>';
                    removeBtn.onclick = () => {
                        fileItem.remove();
                        if (fileList.children.length === 0) {
                            filePreview.classList.add('hidden');
                        }
                    };
                    
                    fileItem.appendChild(fileInfo);
                    fileItem.appendChild(removeBtn);
                    fileList.appendChild(fileItem);
                });
            } else {
                filePreview.classList.add('hidden');
            }
        });
    }
    
    // Helper function to format file size
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }
});
</script>
