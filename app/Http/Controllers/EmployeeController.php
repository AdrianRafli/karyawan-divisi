<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('division')->get();
        return view('dashboard', compact('employees'));
    }

    public function create()
    {
        $divisions = Division::all();
        return view('employees.create', compact('divisions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'nullable|string|max:15',
            'division_id' => 'required|exists:divisions,id',
        ]);

        Employee::create($validated);

        return redirect()->route('dashboard')->with('success', 'Karyawan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $divisions = Division::all();

        return view('employees.edit', compact('employee', 'divisions'));
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'phone' => 'nullable|string|max:15',
            'division_id' => 'required|exists:divisions,id',
        ]);

        $employee->update($validated);

        return redirect()->route('dashboard')->with('success', 'Karyawan berhasil diupdate!');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('dashboard')->with('success', 'Karyawan berhasil dihapus!');
    }
}
