<?php
namespace App\Filters;
use Illuminate\Http\Request;
class ApiFilter{
 protected $safeParams = [];
 protected $columnMap = [];
 protected $operatorMap = [];

    public function transform(Request $req){

        $eloQuery = [];

        foreach ($this->safeParams as $parm => $operators) {
            $query = $req->query($parm);
            if(!isset($query)){
                continue;
            }
            $column = $this->columnMap[$parm] ?? $parm;
            foreach($operators as $operator){
                if(isset($query[$operator])){
                    $eloQuery[]=[$column,$this->operatorMap[$operator],$query[$operator]];
                }
            }
        }
        return $eloQuery;
    }

}