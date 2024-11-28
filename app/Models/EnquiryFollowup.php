<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class EnquiryFollowup extends Model
{
 
    public $table = 'enquiry_followup';

    protected $fillable = ['enquiry_id', 'status', 'followup_date', 'remarks', 'follow_date', 'follow_time'];

	


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