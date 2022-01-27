<?php 
namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model{
    
    protected $table      = 'products';
    protected $primaryKey = 'idproduct';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['productname','description','image','price','stock'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}

?>