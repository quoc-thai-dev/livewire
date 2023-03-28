<?php

namespace App\Http\Livewire\Expense;

use App\Models\category;
use App\Models\expense;
use Carbon\Carbon;
use Livewire\Component;

class Index extends Component
{
    public $expenses;
    public $type="i";
    public $expenseCrud;
    public $categories;
    public $itemId;
    public $listeners=['deleteExpense'];

    public $name;
    public $price;
    public $category;
    public $date;
    public $created_at;

    public function render()
    {
        return view('livewire.expense.index')->with(['expenses' => $this->getExpense(),'categories'=>$this->getCategory()]);
    }
    public function getExpense(){
        $this->expenses= expense::join('categories',"categories.id","=","expenses.category_id")->select(["expenses.id","expenses.name","expenses.price","expenses.date","categories.category_name"])->get();
    }
    public function getCategory(){
        $this->categories=category::all();
    }
    public function confirmDelete($id){
        $this->itemId=$id;
//        $this->dispatchBrowserEvent('showModalDelete',['id'=>123]);
    }
    public function hideModal(){
        $this->dispatchBrowserEvent('hideModal');
    }
    public function showModalId($id){
        $this->itemId=$id;
        $this->dispatchBrowserEvent('showModal');
    }
    public function deleteExpense(){
        $ex=expense::find($this->itemId);
        $ex->delete();
        $this->hideModal();
    }
    public function showModalInsert(){
        $this->dispatchBrowserEvent('showModalInsert');
    }
    public function hideModalInsert(){
        $this->dispatchBrowserEvent('hideModalInsert');
    }
    public function addExpense(){
//        dd(Carbon::now());
        try{
            $ex=new expense();
            $ex->name=$this->name;
            $ex->price=$this->price;
            $ex->category_id=$this->category;
            $ex->status=true;
            $ex->date=Carbon::now()->toDateTimeString();
            $ex->save();
        }catch(\Exception $ex){
            dd($ex->getMessage());
        }
        $this->hideModalInsert();
    }
    public function getExpenseById($id){
        $this->expenseCrud=expense::find($id);
        return expense::find($id);
    }
    public function showUpdateModal($id){
        $this->type="u";
        $ex=$this->getExpenseById($id);
        $this->name=$ex->name;
        $this->price=$ex->price;
        $this->category=$ex->category_id;
        $this->date=$ex->date;
        $this->created_at=$ex->created_at;
        $this->showModalInsert();
    }
    public function updateExpense(){
        $ex = $this->expenseCrud;
        $ex->name=$this->name;
        $ex->price=$this->price;
        $ex->category_id=$this->category;
        $ex->date=$this->date;
        $ex->save();
        $this->hideModalInsert();
    }
}
