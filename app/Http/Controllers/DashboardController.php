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
      
      $users = User::all();

      $presence = Presence::where('identity_number', $user->identity_number)->where('tgl_presensi', $date_now)->first();
      
      $presences_month = Presence::where('identity_number', $user->identity_number)->whereMonth('created_at', Carbon::now())->get();
      
      // dd($presence_month);
    
      return view('dashboard.dashboard', compact('presence', 'user', 'presences_month', 'users'));
   }
}
