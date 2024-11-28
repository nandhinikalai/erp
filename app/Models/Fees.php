<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Fees extends Model
{
 
    public $table = 'fees_collection';

    protected $fillable = ['admission_id', 'payment_date', 'title', 'amount', 'payment_method', 'remarks','bank_name', 'acc_no', 'ifsc_code', 'transaction_id', 'upi_id','concession_amt','concession_type','concession_per'];


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