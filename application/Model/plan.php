<?php

namespace Mini\Model;

use stdClass;
use Mini\Core\Model;
use Mini\Libs\Helper;

class Plan extends Model
{
    public function calcPlan($origin,$destiny,$minutes)
    {
        $values=$this->searchvalues($origin, $destiny);
        $value=$values->decCallPriece;
        $plans=$this->calcFaleMais($origin,$destiny,$minutes);
        $dataPlan[0]=(object) ['callPriece'=>$minutes*$value,'total'=>$minutes*$value,'planValue'=>0,'strPlanName'=>'Sem Plano'];
        $dataPlan=array_merge($dataPlan, $plans); 
        
        return $dataPlan;
    }
    public function getAllPlans(){
        $sql = "SELECT * FROM tb_plans ORDER BY intPlanID";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    private function calcFaleMais($origin,$destiny,$minutes)
    {
        $sql = "SELECT 
            strPlanName,
            decPlanPriece,
            intPlanMinutes, 
            CASE
                WHEN :mins <= intPlanMinutes THEN 0
                ELSE ((1.1*decCallPriece)*:mins)
            END as callPriece,
            CASE
                WHEN :mins <= intPlanMinutes THEN decPlanPriece
                ELSE ((decPlanPriece)+(1.1*decCallPriece)*:mins)
            END as total
        FROM tb_plans 
            inner join tb_calls 
            on strCallOrigin=:origin 
            AND strCallDestiny=:destiny
        ORDER BY intPlanID";
        $query = $this->db->prepare($sql);
        $query->execute([':origin'=>$origin,':destiny'=>$destiny,':mins'=>$minutes]);

        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, [':origin'=>$origin,':destiny'=>$destiny,':minutes'=>$minutes]);
        return $query->fetchAll();
    }
    private function searchvalues($origin, $destiny) {
        $sql = "SELECT * FROM tb_calls WHERE strCallOrigin=:origin AND strCallDestiny=:destiny";
        $query = $this->db->prepare($sql);
        $query->execute([':origin'=>$origin,':destiny'=>$destiny]);
        return $query->fetch();
    }
    public function searchBestPlan($dataPlan){
        $lowerValue=0;
        $lowerKey=0;
        foreach ($dataPlan as $key => $plan) {
            if($plan->total<$lowerValue || !$lowerValue){
                $lowerValue=$plan->total;
                $lowerKey=$key;     
            }
        } 
        return $dataPlan[$lowerKey];
    }
}
