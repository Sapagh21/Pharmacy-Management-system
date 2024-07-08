<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PurchaseController extends Controller
{
    //!fuction to show purchase page
    public function showPurchase()
    {
        $products = DB::select("select * from drugs");
        return view('orders.purchase', ['products' => $products]);
    }

    //! function to handle purchase
    public function handlePurchase(Request $request)
    {
        $prodId = $request->product;

        $product = DB::select("select * from drugs where id=? ", [$prodId]);
        if ($product) {
            $product = $product[0];
        } else {
            return back()
                ->with('error', 'Please Select a product')
                ->withInput();;
        }





        //! defining data variables
        $costumer_name = $request->costumer_name;
        $phone = $request->phone;
        $quantity = (int)$request->quantity;

        //! updating the product quantity

        $new_quantity = ($product->quantity) - ($quantity);

        if ($new_quantity < 0) {
            return back()
                ->with('error', 'This much is not available! , There are ' . $product->quantity . "in stock")
                //? this can be handled in the other page tho by defining a maximum number for the quantity;
                ->withInput();
        }

        //! calculating total price
        $total_price = ($request->quantity) * ($product->price);
        //! inserting purchase data in database
        DB::insert(
            "insert into purchase (customer_name,phone_number,product_id,quantity,Total_price) values(?,?,?,?,?)",
            [$costumer_name, $phone, $prodId, $quantity, $total_price]
        );

        DB::update("update drugs set quantity=? where id=?", [$new_quantity, $prodId]);
        // return "Added Succefully!";
        return redirect()->route('showallPurchase');
    }

    public function showallPurchases()
    {
        $purchases = DB::select("SELECT p.* , d.name 
                                 from purchase p
                                JOIN drugs d ON p.product_id = d.id");
        return view('orders.all_purchases', ['purchases' => $purchases]);
    }

    // All purchase delete and search 



    public function deletePurchase(Request $request, $purchaseId, $prodId)
    {
        
        $purchase = DB::select('SELECT * from purchase where id = ?', [$purchaseId])[0];
        $product = DB::select("select * from drugs where id=? ", [$prodId])[0];

        $newQuantity = $purchase->quantity  + $product->quantity;

        DB::update("update drugs set quantity=? where id=?", [$newQuantity, $prodId]);

        DB::delete("delete from purchase where id=?", [$purchaseId]);

        return back()->with('msg', "Record Deleted Succesfully!");
    }










    public function PurchaseSearch(Request $request)
    {
        $purchases = DB::select("
            select * from purchase
            where (:id is null or id like :id)
            and (:customer_name is null or customer_name like :customer_name)
            and (:phone is null or phone like :phone)
        ", [
            'id' => "%$request->id%",
            'customer_name' => "%$request->customer_name%",
            'phone'  => "%$request->phone%",
        ]);
        return view('all_purchases', ['purchases' => $purchases]);
    }
}
