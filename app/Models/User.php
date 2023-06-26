<?php

namespace App\Models;

use Adldap\Laravel\Traits\HasLdapUser;
use App\Models\Parlamento\GroupsHasViews;
use App\Models\Parlamento\IdeHelperUser;
use App\Models\Parlamento\Profile;
use App\Models\Permitions\GroupsHasUsers;
use App\Models\Traits\Perfis\ApplicationUser;
use App\Models\Traits\Perfis\AssembleiaUser;
use App\Models\Traits\Search;
use GuzzleHttp\Middleware;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use Spatie\Permission\Traits\HasRoles;
use function asset;

/**
 * @mixin IdeHelperUser
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasRoles;
    use HasLdapUser;
    use Search;
    use Impersonate;
    use ApplicationUser, AssembleiaUser;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $searchable = [
        'name',
        'email',
    ];

    public function canImpersonate()
    {
        return $this->isSuperAdmin();
    }

    public function updateUtilizador($validatedData)
    {
        $this->update($validatedData);
        $this->roles()->detach();
        $this->assignRole($validatedData['perfil']);

    }

    public function getAvatarUrlAttribute()
    {

        if ($this->avatar) {
            return asset('storage/avatars/' . $this->avatar);
        } else {
            return asset('dist/img/avatar5.png');
        }
    }

    public function getAvatarN($email)
    {
        $profile = Profile::where('primavera_email', $email)->first();
        if ($profile)
            return \Storage::url($profile->image_profile);
        return '/assets/media/149071.png';
    }

    public function avatar()
    {

        $profile = Profile::where('primavera_email', $this->ldap->getEmail())->first();
        if ($profile)
            return \Storage::url($profile->image_profile);
        return '/assets/media/149071.png';
    }


    public function isAN($attr): bool
    {
        if (auth()->user()->isSuperAdmin()) {
            return true;
        }


        $emails = auth()->user()->ldap->getEmail();
        $activity = array();
        if ($emails) {

            $grups = GroupsHasUsers::where('user_email', $emails)->distinct()->get('group_id');

            foreach ($grups as $g) {
                $activity = GroupsHasViews::where('name_views', 'LIKE', "{$attr['Title']}%")
                    ->where('group_id', $g->group_id)
                    ->first();

            }
            return (bool)$activity;

        }


        return false;

    }

}
