<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class UploadController extends Controller
{
    /**
     * Upload image untuk Summernote editor
     */
    public function storeSummernote(Request $request)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Upload ke MinIO/S3
            $file = $request->file('image');
            
            // Generate unique filename
            $filename = 'summernote/' . Str::uuid() . '.' . $file->getClientOriginalExtension();
            
            // Upload original image
            $path = Storage::disk('s3')->put($filename, file_get_contents($file));
            
            // Get URL
            $url = Storage::disk('s3')->url($filename);

            // Return response untuk Summernote
            return response()->json([
                'success' => true,
                'url' => $url,
                'filename' => $filename
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Upload failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Upload image untuk form biasa
     */
    public function storeImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB
            'folder' => 'nullable|string'
        ]);

        try {
            $file = $request->file('file');
            $folder = $request->input('folder', 'uploads/images');
            
            // Generate unique filename
            $filename = $folder . '/' . Str::uuid() . '.' . $file->getClientOriginalExtension();
            
            // Upload ke MinIO/S3
            $path = Storage::disk('s3')->put($filename, file_get_contents($file));
            
            // Get URL
            $url = Storage::disk('s3')->url($filename);

            return response()->json([
                'success' => true,
                'url' => $url,
                'path' => $filename,
                'filename' => basename($filename)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Upload failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Upload file biasa (PDF, DOC, dll)
     */
    public function storeFile(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt|max:10240', // 10MB
            'folder' => 'nullable|string'
        ]);

        try {
            $file = $request->file('file');
            $folder = $request->input('folder', 'uploads/files');
            
            // Generate unique filename
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $filename = $folder . '/' . Str::uuid() . '_' . $originalName;
            
            // Upload ke MinIO/S3
            $path = Storage::disk('s3')->put($filename, file_get_contents($file));
            
            // Get URL
            $url = Storage::disk('s3')->url($filename);

            return response()->json([
                'success' => true,
                'url' => $url,
                'path' => $filename,
                'filename' => $originalName,
                'size' => $file->getSize()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Upload failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Upload dan resize image untuk thumbnail
     */
    public function storeAndResize(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'width' => 'nullable|integer|min:50|max:2000',
            'height' => 'nullable|integer|min:50|max:2000',
            'folder' => 'nullable|string'
        ]);

        try {
            $file = $request->file('file');
            $folder = $request->input('folder', 'uploads/resized');
            $width = $request->input('width', 800);
            $height = $request->input('height', 600);
            
            // Resize image
            $image = Image::make($file)->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode($file->getClientOriginalExtension());
            
            // Generate unique filename
            $filename = $folder . '/' . Str::uuid() . '.' . $file->getClientOriginalExtension();
            
            // Upload ke MinIO/S3
            Storage::disk('s3')->put($filename, $image->__toString());
            
            // Get URL
            $url = Storage::disk('s3')->url($filename);

            return response()->json([
                'success' => true,
                'url' => $url,
                'path' => $filename,
                'dimensions' => [
                    'width' => $image->width(),
                    'height' => $image->height()
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Upload failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete file dari storage
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'path' => 'required|string'
        ]);

        try {
            $path = $request->input('path');
            
            // Hapus dari storage
            $deleted = Storage::disk('s3')->delete($path);
            
            if ($deleted) {
                return response()->json([
                    'success' => true,
                    'message' => 'File deleted successfully'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'File not found or already deleted'
                ], 404);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Delete failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get temporary signed URL (jika diperlukan)
     */
    public function getSignedUrl(Request $request)
    {
        $request->validate([
            'path' => 'required|string',
            'expiry' => 'nullable|integer|min:1|max:60' // menit
        ]);

        try {
            $path = $request->input('path');
            $expiry = $request->input('expiry', 5); // default 5 menit
            
            // Generate signed URL
            $url = Storage::disk('s3')->temporaryUrl(
                $path, 
                now()->addMinutes($expiry)
            );

            return response()->json([
                'success' => true,
                'url' => $url,
                'expires_at' => now()->addMinutes($expiry)->toDateTimeString()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to generate URL: ' . $e->getMessage()
            ], 500);
        }
    }
}