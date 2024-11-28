<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Admission extends Model
{
 
    public $table = 'admission';

    protected $fillable = ['name', 'type', 'dob', 'gender', 'mobile_no', 'address_line1', 'address_line2', 'city', 'state', 'father_name', 'father_no', 'father_occupation', 'relation_type', 'pincode', 'mother_name', 'mother_no', 'mother_occupation', 'mother_email', 'guardian_name', 'guardian_no', 'guardian_occupation', 'guardian_email', 'refereed_by', 'admission_date', 'course_id', 'father_email', 'blood_group','student_photo','documents','health_issues','health_remarks','remarks','document_type','enquiry_no','total_fee'];

	function course(){
		return $this->belongsTo('App\Models\Course', 'course_id', 'id');
	}

	function fees(){
		return $this->hasMany('App\Models\Fees','admission_id','id');
	}

	function concessions(){
		if($this->course->concession == 'Yes')
		{
			if($this->fees()->sum('concession_amt') > 0){
				return "Apply Concession";
			}
			return "Not Apply Concession";
		}
		return "No Concession";
	}
	

	function remaining_fees(){
		$course = $this->course()->first();
		$remaining_fees = $course->course_fee - $this->fees()->sum('amount') - $this->fees()->sum('concession_amt');
		return $remaining_fees;
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