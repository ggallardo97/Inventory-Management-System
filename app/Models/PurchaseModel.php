<?php 
namespace App\Models;

use CodeIgniter\Model;

class PurchaseModel extends Model{
    
    protected $table      = 'purchases';
    protected $primaryKey = 'idpurchase';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['idprod','datepurchase','timepurchase','amount','total'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}

?>