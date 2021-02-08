<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppModel extends Model
{
  public $fillable = ['username', 'password'];
  protected $table = 'account';
  //protected $hidden = ['password'];
}
