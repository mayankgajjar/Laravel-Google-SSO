<?php
namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Http;

class UserRepository
{
    public function findByGoogleId($googleId)
    {
        $res_data = false;
        if(!empty($googleId)){
            $res_data = User::where('google_id', $googleId)->first();
        }
        return $res_data;
    }

    public function create(array $data)
    {
        $res_data = false;
        if(!empty($data)){
            $res_data =  User::create($data);
        }
        return $res_data;
    }

    public function GetUserInfoByID($userID) 
    {
        $user_data = [];
        if(!empty($userID)){
            $user_data = User::find($userID);
        }
        return $user_data;
    }

    public function GetWeatherData($city_name) 
    {
        $res_data = [];
        if(!empty($city_name)){
            $api_url = "https://api.openweathermap.org/data/2.5/weather?q=".$city_name."&appid=".env('WEATHER_API_KEY')."";
            $response = Http::get($api_url);
            if ($response->getStatusCode() == 200) { // 200 OK
                $res_data = $response->getBody()->getContents();
            }
        }
        return $res_data;
    }
}
