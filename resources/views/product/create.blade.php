<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product - Econnect</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
    <style>
        .form-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: inherit;
        }

        .image-preview {
            margin-top: 1rem;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 1rem;
        }

        .image-preview img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 4px;
        }

        .submit-btn {
            background: #1a5d1a;
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            width: 100%;
        }

        .submit-btn:hover {
            background: #134e13;
        }

        .error {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
    @include('layouts.header')

    <main class="product-content">
        <div class="breadcrumb">
            <a href="{{ route('catalog') }}">Catalog</a>
            <span>/</span>
            <span>Add New Product</span>
        </div>

        <div class="form-container">
            <h1>Add New Product</h1>
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" id="productForm">
                @csrf
                <div class="form-group">
                    <label for="name">Product Name</label>
                    <input type="text" id="name" name="name" required>
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="4" required></textarea>
                    @error('description')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="category">Category</label>
                    <select id="category" name="category" required>
                        <option value="">Select a category</option>
                        <option value="Plastic Waste">Plastic Waste</option>
                        <option value="Wood Waste">Wood Waste</option>
                        <option value="Fabric and Textile Waste">Fabric and Textile Waste</option>
                        <option value="Glass Waste">Glass Waste</option>
                        <option value="Ceramic Waste">Ceramic Waste</option>
                        <option value="Metal Waste">Metal Waste</option>
                    </select>
                    @error('category')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="price">Price (Rp)</label>
                    <input type="number" id="price" name="price" min="0" step="500" required>
                    @error('price')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="unit">Unit</label>
                    <select id="unit" name="unit" required>
                        <option value="kg">Kilogram (kg)</option>
                        <option value="m">Meter (m)</option>
                        <option value="pcs">Pieces (pcs)</option>
                    </select>
                    @error('unit')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" id="stock" name="stock" min="0" required>
                    @error('stock')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="main_image">Main Image</label>
                    <input type="file" id="main_image" name="main_image" accept="image/*" required>
                    <div id="mainImagePreview" class="image-preview"></div>
                    @error('main_image')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="additional_images">Additional Images</label>
                    <input type="file" id="additional_images" name="additional_images[]" accept="image/*" multiple>
                    <div id="additionalImagesPreview" class="image-preview"></div>
                    @error('additional_images')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="submit-btn">Add Product</button>
            </form>
        </div>
    </main>

    <script>
        // Preview main image
        document.getElementById('main_image').addEventListener('change', function(e) {
            const preview = document.getElementById('mainImagePreview');
            preview.innerHTML = '';
            
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    preview.appendChild(img);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        // Preview additional images
        document.getElementById('additional_images').addEventListener('change', function(e) {
            const preview = document.getElementById('additionalImagesPreview');
            preview.innerHTML = '';
            
            if (this.files) {
                Array.from(this.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        preview.appendChild(img);
                    }
                    reader.readAsDataURL(file);
                });
            }
        });
    </script>
</body>
</html> 