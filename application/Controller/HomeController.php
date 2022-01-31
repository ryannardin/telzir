<?php



namespace Mini\Controller;
use Mini\Model\Plano;
class HomeController
{
    public function index()
    {
        
        view('_templates/header.php');
        view('home/index.php');
        view('_templates/footer.php');
    }
    public function calcularPlano()
    {
        $plano = new Plano();
        $dataPlan= $plano->calcPlan($_POST['origin'],$_POST['destiny'],$_POST['minutes']);  
        view('_templates/header.php');
        view('home/index.php',["dataPlan" => $dataPlan,'minutes'=>$_POST['minutes']]);
        view('_templates/footer.php');
    }
}
