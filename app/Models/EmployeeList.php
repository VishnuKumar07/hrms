<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeList extends Model
{
    protected $table = 'employee_list';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }

    public function personalDetails()
    {
        return $this->hasOne(PersonalDetails::class, 'user_id', 'user_id');
    }

}
