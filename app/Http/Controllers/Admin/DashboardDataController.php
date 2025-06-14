<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DashboardData;
use Illuminate\Http\Request;

class DashboardDataController extends Controller
{
    /**
     * Menampilkan daftar semua data dashboard.
     */
   public function index()
    {
         $dashboardData = DashboardData::latest('period_date')->paginate(15);
        return view('admin.data.index', compact('dashboardData'));

        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // --- Data untuk Grafik ---
        $energyData = DashboardData::where('metric_name', 'Konsumsi Listrik')
            ->latest('period_date')
            ->take(12)
            ->get()
            ->sortBy('period_date');

        $chartLabels = $energyData->pluck('period_date')->map(fn ($date) => \Carbon\Carbon::parse($date)->format('Y'));
        $chartValues = $energyData->pluck('metric_value');

        // --- Data untuk Kartu Statistik ---
        $latestConsumption = $energyData->last(); // Ambil data terbaru
        $previousConsumption = $energyData->slice(-2, 1)->first(); // Ambil data kedua dari belakang

        $stats = [
            'latest_kwh' => 0,
            'monthly_cost' => 0,
            'efficiency_change' => 0,
            'co2_saved' => 0,
        ];

        if ($latestConsumption) {
            $stats['latest_kwh'] = $latestConsumption->metric_value;
            // Estimasi biaya bulanan dari data tahunan
            $stats['monthly_cost'] = ($latestConsumption->metric_value / 12) * 1444.70;

            if ($previousConsumption) {
                $kwhChange = $previousConsumption->metric_value - $latestConsumption->metric_value;
                // Hitung perubahan efisiensi jika ada data pembanding
                $stats['efficiency_change'] = ($kwhChange / $previousConsumption->metric_value) * 100;
                
                // Jika konsumsi menurun (efisiensi naik), hitung CO2 yang tersimpan
                if ($kwhChange > 0) {
                    // Faktor emisi rata-rata PLN sekitar 0.85 kg CO2 per kWh
                    $stats['co2_saved'] = $kwhChange * 0.85;
                }
            }
        }

        return view('dashboard', [
            'chartLabels' => $chartLabels,
            'chartValues' => $chartValues,
            'stats' => $stats, // Kirim data statistik ke view
        ]);
    }

    /**
     * Menampilkan form untuk membuat data baru.
     */
    public function create()
    {
        return view('admin.data.create');
    }

    /**
     * Menyimpan data baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'metric_name' => 'required|string|max:255',
            'metric_value' => 'required|numeric',
            'period_date' => 'required|date',
            'source' => 'nullable|string|max:255',
        ]);

        DashboardData::create($request->all());

        return redirect()->route('admin.data.index')->with('success', 'Data referensi berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data.
     */
    public function edit(DashboardData $dashboardData)
    {
        // Nama variabel $dashboardData harus sama dengan yang ada di route resource
        return view('admin.data.edit', compact('dashboardData'));
    }

    /**
     * Memperbarui data di database.
     */
    public function update(Request $request, DashboardData $dashboardData)
    {
        $request->validate([
            'metric_name' => 'required|string|max:255',
            'metric_value' => 'required|numeric',
            'period_date' => 'required|date',
            'source' => 'nullable|string|max:255',
        ]);

        $dashboardData->update($request->all());

        return redirect()->route('admin.data.index')->with('success', 'Data referensi berhasil diperbarui.');
    }

    /**
     * Menghapus data dari database.
     */
    public function destroy(DashboardData $dashboardData)
    {
        $dashboardData->delete();
        return redirect()->route('admin.data.index')->with('success', 'Data referensi berhasil dihapus.');
    }
}