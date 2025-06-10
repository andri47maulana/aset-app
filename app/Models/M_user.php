<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class M_user extends Model
{
     
    protected $table = 'user';

    protected $primaryKey = 'user_id';

    protected $allowedFields = ['unit_id', 'role_id', 'username', 'password', 'user_telp', 'user_status'];

    protected $returnType = 'object';

 
}