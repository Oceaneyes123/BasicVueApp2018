<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountModel extends Model
{
  public $fillable = ['user_id', 'first_name', 'last_name', 'birth_date', 'province', 'city'];
  protected $table = 'information';
}
