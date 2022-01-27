<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ProductModel;
use App\Models\PurchaseModel;

class Dashboard extends BaseController{

    protected $session;

    public function __construct(){
        $this->session = \Config\Services::session();
        $this->session->start();
    }

    public function index(){

        if(isset($_SESSION['user']))return redirect()->to('dashboard/main');

        else $this->loadViews('login');
        
	}

    public function createUser($nameus,$username,$email,$userpassword){

        $userModel      = new UserModel();
        $hashPassword   = password_hash($userpassword,PASSWORD_DEFAULT);

        $dataUser = [
            'nameus'        => $nameus,
            'username'      => $username,
            'userpassword'  => $hashPassword,
            'email'         => $email
        ];

        $userModel->insert($dataUser);

    }

    public function getUser($username){

        $userModel  = new UserModel();
        $user       = $userModel->where('username',$username)->find();

        return $user;
    }

    public function validatePassword($username, $userpassword){

        $user = $this->getUser($username);

        if($user){

            $passw = preg_replace('([^A-Za-z0-9])','',$userpassword);

            if(password_verify($passw,$user[0]['userpassword'])) return true;
            else return false;

        }else return false;

    }

    public function createUserSession($username, $userpassword){

        if($this->validatePassword($username, $userpassword)){

            $user = $this->getUser($username);

            $_SESSION['user']['username']   = $user[0]['nameus'];
            $_SESSION['user']['iduser']     = $user[0]['iduser'];

            return redirect()->to('dashboard/main');

        }else{

            echo "Something went wrong!";
            return redirect()->to('dashboard/loginUser');
        }

    }

    public function loginUser(){

        if(isset($_SESSION['user'])) return redirect()->to('dashboard/main');

        else{

            if($_POST){

                helper(['url','form']);
                $validation = \Config\Services::validation();

                $validation->setRules([
                    'username'      => 'required',
                    'userpassword'  => 'required'
                ],[
                    'username' =>[
                        'required' => 'User is required!'
                    ],
                    'userpassword' =>[
                        'required' => 'Password is required!'
                    ]
                ]);

                if($validation->withRequest($this->request)->run()){

                    return $this->createUserSession($_POST['username'],$_POST['userpassword']);

                }else{
                    
                    $errors         = $validation->getErrors();
                    $data['error']  = $errors;
                    $this->loadViews('login',$data);
                }
            }else{
                $this->loadViews('login');
            }
        }
    }

    public function logout(){

        unset($_SESSION['user']);
        session_destroy();

        return redirect()->to('dashboard/loginUser');
    }

    public function registerUser(){

        helper(['url','form']);
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nameus'        => 'required',
            'username'      => 'required',
            'userpassword'  => 'required',
            'email'         => 'required'
        ],[
            'nameus' =>[
                'required' => 'Name is required!'
            ],
            'username' =>[
                'required' => 'User is required!'
            ],
            'userpassword' =>[
                'required' => 'Password is required!'
            ],
            'email' =>[
                'required' => 'Email is required!'
            ]
        ]);

        if($_POST){

            if($validation->withRequest($this->request)->run()){

                $this->createUser($_POST['nameus'],$_POST['username'],$_POST['email'],$_POST['userpassword']);
                return $this->createUserSession($_POST['username'],$_POST['userpassword']);
                
            }else{
                $errors         = $validation->getErrors();
                $data['error']  = $errors;
                $this->loadViews('register',$data);
            }
        }else{
            $this->loadViews('register');
        }
    }

    public function getProducts(){

        $productModel      = new ProductModel();
        $products          = $productModel->findAll();

        return $products;

    }

    public function getProduct($idproduct){

        $productModel   = new ProductModel();
        $product        = $productModel->where('idproduct',$idproduct)
                                       ->first();

        return $product;

    }

    public function main(){

        if(isset($_SESSION['user'])){

            $data['products']   = [];
            $products           = $this->getProducts();

            if($products) $data['products'] = $products;
            
            $this->loadViews('main',$data);

        }else $this->loadViews('login');

    }

    public function deleteProduct(){

        if(isset($_POST)){

            $productModel = new ProductModel();

            $productModel->where('idproduct',$_POST['idproduct'])
                          ->delete();

            $status = "PRODUCT DELETED";

        }else $status = "ERROR";

        echo ($status);die;
    }

    public function editProduct(){

        if(isset($_POST)){

            $productModel = new ProductModel();

            $arrayData    = array(  'productname'   => $_POST['name'],
                                    'description'   => $_POST['description'],
                                    'stock'         => $_POST['stock'],
                                    'price'         => $_POST['price']);
            
            $productModel->set($arrayData)
                         ->where('idproduct',$_POST['idprod'])
                         ->update();

            $status = "PRODUCT MODIFIED!";

        }else $status = "ERROR";

        echo ($status);die;

    }

    public function updateStockProduct($idproduct, $newstock){

        $productModel = new ProductModel();

        $productModel->set('stock',$newstock)
                     ->where('idproduct',$idproduct)
                     ->update();

    }

    public function buyProduct(){

        if(isset($_POST)){

            $purchaseModel  = new PurchaseModel();
            $product        = $this->getProduct($_POST['idprod']);

            if($_POST['amount'] <= $product['stock']){

                $newstock       = $product['stock'] - $_POST['amount'];
                $totalprice     = $product['price'] * $_POST['amount'];
                
                $this->updateStockProduct($_POST['idprod'],$newstock);

                date_default_timezone_set('America/Argentina/Salta');

                $arrayPurchase  = [
                    'idprod'        => $_POST['idprod'],
                    'datepurchase'  => date('Y-m-d'),
                    'timepurchase'  => date("H:i:s",time()),
                    'amount'        => $_POST['amount'],
                    'total'         => $totalprice
                ];

                $purchaseModel->insert($arrayPurchase);

                $status = "PRODUCT MODIFIED!";

            }else $status = "ERROR";
            
        }else $status = "ERROR";

        echo ($status);die;

    }

    public function getPurchases(){

        $purchaseModel  = new PurchaseModel();
        $purchases      = $purchaseModel->select('idpurchase,productname,datepurchase,timepurchase,amount,total')
                                        ->join('products','products.idproduct = purchases.idprod')
                                        ->findAll();

        return $purchases;

    }

    public function purchases(){

        if(isset($_SESSION['user'])){

            $data['purchases']  = [];
            $purchases          = $this->getPurchases();

            if($purchases) $data['purchases'] = $purchases;

            $this->loadViews('purchases',$data);

        }else return redirect()->to('dashboard/loginUser');
    }

    public function addProduct(){

        if(isset($_SESSION['user'])){

            if(isset($_POST)){

                $productModel  = new ProductModel();
    
                $arrayProduct  = [
                    'productname'  => $_POST['name'],
                    'description'  => $_POST['description'],
                    'stock'        => $_POST['stock'],
                    'price'        => $_POST['price']
                ];
    
                $productModel->insert($arrayProduct);
    
                $status = "PRODUCT ADDED!";
    
            }else $status = "ERROR";
    
            echo ($status);die;

        }else return redirect()->to('dashboard/loginUser');

    }

    public function loadViews($view = null, $data = null){

        if($data){

            echo view('includes/header',$data);
            echo view($view,$data);
            echo view('includes/footer',$data);

        }else{

            echo view('includes/header');
            echo view($view);
            echo view('includes/footer');
        }
        
    }
}

?>
