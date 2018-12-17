<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShiftTrade;
use App\Shift;
use App\User;
class AdminController extends Controller
{
	public function tradeList()
    {
		$shiftTrades = ShiftTrade::waitingApproval()->get();
		return view('admin.tradelist.approval', compact('shiftTrades'));
	}
	public function acceptTrade($shiftTradeId) {
		$shiftTrade = ShiftTrade::find($shiftTradeId);
		$shift = Shift::find($shiftTrade->shift_id);
		//Change the shift user_id to the new owner from shiftTrade
		$shift->user_id = $shiftTrade->new_owner_id;
		$shift->save();
		//Set the ShiftTrade to approved
		$shiftTrade->approved = 1;
		$shiftTrade->save();
		session()->flash('message', 'Du har nu accepteret byttet mellem ' . ' INDSÆT NANV'  . ' og ' . 'INDSÆT NAVN2');
		return redirect()->route('adminTradeList');
	}
	
	public function declineTrade($shiftTradeId) {
		$shiftTrade = ShiftTrade::find($shiftTradeId);
		$originalOwner = User::find($shiftTrade->original_owner_id);
		$newOwner = User::find($shiftTrade->new_owner_id);
		$shiftTrade->new_owner_id = null;
		$shiftTrade->save();
		session()->flash('message', 'Du har nu AFVIST byttet mellem ' . $originalOwner->name . ' og ' . $newOwner->name);
		return redirect()->back();
	}

}