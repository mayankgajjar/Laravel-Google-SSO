<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, UserRepository $userRepository)
    {
        $response_array = (object)array();

        $userData =  $userRepository->GetUserInfoByID(Auth::id());
        $userobject = (object)array();
        $userobject->id = $userData->id;
        $userobject->first_name = $userData->first_name;
        $userobject->last_name = $userData->last_name;
        $userobject->email = $userData->email;
        $userobject->profile = $userData->profile;
        $userobject->status = $userData->status;
        $userobject->created_at = $userData->created_at;
        $userobject->updated_at = $userData->updated_at;
        $response_array->user = $userobject;

        $locationobject = (object)array();
        $ip =  $request->ip();
        //$ip = '162.159.24.227'; /* Static IP address */
        if(!empty($ip)){
            $currentUserInfo = Location::get($ip);
            if(!empty($currentUserInfo)){

                $cachedWeather = Redis::get('Weather_' . $currentUserInfo->cityName);

                if(!empty($cachedWeather)){
                    $WeatherData = json_decode($cachedWeather);
                } else {
                    $Weather_Data = $userRepository->GetWeatherData($currentUserInfo->cityName);
                    Redis::set('Weather_' . $currentUserInfo->cityName, $Weather_Data);
                    $WeatherData = json_decode($Weather_Data);
                }
                
                if(!empty($WeatherData)){
                    $WeatherData->main->city = $WeatherData->name; 
                    $locationobject = $WeatherData->main;
                    $response_array->main = $locationobject;
                }
            }
        }

        //dd($response_array);
        return view('home', compact('response_array'));
    }


}
