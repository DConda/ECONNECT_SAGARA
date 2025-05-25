@props([
    'type' => 'general',
    'folder' => 'uploads',
    'accept' => '*',
    'maxSize' => 5, // in MB
    'preview' => true,
    'multiple' => false,
    'buttonText' => 'Choose File',
    'uploadText' => 'Upload',
    'removeText' => 'Remove',
])

<div 
    x-data="fileUpload({
        type: '{{ $type }}',
        folder: '{{ $folder }}',
        maxSize: {{ $maxSize }},
        multiple: {{ $multiple ? 'true' : 'false' }},
        preview: {{ $preview ? 'true' : 'false' }},
        initialFiles: []
    })"
    class="file-upload"
>
    <div class="upload-container">
        <input 
            type="file" 
            class="hidden" 
            x-ref="fileInput"
            @change="handleFileSelect"
            accept="{{ $accept }}"
            :multiple="multiple"
        >
        
        <button 
            type="button" 
            class="choose-button"
            @click="$refs.fileInput.click()"
        >
            {{ $buttonText }}
        </button>

        <template x-if="preview && files.length > 0">
            <div class="preview-container">
                <template x-for="(file, index) in files" :key="index">
                    <div class="preview-item">
                        <!-- Image preview -->
                        <template x-if="file.type.startsWith('image/')">
                            <img :src="file.preview" alt="Preview" class="preview-image">
                        </template>
                        
                        <!-- File info -->
                        <div class="file-info">
                            <span x-text="file.name"></span>
                            <span x-text="formatFileSize(file.size)" class="file-size"></span>
                        </div>

                        <!-- Progress bar -->
                        <template x-if="file.uploading">
                            <div class="progress-bar">
                                <div class="progress" :style="{ width: file.progress + '%' }"></div>
                            </div>
                        </template>

                        <!-- Actions -->
                        <div class="actions">
                            <template x-if="!file.uploaded">
                                <button 
                                    type="button" 
                                    class="upload-button"
                                    @click="uploadFile(file)"
                                    :disabled="file.uploading"
                                >
                                    {{ $uploadText }}
                                </button>
                            </template>
                            <button 
                                type="button" 
                                class="remove-button"
                                @click="removeFile(index)"
                            >
                                {{ $removeText }}
                            </button>
                        </div>
                    </div>
                </template>
            </div>
        </template>

        <!-- Error messages -->
        <template x-if="error">
            <div class="error-message" x-text="error"></div>
        </template>
    </div>
</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('fileUpload', ({ type, folder, maxSize, multiple, preview, initialFiles = [] }) => ({
        files: [],
        error: null,

        init() {
            this.files = initialFiles.map(file => ({
                ...file,
                uploaded: true,
                preview: file.url
            }));
        },

        handleFileSelect(event) {
            const selectedFiles = Array.from(event.target.files);
            
            // Validate files
            for (const file of selectedFiles) {
                // Check file size
                if (file.size > maxSize * 1024 * 1024) {
                    this.error = `File ${file.name} is too large. Maximum size is ${maxSize}MB.`;
                    return;
                }

                // Create preview for images
                if (preview && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        file.preview = e.target.result;
                        this.files = [...this.files];
                    };
                    reader.readAsDataURL(file);
                }

                // Add file to list
                this.files.push({
                    file,
                    name: file.name,
                    size: file.size,
                    type: file.type,
                    progress: 0,
                    uploading: false,
                    uploaded: false,
                    preview: null
                });
            }

            // Clear input
            event.target.value = '';
        },

        async uploadFile(file) {
            if (file.uploaded) return;

            console.log('Starting file upload:', file);
            const formData = new FormData();
            formData.append('file', file.file);
            formData.append('type', type);
            formData.append('folder', folder);

            file.uploading = true;
            this.error = null;

            try {
                const token = document.querySelector('meta[name="csrf-token"]').content;
                console.log('CSRF Token:', token);
                console.log('Making upload request to:', '/upload');
                
                const response = await fetch('/upload', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': token
                    }
                });

                console.log('Upload response status:', response.status);
                const result = await response.json();
                console.log('Upload response:', result);

                if (result.success) {
                    file.uploaded = true;
                    file.path = result.path;
                    file.url = result.url;
                    console.log('File uploaded successfully. Dispatching event with:', result);
                    this.$dispatch('file-uploaded', { file: result });
                } else {
                    throw new Error(result.message || 'Upload failed');
                }
            } catch (error) {
                console.error('Upload error:', error);
                this.error = `Upload failed: ${error.message}`;
            } finally {
                file.uploading = false;
            }
        },

        async removeFile(index) {
            const file = this.files[index];

            if (file.uploaded) {
                try {
                    const response = await fetch('/upload', {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ path: file.path })
                    });

                    const result = await response.json();
                    if (!result.success) {
                        throw new Error(result.message);
                    }
                } catch (error) {
                    this.error = `Deletion failed: ${error.message}`;
                    return;
                }
            }

            this.files.splice(index, 1);
            this.$dispatch('file-removed', { index });
        },

        formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }
    }));
});
</script>

<style>
.file-upload {
    width: 100%;
}

.upload-container {
    border: 2px dashed #ddd;
    padding: 1.5rem;
    border-radius: 8px;
    background: #fff;
}

.choose-button {
    background: #1a5d1a;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 4px;
    border: none;
    cursor: pointer;
    font-size: 0.875rem;
    transition: background-color 0.3s;
}

.choose-button:hover {
    background: #134e13;
}

.preview-container {
    margin-top: 1rem;
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.preview-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 0.75rem;
    background: #f5f5f5;
    border-radius: 4px;
}

.preview-image {
    width: 48px;
    height: 48px;
    object-fit: cover;
    border-radius: 4px;
}

.file-info {
    flex: 1;
    display: flex;
    flex-direction: column;
    font-size: 0.875rem;
}

.file-size {
    color: #666;
    font-size: 0.75rem;
}

.progress-bar {
    flex: 1;
    height: 4px;
    background: #ddd;
    border-radius: 2px;
    overflow: hidden;
}

.progress {
    height: 100%;
    background: #1a5d1a;
    transition: width 0.3s ease;
}

.actions {
    display: flex;
    gap: 0.5rem;
}

.upload-button,
.remove-button {
    padding: 0.25rem 0.75rem;
    border-radius: 4px;
    border: none;
    cursor: pointer;
    font-size: 0.75rem;
    transition: background-color 0.3s;
}

.upload-button {
    background: #1a5d1a;
    color: white;
}

.upload-button:hover {
    background: #134e13;
}

.remove-button {
    background: #dc3545;
    color: white;
}

.remove-button:hover {
    background: #bb2d3b;
}

.error-message {
    margin-top: 0.5rem;
    color: #dc3545;
    font-size: 0.875rem;
}

.upload-button:disabled {
    background: #ccc;
    cursor: not-allowed;
}
</style> 