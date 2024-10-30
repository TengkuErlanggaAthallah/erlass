<?php

namespace App\Http\Controllers;

use App\Models\User; // Pastikan ini ditambahkan
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Media;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    public function uploadMedia(Request $request)
    {
        \Log::info('Upload media called');
        // Validasi file dan input
        $rules = $this->getValidationRules($request->input('category'));
        $request->validate($rules);
    
        // Upload file media, gambar, dan thumbnail
        $media = $this->handleFileUpload($request, 'media', 'public/videos', 'video_title');
        $image = $this->handleFileUpload($request, 'image', 'public/images', 'title');
        $thumbnail = $this->handleFileUpload($request, 'thumbnail', 'public/thumbnails', 'video_title');
    
        // Simpan data media ke database
        $createdMedia = Media::create([
            'media' => $media,
            'image' => $image,
            'thumbnail' => $thumbnail,
            'category' => $request->input('category'),
            'title' => $request->input('title', null),
            'upload_date' => $request->input('upload_date', null),
            'description' => $request->input('description', null),
            'designer_name' => $request->input('designer_name', null),
            'design_date' => $request->input('design_date', null),
            'video_title' => $request->input('video_title', null),
            'video_date' => $request->input('video_date', null),
            'quote' => $request->input('quote', null),
            'user_id' => auth()->id(), // Simpan ID user yang mengupload
        ]);
    
        // Tentukan pesan notifikasi berdasarkan kategori media
        $message = '';
        switch ($createdMedia->category) {
            case 'motivational_quotes':
                $message = 'Quote motivasi berhasil diunggah!';
                break;
            case 'alat_promosi_internal':
                $message = 'Alat promosi internal berhasil diunggah!';
                break;
            case 'design_corner':
                $message = 'Desain baru berhasil diunggah ke Design Corner!';
                break;
            case 'promotion_videos':
                $message = 'Video promosi berhasil diunggah!';
                break;
            case 'produk':
                $message = 'Produk baru berhasil diunggah!';
                break;
            default:
                $message = 'Media berhasil diunggah!';
                break;
        }
    
        return back()->with('success', $message);
    }    

    public function index()
    {
        $media = Media::all();
        $users = User::where(function($query) {
            $query->where('role', 'petugas')
                  ->orWhere('role', 'admin');
        })->where('id', '!=', auth()->id())->get(); // Mengecualikan pengguna yang sedang login
    
        return view('admin.media.index', compact('media', 'users')); // Kirim variabel media dan users ke view
    }

    public function update(Request $request, $id)
    {
        \Log::info('Update request data:', $request->all()); // Log data yang diterima
    
        $media = Media::findOrFail($id);
        
        // Validasi input
        $request->validate($this->getValidationRulesForUpdate());
        
        // Update file media, gambar, dan thumbnail jika ada
        if ($request->hasFile('media')) {
            $this->updateFile($request, $media, 'media', 'public/videos', 'video_title');
        }
        
        if ($request->hasFile('thumbnail')) {
            $this->updateFile($request, $media, 'thumbnail', 'public/thumbnails', 'video_title');
        }
        
        if ($request->hasFile('image')) {
            $this->updateFile($request, $media, 'image', 'public/images', 'title');
        }
        
        // Update data lainnya jika ada
        $updateData = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'designer_name' => $request->input('designer_name'),
            'design_date' => $request->input('design_date'),
            'upload_date' => $request->input('upload_date'),
            'video_title' => $request->input('video_title'),
            'video_date' => $request->input('video_date'),
            'quote' => $request->input('quote'),
        ];
        
        // Hanya update jika ada input yang tidak null
        foreach ($updateData as $key => $value) {
            if ($value === null) {
                unset($updateData[$key]);
            }
        }
        
        $media->update($updateData);
        
        // Mengembalikan respons JSON
        return response()->json(['success' => true, 'message' => 'Media berhasil diperbarui!']);
    }
    
    private function updateFile(Request $request, $media, $fileInputName, $storagePath, $titleInputName)
    {
        if ($request->hasFile($fileInputName)) {
            // Hapus file lama jika ada
            if ($media->$fileInputName) {
                \Log::info("Attempting to delete old file: {$media->$fileInputName}");
                $this->deleteFile($media->$fileInputName, $storagePath);
            }
    
            // Simpan file baru
            $fileUrl = $this->handleFileUpload($request, $fileInputName, $storagePath, $titleInputName);
            $media->$fileInputName = $fileUrl;
    
            // Tambahkan logging untuk memastikan URL baru
            \Log::info("Updated {$fileInputName} with URL: {$fileUrl}");
    
            // Simpan perubahan ke database
            $media->save();
        }
    }
    

    private function handleFileUpload(Request $request, $fileInputName, $storagePath, $titleInputName)
    {
        if ($request->hasFile($fileInputName)) {
            $file = $request->file($fileInputName);
            // Tambahkan timestamp atau ID media ke nama file
            $fileName = Str::slug($request->input($titleInputName, 'default')) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs($storagePath, $fileName);
    
            // Tambahkan logging
            \Log::info("File uploaded: {$fileName} to {$filePath}");
    
            return Storage::url($filePath);
        }
        return null;
    }    

    public function destroy($id)
    {
        $media = Media::find($id);
        if ($media) {
            // Jika file yang di-upload perlu dihapus juga
            if ($media->image && Storage::exists($media->image)) {
                Storage::delete($media->image);
            }
            $media->delete();
            return response()->json(['success' => true, 'message' => 'Media berhasil dihapus']);
        }
        return response()->json(['success' => false, 'message' => 'Media tidak ditemukan']);
    }

    private function getValidationRules($category)
{
    $rules = ['category' => 'required|string'];

    switch ($category) {
        case 'motivational_quotes':
            $rules['image'] = 'required|mimes:jpeg,png,jpg,gif,svg|max:10240';
            $rules['upload_date'] = 'required|date';
            $rules['quote'] = 'required|string|max:500';
            break;

        case 'alat_promosi_internal':
            $rules['description'] = 'required|string';
            $rules['title'] = 'required|string|max:255';
            $rules['image'] = 'required|mimes:jpeg,png,jpg,gif,svg|max:10240'; // Hanya menerima gambar
            $rules['upload_date'] = 'required|date';
            break;

        case 'design_corner':
            $rules['designer_name'] = 'required|string|max:255';
            $rules['description'] = 'required|string';
            $rules['design_date'] = 'required|date';
            $rules['image'] = 'required|mimes:jpeg,png,jpg,gif,svg|max:10240'; // Hanya menerima gambar
            break;

        case 'promotion_videos':
            $rules['video_title'] = 'required|string|max:255';
            $rules['video_date'] = 'required|date';
            $rules['thumbnail'] = 'required|mimes:jpeg,png,jpg,gif,svg|max:10240'; // Thumbnail harus berupa gambar
            $rules['media'] = 'required|mimes:mp4,mkv,avi|max:200000'; // Hanya menerima video
            break;

        case 'produk':
            $rules['description'] = 'required|string';
            $rules['title'] = 'required|string|max:255';
            $rules['image'] = 'required|mimes:jpeg,png,jpg,gif,svg|max:10240'; // Hanya menerima gambar
            $rules['upload_date'] = 'required|date';
            break;

        default:
            abort(400, 'Kategori tidak dikenali.');
    }

    return $rules;
}

    private function getValidationRulesForUpdate()
    {
        return [
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'designer_name' => 'nullable|string|max:255',
            'design_date' => 'nullable|date',
            'upload_date' => 'nullable|date',
            'video_title' => 'nullable|string|max:255',
            'video_date' => 'nullable|date',
            'thumbnail' => 'nullable|image|max:2048',
            'media' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,mp4,mkv,avi|max:200000',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'quote' => 'nullable|string',
        ];
    }

    private function deleteFile($fileUrl, $storagePath)
{
    if ($fileUrl && Storage::exists($storagePath . '/' . basename($fileUrl))) {
        // Tambahkan logging
        \Log::info("Deleting file: {$storagePath}/" . basename($fileUrl));
        
        Storage::delete($storagePath . '/' . basename($fileUrl));
    }
}

public function showUploadForm()
{
    // Ambil semua pengguna untuk ditampilkan di form upload
    $users = User::where(function($query) {
        $query->where('role', 'petugas')
              ->orWhere('role', 'admin');
    })->where('id', '!=', auth()->id())->get(); // Mengecualikan pengguna yang sedang login
    
    return view('admin.media.upload', compact('users')); // Kirim variabel users ke view
}

    public function showPromotionVideos()
    {
        $media = Media::where('category', 'promotion_videos')->get()->map(function ($item) {
            // Menandai sebagai baru jika diupload dalam 1 hari terakhir
            $item->is_new = $this->isMediaNew($item->video_date);
            return $item;
        });
        return view('categories.promotion_videos', compact('media'));
    }

    public function showMotivationalQuotes() 
    {
        $media = Media::where('category', 'motivational_quotes')->get()->map(function ($item) {
            // Menandai sebagai baru jika diupload dalam 1 hari terakhir
            $item->is_new = $this->isMediaNew($item->upload_date);
            return $item;
        });
        return view('categories.motivational_quotes', compact('media'));
    }

    public function showDesignCorner()
    {
        $media = Media::where('category', 'design_corner')->get()->map(function ($item) {
            // Menandai sebagai baru jika diupload dalam 1 hari terakhir
            $item->is_new = $this->isMediaNew($item->design_date);
            return $item;
        });
        return view('categories.design_corner', compact('media'));
    }

    public function showAlatPromosiInternal()
    {
        // Mengambil media berdasarkan kategori 'alat_promosi_internal'
        $media = Media::where('category', 'alat_promosi_internal')->get()->map(function ($item) {
            // Menandai sebagai baru jika diupload dalam 1 hari terakhir
            $item->is_new = $this->isMediaNew($item->upload_date);
            return $item;
        });
    
        // Mengirim data ke view
        return view('categories.alat_promosi_internal', compact('media'));
    }

    public function showProduk()
    {
        // Mengambil media berdasarkan kategori 'alat_promosi_internal'
        $media = Media::where('category', 'produk')->get()->map(function ($item) {
            // Menandai sebagai baru jika diupload dalam 1 hari terakhir
            $item->is_new = $this->isMediaNew($item->upload_date);
            return $item;
        });
    
        // Mengirim data ke view
        return view('categories.produk', compact('media'));
    }

    public function show($id)
    {
        $media = Media::findOrFail($id); // Cari media berdasarkan ID, jika tidak ditemukan akan error 404
        return view('petugas.media.show', compact('media')); // Tampilkan view yang sesuai untuk menampilkan detail media
    }
        // Fungsi untuk menentukan apakah media baru
        private function isMediaNew($uploadDate)
        {
            return now()->diffInDays(\Carbon\Carbon::parse($uploadDate)) < 1; 
        }
        public function detail($title)
        {
            $media = Media::findOrFail($title); // Ambil detail media berdasarkan ID
            return view('categories.detail', compact('media')); // Tampilkan view detail produk
        }
}
