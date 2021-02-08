<?php

namespace App\Http\Controllers;
use App\AppModel;

use Illuminate\Http\Request;

class AppController extends Controller
{
  public function registerAccount(Request $request){
    $username = $request->username;
    $password = $request->password;
    $newdata = new AppModel;
    $newdata->username = $username;
    //$newdata->password = bcrypt($password);
    $newdata->password = $password;
    $newdata->save();
    return response()->json($newdata);
  }

  public function getList(Request $request){
      $allData = AppModel::all();
      return response()->json(['list' => $allData]);
    }
}
