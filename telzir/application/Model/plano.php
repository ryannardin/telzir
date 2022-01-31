<?php

namespace Mini\Model;

class Plano
{
    private $valores=[
        ['origem'=>11,'destino'=>16,'valor'=>1.90],
        ['origem'=>16,'destino'=>11,'valor'=>2.90],
        ['origem'=>11,'destino'=>17,'valor'=>1.70],
        ['origem'=>17,'destino'=>11,'valor'=>2.70],
        ['origem'=>11,'destino'=>18,'valor'=>0.90],
        ['origem'=>18,'destino'=>11,'valor'=>1.90]
    ];
    public function calcPlano($origem,$destino,$minutos)
    {
        $dadosCalculados=(object)[];
        $valores=$this->buscarValores($origem, $destino);
        $valor=$valores['valor'];
        $dadosCalculados->semPlano=['valorLigacao'=>$minutos*$valor,'valorTotal'=>$minutos*$valor,'valorPlano'=>0,'nomePlano'=>'semPlano'];
        $dadosCalculados->faleMais30=$this->calcularfaleMais($valor,$minutos,'30');
        $dadosCalculados->faleMais60=$this->calcularfaleMais($valor,$minutos,'60');
        $dadosCalculados->faleMais120=$this->calcularfaleMais($valor,$minutos,'120');
        $dadosCalculados->melhorPlano=$this->buscarMelhorPlano($dadosCalculados);
        return $dadosCalculados;
    }
    private function calcularfaleMais($valor,$minutos,$faleMais)
    {
        $valorLigacao=$minutos*($valor*1.1);
        switch($faleMais){
            case '30':
                if($minutos<=30)
                    return ['valorTotal'=>59.99,'valorLigacao'=>0,'minutos'=>30,'valorPlano'=>59.99,'nomePlano'=>'FaleMais 30'];
                else
                    return ['valorTotal'=>59.99+ $valorLigacao,'valorLigacao'=>$valorLigacao,'minutos'=>30,'valorPlano'=>59.99,'nomePlano'=>'FaleMais 30'];    
            break;
            case '60':
                if($minutos<=60)
                    return ['valorTotal'=>109.99,'valorLigacao'=>0,'minutos'=>60,'valorPlano'=>109.99,'nomePlano'=>'FaleMais 60'];
                else
                    return ['valorTotal'=>109.99+ $valorLigacao,'valorLigacao'=>$valorLigacao,'minutos'=>60,'valorPlano'=>109.99,'nomePlano'=>'FaleMais 60'];     
            break;
            case '120':
                if($minutos<=120)
                    return ['valorTotal'=>199.99,'valorLigacao'=>0,'minutos'=>120,'valorPlano'=>199.99,'nomePlano'=>'FaleMais 120'];
                else  
                    return ['valorTotal'=>199.99+ $valorLigacao,'valorLigacao'=>$valorLigacao,'minutos'=>120,'valorPlano'=>199.99,'nomePlano'=>'FaleMais 120'];
            break;
        }
    }
    private function buscarValores($origem, $destino) {
        foreach ($this->valores as $key => $val) 
            if ($val['origem']==$origem && $val['destino']==$destino) 
                return $this->valores[$key];
    }
    private function buscarMelhorPlano($dadosCalculados){
        $menorValor=null;
        $keyMenorValor=null;
        foreach ($dadosCalculados as $key => $dadoCalculado) {
            if($menorValor==null || $dadoCalculado['valorTotal']<$menorValor){
                $menorValor=$dadoCalculado['valorTotal'];
                $keyMenorValor=$key;
            }
        }
        return $dadosCalculados->$keyMenorValor;
    }
}
