<?php

namespace App\Http\Livewire\Layouts;

use App\Models\GetJSON;
use App\Models\Parlamento\GroupsHasViews;
use App\Models\Parlamento\Profile;
use App\Models\Permitions\GroupsHasUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Livewire\Component;


class SideBar extends Component
{
    use GetJSON;

    public $mainMenu = array();
    public $profile_image = "/assets/media/149071.png";

    public function mount()
    {
        $profile = Profile::where('primavera_email', auth()->user()->ldap->getEmail())->first();
        if ($profile) {
            $this->profile_image = Storage::url($profile->image_profile);
        }

        $this->mainMenu = $this->parseEncode('mainmenu.json')['mainmenu'];

    }

    public function render(): View
    {


        return view('livewire.layouts.side-bar');
    }

    public function logoutRequest()
    {
        Auth::logout();
        return redirect()->intended('dashboard');
    }
}
