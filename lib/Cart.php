<?php


class Cart{

    private $db;
    
    public function __construct(){
        $this->db = new Database();    
    }


    public function CheckCartQuantity(){
        $items_in_cart = 0;
        if(isset($_SESSION["cart_array"])){
            $items_in_cart = '<span class="group-hover:text-gray-700 text-gray-600">'.count($_SESSION["cart_array"]).'</span>';
        }
        return $items_in_cart;
    }

    public function AddToCart($itemNaam){

    }
    
    public function RenderCartItems(){
        
    }

    public function CheckIfVoorraadIsNotNull($itemNaam){
        
    }

    public function UpdateProductQuantity(){
        
    }
    public function RemoveItemFromCart(){
        
    }
}
