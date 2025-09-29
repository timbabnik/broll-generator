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
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-white rounded-2xl m-4 shadow-lg">
            <!-- Logo -->
            <div class="p-6">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-check text-white text-sm"></i>
                    </div>
                    <span class="text-xl font-bold text-gray-800">GoldenTree</span>
                </div>
            </div>

            <!-- Menu -->
            <div class="px-6">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">PROJECTS</h3>
                <nav class="space-y-2">
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 bg-green-500 text-white rounded-lg">
                        <i class="fas fa-th-large"></i>
                        <span>Project 1</span>
                    </a>
                    <a href="#" class="flex items-center justify-between px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-tasks"></i>
                            <span>Project 2</span>
                        </div>
                        
                    </a>
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                        <i class="fas fa-calendar"></i>
                        <span>Project 3</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                        <i class="fas fa-chart-bar"></i>
                        <span>Project 4</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                        <i class="fas fa-users"></i>
                        <span>Project 5</span>
                    </a>
                </nav>
            </div>

            <!-- General -->
            <div class="px-6 mt-8">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">GENERAL</h3>
                <nav class="space-y-2">
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                    
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </nav>
            </div>

            <!-- Mobile App Card -->
            
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-white mr-2 shadow-sm my-4 rounded-2xl border-b px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <input type="text" placeholder="Search task" class="w-80 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                        <button class="bg-gray-100 hover:bg-gray-200 px-3 py-2 rounded-lg text-sm text-gray-600">
                            <i class="fas fa-keyboard mr-1"></i>⌘F
                        </button>
                    </div>
                    <div class="flex items-center space-x-4">
                        
                        <div class="flex items-center space-x-3">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=40&h=40&fit=crop&crop=face" alt="Profile" class="w-10 h-10 rounded-full">
                            <div>
                                <p class="font-semibold text-gray-800">Totok Michael</p>
                                <p class="text-sm text-gray-500">tmichael20@mail.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <main class="flex-1 p-6 overflow-y-auto bg-white rounded-2xl shadow-lg my-4">
                <!-- Dashboard Header -->
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">B-Roll Library</h1>
                        <p class="text-gray-600 mt-2">Generate, search, and find b roll photos and videos.</p>
                    </div>
                    <div class="flex space-x-3">
                        <button class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg font-medium flex items-center space-x-2" onclick="openAddProjectModal()">
                            <i class="fas fa-plus"></i>
                            <span>Add Project</span>
                        </button>
                        <button class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg font-medium">
                            Import Data
                        </button>
                    </div>
                </div>

                <!-- Project Summary Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Total Projects -->
                    <div class="bg-white rounded-lg p-6 shadow-sm">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-gray-600 font-medium">Your Projects</h3>
                            <i class="fas fa-arrow-up text-green-500"></i>
                        </div>
                        <div class="text-4xl font-bold text-green-600 mb-2">24</div>
                        <div class="bg-green-500 text-white text-xs px-3 py-1 rounded-full inline-flex items-center">
                            <i class="fas fa-arrow-up mr-1"></i>
                            5 Increased from last month
                        </div>
                    </div>

                    <!-- Ended Projects -->
                    <div class="bg-white rounded-lg p-6 shadow-sm">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-gray-600 font-medium">Photos</h3>
                            <i class="fas fa-arrow-up text-gray-400"></i>
                        </div>
                        <div class="text-4xl font-bold text-gray-600 mb-2">10</div>
                        <div class="bg-gray-500 text-white text-xs px-3 py-1 rounded-full inline-flex items-center">
                            <i class="fas fa-arrow-up mr-1"></i>
                            6 Increased from last month
                        </div>
                    </div>

                    <!-- Running Projects -->
                    <div class="bg-white rounded-lg p-6 shadow-sm">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-gray-600 font-medium">Videos</h3>
                            <i class="fas fa-arrow-up text-gray-400"></i>
                        </div>
                        <div class="text-4xl font-bold text-gray-600 mb-2">12</div>
                        <div class="bg-gray-500 text-white text-xs px-3 py-1 rounded-full inline-flex items-center">
                            <i class="fas fa-arrow-up mr-1"></i>
                            2 Increased from last month
                        </div>
                    </div>

                    <!-- Pending Project -->
                    <div class="bg-white rounded-lg p-6 shadow-sm">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-gray-600 font-medium">Pending Project</h3>
                            <i class="fas fa-arrow-up text-gray-400"></i>
                        </div>
                        <div class="text-4xl font-bold text-gray-600 mb-2">2</div>
                        <div class="text-gray-500 text-sm">On Discuss</div>
                    </div>
                </div>

                <!-- Video & Photo Library -->
                <div class="mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Video & Photo Library</h2>
                       
                    </div>

                    <!-- Media Gallery -->
                    <div class="bg-white rounded-lg shadow-sm p-0">
                        <div class="flex items-center justify-between mb-6">
                      
                            <div class="flex space-x-2">
                                <button class="filter-btn px-3 py-1 bg-green-500 text-white text-sm rounded-lg" data-filter="all">All</button>
                                <button class="filter-btn px-3 py-1 bg-gray-100 text-gray-600 text-sm rounded-lg" data-filter="videos">Videos</button>
                                <button class="filter-btn px-3 py-1 bg-gray-100 text-gray-600 text-sm rounded-lg" data-filter="photos">Photos</button>
                            </div>
                        </div>
                        
                        <!-- Video Grid -->
                        <div class="mb-8 p-6 media-section" data-type="videos">
                            <h4 class="text-md font-semibold text-gray-700 mb-4 flex items-center">
                                <i class="fas fa-video text-blue-500 mr-2"></i>
                                Videos
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                <div class="relative group cursor-pointer">
                                    <div class="aspect-video bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-play text-white text-4xl"></i>
                                    </div>
                                    <div class="absolute bottom-2 right-2 bg-black bg-opacity-70 text-white text-xs px-2 py-1 rounded">
                                        2:34
                                    </div>
                                    <p class="text-base text-gray-600 mt-2 truncate">Project Demo.mp4</p>
                                </div>
                                
                                <div class="relative group cursor-pointer">
                                    <div class="aspect-video bg-gradient-to-br from-green-400 to-green-600 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-play text-white text-4xl"></i>
                                    </div>
                                    <div class="absolute bottom-2 right-2 bg-black bg-opacity-70 text-white text-xs px-2 py-1 rounded">
                                        1:45
                                    </div>
                                    <p class="text-base text-gray-600 mt-2 truncate">Team Meeting.mov</p>
                                </div>
                                
                                <div class="relative group cursor-pointer">
                                    <div class="aspect-video bg-gradient-to-br from-purple-400 to-purple-600 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-play text-white text-4xl"></i>
                                    </div>
                                    <div class="absolute bottom-2 right-2 bg-black bg-opacity-70 text-white text-xs px-2 py-1 rounded">
                                        3:12
                                    </div>
                                    <p class="text-base text-gray-600 mt-2 truncate">Tutorial.mp4</p>
                                </div>
                                
                                <div class="relative group cursor-pointer">
                                    <div class="aspect-video bg-gradient-to-br from-red-400 to-red-600 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-play text-white text-4xl"></i>
                                    </div>
                                    <div class="absolute bottom-2 right-2 bg-black bg-opacity-70 text-white text-xs px-2 py-1 rounded">
                                        4:28
                                    </div>
                                    <p class="text-base text-gray-600 mt-2 truncate">Presentation.mp4</p>
                                </div>
                                
                                <div class="relative group cursor-pointer">
                                    <div class="aspect-video bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-play text-white text-4xl"></i>
                                    </div>
                                    <div class="absolute bottom-2 right-2 bg-black bg-opacity-70 text-white text-xs px-2 py-1 rounded">
                                        1:56
                                    </div>
                                    <p class="text-base text-gray-600 mt-2 truncate">Quick Tips.mp4</p>
                                </div>
                                
                                <div class="relative group cursor-pointer">
                                    <div class="aspect-video bg-gradient-to-br from-indigo-400 to-indigo-600 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-play text-white text-4xl"></i>
                                    </div>
                                    <div class="absolute bottom-2 right-2 bg-black bg-opacity-70 text-white text-xs px-2 py-1 rounded">
                                        2:18
                                    </div>
                                    <p class="text-base text-gray-600 mt-2 truncate">Review.mp4</p>
                                </div>
                            </div>
                        </div>

                        <!-- Photo Grid -->
                        <div class="p-6 media-section" data-type="photos">
                            <h4 class="text-md font-semibold text-gray-700 mb-4 flex items-center">
                                <i class="fas fa-image text-green-500 mr-2"></i>
                                Photos
                            </h4>
                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                                <div class="relative group cursor-pointer">
                                    <div class="aspect-square bg-gradient-to-br from-pink-400 to-pink-600 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-image text-white text-3xl"></i>
                                    </div>
                                    <p class="text-sm text-gray-600 mt-2 truncate">Screenshot.png</p>
                                </div>
                                
                                <div class="relative group cursor-pointer">
                                    <div class="aspect-square bg-gradient-to-br from-cyan-400 to-cyan-600 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-image text-white text-3xl"></i>
                                    </div>
                                    <p class="text-sm text-gray-600 mt-2 truncate">Design.jpg</p>
                                </div>
                                
                                <div class="relative group cursor-pointer">
                                    <div class="aspect-square bg-gradient-to-br from-orange-400 to-orange-600 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-image text-white text-3xl"></i>
                                    </div>
                                    <p class="text-sm text-gray-600 mt-2 truncate">Mockup.png</p>
                                </div>
                                
                                <div class="relative group cursor-pointer">
                                    <div class="aspect-square bg-gradient-to-br from-teal-400 to-teal-600 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-image text-white text-3xl"></i>
                                    </div>
                                    <p class="text-sm text-gray-600 mt-2 truncate">Logo.svg</p>
                                </div>
                                
                                <div class="relative group cursor-pointer">
                                    <div class="aspect-square bg-gradient-to-br from-rose-400 to-rose-600 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-image text-white text-3xl"></i>
                                    </div>
                                    <p class="text-sm text-gray-600 mt-2 truncate">Banner.jpg</p>
                                </div>
                                
                                <div class="relative group cursor-pointer">
                                    <div class="aspect-square bg-gradient-to-br from-violet-400 to-violet-600 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-image text-white text-3xl"></i>
                                    </div>
                                    <p class="text-sm text-gray-600 mt-2 truncate">Icon.png</p>
                                </div>
                                
                                <div class="relative group cursor-pointer">
                                    <div class="aspect-square bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-image text-white text-3xl"></i>
                                    </div>
                                    <p class="text-sm text-gray-600 mt-2 truncate">Chart.png</p>
                                </div>
                                
                                <div class="relative group cursor-pointer">
                                    <div class="aspect-square bg-gradient-to-br from-amber-400 to-amber-600 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-image text-white text-3xl"></i>
                                    </div>
                                    <p class="text-sm text-gray-600 mt-2 truncate">Graph.jpg</p>
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
