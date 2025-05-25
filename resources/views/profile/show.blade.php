@extends('layouts.app')

@section('content')
<div class="profile-container">
    <div class="profile-header">
        <div class="profile-avatar">
            @if($user->avatar)
                <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}'s avatar">
            @else
                <div class="avatar-placeholder">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>
            @endif
        </div>
        <div class="profile-info">
            <h1>{{ $user->name }}</h1>
            <p class="email">{{ $user->email }}</p>
            @if($user->bio)
                <p class="bio">{{ $user->bio }}</p>
            @endif
            <a href="{{ route('profile.edit') }}" class="edit-button">Edit Profile</a>
        </div>
    </div>

    <div class="profile-details">
        <div class="detail-section">
            <h2>Personal Information</h2>
            <div class="detail-grid">
                <div class="detail-item">
                    <label>Phone</label>
                    <p>{{ $user->phone ?? 'Not provided' }}</p>
                </div>
                <div class="detail-item">
                    <label>Address</label>
                    <p>{{ $user->address ?? 'Not provided' }}</p>
                </div>
                <div class="detail-item">
                    <label>Birth Date</label>
                    <p>{{ $user->birth_date ? $user->birth_date->format('F d, Y') : 'Not provided' }}</p>
                </div>
                <div class="detail-item">
                    <label>Gender</label>
                    <p>{{ $user->gender ? ucfirst($user->gender) : 'Not provided' }}</p>
                </div>
            </div>
        </div>

        @if($user->social_media)
        <div class="detail-section">
            <h2>Social Media</h2>
            <div class="social-links">
                @foreach($user->social_media as $platform => $link)
                    <a href="{{ $link }}" target="_blank" class="social-link">
                        <img src="{{ asset('images/' . $platform . '.png') }}" alt="{{ $platform }}">
                        {{ ucfirst($platform) }}
                    </a>
                @endforeach
            </div>
        </div>
        @endif

        <div class="detail-section">
            <h2>Account Statistics</h2>
            <div class="stats-grid">
                <div class="stat-item">
                    <span class="stat-value">{{ $user->orders()->count() }}</span>
                    <label>Orders</label>
                </div>
                <div class="stat-item">
                    <span class="stat-value">{{ $user->reviews()->count() }}</span>
                    <label>Reviews</label>
                </div>
                <div class="stat-item">
                    <span class="stat-value">{{ $user->favorites()->count() }}</span>
                    <label>Favorites</label>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.profile-container {
    max-width: 800px;
    margin: 2rem auto;
    padding: 0 1rem;
}

.profile-header {
    display: flex;
    align-items: center;
    gap: 2rem;
    margin-bottom: 2rem;
}

.profile-avatar {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    overflow: hidden;
}

.profile-avatar img {
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

.profile-info {
    flex: 1;
}

.profile-info h1 {
    margin: 0 0 0.5rem 0;
    font-size: 2rem;
}

.email {
    color: #666;
    margin-bottom: 1rem;
}

.bio {
    margin-bottom: 1rem;
    line-height: 1.6;
}

.edit-button {
    display: inline-block;
    padding: 0.5rem 1rem;
    background: #1a5d1a;
    color: white;
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.3s;
}

.edit-button:hover {
    background: #134e13;
}

.detail-section {
    background: white;
    padding: 1.5rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.detail-section h2 {
    margin: 0 0 1rem 0;
    font-size: 1.25rem;
}

.detail-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
}

.detail-item label {
    display: block;
    color: #666;
    margin-bottom: 0.25rem;
    font-size: 0.875rem;
}

.detail-item p {
    margin: 0;
    font-weight: 500;
}

.social-links {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.social-link {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    background: #f5f5f5;
    border-radius: 4px;
    text-decoration: none;
    color: inherit;
    transition: background-color 0.3s;
}

.social-link:hover {
    background: #e5e5e5;
}

.social-link img {
    width: 20px;
    height: 20px;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
    text-align: center;
}

.stat-item {
    padding: 1rem;
    background: #f5f5f5;
    border-radius: 4px;
}

.stat-value {
    display: block;
    font-size: 1.5rem;
    font-weight: 600;
    color: #1a5d1a;
    margin-bottom: 0.25rem;
}

.stat-item label {
    color: #666;
    font-size: 0.875rem;
}

@media (max-width: 640px) {
    .profile-header {
        flex-direction: column;
        text-align: center;
    }

    .stats-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection 