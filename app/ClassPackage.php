<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassPackage extends Model
{
    protected $table = "class_packages";

    protected $fillable = [
        'pack_id',
        'pack_name',
        'pack_description',
        'pack_type',
        'total_credit',
        'tag_name',
        'validity_month',
        'pack_price',
        'newbie_first_attend',
        'newbie_addition_credit',
        'newbie_note',
        'estimate_price'
    ];

    protected $casts = [
        'newbie_first_attend' => 'boolean'
    ];

    public function CheckPackage($value) {
        $package = ClassPackage::where('pack_id',$value)->first();
        return $package->id;
    }
}
