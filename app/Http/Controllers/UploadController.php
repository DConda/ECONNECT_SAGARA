<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    /**
     * Handle file upload and return the file path
     */
    public function store(Request $request)
    {
        $type = $request->input('type');
        
        // Validate based on type
        $rules = [
            'type' => 'required|string|in:avatar,product,general',
            'folder' => 'nullable|string'
        ];

        // Add file validation based on type
        if ($type === 'avatar') {
            $rules['file'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048'; // 2MB max for avatars
        } else {
            $rules['file'] = 'required|file|max:5120'; // 5MB max for other files
        }

        $request->validate($rules);

        try {
            $file = $request->file('file');
            $folder = $request->input('folder', 'uploads');

            // Generate a unique filename
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();

            // Determine the storage path based on type
            $path = match($type) {
                'avatar' => 'avatars',
                'product' => 'products',
                'general' => $folder,
            };

            // Store the file
            $filePath = $file->storeAs($path, $filename, 'public');

            return response()->json([
                'success' => true,
                'path' => $filePath,
                'url' => Storage::url($filePath)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Upload failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove a file from storage
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'path' => 'required|string'
        ]);

        try {
            $path = $request->input('path');

            // Security check: only allow deletion from specific folders
            $allowedPaths = ['avatars/', 'products/', 'uploads/'];
            $isAllowed = false;
            foreach ($allowedPaths as $allowedPath) {
                if (str_starts_with($path, $allowedPath)) {
                    $isAllowed = true;
                    break;
                }
            }

            if (!$isAllowed) {
                throw new \Exception('Invalid file path');
            }

            // Delete the file
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
                return response()->json(['success' => true]);
            }

            throw new \Exception('File not found');

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Deletion failed: ' . $e->getMessage()
            ], 500);
        }
    }
} 