<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Watcher;
use App\Models\Order;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function createWatcher()
    {
        return view('admin.watchers.create');
    }

    public function storeWatcher(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'material' => 'nullable|string|max:50',
            'brand' => 'nullable|string|max:50',
            'stock' => 'required|integer',
            'image_url' => 'nullable|url',
        ]);

        Watcher::create($validated);

        return redirect('/dashboard');
    }

    public function edit($watcher_id)
    {
        $watcher = Watcher::findOrFail($watcher_id);
        return view('admin.watchers.edit', compact('watcher'));
    }

    public function updateWatcher(Request $request, $watcher_id)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'material' => 'nullable|string|max:50',
            'brand' => 'nullable|string|max:50',
            'stock' => 'required|integer',
            'image_url' => 'nullable|url',
        ]);

        $watcher = Watcher::findOrFail($watcher_id);
        $watcher->update($validated);

        return redirect('/');
    }
}
