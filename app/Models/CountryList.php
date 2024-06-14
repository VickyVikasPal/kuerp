<?php

namespace App\Models;

//use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Common\SoftdevModel;

class CountryList extends SoftdevModel
{
    public static $auditingDisabled = false; // if true then audit will be disabled
    public $individualAudit = true; // if true then audit data will be inserted this particlur model table
    protected $auditInclude = [
        'name',
        'isd_code'
    ];

    use HasFactory, HasApiTokens, Notifiable;
    public $table = "countrylists";

    protected $primaryKey = 'id'; // or null
    const CREATED_AT = 'date_entered';
    const UPDATED_AT = 'date_modified'; // or null

    public $incrementing = false;

}
