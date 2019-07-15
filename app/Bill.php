<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    use SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at','date'];

    public function customer(){
    	return $this->belongsTo(Customer::class, 'customer_id')->withTrashed();
    }

    public function employee(){
        return $this->belongsTo(Employee::class, 'employee_id')->withTrashed();
    }

    public function service(){
    	return $this->belongsTo(Service::class, 'service_id')->withTrashed();
    }
}
