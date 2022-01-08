<?php

namespace Modules\Ezinvite\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Ezinvite\Entities\Coupon;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request Request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|Response
     */
    public function index(Request $request)
    {
        $data = Coupon::query();

        if ($request->filled('search')) {
            $data->where('code', 'like', '%' . $request->code . '%');
        }

        $data = $data->paginate(10);

        return view('ezinvite::coupons.index', compact(
            'data'
        ));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('ezinvite::coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request Request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $attributes = $request->all([
            'code',
            'credit',
            'limit',
            'expiration_date'
        ]);

        $validator = Validator::make($attributes, [
            'code'            => 'required|min:6|max:255|unique:coupons,code',
            'credit'          => 'required|numeric|min:100',
            'limit'           => 'required|numeric|min:1',
            'expiration_date' => 'required|date|after_or_equal:now',
        ]);

        if ($validator->fails()) {
            return redirect()->route('coupons.create')
                ->with('error', $validator->errors()->first());
        }

        Coupon::query()
            ->create($attributes);

        return redirect()->route('coupons.create')
            ->with('success', __('Created coupons successfully'));

    }

    /**
     * Show the specified resource.
     *
     * @param Coupon $coupon Coupon
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|Response
     */
    public function show(Coupon $coupon)
    {
        return view('ezinvite::coupons.edit', compact('coupon'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Coupon  $coupon  Coupon
     * @param Request $request Request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Coupon $coupon, Request $request)
    {
        $attributes = $request->all([
            'code',
            'credit',
            'limit',
            'expiration_date'
        ]);

        $validator = Validator::make($attributes, [
            'code'            => 'required|min:6|max:255|unique:coupons,code, ' . $coupon->getKey(),
            'credit'          => 'required|numeric|min:100',
            'limit'           => 'required|numeric|min:1',
            'expiration_date' => 'required|date|after_or_equal:now',
        ]);

        if ($validator->fails()) {
            return redirect()->route('coupons.show', compact('coupon'))
                ->with('error', $validator->errors()->first());
        }

        $coupon->update($attributes);

        return redirect()->route('coupons.show', compact('coupon'))
            ->with('success', __('Updated coupons successfully'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Coupon $coupon Coupon
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return redirect()->route('coupons.index')
            ->with('success', __('Deleted coupons successfully'));
    }
}
