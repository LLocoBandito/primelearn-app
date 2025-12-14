<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Step;
use Illuminate\Http\Request;

class StepController extends Controller
{
    /**
     * Menampilkan konten detail satu langkah (step) dalam sebuah materi,
     * dengan perhitungan dinamis untuk total langkah dan URL navigasi.
     *
     * @param  \App\Models\Materi  $materi  Model Materi (dari Route Model Binding)
     * @param  int  $order  Nomor urutan langkah saat ini
     * @return \Illuminate\View\View
     */
    public function show(Materi $materi, $order)
    {
        // 1. Cari langkah berdasarkan materi_id dan urutan (order)
        $step = Step::where('materi_id', $materi->id)
                    ->where('order', $order)
                    ->with('images') 
                    ->firstOrFail(); 

        // 2. MENGHITUNG TOTAL LANGKAH SECARA DINAMIS
        // Langsung hitung jumlah total langkah yang terkait dengan materi ini.
        $totalSteps = Step::where('materi_id', $materi->id)->count(); 

        // Tetapkan nilai ke properti agar dapat diakses di view, misal: $step->total_steps
        // Ini menggantikan kebutuhan kolom di database.
        $step->total_steps = $totalSteps; 

        // --- 3. LOGIKA NAVIGASI ---

        $currentOrder = (int) $order;
        $nextOrder = $currentOrder + 1;
        $previousOrder = $currentOrder - 1;

        // Tentukan URL Langkah Berikutnya
        $nextStepUrl = ($nextOrder <= $totalSteps) ? 
            route('steps.show', [
                'materi' => $materi->id,
                'order' => $nextOrder
            ]) : 
            null;
        
        // Tentukan URL Langkah Sebelumnya
        $previousStepUrl = ($previousOrder >= 1) ? 
            route('steps.show', [
                'materi' => $materi->id,
                'order' => $previousOrder
            ]) : 
            null;
        
        // Tentukan URL Selesaikan Materi (jika ini langkah terakhir)
        $completeMateriUrl = (!$nextStepUrl) ? 
            // Asumsi route kembali ke halaman detail materi induk
            route('materi.show', ['materi' => $materi->id]) :
            null;

        // 4. Tampilkan tampilan blade menggunakan nama file yang benar (step_detail)
        return view('step_detail', compact('step', 'nextStepUrl', 'previousStepUrl', 'completeMateriUrl', 'materi'));
    }
}