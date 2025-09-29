<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.guest')] class extends Component {
    public string $title = 'Hello Janja!';
    public string $subtitle = 'Welcome to our Laravel application';
}; ?>

<div class="flex h-screen bg-[#1A1A1A]" style="background-color: #1A1A1A !important;">
    <!-- Simple Sidebar -->
    <div class="w-64 bg-[#262628] flex-shrink-0 rounded-tr-2xl rounded-br-2xl" style="background-color: #262628 !important; border-right: 1px solid #3E3E3A; border-top-right-radius: 1rem; border-bottom-right-radius: 1rem; height: 100vh;">
        <!-- Logo at the top -->
        <div class="flex items-center justify-center">
            <img src="https://s3-eu-west-1.amazonaws.com/tpd/logos/643ff08b6e11ee74b050911b/0x0.png" alt="Logo" class="w-2/3 h-20 object-contain rounded shadow px-10" />
        </div>
        <div class="px-6 ">
            <h2 class="text-xl font-semibold  mb-2" style="color: #fff !important;">Recent Projects</h2>
           
        </div>
        
        <!-- Projects List -->
        <div class="p-4 space-y-3">
            <!-- Project 1 -->
            <div class="p-3 rounded-lg bg-[#2A2A2C] hover:bg-[#2F2F31] transition-colors duration-200 cursor-pointer ">
                <h3 class="text-[#D1D5DB] font-bold text-sm mb-1" style="color:rgb(124, 124, 124) !important; font-weight: 600 !important;">E-commerce Platform</h3>
                
            </div>
            
            <!-- Project 2 -->
            <div class="p-3 rounded-lg bg-[#2A2A2C] hover:bg-[#2F2F31] transition-colors duration-200 cursor-pointer">
                <h3 class="text-[#D1D5DB] font-medium text-sm mb-1" style="color:rgb(124, 124, 124) !important; font-weight: 600 !important;" >Task Management App</h3>
                
            </div>
            
            <!-- Project 3 -->
            <div class="p-3 rounded-lg bg-[#2A2A2C] hover:bg-[#2F2F31] transition-colors duration-200 cursor-pointer">
                <h3 class="text-[#D1D5DB] font-medium text-sm mb-1" style="color:rgb(124, 124, 124) !important; font-weight: 600 !important;">Blog CMS</h3>
               
            </div>
            
            <!-- Project 4 -->
            <div class="p-3 rounded-lg bg-[#2A2A2C] hover:bg-[#2F2F31] transition-colors duration-200 cursor-pointer">
                <h3 class="text-[#D1D5DB] font-medium text-sm mb-1" style="color:rgb(124, 124, 124) !important; font-weight: 600 !important;">API Dashboard</h3>
               
            </div>
            
            <!-- Project 5 -->
            <div class="p-3 rounded-lg bg-[#2A2A2C] hover:bg-[#2F2F31] transition-colors duration-200 cursor-pointer">
                <h3 class="text-[#D1D5DB] font-medium text-sm mb-1" style="color:rgb(124, 124, 124) !important; font-weight: 600 !important;">Portfolio Website</h3>
             
            </div>
        </div>
        
        <!-- Add New Project Button -->
       
    </div>
    
    <!-- Main Content -->
    <div class="flex-1 p-8">
        <h1 style="font-size: 2rem; font-weight: 900; margin-bottom: 1rem; color: white;">
            Generate your own <span style="color: #AC872E; font-weight: 900;">AI photos 📸</span> &amp; <span style="color: #AC872E; font-weight: 900;">videos 🎬</span>
        </h1>
        <p class="text-lg text-gray-300 mb-8">{{ $subtitle }}</p>
    </div>
</div>
