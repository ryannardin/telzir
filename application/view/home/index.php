<main>
    <section id="about">
        <h1>Sobre a Telzir</h1>
        <p class="fs-21">A <span class="bold">Telzir</span> é uma empresa telefônica especializada em chamadas de longa
            distância nacional focada em melhor
            custo benefício com preços que cabem no seu bolso, também temos planos que reduzem as tarifas
            experimente agora mesmo, faça sua primeira ligação!</p>
    </section>
    <section>
        <form method="post" action="<?=URL?>home/CalcularPlano">
            <h1 style="margin-bottom: 9px;">Calcule a ligação</h1>
            <div class="form-container">
                <div class="input-field">
                    <p>DDD de origem</p>
                    <select name='origin' id='origin'>
                        <option>11</option>
                        <option>16</option>
                        <option>17</option>
                        <option>18</option>
                    </select>
                </div>
                <div class="input-field">
                    <p>DDD de destino</p>
                    <select name='destiny' id=destiny>
                        <option>11</option>
                        <option>16</option>
                        <option>17</option>
                        <option>18</option>
                    </select>
                </div>
                <div class="input-field">
                    <p>Tempo</p>
                    <input type="number" value="<?=(isset($_POST['minutes'])?$_POST['minutes']:'60')?>" name='minutes'>
                </div>
            </div>
            <div class="calculate-btn">
                <button type="submit" class="bold">Calcular</button>
            </div>
        </form>
    </section>
    <?php if(isset($dataPlan)): ?>
        
        <section>
            <h1>Total a pagar</h1>
            <table>
                <thead>
                    <tr>
                        <td class="fs-21">Plano FaleMais</td>
                        <td class="fs-21">Valor</td>
                        <td class="fs-21">Valor Total</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($dataPlan as $plan): ?>
                        <tr class="<?=($bestPlan->strPlanName==$plan->strPlanName?'best-plan':'')?>">
                            <td><?=$plan->strPlanName?></td>                           
                            <td>R$<?=number_format($plan->callPriece,2,',','.')?></td>
                            <th>R$<?=number_format($plan->total,2,',','.')?></th>
                        </tr>                           
                    <?php endforeach;?>
                </tbody>
            </table>
        </section>
        <?php if($bestPlan->strPlanName!='Sem Plano'):?>
            <section>
                <h1>Plano ideal para você</h1>
                <div class="plan-card best-plan-card">
                    <div class="card-header">
                        <h2><?=$bestPlan->strPlanName?></h2>
                    </div>
                    <div class="card-body">
                        <h2 class="bold">R$<?=number_format($bestPlan->decPlanPriece,2,',','.')?></h2>
                        <p><?=$bestPlan->intPlanMinutes?> minutos</p>
                    </div>
                </div>
            </section>    
        <?php endif?>   
    <?php endif;?>
    <section id="other-plans">
        <h1>Planos</h1>
        <div class="others-card">

        <?php foreach($plans as $plan): ?>
            <div class="plan-card">
                <div class="card-header">
                    <h2><?=$plan->strPlanName?></h2>
                </div>
                <div class="card-body">
                    <h2 class="bold">R$<?=number_format($plan->decPlanPriece,2,',','.')?></h2>
                    <p><?=$plan->intPlanMinutes?> minutos</p>
                </div>
            </div>                         
        <?php endforeach;?>
        </div>
    </section>
</main>
<script>
    select(<?=(isset($_POST['origin'])?$_POST['origin']:'11')?>,document.querySelector("#origin"));
    select(<?=(isset($_POST['destiny'])?$_POST['destiny']:'11')?>,document.querySelector("#destiny"));
</script>