<?php



namespace Mini\Controller;
use Mini\Model\Plan;
class HomeController
{
    public function index()
    {
        $plan = new Plan();
        $plans= $plan->getAllPlans();
        view('_templates/header.php');
        view('home/index.php',["plans"=>$plans]);
        view('_templates/footer.php');
    }
    public function calcularPlano()
    {
        $plan = new Plan();
        $plans= $plan->getAllPlans();
        $dataPlan= $plan->calcPlan($_POST['origin'],$_POST['destiny'],$_POST['minutes']);  
        $bestPlan=$plan->searchBestPlan($dataPlan);
        view('_templates/header.php');
        view('home/index.php',["dataPlan" => $dataPlan,"bestPlan"=>$bestPlan,"minutes"=>$_POST['minutes'],"plans"=>$plans]);
        view('_templates/footer.php');
    }
}
