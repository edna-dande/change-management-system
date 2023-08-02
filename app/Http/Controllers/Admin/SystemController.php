<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\System;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function index ()
    {
        $systems = System::orderBy('id','DESC')->get();
        return view('system_dashboard', compact('systems'));
    }
    public function showSystem(System $system)
    {
//        $system = System::orderBy('id','DESC')->get();
        return view('system_details', compact('system'));

    }

    public function createSystem()
    {
        $systems = System::all();
        return view('admin.systems.create', compact('systems'));
    }

    public function editSystem(System $system)
    {
        return view('admin.systems.edit', compact('system'));
    }

    public function storeSystem(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $system = System::create($validatedData);

        $system->save();

        return redirect()->route('systems')
            ->with('success', 'System created successfully!');
    }

    public function updateSystem(Request $request, System $system)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        $system->update($validatedData);

        return redirect()->route('systems')
            ->with('success', 'System updated successfully!');
    }

    public function destroySystem(System $system)
    {
        $system->delete();

        return redirect()->route('systems')
            ->with('success', 'System deleted successfully!');
    }
}
