<?php

use App\Http\Controllers\EmployeeController;
use App\Models\Employee;
use Illuminate\Support\Facades\Route;
use Barryvdh\DomPDF\Facade\Pdf;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Halaman Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Redirect ke Dashboard jika root URL diakses
Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [EmployeeController::class, 'index'])->name('dashboard');

    Route::resource('employees', EmployeeController::class)->except(['show']);

    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
});

// saya melakukan export excel/csv secara manual karena tidak bisa menggunakan library Maatwebsite\Excel
Route::get('/employees/export', function () {
    // Set nama file
    $fileName = 'employees.csv';

    // Ambil data karyawan beserta relasi divisi
    $employees = Employee::with('division')->get();

    // Header untuk file CSV
    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => "attachment; filename=\"$fileName\"",
    ];

    // Callback untuk menulis data ke file CSV
    $callback = function () use ($employees) {
        $file = fopen('php://output', 'w');

        // Tulis header kolom di CSV
        fputcsv($file, ['ID', 'Nama', 'Email', 'Telepon', 'Divisi']);

        // Tulis data karyawan ke CSV
        foreach ($employees as $employee) {
            fputcsv($file, [
                $employee->id,
                $employee->name,
                $employee->email,
                $employee->phone,
                $employee->division ? $employee->division->name : 'Tidak Ada',
            ]);
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
})->name('employees.export');

// cetak pdf
Route::get('/employees/export-pdf', function () {
    // Ambil data karyawan beserta relasi divisi
    $employees = \App\Models\Employee::with('division')->get();

    // Generate PDF
    $pdf = Pdf::loadView('employees.pdf', compact('employees'))->setPaper('a4', 'landscape');

    // Unduh file PDF
    return $pdf->download('employees.pdf');
})->name('employees.export-pdf');


require __DIR__.'/auth.php';
