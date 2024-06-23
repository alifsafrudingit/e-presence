<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
   public function index()
   {
      $user = Auth::user();
      $date_now = date('Y-m-d');
      $month_now = date('m');
      $year_now = date('Y');
      
      $users = User::all();

      $presence = Presence::where('identity_number', $user->identity_number)->where('tgl_presensi', $date_now)->first();
      
      $presence_history = Presence::where('identity_number', $user->identity_number)->whereRaw('MONTH(tgl_presensi)="' . $month_now . '"')->whereRaw('YEAR(tgl_presensi)="' . $year_now . '"')->orderBy('tgl_presensi', 'DESC')->get();
    
      return view('dashboard.dashboard', compact('presence', 'user', 'presence_history', 'users'));
   }
}
