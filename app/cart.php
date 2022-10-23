<?php
 namespace App;
 use Session;
 class Cart
{
        public $groomings = null;
        public $totalQty = 0;
        public $totalPrice = 0;

    public function __construct($oldCart) {
        if($oldCart) {
            $this->groomings = $oldCart->groomings;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }
    public function add($grooming, $id){
        //dd($this->groomings);
        $storedItem = ['qty'=>0, 'price'=>$grooming->price, 'grooming'=> $grooming];
        if ($this->groomings){
            if (array_key_exists($id, $this->groomings)){
                $storedItem = $this->groomings[$id];
            }
        }
       //$storedItem['qty'] += $grooming->qty;
        $storedItem['qty']++;
        $storedItem['price'] = $grooming->price * $storedItem['qty'];
        $this->groomings[$id] = $storedItem;
        $this->totalQty++;
        $this->totalPrice += $grooming->price;
    }

    //    public function reduceByOne($id){
    //     $this->groomings[$id]['qty']--;
    //     $this->groomings[$id]['price']-= $this->groomings[$id]['grooming']['price'];
    //     $this->totalQty --;
    //     $this->totalPrice -= $this->groomings[$id]['grooming']['price'];
    //     if ($this->groomings[$id]['qty'] <= 0) {
    //         unset($this->groomings[$id]);
    //     }
    // }
        public function removeItem($id){
        $this->totalQty -= $this->groomings[$id]['qty'];
        $this->totalPrice -= $this->groomings[$id]['price'];
        unset($this->groomings[$id]);
    }
}