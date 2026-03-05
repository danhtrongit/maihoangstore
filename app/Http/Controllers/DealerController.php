<?php

namespace App\Http\Controllers;

use App\Models\DealerRegistration;
use Illuminate\Http\Request;

class DealerController extends Controller
{
    public function index()
    {
        return view('dealer');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:100',
            'products_interested' => 'nullable|string',
            'message' => 'nullable|string',
        ]);

        DealerRegistration::create($validated);

        return redirect()->route('dealer.index')->with('success', 'Đăng ký đại lý thành công! Chúng tôi sẽ liên hệ bạn sớm nhất.');
    }
}
