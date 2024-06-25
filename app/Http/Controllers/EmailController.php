<?php

namespace App\Http\Controllers;

use App\Models\Bilhete;
use app\Models\Recibo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\User;

class EmailController extends Controller
{
    public static function enviarRecibo(Recibo $recibo)
    {
        // SEND EMAIL WITH MAILABLE CLASS
        // Send to user:

        $user = User::findOrFail(Auth::user()->id);
        $bilhetes = Bilhete::where('recibo_id', $recibo->id)->get();
        
        /*Mail::to($user);*/
    }
}