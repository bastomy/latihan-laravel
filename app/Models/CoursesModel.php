<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoursesModel extends Model
{
  protected $table = 'courses';

	public function save_data($data){                          
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        return CoursesModel::insertGetId($data);
    }

    public function update_data($id,$data){
        $data['updated_at'] = date('Y-m-d H:i:s');
        return CoursesModel::where('id', $id)
                                ->update($data);
    }

    public function get_by_user($id){
      return CoursesModel::where("id_user",$id)
                  ->get();
    }

    public function get_by_id($id){
   		return CoursesModel::where("id",$id)
   						    ->first();
    }

    public function delete_data($id)
    {
      return CoursesModel::where('id',$id)
                  ->delete();
    }
}
