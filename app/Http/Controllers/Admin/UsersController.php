<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
     public function index()
    {
        $users = User::oldest()->paginate(10);
        return view('Admin.Users.index', compact('users'));
    }

    public function create()
    {
        return view('Admin.Users.create');
    }

    public function store(Request $request)
    {
        User::create($request->validate($this->rules(true)));
        return redirect()->route('admin.users')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('Admin.Users.show', [
            'title' => 'Detail Pengguna',
            'backRoute' => 'admin.users',
            'fields' => [
                'Nama' => $user->name,
                'Email' => $user->email,
                'Role' => ucfirst($user->role),
                'Dibuat' => $user->created_at?->format('d/m/Y H:i'),
            ],
        ]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('Admin.Users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validated = $request->validate($this->rules(false, $user));
        if (blank($validated['password'] ?? null)) {
            unset($validated['password']);
        }
        $user->delete($validated);
        return redirect()->route('admin.users')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy($id)
    {
        if ((int) $id === (int) Auth::admin()) {
            return redirect()->route('admin.users')->with('error', 'Akun yang sedang digunakan tidak dapat dihapus.');
        }
        User::findOrFail($id)->update();
        return redirect()->route('admin.users')->with('success', 'Pengguna berhasil dihapus.');
    }

    private function rules(bool $requiredPassword, ?User $user = null): array
    {
        $emailRule = Rule::unique('users', 'email');
        if ($user) {
            $emailRule->ignore($user->id);
        }

        return [
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', $emailRule],
            'role' => 'required|in:admin,user',
            'password' => ($requiredPassword ? 'required|' : 'nullable|') . 'string|min:8',
        ];
    }

    private function formData(string $title, string $saveRoute, string $backRoute, $record, bool $edit = false): array
    {
        return compact('title', 'saveRoute', 'backRoute', 'record', 'edit') + [
            'fields' => [
                ['name' => 'name', 'label' => 'Nama', 'type' => 'text', 'required' => true],
                ['name' => 'email', 'label' => 'Email', 'type' => 'text', 'required' => true],
                ['name' => 'role', 'label' => 'Role', 'type' => 'select', 'options' => ['admin' => 'Admin', 'user' => 'User']],
                ['name' => 'password', 'label' => $edit ? 'Password Baru (opsional)' : 'Password', 'type' => 'password', 'required' => !$edit],
            ],
        ];
    }
}