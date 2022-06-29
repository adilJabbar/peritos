<?php

namespace App\Models;

use App\Models\Admin\Destiny;
use App\Models\Admin\Ramo;
use App\Models\Admin\Status;
use App\Models\Admin\Typecase;
use App\Models\Expedient\Anexo;
use App\Models\Expedient\Assessment;
use App\Models\Expedient\Attachment;
use App\Models\Expedient\Picture;
use App\Models\Expedient\TextAdjuster;
use App\Models\Expedient\TextPreexistence;
use App\Models\Insurance\Agent;
use App\Models\Insurance\Company\Area;
use App\Models\Insurance\Policy;
use App\Models\Insurance\Subguarantee;
use App\Models\Video\VideoSession;
use App\Traits\HasLocalDates;
use App\Traits\IsWorkTimeable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Expedient extends Model
{
    use HasFactory, HasLocalDates, IsWorkTimeable;

    protected $guarded = [];

    protected $casts = [
        'requested_at' => 'datetime',
        'happened_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    protected $appends = [
        'requested_at_for_editing',
        'happened_at_for_editing',
    ];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function affecteds()
    {
        return $this->belongsToMany(Person::class, 'expedient_person')->withPivot(['type', 'amount', 'address_id', 'currency_id', 'notes', 'company', 'policy', 'case']);
    }

    public function adjuster()
    {
        return $this->belongsTo(User::class, 'adjuster_id');
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function anexos()
    {
        return $this->hasMany(Anexo::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function billable()
    {
        return $this->morphTo();
    }

    public function collaborators()
    {
        return $this->belongsToMany(User::class, 'collaborator_expedient', 'expedient_id', 'collaborator_id');
    }

    public function contactAttempts()
    {
        return $this->hasMany(ContactAttempt::class);
    }

    public function createCode($gabinete_id)
    {
        return (self::where('gabinete_id', $gabinete_id)->OrderByDesc('code')->first()->code ?? 0) + 1;
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function currency()
    {
        return $this->address->country->currency;
    }

    public function documents()
    {
        return $this->hasMany(CreatedDocuments::class);
    }

    public function estimations()
    {
        return $this->hasMany(Estimation::class);
    }

    public function first_estimation()
    {
        return $this->estimations->where('origin', 'initial')->first();
    }

    public function gabinete()
    {
        return $this->belongsTo(Gabinete::class);
    }

    public function gabineteOrSubcontractorName()
    {
        $subcontractor = $this->gabinete->users->find($this->adjuster)->isSubcontractor($this->gabinete->id);

        return $subcontractor ? Subcontractor::find($subcontractor)->name : $this->gabinete->name;
    }

    public function getCountryAttribute()
    {
//        dd($this->billable_address_id);
        if ($this->address) {
            return $this->address->country;
        } elseif (class_basename($this->billable) === 'Company') {
            return $this->billable->country;
        } else {
            return Address::find($this->billable_address_id)->country;
        }
    }

    public function getExpiresAtForHumansAttribute()
    {
        return $this->expires_at->format(auth()->user()->date_for_humans_format);
    }

    public function getHappenedAtForEditingAttribute()
    {
        return $this->happened_at?->format('Y-m-d');
    }

    public function getHappenedAtForHumansAttribute()
    {
        return $this->happened_at->format(auth()->user()->date_for_humans_format);
    }

    public function getIconUrlAttribute()
    {
        return class_basename($this->billable) === 'Company'
            ? $this->billable->logo_url
            : asset('img/default_avatar.png');
    }

    public function getLimitColorAttribute()
    {
        if ($this->expires_at < now()) {
            return 'red';
        } elseif ($this->expires_at->subHours(24) < now()) {
            return 'yellow';
        } else {
            return 'green';
        }
    }

    public function getPriorityColorAttribute()
    {
        if ($this->priority === 'alta') {
            return 'red';
        } elseif ($this->priority === 'media') {
            return 'yellow';
        } else {
            return 'green';
        }
    }

    public function getRequestedAtForEditingAttribute()
    {
        return optional($this->localize('requested_at'))->format('Y-m-d\TH:i');
    }

    public function getRequestedAtForHumansAttribute()
    {
        return $this->localize('requested_at')->format(auth()->user()->date_for_humans_format);
    }

    public function getRequiresPreexistencesAttribute()
    {
        return $this->typecases()->pluck('preexistences')->sum();
    }

    public function getRequiresTasacionAttribute()
    {
        return $this->typecases()->pluck('tasacion')->sum();
    }

    public function guarantees()
    {
        return $this->policy->product->guarantees ?? $this->ramo->defaultProduct->guarantees;
    }

    public function logs()
    {
        return $this->morphMany(Log::class, 'loggable');
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }

    public function policy()
    {
        return $this->belongsTo(Policy::class);
    }
//
//    public function preexistence()
//    {
//        return $this->address->preexistenceable;
//    }

    public function ramo()
    {
        return $this->belongsTo(Ramo::class);
    }

    public function sent_documents()
    {
        return $this->documents()->where('sent_at', ! null)->get();
    }

    public function setCodeAttribute($value)
    {
        if ($value) {
            $this->attributes['code'] = $value;
//            $this->full_code = str_pad($this->gabinete->id, 3, '0', STR_PAD_LEFT)
            $this->attributes['full_code'] = strtoupper(substr($this->gabinete->name, 0, 3))
                .'·'.date('ym')
                .'·'.str_pad($this->code, 5, '0', STR_PAD_LEFT);
        }
    }

    public function setHappenedAtForEditingAttribute($value)
    {
        if ($value) {
            $this->happened_at = Carbon::createFromFormat('Y-m-d', $value);
        }
    }

    public function setRequestedAtForEditingAttribute($value)
    {
        if ($value) {
            $this->requested_at = Carbon::createFromFormat('Y-m-d\TH:i', $value, auth()->user()->timezone)->tz('UTC');
            $this->expires_at = $this->requested_at->addHours(6);
        }
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function subguarantees()
    {
        $subguarantees = $this->assessments->pluck('subguarantee_id')->unique();

        return Subguarantee::distinct()->whereIn('id', $subguarantees)->orderBy('guarantee_id')->get();
    }

    public function subguaranteesUsed($personId)
    {
        $subguarantees = $this->assessments->where('person_id', $personId)->pluck('subguarantee_id')->unique();

        return Subguarantee::distinct()->whereIn('id', $subguarantees)->orderBy('guarantee_id')->get();
    }

    public function tasacionCapital()
    {
        $capitals = $this->policy->capitals->whereIn('id', $this->assessments->pluck('capital_id')->unique());
        $subguarantees = $this->subguarantees();
        $people = Person::whereIn('id', $this->assessments->pluck('person_id')->unique())->get();
        $destinies = Destiny::whereIn('id', $this->assessments->pluck('destiny_id')->unique())->get();

        foreach ($capitals as $capital) {
            $capital->assessments = $this->assessments->where('capital_id', $capital->id);
            $capital->subguarantees = $subguarantees->whereIn('id', $capital->assessments->pluck('subguarantee_id')->unique());
            $capital->people = $people->whereIn('id', $capital->assessments->pluck('person_id')->unique());
        }

        return [
            'capitals' => $capitals,
            'subguarantees' => $subguarantees,
            'people' => $people,
            'destinies' => $destinies,
        ];
    }

    public function tasacionPerson()
    {
        $capitals = $this->policy->capitals->whereIn('id', $this->assessments->pluck('capital_id')->unique());
        $subguarantees = $this->subguarantees();
        $people = Person::whereIn('id', $this->assessments->pluck('person_id')->unique())->get();
        $destinies = Destiny::whereIn('id', $this->assessments->pluck('destiny_id')->unique())->get();

        foreach ($people as $person) {
            $person['assessments'] = $this->assessments->where('person_id', $person->id);
            $person['subguarantees'] = $subguarantees->whereIn('id', $person->assessments->pluck('subguarantee_id'))->unique();
            $person['capitals'] = $capitals->whereIn('id', $person->assessments->pluck('capital_id')->unique());
//            if($person->id != 1)dd($person);
//            foreach ($person->capitals as $capital){
//                $person->capitals->assessments = $person->assessments->where('capital_id', $capital->id);
////                $capital->subguarantees = $subguarantees->whereIn('id', $capital->assessments->pluck('subguarantee_id')->unique());
////                foreach($capital->subguarantees as $subguarantee){
////                    $subguarantee->assessments = $capital->assessments->where('subguarantee_id', $subguarantee->id);
////                }
//            }
        }

//        dd($people);
        return [
            'capitals' => $capitals,
            'subguarantees' => $subguarantees,
            'people' => $people,
            'destinies' => $destinies,
        ];
    }

    public function technicians()
    {
        return User::where('id', $this->adjuster_id)->orWhereIn('id', $this->collaborators->pluck('id'))->get();
    }

    public function textAdjuster()
    {
        return $this->hasOne(TextAdjuster::class);
    }

    public function textPreexistence()
    {
        return $this->hasOne(TextPreexistence::class);
    }

    public function totalByDestiny($destiny_id)
    {
        return $this->assessments->where('destiny_id', $destiny_id)->sum('total');
    }

    public function totalByDestinyAndPerson($destiny_id, $person_id)
    {
        return $this->assessments->where('destiny_id', $destiny_id)->where('person_id', $person_id)->sum('total');
    }

    public function totalByPerson($person_id)
    {
        return $this->assessments->where('person_id', $person_id)->sum('total');
    }

    public function totalBySubguaranteeAndPerson($subguarantee_id, $person_id)
    {
        return $this->assessments->where('person_id', $person_id)->where('subguarantee_id', $subguarantee_id)->sum('total');
    }

    public function totalRealByPerson($person_id)
    {
        return $this->assessments->where('person_id', $person_id)->sum('total_real');
    }

    public function totalProposedAffecteds()
    {
        return $this->assessments->where('person_id', '!=', $this->person_id)->sum('total_proposed');
    }

    public function totalProposedByDestiny($destiny_id)
    {
        return $this->assessments->where('destiny_id', $destiny_id)->sum('total_proposed');
    }

    public function totalProposedByDestinyAndPerson($destiny_id, $person_id)
    {
        return $this->assessments->where('destiny_id', $destiny_id)->where('person_id', $person_id)->sum('total_proposed');
    }

    public function totalProposedByCapital($capital_id)
    {
        return $this->assessments->where('capital_id', $capital_id)->sum('total_proposed');
    }

    public function totalProposedByPerson($person_id)
    {
        return $this->assessments->where('person_id', $person_id)->sum('total_proposed');
    }

    public function totalProposedCovered()
    {
        return $this->assessments->whereIn('destiny_id', [1, 2])->sum('total_proposed');
    }

    public function totalProposedExcluded()
    {
        return $this->assessments->whereNotIn('destiny_id', [1, 2])->sum('total');
    }

    public function typecases()
    {
        return $this->belongsToMany(Typecase::class);
    }

    public function updateStatus($from, $to)
    {
        $this->logs()->create([
            'user_id' => auth()->user()->id,
            'name' => 'status',
            'from' => $from,
            'to' => $to,
        ]);
    }

    public function videoSessions()
    {
        return $this->morphMany(VideoSession::class, 'videoable');
    }

    public function visits()
    {
        return $this->hasMany(VisitAppointment::class);
    }

    public function workTimes()
    {
        return $this->morphMany(WorkTime::class, 'timeable');
    }
}
