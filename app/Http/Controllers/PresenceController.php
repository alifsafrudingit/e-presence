<?php

namespace App\Http\Controllers;

use App\Http\Requests\PresenceRequest;
use App\Models\Presence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PresenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $date_now = date('Y-m-d');
        $identity_number = Auth::user()->identity_number;
        
        $check = Presence::where('tgl_presensi',$date_now)->where('identity_number', $identity_number)->count();
        
        return view('presence.create', compact('check'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PresenceRequest $request)
    {
        $identity_number = Auth::user()->identity_number;
        $tgl_presensi = date('Y-m-d');
        $time = date('H:i:s');
        
        $latitude_office = -7.6990533;
        $longitude_office = 110.5740319;
        
        $location = $request->lokasi;
        $user_location = explode(',', $location);
        $latitude_user = $user_location[0];
        $longitude_user = $user_location[1];
        
        $distance = $this->distance($latitude_office, $longitude_office, $latitude_user, $longitude_user);
        $radius = round($distance['meters']);

        $image = $request->image;
        $folderPath = 'public/uploads/absensi/';
        $formatName = rand(1000,9999) . "-" . $tgl_presensi;
        $image_parts = explode(';base64', $image);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = $formatName . ".png";
        $file = $folderPath . $fileName;
        
        $get_data =  Presence::where('tgl_presensi',$tgl_presensi)->where('identity_number', $identity_number);
        
        $check = $get_data->count();
        
        if ($radius > 20) {
            echo 'error|Maaf anda berada diluar radius kantor|Jarak anda adalah ' . $radius . ' meter dari kantor|not_radius';
        } else {
            if ($check > 0) {  
                $check_now = $get_data->first();
                $starttimestamp = strtotime($check_now->time_in);
                $endtimestamp = strtotime($time);
                $difference = abs($endtimestamp - $starttimestamp)/3600;
                
                if ($difference < 7) {
                    echo 'error|Belum Saatnya Absen Pulang|Pastikan waktunya|not_time';
                } else {
                    $data_out = [
                        'time_out' => $time,
                        'foto_out' => $fileName,
                        'location_out' => $location
                    ];
                    
                    $update = $get_data->update($data_out);
                    
                    if ($update) {
                        echo 'success|Absen Pulang|Terimakasih, Hati-hati dijalan!|check_out';
                        Storage::put($file, $image_base64);
                    } else {
                        echo 'error|Gagal Absen Pulang|Silahkan hubungi tim IT|check_out';
                    }
                }
            } else {      
                $data_in = [
                    'identity_number' => $identity_number,
                    'tgl_presensi' => $tgl_presensi,
                    'time_in' => $time,
                    'foto_in' => $fileName,
                    'location_in' => $location,
                ];
                
                $save = Presence::create($data_in);
                 if ($save) {
                    echo 'success|Absen Masuk|Terimakasih, Selamat bekerja!|check_in';
                    Storage::put($file, $image_base64);
                } else {
                    echo 'error|Gagal Absen Masuk|Silahkan hubungi tim IT|check_in';
    
                }
            }
        }     
       

        
    }
    
    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2) * cos(deg2rad($theta))));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('meters');
    }

    /**
     * Display the specified resource.
     */
    public function show(Presence $presence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Presence $presence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Presence $presence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Presence $presence)
    {
        //
    }
}
