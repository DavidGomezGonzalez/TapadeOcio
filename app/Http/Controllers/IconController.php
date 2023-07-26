<?php

namespace App\Http\Controllers;

use App\Models\Icon;
use Illuminate\Http\Request;

class IconController extends Controller
{
    public function index()
    {
        $icons = Icon::all();
        return view('icons.index', compact('icons'));
    }

    public function create()
    {

        return view('icons.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'icon' => 'required|file|mimes:svg|max:2048',
        ]);

        $iconFile = $request->file('icon');
        $iconFileName = time() . '_' . $iconFile->getClientOriginalName();
        $iconFile->storeAs('public/svg', $iconFileName);

        $icon = new Icon;
        $icon->name = $request->input('name');
        $icon->filename = $iconFileName;
        $icon->save();

        return redirect()->route('icons.index')->with('success', 'Icon uploaded successfully.');
    }

    public function show(Icon $icon)
    {
        return view('icons.show', compact('icon'));
    }

    public function edit(Icon $icon)
    {
        return view('icons.edit', compact('icon'));
    }

    public function update(Request $request, Icon $icon)
    {
        $request->validate([
            'name' => 'required',
            'icon' => 'nullable|file|mimes:svg|max:2048',
        ]);

        if ($request->hasFile('icon')) {
            $iconFile = $request->file('icon');
            $iconFileName = time() . '_' . $iconFile->getClientOriginalName();
            $iconFile->storeAs('public/svg', $iconFileName);
            $icon->filename = $iconFileName;
        }

        $icon->name = $request->input('name');
        $icon->save();

        return redirect()->route('icons.index')->with('success', 'Icon updated successfully.');
    }

    public function destroy(Icon $icon)
    {
        $icon->delete();
        return redirect()->route('icons.index')->with('success', 'Icon deleted successfully.');
    }
}
