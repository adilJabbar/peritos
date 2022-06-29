<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function affecteds()
    {
        return $this->belongsToMany(Expedient::class, 'expedient_person')->withPivot(['type', 'amount', 'address_id', 'currency_id', 'notes', 'company', 'policy', 'case']);
    }

    public function contacts()
    {
        return $this->morphMany(Contact::class, 'contactable');
    }

    public function expedients()
    {
        return $this->morphMany(Expedient::class, 'billable');
    }

    public function setLegalIdAttribute($value)
    {
//        dd($value);
        $this->attributes['legal_id'] = preg_replace('/[^a-zA-Z0-9]/', '', strtoupper($value));
//        if($value) $this->attributes['legal_id'] = preg_replace("/[^a-zA-Z0-9]/", "", strtoupper($value));
    }

    public function saveAddress($address)
    {
        return $this->addresses()->updateOrCreate(
            ['id' => $address['id']],
            $address
        );
    }

    public function updateOrCreateAddress($address)
    {
        if ($address['id']) {
            $this->addresses->find($address['id'])->update($address);
        } else {
            $this->addresses()->create([
                'address' => $address['address'],
                'city' => $address['city'],
                'state' => $address['state'],
                'zip' => $address['zip'],
                'country_id' => $address['country_id'],
            ]);
        }
    }

    public function updateOrCreateContacts($contacts)
    {
        foreach ($contacts as $contact) {
            if ($contact['id'] ?? false) {
                $this->contacts->find($contact['id'])->update($contact);
            } else {
                $this->contacts()->create([
                    'type' => $contact['type'],
                    'value' => $contact['value'],
                ]);
            }
        }
    }

    public function saveContacts($contacts)
    {
        foreach ($contacts as $contact) {
            $this->contacts()->updateOrCreate(
                ['id' => $contact['id']], ['type' => $contact['type'], 'value' => $contact['value']]
            );
        }
    }
}
