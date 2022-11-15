<?php

namespace App\Http\Controllers\Dashboard\Home;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $photo_home = Setting::where('key','photo_home')->first();
        $features = Setting::where('key','features')->get();
        $screen_shot = Setting::where('key','screen_shot')->get();
        $phone = Setting::where('key','phone')->first();
        $email = Setting::where('key','email')->first();
        $address = Setting::where('key','address')->first();
        $question_1 = Setting::where('key','question_1')->first();
        $question_2 = Setting::where('key','question_2')->first();
        $question_3 = Setting::where('key','question_3')->first();
        $question_4 = Setting::where('key','question_4')->first();
        $question_5 = Setting::where('key','question_5')->first();
        $question_6 = Setting::where('key','question_6')->first();
        $answer_1 = Setting::where('key','answer_1')->first();
        $answer_2 = Setting::where('key','answer_2')->first();
        $answer_3 = Setting::where('key','answer_3')->first();
        $answer_4 = Setting::where('key','answer_4')->first();
        $answer_5 = Setting::where('key','answer_5')->first();
        $answer_6 = Setting::where('key','answer_6')->first();
        $background_download = Setting::where('key','background_download')->first();
        $download_link = Setting::where('key','download_link')->first();
        $logo = Setting::where('key','logo')->first();
        $logo_header = Setting::where('key','logo_header')->first();
        $facebook_link = Setting::where('key','facebook_link')->first();
        $twitter_link = Setting::where('key','twitter_link')->first();
        $instagram_link = Setting::where('key','instagram_link')->first();
        $loading = Setting::where('key','loading')->first();
        $title = Setting::where('key','title')->first();
        return response()->view('dashboard.home.index',compact('photo_home','features','screen_shot','phone','email','address','question_1','question_2','question_3','question_4','question_5','question_6','answer_1','answer_2','answer_3','answer_4','answer_5','answer_6','background_download','download_link','logo','logo_header','facebook_link','twitter_link','instagram_link','loading','title'));
    }
}
