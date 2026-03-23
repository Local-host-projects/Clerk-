<?php
use App\Models\Deck;

 function Upload($file){
    $filename = md5($file->getClientOriginalName()).'_' .time().'.'.$file->getClientOriginalExtention();
    $file->storeAs($filename,'public/filess');
    return $filename;
 }

function generateUniqueDeckCode(): string
{
    do {
        // Generate a random 8-digit number
        $code = mt_rand(10000000, 99999999);
    } while (Deck::where('code', $code)->exists()); // keep generating until it's unique

    return (string) $code;
}