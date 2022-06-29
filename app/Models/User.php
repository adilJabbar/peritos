<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasRoles;
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'last_name',
        'username',
        'email',
        'password',
        'language',
        'country_id',
        'is_active',
        'timezone',
        'signature',
        'backoffice_id',
        'supervisor_id',
        'supervised_advances',
        'supervised_reports',
        'supervised_incidences',
        'contact_to_company',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'full_name',
        'profile_photo_url',
        'date_for_humans_format',
    ];

    public function allowedToGabinete($gabinete_id)
    {
        return $this->can('administration') || $this->isStaffOfGabinete($gabinete_id);
    }

    public function allowedToExpedient($expedient)
    {
        return $this->can('administration') || $this->isStaffOfGabinete($expedient->gabinete->id);
    }

    public function backoffice($gabinete)
    {
        return self::find($this->gabinetes->find($gabinete->id)->pivot->backoffice_id);
    }

    public function backoffices()
    {
//        $testing =  User::whereHas('gabinetes', function($query){
//            $query->whereIn('gabinete_id', $this->gabinetes->pluck('id'));
//        })->get();
//        dd($testing);
        return self::whereHas('gabinetes', function ($query) {
            $query->whereIn('gabinete_id', $this->gabinetes->pluck('id'));
        })->get();
    }

    public function collaborationExpedients()
    {
        return $this->belongsToMany(Expedient::class, 'collaborator_expedient', 'collaborator_id', 'expedient_id');
    }

    public function contactToCompany($gabinete)
    {
        return $this->gabinetes->find($gabinete->id)->pivot->contact_to_company;
    }

    public function documents()
    {
        return $this->hasMany(CreatedDocuments::class, 'created_by');
    }

    public function expedients()
    {
        return $this->hasMany(Expedient::class, 'adjuster_id');
    }

    public function favoriteGabinete()
    {
        return $this->gabinetes()->wherePivot('favorite', 1)->first();
    }

    public function gabinetes()
    {
        return $this->belongsToMany(Gabinete::class)->withPivot('favorite', 'backoffice_id', 'supervisor_id', 'supervised_advances', 'supervised_reports', 'supervised_incidences', 'contact_to_company', 'subcontractor_id');
    }

    public function gabinetesExpedients()
    {
        return $this->gabinetesExpedientsQuery()->get();
    }

    public function gabinetesExpedientsQuery()
    {
        $expedients = $this->newCollection();
        foreach ($this->gabinetes as $gabinete) {
            if ($subcontractor = $this->isSubcontractor($gabinete->id)) {
                foreach ($gabinete->subcontractorExpedients($subcontractor) as $expedient) {
//                if($subcontractor == 3) dd($expedient);
                    $expedients->push($expedient);
                }
            } else {
                foreach ($gabinete->expedients as $expedient) {
                    $expedients->push($expedient);
                }
            }
        }

        return Expedient::whereIn('id', $expedients->pluck('id'));
    }

    public function isStaffOfGabinete($gabinete_id)
    {
        return $this->gabinetes->firstWhere('id', $gabinete_id);
    }

    public function isSubcontractor($gabineteId)
    {
        return $this->gabinetes->find($gabineteId)->pivot->subcontractor_id;
    }

    public function myGabinetes()
    {
        return $this->can('administration')
            ? Gabinete::all()
            : $this->gabinetes;
    }

    public function getDateForHumansFormatAttribute()
    {
        return $this->language == 'es'
            ? 'd M Y'
            : 'M, d Y';
    }

    public function getFullDateForHumansFormatAttribute()
    {
        return $this->language == 'es'
            ? 'd M Y H:i'
            : 'M, d Y H:i A';
    }

    public function getFullNameAttribute()
    {
        return $this->name.($this->last_name ? ' '.$this->last_name : '');
    }

    public function getMainGabineteAttribute()
    {
        return $this->gabinetes()->wherePivot('favorite', true)->first();
    }

    public function getMaxRoleAttribute()
    {
        $maxRole = 0;
        foreach ($this->roles as $role) {
            if ($role->level > $maxRole) {
                $maxRole = $role->level;
            }
        }

        return $maxRole;
    }

    public function getStatusColorAttribute()
    {
        return [
            '0' => 'red',
            '1' => 'green',
        ][$this->is_active] ?? 'gray';
    }

    public function getStatusTextAttribute()
    {
        return [
            '0' => __('Inactivo'),
            '1' => __('Activo'),
        ][$this->is_active] ?? __('Desconocido');
    }

    public function getBirthdayForEditingAttribute()
    {
        return $this->birthday?->format('Y-m-d');
    }

    public function setBirthdayForEditingAttribute($value)
    {
        if ($value) {
            $this->birthday = Carbon::parse($value);
        }
    }

    public function subcontractors()
    {
        return $this->belongsToMany(Subcontractor::class, 'gabinete_user', 'user_id', 'subcontractor_id');
    }

    public function supervisedAdvances($gabinete)
    {
        return $this->gabinetes->find($gabinete->id)->pivot->supervised_advances;
    }

    public function supervisedIncidences($gabinete)
    {
        return $this->gabinetes->find($gabinete->id)->pivot->supervised_incidences;
    }

    public function supervisedReports($gabinete)
    {
        return $this->gabinetes->find($gabinete->id)->pivot->supervised_reports;
    }

    public function supervisor($gabinete)
    {
        return self::find($this->gabinetes->find($gabinete->id)->pivot->supervisor_id);
    }

    public function visits()
    {
        return $this->hasMany(VisitAppointment::class, 'technician_id');
    }

    public function zipCoverages()
    {
        return $this->hasMany(ZipCoverage::class);
    }
}
