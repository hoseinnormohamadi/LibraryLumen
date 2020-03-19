<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Base\Book;
use App\Models\Base\Payment;
use App\Models\Base\UserBooks;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Kavenegar\KavenegarApi;


class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function Buy($id){
        $Book = Book::find($id);
        if ($Book->Status == 'unavailable' || empty($Book)){
            return response()->AloResponse(null, 'success', Lang::get('messages.BookUnavailable'));
        }
        $validate_payment = Payment::where([['user_id', Auth::user()->ID], ['Book_id', $Book->id]])->first();
        if ($validate_payment){
            return response()->AloResponse(null, 'success', Lang::get('messages.UHaveBook'));
        }
        $Payment = Payment::create([
            'user_id' => Auth::user()->ID,
            'Book_id' => $Book->id,
            'Amount' => $Book->BookPrice,
            'Book_Status' => 'Buy',
            'Payment_Status' => 'Cleared',
        ]);
        $UserBook = UserBooks::create([
            'BookID' => $Book->id,
            'UserID' => Auth::user()->ID,
            'Status' => 'Buy'
        ]);
        $sender = "1000596446";
        $receptor = "09301040145";
        $message = "کتاب " . $Book->BookName . " با موفقیت در تاریخ " . Carbon::now()->format('d-m-Y') . " خریداری شد.";
        $api = new KavenegarApi("415732667156325241534838715050416E3337695678476467514B4D4C7377332B683568306B702B542B593D");
        $api->Send($sender, $receptor, $message);

        return response()->AloResponse($Payment, 'success', Lang::get('messages.BuySuccess'));
    }
    public function Rent($id){
        $Book = Book::find($id);
        if ($Book->Status == 'unavailable' || empty($Book)){
            return response()->AloResponse(null, 'success', Lang::get('messages.BookUnavailable'));
        }
        $validate_payment = Payment::where([['user_id', Auth::user()->ID], ['Book_id', $Book->id]])->first();
        if ($validate_payment){
            return response()->AloResponse(null, 'success', Lang::get('messages.UHaveBook'));
        }
        $Payment = Payment::create([
            'user_id' => Auth::user()->ID,
            'Book_id' => $Book->id,
            'Amount' => $Book->BookRentPrice,
            'Book_Status' => 'Rent',
            'Payment_Status' => 'Cleared',
        ]);
        $UserBook = UserBooks::create([
            'BookID' => $Book->id,
            'UserID' => Auth::user()->ID,
            'Status' => 'Rent',
            'RentStatus' => 'InUse'
        ]);
        $sender = "1000596446";
        $receptor = "09301040145";
        $message = "کتاب " . $Book->BookName . " با موفقیت در تاریخ " . Carbon::now()->format('d-m-Y') . " خریداری شد.";
        $api = new KavenegarApi("415732667156325241534838715050416E3337695678476467514B4D4C7377332B683568306B702B542B593D");
        $api->Send($sender, $receptor, $message);

        return response()->AloResponse($Payment, 'success', Lang::get('messages.BuySuccess'));

    }
    public function UnRent($id){
        $Book = Book::find($id);
        if (empty($Book)){
            return response()->AloResponse(null, 'success', Lang::get('messages.BookUnavailable'));
        }
        $BookStatus = UserBooks::where([['UserID' , Auth::user()->ID],['BookID' , $Book->id]])->get();
        if ($BookStatus[0]->RentStatus == 'InUse'){
           $UserBook = UserBooks::find($BookStatus[0]->id);
           $UserBook->RentStatus = 'Finished';
           $UserBook->save();
        }
        return response()->AloResponse($BookStatus, 'success', Lang::get('messages.BookUnrented'));
    }



}