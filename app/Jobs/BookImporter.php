<?php
namespace App\Jobs;

use App\Models\Base\Book;
use Illuminate\Support\Facades\Validator;class BookImporter extends Job
{
    public $BookData;
	public function __construct($UserID,$BookName,$BookPrice,$BookRentPrice)
	{
	    $this->BookData['UserID'] = $UserID;
	    $this->BookData['BookName'] = $BookName;
	    $this->BookData['BookPrice'] = $BookPrice;
	    $this->BookData['BookRentPrice'] = $BookRentPrice;
	}

	public function handle()
	{
	    $this->AddBook($this->BookData);
	}
	public function AddBook($BookData){

        Book::create([
            'BookName' => $BookData['BookName'],
            'BookPrice' => $BookData['BookPrice'],
            'BookRentPrice' => $BookData['BookRentPrice'],
            'user_id' => $BookData['UserID'],
        ]);
    }
}