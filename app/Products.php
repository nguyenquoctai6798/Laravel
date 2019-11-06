<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    public static function getAllProduct(){
        $listProduct = Products::all();
        return $listProduct;
    }

    public static function deleteProduct($id){
        $product = Products::where('Id', $id);
        $product->delete();
    }

    public static function getProductId($id){
        $product = Products::where('Id', $id)->get();
        return $product;
    }

    public static function editProduct($request ,$id, $fileName){
        
        $product = new Products;
        $product->Name = $request->Name;
        $product->Price = $request->Price;
        $product->Description = $request->Description;
        if($fileName != null){
            $product::where('Id', (int)$id)->Update(['Name'=>$product->Name, 'Price'=>$product->Price,'Img'=>$fileName, 'Description'=>$product->Description]);
        }
        else{
            $product::where('Id', (int)$id)->Update(['Name'=>$product->Name, 'Price'=>$product->Price, 'Description'=>$product->Description]);
        }
       
    }

    public static function creteProductPost($request, $fileName){
        $product = new Products;
        $product->insert(['Name'=>$request->Name, 'Price'=>$request->Price, 'Img'=>$fileName, 'Description'=>$request->Description]);
    }
}
