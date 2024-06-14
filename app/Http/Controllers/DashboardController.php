<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
   public function index()
   {
      $user = Auth::user();
      
      // dd($user);
      // $presence = Presence::where('id', Auth::user()->id)->first();
      // $presence = Presence::where('id', Auth::user()->id)->first();
      
      // if ($presence == null) {
      //    $presence = '00:00:00';
      // }
      
      // dd($presence) ;
    
     return view('dashboard.dashboard', compact('user'));
   }
}
