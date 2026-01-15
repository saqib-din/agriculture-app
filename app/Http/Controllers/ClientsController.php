<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    // -----------------------------
    // 1️⃣ List all clients
    // -----------------------------
    public function index()
    {
        $clients = Client::all();
        return view('pages.admin-side.clients.index', compact('clients'));
    }

    // -----------------------------
    // 2️⃣ Show create form (admin panel)
    // -----------------------------
    public function create()
    {
        return view('pages.admin-side.clients.create');
    }

    // -----------------------------
    // 3️⃣ Store new client from admin panel
    // -----------------------------
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'nullable|email',
            'phone'     => 'nullable|string|max:20',
            'company'   => 'nullable|string|max:255',
            'status'    => 'required|boolean',

            'street'    => 'nullable|string|max:255',
            'city'      => 'nullable|string|max:255',
            'state'     => 'nullable|string|max:255',
            'country'   => 'nullable|string|max:255',
            'zip_code'  => 'nullable|string|max:20',
            'ntn_gst'   => 'nullable|string|max:50',
            'image'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/clients'), $filename);
            $data['image'] = 'uploads/clients/' . $filename;
        }

        Client::create($data);

        return redirect()->route('clients.index')
            ->with('success', 'Client added successfully!');
    }

    // -----------------------------
    // 4️⃣ Show edit form
    // -----------------------------
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('pages.admin-side.clients.edit', compact('client'));
    }

    // -----------------------------
    // 5️⃣ Update client
    // -----------------------------
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'nullable|email',
            'phone'     => 'nullable|string|max:20',
            'company'   => 'nullable|string|max:255',
            'status'    => 'required|boolean',

            'street'    => 'nullable|string|max:255',
            'city'      => 'nullable|string|max:255',
            'state'     => 'nullable|string|max:255',
            'country'   => 'nullable|string|max:255',
            'zip_code'  => 'nullable|string|max:20',
            'ntn_gst'   => 'nullable|string|max:50',
            'image'     => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        $client = Client::findOrFail($id);
        $data = $request->except(['_token', '_method']);

        // ✅ Replace image if uploaded
        if ($request->hasFile('image')) {
            if ($client->image && file_exists(public_path($client->image))) {
                unlink(public_path($client->image));
            }
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/clients'), $filename);
            $data['image'] = 'uploads/clients/' . $filename;
        }

        $client->update($data);

        return redirect()->route('clients.index')
            ->with('success', 'Client updated successfully!');
    }

    // -----------------------------
    // 6️⃣ Delete client
    // -----------------------------
    public function destroy($id)
    {
        Client::destroy($id);
        return redirect()->back()
            ->with('success', 'Client deleted successfully!');
    }

    // -----------------------------
    // 7️⃣ Quick client create (anywhere, no view)
    // -----------------------------
    public function quickStore(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
        ]);

        // 🔎 Check existing client (phone OR email)
        $client = Client::where('phone', $request->phone)
                        ->orWhere('email', $request->email)
                        ->first();

        if (!$client) {
            $client = Client::create([
                'name'   => $request->name,
                'phone'  => $request->phone,
                'email'  => $request->email,
                'status' => 1,
            ]);
        }

        return response()->json($client);
    }
}
