<?php

 function Upload($file){
    $filename = md5($file->getClientOriginalName()) . '_' . time() . '.' . $file->getClientOriginalExtension();
    
    $file->storeAs('products', $filename, 'public'); // storage/app/public/products
    
    return $filename;
}

