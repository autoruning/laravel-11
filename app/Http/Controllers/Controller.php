<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function validate($request, $rules, $messages = [], $customAttributes = []){
        $validator = \Validator::make($request->all(), $rules, $messages, $customAttributes); 
        if ($validator->fails()) { 
            $arr = $validator->errors()->toArray(); 
            $data = [];
            foreach($arr as $k=>$v){
                $data[$k] = $v[0];
            }
            return $this->error($validator->errors()->first(),$data);
        }
    }
    public function success($message = '',$data = []){ 
        return  [
            'code' => 0,
            'message' => $message,
            'data'=>$data
        ];
    }

    public function error($message = '',$data = []){ 
        return  [
            'code' => 250,
            'message' => $message,
            'data'=>$data
        ];
    }
}
