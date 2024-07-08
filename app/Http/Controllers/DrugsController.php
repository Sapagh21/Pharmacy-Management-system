<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DrugsController extends Controller
{
    public function showAddDrug()
    {
        return view('drugs.add_drug');
    }
    public function handleAddDrug(Request $request)
    {
        $name = $request->name;
        $description = $request->description;
        $quantity = $request->quantity;
        $price = $request->price;
        $Expiry_date = $request->Expiry_date;
        $prescription_required = $request->prescription_required;
        DB::insert(
            "insert into drugs (name, description, quantity, price,Expiry_date ,prescription_required ) values (?, ?, ?, ?, ?, ?)",
            [$name, $description, $quantity, $price, $Expiry_date, $prescription_required],
        );
        return redirect(route('showAllDrugs'));
    }
    public function showModify()
    {
        $drugs = DB::select("select * from drugs");

        return view('drugs.modify', compact('drugs'));
    }

    public function showallDrugs()
    {

        $drugs = DB::select("select * from drugs");
        return view('drugs.all_drugs', compact('drugs'));
    }

    public function DrugsSearch(Request $request)
    {
        $drugs = DB::select("
            select * from drugs
            where (:id is null or id like :id)
            and (:name is null or name like :name)
        ", [
            'id' => "%$request->id%",
            'name' => "%$request->name%",
        ]);
        return view('drugs.all_drugs', ['drugs' => $drugs]);
    }

    public function deleteDrug(Request $request, $id)
    {

        DB::delete("delete from drugs where id=?", [$id]);

        return redirect(route('showAllDrugs'));
    }


    public function showUpdateDrug($id)
    {
        $drugs = DB::select("select * from drugs where id=?", [$id])[0];

        return view('drugs.update_drug', compact('drugs'));
    }

    public function handleUpdateDrug(Request $request, $id)
    {
        $name = $request->name;
        $description = $request->description;
        $quantity = $request->quantity;
        $price = $request->price;
        $Expiry_date = $request->Expiry_date;
        $prescription_required = $request->prescription_required;

        DB::update(
            "update drugs set name=? ,description=? ,quantity=? ,price=? ,Expiry_date=? ,prescription_required=?  where id=? ",
            [$name, $description, $quantity, $price, $Expiry_date, $prescription_required, $id],
        );
        return redirect(route('showAllDrugs'));
    }

    public function showDrug($id, $name)
    {
        $drugs = DB::select("select * from drugs where id = ?", [$id])[0];
        return view('drugs.show_drug', ['drugs' => $drugs]);
    }
}
