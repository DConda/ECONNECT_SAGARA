@extends('layouts.app')

@section('content')
<div class="profile-container">
    <div class="profile-header">
        <h1>Edit Profile</h1>
        <a href="{{ route('profile.show') }}" class="back-button">Back to Profile</a>
    </div>

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="profile-form">
        @csrf
        @method('PUT')

        <div class="form-section">
            <h2>Profile Picture</h2>
            <div class="avatar-upload">
                <div class="current-avatar">
                    @if($user->avatar)
                        <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}'s avatar">
                    @else
                        <div class="avatar-placeholder">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                    @endif
                </div>
                <div class="avatar-actions">
                    <x-file-upload
                        type="avatar"
                        accept="image/*"
                        :maxSize="2"
                        :multiple="false"
                        buttonText="Upload New Picture"
                        @file-uploaded="function(e) { 
                            console.log('File uploaded event received:', e.detail);
                            if (e.detail.file && e.detail.file.url) {
                                document.querySelector('.current-avatar').innerHTML = `<img src='${e.detail.file.url}' alt='{{ $user->name }}'s avatar'>`;
                                document.querySelector('input[name=avatar_path]').value = e.detail.file.path;
                                console.log('Avatar path set to:', e.detail.file.path);
                                document.querySelector('form.profile-form').submit();
                            } else {
                                console.error('Invalid file upload response:', e.detail);
                            }
                        }"
                    />
                    @if($user->avatar)
                        <button type="button" onclick="document.getElementById('delete-avatar-form').submit();" class="delete-button">
                            Remove Picture
                        </button>
                    @endif
                </div>
            </div>
            <input type="hidden" name="avatar_path" value="{{ old('avatar_path', $user->avatar) }}">
            @error('avatar')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-section">
            <h2>Basic Information</h2>
            <div class="form-grid">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group full-width">
                    <label for="bio">Bio</label>
                    <textarea id="bio" name="bio" rows="4">{{ old('bio', $user->bio) }}</textarea>
                    @error('bio')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-section">
            <h2>Contact Information</h2>
            <div class="form-grid">
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                    @error('phone')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" value="{{ old('address', $user->address) }}">
                    @error('address')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-section">
            <h2>Personal Details</h2>
            <div class="form-grid">
                <div class="form-group">
                    <label for="birth_date">Birth Date</label>
                    <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date', $user->birth_date?->format('Y-m-d')) }}">
                    @error('birth_date')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender">
                        <option value="">Select gender</option>
                        <option value="male" {{ old('gender', $user->gender) === 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender', $user->gender) === 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ old('gender', $user->gender) === 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('gender')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-section">
            <h2>Social Media</h2>
            <div class="form-grid">
                <div class="form-group">
                    <label for="social_media[facebook]">Facebook</label>
                    <input type="url" id="social_media[facebook]" name="social_media[facebook]" 
                           value="{{ old('social_media.facebook', $user->social_media['facebook'] ?? '') }}"
                           placeholder="https://facebook.com/username">
                </div>

                <div class="form-group">
                    <label for="social_media[twitter]">Twitter</label>
                    <input type="url" id="social_media[twitter]" name="social_media[twitter]"
                           value="{{ old('social_media.twitter', $user->social_media['twitter'] ?? '') }}"
                           placeholder="https://twitter.com/username">
                </div>

                <div class="form-group">
                    <label for="social_media[instagram]">Instagram</label>
                    <input type="url" id="social_media[instagram]" name="social_media[instagram]"
                           value="{{ old('social_media.instagram', $user->social_media['instagram'] ?? '') }}"
                           placeholder="https://instagram.com/username">
                </div>
            </div>
        </div>

        <div class="form-section">
            <h2>Change Password</h2>
            <div class="form-grid">
                <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <input type="password" id="current_password" name="current_password">
                    @error('current_password')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" id="new_password" name="new_password">
                    @error('new_password')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="new_password_confirmation">Confirm New Password</label>
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation">
                </div>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="save-button">Save Changes</button>
            <a href="{{ route('profile.show') }}" class="cancel-button">Cancel</a>
        </div>
    </form>

    <form id="delete-avatar-form" action="{{ route('profile.delete-avatar') }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
</div>

<style>
.profile-container {
    max-width: 800px;
    margin: 2rem auto;
    padding: 0 1rem;
}

.profile-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.profile-header h1 {
    margin: 0;
}

.back-button {
    padding: 0.5rem 1rem;
    background: #f5f5f5;
    color: #333;
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.3s;
}

.back-button:hover {
    background: #e5e5e5;
}

.form-section {
    background: white;
    padding: 1.5rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.form-section h2 {
    margin: 0 0 1rem 0;
    font-size: 1.25rem;
}

.avatar-upload {
    display: flex;
    align-items: center;
    gap: 2rem;
}

.current-avatar {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    overflow: hidden;
}

.current-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.avatar-placeholder {
    width: 100%;
    height: 100%;
    background: #1a5d1a;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    font-weight: 600;
}

.avatar-actions {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.hidden {
    display: none;
}

.upload-button,
.delete-button {
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 0.875rem;
    text-align: center;
}

.upload-button {
    background: #1a5d1a;
    color: white;
}

.delete-button {
    background: #dc3545;
    color: white;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}

.form-group {
    margin-bottom: 1rem;
}

.form-group.full-width {
    grid-column: span 2;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    color: #666;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-family: inherit;
    font-size: inherit;
}

.form-group textarea {
    resize: vertical;
}

.error {
    display: block;
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

.form-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    margin-top: 2rem;
}

.save-button,
.cancel-button {
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1rem;
    text-decoration: none;
}

.save-button {
    background: #1a5d1a;
    color: white;
}

.cancel-button {
    background: #f5f5f5;
    color: #333;
}

.save-button:hover {
    background: #134e13;
}

.cancel-button:hover {
    background: #e5e5e5;
}

@media (max-width: 640px) {
    .form-grid {
        grid-template-columns: 1fr;
    }

    .form-group.full-width {
        grid-column: auto;
    }

    .avatar-upload {
        flex-direction: column;
        text-align: center;
    }

    .form-actions {
        flex-direction: column;
    }

    .save-button,
    .cancel-button {
        width: 100%;
        text-align: center;
    }
}
</style>

<script>
document.getElementById('avatar').addEventListener('change', function(e) {
    if (this.files && this.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.querySelector('.current-avatar img') || document.createElement('img');
            img.src = e.target.result;
            if (!document.querySelector('.current-avatar img')) {
                document.querySelector('.current-avatar').innerHTML = '';
                document.querySelector('.current-avatar').appendChild(img);
            }
        }
        reader.readAsDataURL(this.files[0]);
    }
});
</script>
@endsection 