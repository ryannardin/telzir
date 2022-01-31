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
        $dadosCalculados= $plano->calcPlano($_POST['origem'],$_POST['destino'],$_POST['minutos']);  
        view('_templates/header.php');
        view('home/index.php',["dadosCalculados" => $dadosCalculados,'minutos'=>$_POST['minutos']]);
        view('_templates/footer.php');
    }
}
