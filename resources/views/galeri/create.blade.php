@extends('layouts.app')

@section('content')
<section class="py-12 bg-white dark:bg-gray-900">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">Create New Gallery</h1>
        
        <!-- Error Notification -->
        @if (session('error'))
        <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 rounded-lg">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800 dark:text-red-200">
                        Upload Failed
                    </h3>
                    <div class="mt-2 text-sm text-red-700 dark:text-red-300">
                        {{ session('error') }}
                    </div>
                </div>
            </div>
        </div>
        @endif

        <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data" 
              class="bg-gray-50 dark:bg-gray-800 p-8 rounded-xl shadow-sm">
            @csrf

            <!-- Tambahkan ini untuk menampilkan error -->
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <!-- Thumbnail Upload -->
            <div class="mb-8">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Gallery Thumbnail</label>
                <div class="mt-1 flex items-center">
                    <div class="relative group">
                        <div id="thumbnail-preview" class="w-40 h-40 rounded-lg bg-gray-200 dark:bg-gray-700 flex items-center justify-center overflow-hidden">
                            <svg class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity rounded-lg">
                            <span class="text-white text-sm font-medium">Change</span>
                        </div>
                    </div>
                    <div class="ml-6 flex-1">
                        <input type="file" name="thumbnail" id="thumbnail" required accept="image/*" 
                               class="hidden" onchange="previewThumbnail(this)">
                        <label for="thumbnail" class="cursor-pointer inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            Upload Thumbnail
                        </label>
                        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Recommended size: 800x800px (Max 5MB)</p>
                    </div>
                </div>
            </div>

            <!-- Gallery Info -->
            <div class="mb-8">
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="judul" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Gallery Title</label>
                        <input type="text" name="judul" id="judul" required
                               class="mt-1 block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500"
                               value="{{ old('judul') }}">
                    </div>
                    
                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description (Optional)</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4"
                                  class="mt-1 block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500">{{ old('deskripsi') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Multiple Image Upload -->
            <div class="mb-8">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Gallery Images (100-150 photos)</label>
                
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-xl">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600 dark:text-gray-400">
                            <label for="gallery-images" class="relative cursor-pointer bg-white dark:bg-gray-700 rounded-md font-medium text-primary-600 dark:text-primary-400 hover:text-primary-500 focus-within:outline-none">
                                <span>Upload files</span>
                                <input id="gallery-images" name="gallery_images[]" type="file" multiple 
                                       accept="image/*" class="sr-only" onchange="previewFiles(this)">
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            PNG, JPG, GIF up to 15MB each (1-150 photos required)
                        </p>
                    </div>
                </div>
                
                <!-- File preview container -->
                <div id="file-preview" class="mt-4 grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-2 hidden">
                    <!-- Preview items will be added here by JavaScript -->
                </div>
                
                <!-- Upload progress -->
                <div id="upload-progress" class="mt-4 hidden">
                    <div class="flex justify-between mb-1">
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Uploading...</span>
                        <span id="progress-percent" class="text-sm font-medium text-gray-700 dark:text-gray-300">0%</span>
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                        <div id="progress-bar" class="bg-primary-600 h-2.5 rounded-full" style="width: 0%"></div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('galeri.index') }}" class="px-6 py-3 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    Cancel
                </a>
                <button type="submit" id="submit-btn" class="px-6 py-3 bg-primary-600 text-white rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-colors">
                    Create Gallery
                </button>
            </div>
        </form>
    </div>

    <script>
    // Thumbnail preview
    function previewThumbnail(input) {
        const preview = document.getElementById('thumbnail-preview');
        const file = input.files[0];
        
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
            }
            
            reader.readAsDataURL(file);
        }
    }

    // Multiple files preview
    function previewFiles(input) {
        const previewContainer = document.getElementById('file-preview');
        previewContainer.innerHTML = '';
        
        if (input.files.length > 0) {
            previewContainer.classList.remove('hidden');
            
            // Limit to 150 files
            const files = Array.from(input.files).slice(0, 150);
            
            files.forEach(file => {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const previewItem = document.createElement('div');
                    previewItem.className = 'relative group';
                    previewItem.innerHTML = `
                        <div class="aspect-square bg-gray-200 dark:bg-gray-700 rounded-lg overflow-hidden">
                            <img src="${e.target.result}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <button type="button" class="text-white bg-red-500 rounded-full p-1" onclick="removePreview(this)">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate mt-1">${file.name}</p>
                        <p class="text-xs text-gray-400 dark:text-gray-500">${(file.size / (1024*1024)).toFixed(15)}MB</p>
                    `;
                    previewContainer.appendChild(previewItem);
                }
                
                reader.readAsDataURL(file);
            });
            
            // Validate file count
            if (input.files.length < 1) {
                showError('Minimum 1 photos required');
            } else if (input.files.length > 150) {
                showError('Maximum 150 photos allowed');
            }
        } else {
            previewContainer.classList.add('hidden');
        }
    }

    // Remove preview item
    function removePreview(button) {
        button.closest('.relative').remove();
    }

    // Show error message
    function showError(message) {
        alert(message); // You can replace this with a more elegant notification
    }

    // Form submission with progress
    document.querySelector('form').addEventListener('submit', function(e) {
        const submitBtn = document.getElementById('submit-btn');
        const progressBar = document.getElementById('upload-progress');
        const progressPercent = document.getElementById('progress-percent');
        const progressBarFill = document.getElementById('progress-bar');
        
        submitBtn.disabled = true;
        submitBtn.innerHTML = 'Uploading...';
        progressBar.classList.remove('hidden');
        
        const formData = new FormData(this);
        const xhr = new XMLHttpRequest();
        
        xhr.upload.addEventListener('progress', function(e) {
            if (e.lengthComputable) {
                const percentComplete = Math.round((e.loaded / e.total) * 100);
                progressPercent.textContent = percentComplete + '%';
                progressBarFill.style.width = percentComplete + '%';
            }
        });
        
        xhr.addEventListener('load', function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                // Success - handled by Laravel redirect
            } else {
                const response = JSON.parse(xhr.responseText);
                showError(response.message || 'Upload failed');
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Create Gallery';
                progressBar.classList.add('hidden');
            }
        });
        
        xhr.addEventListener('error', function() {
            showError('Network error occurred');
            submitBtn.disabled = false;
            submitBtn.innerHTML = 'Create Gallery';
            progressBar.classList.add('hidden');
        });
        
        xhr.open('POST', this.action, true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.send(formData);
        
        e.preventDefault();
    });

    // Drag and drop functionality
    document.addEventListener('DOMContentLoaded', function() {
        const dropArea = document.querySelector('.border-dashed');
        const fileInput = document.getElementById('gallery-images');
        
        // Prevent default drag behaviors
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, preventDefaults, false);
        });
        
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        // Highlight drop area when item is dragged over it
        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, unhighlight, false);
        });
        
        function highlight() {
            dropArea.classList.add('border-primary-500', 'bg-primary-50', 'dark:bg-gray-700');
        }
        
        function unhighlight() {
            dropArea.classList.remove('border-primary-500', 'bg-primary-50', 'dark:bg-gray-700');
        }
        
        // Handle dropped files
        dropArea.addEventListener('drop', handleDrop, false);
        
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            
            if (files.length > 150) {
                showError('Maximum 150 photos allowed');
                return;
            }
            
            if (files.length < 1) {
                showError('Minimum 1 photos required');
                return;
            }
            
            // Update file input with dropped files
            fileInput.files = files;
            
            // Trigger preview function
            previewFiles(fileInput);
        }
        
        // Also handle click to select files
        dropArea.addEventListener('click', () => {
            fileInput.click();
        });
    });
    </script>
</section>
@endsection