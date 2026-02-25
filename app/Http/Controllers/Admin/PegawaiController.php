<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
   public function index(Request $request)
{
    $q = $request->q;

    $pegawai = User::where('role', 'pegawai')
        ->when($q, function ($query) use ($q) {
            $query->where('name', 'like', "%$q%")
                  ->orWhere('email', 'like', "%$q%");
        })
        ->latest()
        ->get();

    return view('admin.pegawai.index', compact('pegawai', 'q'));
}


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => 'pegawai',
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('admin.pegawai.index')->with('success', 'Pegawai berhasil ditambahkan 💜');
    }

    public function update(Request $request, User $user)
    {
        if ($user->role !== 'pegawai') {
            return back()->with('error', 'User ini bukan pegawai.');
        }

        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
        ]);

        $user->name = $data['name'];
        $user->email = $data['email'];

        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        return redirect()->route('admin.pegawai.index')->with('success', 'Pegawai berhasil diupdate ✨');
    }

    public function destroy(User $user)
    {
        if ($user->role !== 'pegawai') {
            return back()->with('error', 'User ini bukan pegawai.');
        }

        $user->delete();

        return redirect()->route('admin.pegawai.index')->with('success', 'Pegawai berhasil dihapus 🗑️');
    }
}
