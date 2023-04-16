<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\AboutUs;
use App\Models\Services;
use App\Models\Categories;
use App\Models\Projects;
use App\Models\FAQ;
use App\Models\Contact;

class IndexController extends Controller
{
    //
    public function Home()
    {
        $settingData = Settings::where('id', 1)->first();
        $aboutusData = AboutUs::all();
        $serviceData = Services::all();
        $allCat = Categories::all();
        $allProject = Projects::all();
        $allFaq = FAQ::all();
        return view('site.home')->with([
            'settingData' => $settingData, 'aboutusData' => $aboutusData,
            'serviceData' => $serviceData, 'allCat' => $allCat, 'allProject' => $allProject,
            'allFaq' => $allFaq,
        ]);
    }

    public function ContactUsForm(Request $request)
    {
        //validation
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'subject' => 'required|max:255',
            'message' => 'required',

        ]);
        //send email
        //Store
        $data = new Contact();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->subject = $request->subject;
        $data->message = $request->message;
        $data->save();


        return back()->with('flash_message', 'تم ارسال الرساله بنجاح وسيتم التواصل فى اقرب وقت');
    }
}
