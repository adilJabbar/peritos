<?php

namespace App\Models;

use App\Events\NewGabineteCreated;
use App\Models\Admin\Country;
use App\Models\Insurance\Agent;
use App\Models\Insurance\Company;
use App\Models\Sales\Contract;
use App\Traits\HasAddress;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class Gabinete extends Model
{
    use HasFactory, HasAddress;

    protected $guarded = [];

    protected $casts = [
        'token_expires' => 'datetime',
    ];

    public function activeAgents()
    {
        return $this->agents->where('is_active', true);
    }

    public function advance()
    {
        return $this->hasOne(Documentversion::class, 'id', 'advance_id');
    }

    public function agents()
    {
        return $this->belongsToMany(Agent::class);
    }

    public function backoffice($company)
    {
        return User::find($this->companies->find($company->id)->pivot->default_backoffice_user);
    }

    public function subscriptions()
    {
        return $this->hasMany(Contract::class, 'gabinete_id', 'id');
    }

    public function currentSubscription()
    {
        return $this->subscriptions
            ->where('renewal_time', '<', Carbon::now())
            ->where('expiration_time', '>', Carbon::now())
            ->first();
    }

    public function backoffices()
    {
        return User::whereRelation('gabinetes', 'gabinetes.id', $this->id)->whereRelation('roles', 'name', 'Administrative')->get();
    }

    public function checkLegalIdExists($legal_id)
    {
        $people = Person::where('legal_id', $legal_id)->get();
        $gabinete = $this;

        return $people->filter(function ($person) use ($gabinete) {
            return ($person->expedients->where('gabinete_id', $gabinete->id)->count() > 0) || $gabinete->expedients->where('person_id', $person->id)->count() > 0;
        })->first();
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class)->withPivot(['default_assign_user', 'default_backoffice_user']);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function defaultUser($company)
    {
        return User::find($this->companies->find($company->id)->pivot->default_assign_user);
    }

    public function employees()
    {
        return $this->users()->wherePivot('subcontractor_id', 0)->get();
    }

    public function expedients()
    {
        return $this->hasMany(Expedient::class);
    }

    public function externals($subcontractor = null)
    {
        if (! $subcontractor) {
            return $this->users()->role('Technician')->wherePivot('subcontractor_id', '!=', 0)->with('subcontractors')->get();
        } else {
            return $this->users()->role('Technician')->wherePivot('subcontractor_id', $subcontractor)->with('subcontractors')->get();
        }
    }

    public function createAdministratorUserToken()
    {
        return $this->update([
            'create_main_user_token' => bin2hex(random_bytes(40)),
            'token_expires' => Carbon::now()->addMinute(30),
        ])
            && event(new NewGabineteCreated($this));
    }

    public function getActiveUsersAttribute()
    {
        return $this->users->where('is_active', true);
    }

//    protected function defaultLogoUrl()
//    {
//        return $this->logo
//            ? Storage::disk('logos')->url($this->logo)
//            : 'https://ui-avatars.com/api/?name='.urlencode($this->name).'&color=7F9CF5&background=EBF4FF';
//    }

    public function getLogoUrlAttribute()
    {
        return $this->logo
            ? Storage::disk('logos')->url($this->logo)
            : 'https://ui-avatars.com/api/?name='.urlencode($this->name).'&color=7F9CF5&background=EBF4FF';
    }

    public function getLogoHorizUrlAttribute()
    {
        return $this->logo_horiz
            ? Storage::disk('logos')->url($this->logo_horiz)
            : $this->logo_url;
    }

    public function getLogoIconUrlAttribute()
    {
        return $this->logo_icon
            ? Storage::disk('logos')->url($this->logo_icon)
            : $this->logo_url;
    }

    public function getColorPrimaryAttribute()
    {
        return $this->primary_color
            ? $this->primary_color
            : '#9c411a';
    }

    public function getColorPrimaryTextAttribute()
    {
        return $this->primary_color_text
            ? $this->primary_color_text
            : '#fff';
    }

    public function getColorSecondaryAttribute()
    {
        return $this->secondary_color
            ? $this->secondary_color
            : '#38C172';
    }

    public function getColorSecondaryTextAttribute()
    {
        return $this->secondary_color_text
            ? $this->secondary_color_text
            : '#000';
    }

    public function subcontractorExpedients($subcontractor)
    {
        return $this->subcontractorExpedientsQuery($subcontractor)->get();
    }

    public function subcontractorExpedientsQuery($subcontractor)
    {
        $users = $this->externals($subcontractor);

        return $this->expedients()->whereIn('adjuster_id', $users->pluck('id')->toArray());
    }

    public function subcontractors()
    {
        return $this->hasMany(Subcontractor::class);
    }

    public function supervisors()
    {
//        Returns all the users with a role of technician or higher
        $technicianValue = Role::where('name', 'Technician')->first()->level;

        return User::whereRelation('gabinetes', 'gabinetes.id', $this->id)->whereRelation('roles', 'level', '>=', $technicianValue)->get();
    }

    public function techniciansExternalsForZip($countryId, $zip)
    {
        $techniciansArray = $this->zipCoverages()->where('country_id', $countryId)->where('from', '<=', $zip)->where('to', '>=', $zip)->pluck('user_id')->toArray();

        return $this->users()
            ->whereIn('users.id', $techniciansArray)
            ->wherePivot('subcontractor_id', '!=', 0)
            ->with('subcontractors')
            ->get();
    }

    public function techniciansForZip($countryId, $zip)
    {
        $techniciansArray = $this->zipCoverages()->where('country_id', $countryId)->where('from', '<=', $zip)->where('to', '>=', $zip)->pluck('user_id')->toArray();

        return $this->users()->whereIn('users.id', $techniciansArray)->wherePivot('subcontractor_id', 0)->get();
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->with('roles')->withPivot('backoffice_id', 'supervisor_id', 'supervised_advances', 'supervised_reports', 'supervised_incidences', 'contact_to_company', 'subcontractor_id');
    }

    public function zipCoverages()
    {
        return $this->hasMany(ZipCoverage::class);
    }
}
