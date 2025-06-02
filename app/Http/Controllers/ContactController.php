<?php
namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('homepage.contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ho_ten' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'chu_de' => 'required|string|max:255',
            'noi_dung' => 'required|string',
        ]);

        Contact::create($validated);

        if ($request->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('contact.index')->with('success', 'Thông tin liên hệ của bạn đã được gửi. Cảm ơn bạn!');
    }
}
