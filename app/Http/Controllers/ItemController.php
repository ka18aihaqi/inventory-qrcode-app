<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ItemController extends Controller {
    
    public function index() {
        $items = Item::with(['category', 'location'])->get();
        $categories = Category::all();
        $locations = Location::all();
        
        return view('pages.items', compact('items', 'categories', 'locations'));
    }

    public function create() {
        $categories = Category::all();
        $locations = Location::all();
        return view('items.create', compact('categories', 'locations'));
    }

    public function store(Request $request) 
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'serial_number' => 'required|unique:items,serial_number',
            'status' => 'required|in:Available,In Use,Maintenance,Lost',
            'location_id' => 'required|exists:locations,id',
        ]);

        // Simpan item ke database tanpa QR Code dulu
        $item = Item::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'serial_number' => $request->serial_number,
            'status' => $request->status,
            'location_id' => $request->location_id,
        ]);

        // Buat URL berdasarkan serial_number
        $url = route('items.show', ['serial_number' => $item->serial_number]);

        // Generate QR Code dengan URL
        $qrCode = QrCode::format('png')->size(200)->generate($url);
        
        // Gunakan serial number sebagai nama file
        $qrPath = 'qrcodes/' . $item->serial_number . '.png';

        // Simpan QR Code ke storage
        Storage::disk('public')->put($qrPath, $qrCode);

        // Update item dengan path QR Code
        $item->update(['qr_code' => $qrPath]);

        return redirect()->route('items.index')->with('success', 'Item added successfully.');
    }

    public function edit(Item $item) {
        $categories = Category::all();
        $locations = Location::all();
        return view('items.edit', compact('item', 'categories', 'locations'));
    }

    public function update(Request $request, Item $item) 
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'serial_number' => 'required|unique:items,serial_number,' . $item->id,
            'status' => 'required|in:Available,In Use,Maintenance,Lost',
            'location_id' => 'required|exists:locations,id',
        ]);

        // Cek apakah serial number berubah
        $serialChanged = $item->serial_number !== $request->serial_number;

        // Simpan serial number lama untuk menghapus file jika berubah
        $oldSerialNumber = $item->serial_number;

        // Update item terlebih dahulu
        $item->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'serial_number' => $request->serial_number,
            'status' => $request->status,
            'location_id' => $request->location_id,
        ]);

        // Jika serial number berubah, buat QR Code baru
        if ($serialChanged) {
            // Hapus QR Code lama
            $oldQrPath = 'qrcodes/' . $oldSerialNumber . '.png';
            if (Storage::disk('public')->exists($oldQrPath)) {
                Storage::disk('public')->delete($oldQrPath);
            }

            // Buat URL berdasarkan serial number baru
            $url = route('items.show', ['serial_number' => $item->serial_number]);

            // Generate QR Code
            $qrCode = QrCode::format('png')->size(200)->generate($url);
            
            // Gunakan serial number baru sebagai nama file
            $qrPath = 'qrcodes/' . $item->serial_number . '.png';

            // Simpan QR Code baru di storage
            Storage::disk('public')->put($qrPath, $qrCode);

            // Update item dengan path QR Code baru
            $item->update(['qr_code' => $qrPath]);
        }

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }


    public function destroy(Item $item) {
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }

    public function show($serial_number) {
        $item = Item::where('serial_number', $serial_number)->firstOrFail();
        return view('pages.show', compact('item'));
    }     
}
