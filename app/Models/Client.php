<?php

namespace App\Models;

use App\Channels\FcmChannel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;


class Client extends Authenticatable{
    use HasApiTokens, Notifiable;


    protected $guarded = ['id'];

    public function wallet(){
        return $this->hasOne('App\Models\Wallet');
    }

    public function walletTransactions(){
        return $this->hasMany('App\Models\WalletTransaction')->join('transactions', 'transactions.id', '=', 'wallet_transactions.transaction_id')->orderBy('transactions.transaction_date', 'DESC')->select('wallet_transactions.*');
    }

    public function products(){
        return $this->hasManyThrough(Product::class, ClientProduct::class, 'client_id', 'id', 'id', 'product_id');
    }

    public function exams(){
        return $this->hasManyThrough(Exam::class, ClientExam::class, 'client_id', 'id', 'id', 'exam_id')->orderByDesc('created_at');
    }

    public function voices(){
        return $this->hasMany(Voice::class);
    }

}
