<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CareerController extends Controller
{
    public function index()
    {
        $careers = Career::latest()->paginate(10);
        return view('admin.career.index', compact('careers'));
    }

    public function create()
    {
        return view('admin.career.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'position' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'employment_type' => 'required|in:full_time,part_time,contract,internship,remote',
            'location' => 'required|string|max:255',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0|gt:salary_min',
            'application_deadline' => 'required|date|after:today',
            'vacancies' => 'required|integer|min:1',
            'experience_required' => 'nullable|integer|min:0',
            'benefits' => 'nullable|string',
            'is_active' => 'boolean',
        ], [
            'salary_max.gt' => 'Maximum salary must be greater than minimum salary.',
            'application_deadline.after' => 'Application deadline must be after today.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        if ($request->has('benefits') && !empty($request->benefits)) {
            $data['benefits'] = array_filter(
                array_map('trim', explode("\n", $request->benefits))
            );
        }

        Career::create($data);

        return redirect()->route('admin.career.index')
            ->with('success', 'Lowongan kerja berhasil dibuat!');
    }

  public function show(Career $career)
{
    // Kembalikan view untuk halaman detail
    return view('admin.career.show', compact('career'));
}
    public function edit(Career $career)
    {
        return view('admin.career.edit', compact('career'));
    }

    public function update(Request $request, Career $career)
    {
        $validator = Validator::make($request->all(), [
            'position' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'employment_type' => 'required|in:full_time,part_time,contract,internship,remote',
            'location' => 'required|string|max:255',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0|gt:salary_min',
            'application_deadline' => 'required|date',
            'vacancies' => 'required|integer|min:1',
            'experience_required' => 'nullable|integer|min:0',
            'benefits' => 'nullable|string',
            'is_active' => 'boolean',
        ], [
            'salary_max.gt' => 'Maximum salary must be greater than minimum salary.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        if ($request->has('benefits') && !empty($request->benefits)) {
            $data['benefits'] = array_filter(
                array_map('trim', explode("\n", $request->benefits))
            );
        } else {
            $data['benefits'] = null;
        }

        $career->update($data);

        return redirect()->route('admin.career.index')
            ->with('success', 'Lowongan kerja berhasil diperbarui!');
    }

   public function destroy(Career $career)
{
    $career->delete();
    
    // Redirect langsung ke index dengan flash message
    return redirect()->route('admin.career.index')
        ->with('success', 'Lowongan kerja berhasil dihapus!');
}
}