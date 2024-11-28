<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Course extends Model
{
 
    public $table = 'courses';

    protected $fillable = ['code', 'title', 'prerequisites', 'category', 'duration', 'level', 'enrollment_limit', 'course_fee', 'assessment_method', 'enrollment_status','created_by', 'updated_by','concession','start_time','end_time'];

	function admissions(){
		return $this->hasMany('App\Models\Admission','course_id','id');
	}

	public static function boot()
	{
		parent::boot();
		static::creating(function($model)
		{
			$user = Auth::user();
			$model->created_by = $user->id;
			$model->updated_by = $user->id;
		});
		static::updating(function($model)
		{
			$user = Auth::user();
			$model->updated_by = $user->id;
		});
	}
}