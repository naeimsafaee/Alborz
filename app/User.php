<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Crypt;
use Laravel\Passport\HasApiTokens;

class User extends \TCG\Voyager\Models\User
{
    use HasApiTokens, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = array(
        'is_banned' => '',
        'hasproduct' => '',
        'productimeleft' => '',
    );
    public function scopeAdminLevel($query)
    {
        if (auth()->user()->role->type == 1) {
            return $query->whereHas('role', function (Builder $query) {$query->where('type', '=', 1)->orwhere('type', '=', 2);});
        } else {
            return $query;
        }

    }
    public function getIsBannedAttribute()
    {
        return $this->banned()->exists();
    }
    public function getHasproductAttribute()
    {
        return $this->hasMany('App\Models\UserProduct')->where('status', 'active')->whereDate('finish_date', '>=', Carbon::now())->exists();
    }
    public function getProductimeleftAttribute()
    {$timeleft = 0;
        foreach ($this->hasMany('App\Models\UserProduct')->where('status', 'active')->whereDate('finish_date', '>=', Carbon::now())->get() as $key => $userproduct) {
            $timeleft += $userproduct->timeleft ? $userproduct->timeleft : 0;
        }
        return ($timeleft >= 0) ? $timeleft : false;
    }
    public function banned()
    {
        return $this->hasOne('App\Models\Banneduser');
    }
    public function bannedby()
    {
        return $this->hasOne('App\Models\Banneduser', 'byuser_id');
    }
    public function messagetemplate()
    {
        return $this->hasMany('App\Models\Messagetemplate');
    }
    public function notes()
    {
        return $this->hasMany('App\Models\Note')->orWhere('forall', true)->orderby('created_at', 'desc');
    }
    public function note()
    {
        return $this->hasMany('App\Models\Note');
    }
    public function personalizemenu()
    {
        return $this->hasOne('App\Models\Personalizemenu');
    }
    public function support()
    {
        return $this->hasOne('App\Models\Support');
    }

    public function transaction()
    {
        return $this->hasMany('App\Models\Transaction');
    }

    public function userproduct()
    {
        return $this->hasMany('App\Models\UserProduct');
    }

    public function unreadsupport()
    {
        return $this->belongsToMany('App\Models\Support', 'user_unread_support_rel');
    }
    public function supportmessage()
    {
        return $this->belongsToMany('App\Models\Support', 'user_support_rel');
    }

    public function getPhoneAttribute($value)
    {
        try {
            return Crypt::decrypt($value, false);
        } catch (DecryptException $e) {
            return $value;
        }
    }

    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = Crypt::encrypt($value, false);
        if (preg_match('/^[0-9]{2}([0-9]{1})[0-9]{2}([0-9]{2})[0-9]{2}([0-9]{2})$/', $value, $phone_serial)) {
            $this->attributes['phone_serial'] = $phone_serial[3] . $phone_serial[1] . $phone_serial[2];
        }
    }
}
