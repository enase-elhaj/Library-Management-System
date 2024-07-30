<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patron;

class PatronController extends Controller
{
   
    public function index()
    {
        return Patron::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string',
        ]);

        return Patron::create($validated);
    }

    
    public function show(string $id)
    {
        return Patron::findOrFail($id);
    }

   
    public function update(Request $request, string $id)
    {
        $patron = Patron::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'string',
            'contact_information' => 'string',
        ]);

        $patron->update($validated);

        return $patron;
    }

    
    public function destroy(string $id)
    {
        $patron = Patron::findOrFail($id);
        $patron->delete();

        return response()->json(['message' => 'Patron deleted successfully']);
    }
}
