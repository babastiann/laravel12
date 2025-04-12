<?php

namespace App\Observers;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MahasiswaObserver
{
    /**
     * Handle the Mahasiswa "created" event.
     */
    public function created(Mahasiswa $mahasiswa)
    {
        // // Cek apakah sudah ada User dengan userable_id yang sama
        // $existingUser = User::where('userable_id', $mahasiswa->nrp)
        //                     ->where('userable_type', \App\Models\Mahasiswa::class)
        //                     ->first();

        // if (!$existingUser) {
        //     // Jika belum ada, buat User baru
        //     User::create([
        //         'email' => strtolower(str_replace(' ', '', $mahasiswa->email)), // Pastikan email terformat dengan benar
        //         'password' => Hash::make('password123'), // Password default
        //         'userable_id' => $mahasiswa->nrp,
        //         'userable_type' => \App\Models\Mahasiswa::class,
        //     ]);
        // }
    }


    /**
     * Handle the Mahasiswa "updated" event.
     */
    public function updated(Mahasiswa $mahasiswa): void
    {
        //
    }

    /**
     * Handle the Mahasiswa "deleted" event.
     */
    public function deleted(Mahasiswa $mahasiswa): void
    {
         // Jika mahasiswa dihapus, hapus user terkait (jika ada)
         $existingUser = User::where('userable_id', $mahasiswa->nrp)
         ->where('userable_type', \App\Models\Mahasiswa::class)
         ->first();

        if ($existingUser) {
            $existingUser->delete();
        }
    }

    /**
     * Handle the Mahasiswa "restored" event.
     */
    public function restored(Mahasiswa $mahasiswa): void
    {
        //
    }

    /**
     * Handle the Mahasiswa "force deleted" event.
     */
    public function forceDeleted(Mahasiswa $mahasiswa): void
    {
        //
    }
}
