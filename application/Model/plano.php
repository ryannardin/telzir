<?php

namespace Mini\Model;

use stdClass;

class Plano
{
    private $values=[
        ['origin'=>11,'destiny'=>16,'value'=>1.90],
        ['origin'=>16,'destiny'=>11,'value'=>2.90],
        ['origin'=>11,'destiny'=>17,'value'=>1.70],
        ['origin'=>17,'destiny'=>11,'value'=>2.70],
        ['origin'=>11,'destiny'=>18,'value'=>0.90],
        ['origin'=>18,'destiny'=>11,'value'=>1.90]
    ];
    public function calcPlan($origin,$destiny,$minutes)
    {
        $dataPlan=(object)[];
        $values=$this->searchvalues($origin, $destiny);
        $value=$values['value'];
        $dataPlan->withoutPlan=['callValue'=>$minutes*$value,'total'=>$minutes*$value,'planValue'=>0,'planName'=>'semPlano'];
        $dataPlan->faleMais30=$this->calcFaleMais($value,$minutes,'30');
        $dataPlan->faleMais60=$this->calcFaleMais($value,$minutes,'60');
        $dataPlan->faleMais120=$this->calcFaleMais($value,$minutes,'120');
        $dataPlan->bestPlan=$this->searchBestPlan($dataPlan);
        return $dataPlan;
    }
    private function calcFaleMais($value,$minutes,$faleMais)
    {
        $valueLigacao=$minutes*($value*1.1);
        switch($faleMais){
            case '30':
                if($minutes<=30)
                    return ['total'=>59.99,'callValue'=>0,'minutes'=>30,'planValue'=>59.99,'planName'=>'FaleMais 30'];
                else
                    return ['total'=>59.99+ $valueLigacao,'callValue'=>$valueLigacao,'minutes'=>30,'planValue'=>59.99,'planName'=>'FaleMais 30'];    
            break;
            case '60':
                if($minutes<=60)
                    return ['total'=>109.99,'callValue'=>0,'minutes'=>60,'planValue'=>109.99,'planName'=>'FaleMais 60'];
                else
                    return ['total'=>109.99+ $valueLigacao,'callValue'=>$valueLigacao,'minutes'=>60,'planValue'=>109.99,'planName'=>'FaleMais 60'];     
            break;
            case '120':
                if($minutes<=120)
                    return ['total'=>199.99,'callValue'=>0,'minutes'=>120,'planValue'=>199.99,'planName'=>'FaleMais 120'];
                else  
                    return ['total'=>199.99+ $valueLigacao,'callValue'=>$valueLigacao,'minutes'=>120,'planValue'=>199.99,'planName'=>'FaleMais 120'];
            break;
        }
    }
    private function searchvalues($origin, $destiny) {
        foreach ($this->values as $key => $val) 
            if ($val['origin']==$origin && $val['destiny']==$destiny) 
                return $this->values[$key];
    }
    private function searchBestPlan($dataPlan){
        $lowerValue=null;
        $keyLowerValue=null;
        foreach ($dataPlan as $key => $dadoCalculado) {
            if($lowerValue==null || $dadoCalculado['total']<$lowerValue){
                $lowerValue=$dadoCalculado['total'];
                $keyLowerValue=$key;
            }
        }
        return $dataPlan->$keyLowerValue;
    }
}
