<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\Requests\LoginRules;
use App\Http\Requests\PaymentsRules;
use App\Http\Requests\RegisterRules;
use App\Models\Payments;
use App\Models\User;
use Carbon\Carbon;
use PDOException;
use Srmklive\PayPal\Services\ExpressCheckout;
use Srmklive\PayPal\Services\AdaptivePayments;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('authed');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login_page');
    }

    public function dashboard()
    {

        $total_donation = Payments::where('status', 'success')->sum('amount');
        $total_amount = number_format($total_donation, 2, '.', ',');
        $remaining_amount = number_format(((1000000 - $total_donation) / 1000000) * 100);
        $backer = Payments::Select('user_id')->where('status', 'success')->distinct()->get()->count('user_id');

        return view('dashboard', compact('total_amount', 'backer', 'remaining_amount'));
    }

    public function payment(PaymentsRules $request)
    {
        DB::BeginTransaction();

        try {
            $new_payment = new Payments();
            $donation_information = [

                'user_id' => auth::user()->id,
                'amount' => $request->amount
            ];
            $new_payment = $new_payment->create_table($donation_information);

            $username = auth::user()->username;
            $data = [];

            $data['items'] = [
                [
                    'name' => 'Donation of ', $request->amount,
                    'price' => $request->amount,
                    'desc' => $username, ' Donated an amount of ', $request->amount,
                    'qty' => 1
                ]
            ];

            $data['invoice_id'] = $new_payment->id;

            $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";

            $data['return_url'] = route('payment.success');

            $data['cancel_url'] = route('payment.cancel');

            $data['total'] = $request->amount;

            $provider = new ExpressCheckout;

            $response = $provider->setExpressCheckout($data);
            DB::commit();
            return redirect($response['paypal_link']);
        } catch (PDOException $e) {
            DB::rollback();
            abort(500);
        }
    }

    public function cancel(Request $request)
    {
        DB::beginTransaction();
        try {
            $provider = new ExpressCheckout;
            $response1 = $provider->getExpressCheckoutDetails($request->token);

            $donation_information = [
                'id' => $response1['INVNUM'],
                'status' => 'failed',
            ];

            $update_payment = new Payments();
            $update_payment->update_table($donation_information);
            DB::commit();
            return redirect()->route('dashboard')->with('failed', 'Payment failed');
        } catch (PDOException $e) {
            DB::rollBack();
            abort(500);
        }
    }

    public function success(Request $request)
    {
        DB::beginTransaction();
        try {
            $provider = new ExpressCheckout;
            $response1 = $provider->getExpressCheckoutDetails($request->token);

            $donation_information = [
                'id' => $response1['INVNUM'],
                'status' => 'success',
            ];

            $update_payment = new Payments();
            $update_payment->update_table($donation_information);
            DB::commit();
            return redirect()->route('dashboard')->with('success', 'Payment successful');
        } catch (PDOException $e) {
            DB::rollBack();
            abort(500);
        }
    }
}
