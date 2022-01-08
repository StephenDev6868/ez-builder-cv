<?php

namespace Modules\Ezinvite\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Modules\Ezinvite\Entities\Coupon;
use Modules\Ezinvite\Entities\HistoryCredit;
use Modules\User\Entities\User;

class EzinviteController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $linkInvite = optional(Auth::user())->link_invite;
        return view('ezinvite::index', compact('linkInvite'));
    }

    /**
     * Get credit from coupon
     *
     * @param Request $request Request
     *
     * @return mixed
    */
    public function getCredit(Request $request)
    {
        $attributes = $request->only([
            'code'
        ]);

        $validator = Validator::make($attributes, [
            'code' => 'required|string|exists:coupons,code'
        ]);

        if ($validator->fails()) {
            return redirect()->route('invite-coupon')
                ->with(['error' => $validator->errors()->first()]);
        }

        $coupon = Coupon::query()
            ->where('code', $attributes['code'])
            ->first();

        if (! $coupon) {
            return redirect()->route('invite-coupon')
                ->with(['error' => __('Coupon have been deleted or not exits')]);
        }

        if (Carbon::parse($coupon->expiration_date)->lessThanOrEqualTo(now())) {
            return redirect()->route('invite-coupon')
                ->with(['error' => __('This coupon expired')]);
        }

        if ($coupon->useage >=  $coupon->limit) {
            return redirect()->route('invite-coupon')
                ->with(['error' => __('This coupon end of use')]);
        }

        // Get info user need update add credit
        $user = User::query()
            ->where('id', Auth::user()->id)
            ->first();
        (int) $user->credit += (int) $coupon->credit;
        $user->save();

        // Increment useage coupon
        (int) $coupon->useage += 1;
        $coupon->save();

        // Make history credit
        HistoryCredit::query()
            ->create([
                'user_id' =>  $user->getKey(),
                'amount'  =>  $coupon->credit,
                'type'    =>  2,
                'done_at' =>  now(),
            ]);

        return redirect()->route('invite-coupon')
            ->with(['success' => "You have been add {$coupon->credit} credit successfully"]);
    }
}
