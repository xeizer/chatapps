<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Semuaobrolan;

class Chat extends Component
{
    public $orangDipilih;
    public $isiPesan;
    public $semuaPercakapan;
    public $ubahdata;
    public $sistema;

    public function pilihMember($idmember)
    {
        $this->orangDipilih = User::find($idmember);
        Semuaobrolan::where('tujuan', Auth::id())->update([
            'sudahbaca' => 1
        ]);
    }

    public function simpan()
    {
        $simpan = new Semuaobrolan();
        $simpan->dari = Auth::id();
        $simpan->tujuan = $this->orangDipilih->id;
        $simpan->pesan = $this->isiPesan;
        $simpan->sudahbaca = 0;
        $simpan->save();
    }
    public function render()
    {
        if ($this->orangDipilih) {
            $this->semuaPercakapan = Semuaobrolan::where(function ($q) {
                $q->where('dari', Auth::id())->where('tujuan', $this->orangDipilih->id);
            })->orWhere(function ($q) {
                $q->where('dari', $this->orangDipilih->id)->where('tujuan', Auth::id());
            })->get();
        }
        $semuapengguna = User::all()->except(Auth::id());
        return view('livewire.chat')->with([
            'semuapengguna' => $semuapengguna,
            'semuapercakapan' => $this->semuaPercakapan
        ]);
    }
}
