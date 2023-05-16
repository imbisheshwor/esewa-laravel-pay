<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
require '../vendor/autoload.php';

use Cixware\Esewa\Client;
use Cixware\Esewa\Config;

class EsewaController extends Controller
{
    public function esewaPay(Request $request)
    {
        $pid = uniqid();
        $amount = $request->amount;

        Order::insert([
            'user_id' =>$request->user_id,
            'name' => $request->name,
            'email' => $request->email,
            'product_id' => $pid,
            'amount' => $request->amount,
            'esewa_status' => 'unvarified',
            'created_at' =>Carbon::now(),
            'updated_at' =>Carbon::now(),
        ]);


        $successUrl = url('/success');
        $failureUrl = url('/failure');

        // Config for development.
        $config = new Config($successUrl, $failureUrl);

        

        // Initialize eSewa client.
        $esewa = new Client($config);

        $esewa->process($pid, $amount, 0, 0, 0);

    }

    public function esewaPaySuccess()
    {
        $pid = $_GET['oid'];
        $refId = $_GET['refId'];
        $amount = $_GET['amt'];

        $order = Order::where('product_id',$pid)->first();
        $update_status = Order::find($order->id)->update([
            'esewa_status' => 'verified',
            'updated_at' =>Carbon::now(),
        ]);

        if($update_status){
            echo "success";
        }else{
            echo "internal database problem";
        }
    }
    public function esewaPayFailed()
    {
        $pid = $_GET['oid'];
        $refId = $_GET['refId'];
        $amount = $_GET['amt'];

        $order = Order::where('product_id',$pid)->first();
        $update_status = Order::find($order->id)->update([
            'esewa_status' => 'failed',
            'updated_at' =>Carbon::now(),
        ]);

        if($update_status){
            echo "failed";
        }else{
            echo "internal database problem";
        }
    }
}
