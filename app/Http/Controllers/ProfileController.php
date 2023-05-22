<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Gender;
use App\Models\Quote;
use App\Models\User;
use App\Support\Helpers\Helper;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Image;

class ProfileController extends Controller
{
    const AVA_PATH = 'img/users';
    const DEFAULT_PHOTO = '__default.png';

    /**
     * Display the user's profile form.
     */
    public function edit(): View
    {
        $user = request()->user();
        $countries = Country::orderBy('name', 'asc')->get();
        $genders = Gender::orderBy('name', 'asc')->get();

        return view('pages.profile', compact('user', 'countries', 'genders'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        // Name
        if($request->has('name')) {
            $request->validate([
                'name' => ['string', 'min:3', 'max:255', Rule::unique(User::class)->ignore($request->user()->id)]
            ]);

            $user->name = $request->name;
        }

        // Email
        if($request->has('email')) {
            $request->validate([
                'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($request->user()->id)]
            ]);

            $user->email = $request->email;
            if($user->isDirty('email')) {
                $request->user()->email_verified_at = null;
                $user->save();
                $user->sendEmailVerificationNotification();
            }
        }

        // Country
        if($request->has('country_id')) {
            $user->country_id = $request->country_id;
        }

        // Age
        if($request->has('age')) {
            $user->age = $request->age;
        }

        // Gender
        if($request->has('gender_id')) {
            $user->gender_id = $request->gender_id;
        }

        // Biography
        if($request->has('biography')) {
            $user->biography = $request->biography;
        }

        $request->user()->save();

        return redirect()->back();
    }

    public function updateAva(Request $request)
    {
        $user = $request->user();
        $photo = $request->file('photo');

        // Upload FIle
        $filename = Helper::generateSlug($user->name) . '.' . $photo->getClientOriginalExtension();
        $filename = Helper::escapeDuplicateFilename($filename, self::AVA_PATH);
        $photo->move(public_path(self::AVA_PATH), $filename);

        $user->photo = $filename;
        $user->save();

        // resize image
        $thumb = Image::make(public_path(self::AVA_PATH . '/' . $filename));
        $thumb->fit(200, 200, function ($constraint) {
            $constraint->upsize();
          }, 'center');

        $thumb->save(public_path(self::AVA_PATH . '/' . $filename));

        return asset(self::AVA_PATH . '/' . $filename);
    }

    public function removeAva(Request $request)
    {
        $user = $request->user();
        $user->photo = self::DEFAULT_PHOTO;
        $user->save();

        return redirect()->back();
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
