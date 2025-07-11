<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

// class ContactController extends Controller
// {
//     public function index(Request $request)
//     {
//         $query = Contact::query();

//         // Lọc theo trạng thái nếu có chọn
//         if ($request->filled('trang_thai')) {
//             $query->where('trang_thai', $request->input('trang_thai'));
//         }

//         // Tìm kiếm
//         if ($search = $request->input('search')) {
//             $query->where(function ($q) use ($search) {
//                 $q->where('ho_ten', 'like', "%$search%")
//                   ->orWhere('email', 'like', "%$search%")
//                   ->orWhere('chu_de', 'like', "%$search%");
//             });
//         }

//         // Sắp xếp
//         $sort = $request->input('sort', 'desc'); // Mặc định: mới nhất
//         $query->orderBy('created_at', $sort);

//         // Phân trang
//         $contacts = $query->paginate(7);

//         return view('admin.contacts', compact('contacts'));
//     }

//     public function updateStatus($id)
//     {
//         $contact = \App\Models\Contact::findOrFail($id);
//         $contact->trang_thai = $contact->trang_thai == 1 ? 0 : 1;
//         $contact->save();

//         return redirect()->back()->with('success', 'Cập nhật trạng thái thành công.');
//     }

}
