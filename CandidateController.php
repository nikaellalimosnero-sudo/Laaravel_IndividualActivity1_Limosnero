<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
   
    public function index(Request $request)
    {
        $search = $request->input('search');

        $candidates = Candidate::when($search, function ($query, $search) {
                $query->where('first_name', 'like', "%$search%")
                      ->orWhere('middle_name', 'like', "%$search%")
                      ->orWhere('last_name', 'like', "%$search%")
                      ->orWhere('position', 'like', "%$search%")
                      ->orWhere('party', 'like', "%$search%");
            })
            ->latest()
            ->get();

        return view('index', compact('candidates'));
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'first_name'  => 'required|string|max:50',
            'middle_name' => 'nullable|string|max:50',
            'last_name'   => 'required|string|max:50',
            'gender'      => 'required|string|max:20',
            'address'     => 'required|string|max:255',
            'position'    => 'required|string|max:100',
            'party'       => 'nullable|string|max:100',
        ]);

        Candidate::create($request->all());

        return redirect()->route('candidates.index')
                         ->with('success', 'Candidate added successfully!');
    }

    
    public function edit($id)
    {
        $candidate = Candidate::findOrFail($id);
        return view('edit', compact('candidate'));
    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name'  => 'required|string|max:50',
            'middle_name' => 'nullable|string|max:50',
            'last_name'   => 'required|string|max:50',
            'gender'      => 'required|string|max:20',
            'address'     => 'required|string|max:255',
            'position'    => 'required|string|max:100',
            'party'       => 'nullable|string|max:100',
        ]);

        $candidate = Candidate::findOrFail($id);
        $candidate->update($request->all());

        return redirect()->route('candidates.index')
                         ->with('success', 'Candidate updated successfully!');
    }

   
    public function destroy($id)
    {
        Candidate::findOrFail($id)->delete();

        return redirect()->route('candidates.index')
                         ->with('success', 'Candidate deleted successfully!');
    }
}