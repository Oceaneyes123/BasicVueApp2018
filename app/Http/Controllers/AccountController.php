<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AccountModel;

class AccountController extends Controller
{
  public function checkList(Request $request){
      $allData = AccountModel::all();
      return response()->json(['information' => $allData]);
    }

  public function addAccount(Request $request){
    $user_id = $request->user_id;
    $first_name = $request->first_name;
    $last_name = $request->last_name;
    $birth_date = $request->birth_date;
    $province = $request->province;
    $city = $request->city;
    $newdata = new AccountModel;
    $newdata->user_id = $user_id;
    $newdata->first_name = $first_name;
    $newdata->last_name = $last_name;
    $newdata->birth_date = $birth_date;
    $newdata->province = $province;
    $newdata->city = $city;
    $newdata->save();
    return response()->json($newdata);
  }

  public function displayData(Request $request){
    $user_id = $request->user_id;
    $allData = AccountModel::select()->where('user_id', $user_id)->get();
    return response()->json(['info' => $allData]);
  }

  public function updateData(Request $request){
      $user_id = $request->user_id;
      $first_name = $request->first_name;
      $last_name = $request->last_name;
      $birth_date = $request->birth_date;
      $province = $request->province;
      $city = $request->city;
      $newData = AccountModel::find(6);
      $newData->user_id = $user_id;
      $newData->first_name = $first_name;
      $newData->last_name = $last_name;
      $newData->birth_date = $birth_date;
      $newData->province = $province;
      $newData->city = $city;
      $newData->save();
      return response()->json($newData);
  }
}
