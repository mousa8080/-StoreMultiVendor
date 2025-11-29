<?php

namespace App\Http\Controllers\dashpoard;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Locales;
class profileContoller extends Controller
{
    public function edit(Request $request)
    {
        $user = $request->user();
        $countries=Countries::getNames();
        $locales=Locales::getNames();
        return view('dashpoard.profile.edit', compact('user','countries','locales'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'phone' => 'nullable|max:255',
            'street_address' => 'nullable|max:255',
            'city' => 'nullable|max:255',
            'state' => 'nullable|max:255',
            'country' => 'nullable|max:255|size:2',
            'postal_code' => 'nullable|max:255',
            'locale' => 'nullable|max:255|size:2',
            'gender' => 'in:male,female',
            'birth_date' => 'nullable|date|before_or_equal:today',
        ]);
        $user = $request->user();
        $user->profile()->fill($request->all())->save();
        //save  insert if not found or this found  make update data is here

        //    if($profile->first_name){
        //     $profile->update($request->all());
        //    }else{
        //     $request->merge([
        //         'user_id'=>$user->id,
        //     ]);
        //     $user->profile()->create($request->all());
        //    }
        return redirect()->route('dashpoard.profile.edit')->with('success', 'Profile updated successfully');
    }
}
