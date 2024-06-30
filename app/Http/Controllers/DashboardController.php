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

    $presence_history = Presence::where('identity_number', $user->identity_number)
      ->whereRaw('MONTH(tgl_presensi)="' . $month_now . '"')
      ->whereRaw('YEAR(tgl_presensi)="' . $year_now . '"')
      ->orderBy('tgl_presensi', 'DESC')
      ->get();

    $presence_recape = Presence::selectRaw('COUNT(identity_number) as total_presence, SUM(IF(time_in > "09:00",1,0)) as total_late')
      ->where('identity_number', $user->identity_number)
      ->whereRaw('MONTH(tgl_presensi)="' . $month_now . '"')
      ->whereRaw('YEAR(tgl_presensi)="' . $year_now . '"')
      ->first();

    // dd($presence_recape);

    $month_name = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

    $leaderboards = Presence::with('user')->where('tgl_presensi', $date_now)->orderBy('time_in', 'ASC')->get();
    
    // dd($employee_presences_order);
    
    return view('dashboard.dashboard', compact(
      'presence',
      'user',
      'presence_history',
      'users',
      'month_name',
      'month_now',
      'year_now',
      'presence_recape',
      'leaderboards'
    ));
  }
}
