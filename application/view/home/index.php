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
                    <tr <?=($dataPlan->bestPlan['planName'] == 'semPlano' ? "class='best-plan'" : "");?> >
                        <td>Sem Plano</td>                           
                        <td>R$<?=$dataPlan->withoutPlan['callValue']?></td>
                        <th>R$<?=$dataPlan->withoutPlan['total']?></th>          
                    </tr>
                    <tr <?=($dataPlan->bestPlan['planName'] == 'FaleMais 30' ? "class='best-plan'" : "");?> >
                        <td>FaleMais 30</td>                           
                        <td>R$<?=$dataPlan->faleMais30['callValue']?></td>
                        <th>R$<?=$dataPlan->faleMais30['total']?></th>
                    </tr>
                    <tr <?=($dataPlan->bestPlan['planName'] == 'FaleMais 60' ? "class='best-plan'" : "");?> >
                        <td>FaleMais 60</td>                         
                        <td>R$<?=$dataPlan->faleMais60['callValue']?></td>
                        <th>R$<?=$dataPlan->faleMais60['total']?></th>
                    </tr>
                    <tr <?=($dataPlan->bestPlan['planName'] == 'FaleMais 120' ? "class='best-plan'" : "");?> >
                        <td>FaleMais 120</td> 
                        <td>R$<?=$dataPlan->faleMais120['callValue']?></td>
                        <th>R$<?=$dataPlan->faleMais120['total']?></th>
                    </tr>
                </tbody>
            </table>
        </section>
        <?php if($dataPlan->bestPlan['planName']!='semPlano'):?>
            <section>
                <h1>Plano ideal para você</h1>
                <div class="plan-card best-plan-card">
                    <div class="card-header">
                        <h2><?=$dataPlan->bestPlan['planName']?></h2>
                    </div>
                    <div class="card-body">
                        <h2 class="bold">R$<?=$dataPlan->bestPlan['planValue']?></h2>
                        <p><?=$dataPlan->bestPlan['minutes']?> minutos</p>
                    </div>
                </div>
            </section>    
        <?php endif?>   
    <?php endif;?>
    <section id="other-plans">
        <h1>Planos</h1>
        <div class="others-card">
            <div class="plan-card">
                <div class="card-header">
                    <h2>FaleMais 30</h2>
                </div>
                <div class="card-body">
                    <h2 class="bold">R$59,99</h2>
                    <p>30 minutos</p>
                </div>
            </div>
            <div class="plan-card">
                <div class="card-header">
                    <h2>FaleMais 60</h2>
                </div>
                <div class="card-body">
                    <h2 class="bold">R$109,90</h2>
                    <p>60 minutos</p>
                </div>
            </div>
            <div class="plan-card">
                <div class="card-header">
                    <h2>FaleMais 120</h2>
                </div>
                <div class="card-body">
                    <h2 class="bold">R$199,99</h2>
                    <p>120 minutos</p>
                </div>
            </div>
        </div>
    </section>
</main>
<script>
    select(<?=(isset($_POST['origin'])?$_POST['origin']:'11')?>,document.querySelector("#origin"));
    select(<?=(isset($_POST['destiny'])?$_POST['destiny']:'11')?>,document.querySelector("#destiny"));
</script>