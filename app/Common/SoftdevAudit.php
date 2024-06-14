<?php
namespace App\Common;

use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;
use App\Common\Utils;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Common\Datetime\TimeDate;
use Log;

class SoftdevAudit extends Model implements Auditable
{
    use AuditableTrait;

    public function getAuditDatas($table_name,$where,$limit=5)
    {
        return DB::table($table_name)->where($where)->where('new_values','!=','[]')->orderByDesc('id')->limit($limit)->get()->toArray();
    }
    
    public static function SoftdevUP($table_name)
    {
        //$global_settings = Cache::get('global_settings'.);
        if (!Schema::hasTable($table_name)) {
            Schema::create($table_name, function (Blueprint $table) {
                $morphPrefix = config('audit.user.morph_prefix', 'user');
                $table->bigIncrements('id');
                $table->string($morphPrefix . '_type')->nullable();
                $table->string($morphPrefix . '_id', 36)->nullable();
                $table->string('event');
                $table->string('auditable_id', 36)->nullable();
                $table->string('auditable_type', 36);
                //$table->morphs('auditable');
                $table->text('old_values')->nullable();
                $table->text('new_values')->nullable();
                $table->text('url')->nullable();
                $table->ipAddress('ip_address')->nullable();
                $table->string('user_agent', 1023)->nullable();
                $table->string('tags')->nullable();
                $table->timestamps();

            //$table->index([$morphPrefix . '_type']);
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('audits');
    }

    public static function boot()
    {
        parent::boot();
        
        self::creating(function ($model) {
            $datetime = new TimeDate();
            $tableName = $model->getTable();
            if (Schema::hasColumn($tableName, 'id')) {
                $model->id = Utils::create_guid();
            }
            if (Schema::hasColumn($tableName, 'date_entered')) {
                $model->date_entered = $datetime->get_gmt_db_datetime();
            }
            if (Schema::hasColumn($tableName, 'date_modified')) {
                $model->date_modified = $datetime->get_gmt_db_datetime();
            }

            $userId = Auth::id();

            if (Schema::hasColumn($tableName, 'modified_user_id')) {
                $model->modified_user_id = $userId??0;
            }
            if (Schema::hasColumn($tableName, 'created_by')) {
                $model->created_by = $userId??0;
            }
            if (Schema::hasColumn($tableName, 'branch_id')) {
                if (empty($model->branch_id)) {
                    $model->branch_id = Auth::User()->branch_id;
                }
            }
            if (Schema::hasColumn($tableName, 'assigned_user_id')) {
                if (empty($model->assigned_user_id)) {
                    $model->assigned_user_id = $userId??0;
                }
            }
            self::setAuditTable($model);
        });
        self::updating(function ($model) {
            $tableName = $model->getTable();
            $datetime = new TimeDate();
            if (Schema::hasColumn($tableName, 'modified_user_id')) {
               $user = Auth::User();
                if($user !=''){
                    $model->modified_user_id = $user->id;
                    
                }else{
                    //$model->modified_user_id = NULL;
                }
                if (Schema::hasColumn($tableName, 'date_modified')) {
                    $model->date_modified = $datetime->get_gmt_db_datetime();
                }
            }
            self::setAuditTable($model);
        });
        self::deleting(function ($model) {
            self::setAuditTable($model);
        });

        if (in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses(get_called_class()))) {
            self::restoring(function ($model) {
                self::setAuditTable($model);
            });
        }
    }


    public function audits(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        self::setAuditTable($this);
        return $this->morphMany(
            Config::get('audit.implementation', \OwenIt\Auditing\Models\Audit::class),
            'auditable'
        );
    }

    public function hasIndividualAudit(): bool
    {
        return $this->individualAudit ?? false;
    }

    public static function setAuditTable($model = null)
    {
        if (is_null($model)) {
            $name = get_called_class();
            $model = new $name();
        }

        $audit_table = 'audits';

        if ($model->hasIndividualAudit('audits_' . $model->getTable())) {
            self::SoftdevUP('audits_' . $model->getTable()); // create original table
            $files = glob(app_path('Models/*.php'));
            \Illuminate\Support\Collection::make($files)->map(function ($path) {
                try {
                    $class = '\\App\Models\\' . pathinfo($path, PATHINFO_FILENAME);
                    $model = new $class();
                    if (!$model->hasIndividualAudit()) {
                        return null;
                    }
                    config(['audit.drivers.database.table' => 'audits_' . $model->getTable()]);
                // self::SoftdevUP(); // create individual table
                }
                catch (\Throwable $e) {
                }
                return null;
            });
            $audit_table .= '_' . $model->getTable();
        }

        config(['audit.drivers.database.table' => $audit_table]);
    }
}
