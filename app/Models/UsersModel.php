<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersModel extends Model
{
    protected $table = 'users';

	public function save_data($data){                          
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        return UsersModel::insertGetId($data);
    }

    public function update_data($id,$data){
        $data['updated_at'] = date('Y-m-d H:i:s');
        return UsersModel::where('id', $id)
                                ->update($data);
    }

    public function get_byId($id){
   		return UsersModel::where("id",$id)
   						    ->get();
    }
}
