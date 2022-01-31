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
                    <select name='origem' id='origem'>
                        <option>11</option>
                        <option>16</option>
                        <option>17</option>
                        <option>18</option>
                    </select>
                </div>
                <div class="input-field">
                    <p>DDD de destino</p>
                    <select name='destino' id=destino>
                        <option>11</option>
                        <option>16</option>
                        <option>17</option>
                        <option>18</option>
                    </select>
                </div>
                <div class="input-field">
                    <p>Tempo</p>
                    <input type="number" value="<?=(isset($_POST['minutos'])?$_POST['minutos']:'60')?>" name='minutos'>
                </div>
            </div>
            <div class="calculate-btn">
                <button type="submit" class="bold">Calcular</button>
            </div>
        </form>
    </section>
    <?php if(isset($dadosCalculados)): ?>
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
                    <tr <?=($dadosCalculados->melhorPlano['nomePlano'] == 'semPlano' ? "class='best-plan'" : "");?> >
                        <td>Sem Plano</td>                           
                        <td>R$<?=$dadosCalculados->semPlano['valorLigacao']?></td>
                        <th>R$<?=$dadosCalculados->semPlano['valorTotal']?></th>          
                    </tr>
                    <tr <?=($dadosCalculados->melhorPlano['nomePlano'] == 'FaleMais 30' ? "class='best-plan'" : "");?> >
                        <td>FaleMais 30</td>                           
                        <td>R$<?=$dadosCalculados->faleMais30['valorLigacao']?></td>
                        <th>R$<?=$dadosCalculados->faleMais30['valorTotal']?></th>
                    </tr>
                    <tr <?=($dadosCalculados->melhorPlano['nomePlano'] == 'FaleMais 60' ? "class='best-plan'" : "");?> >
                        <td>FaleMais 60</td>                         
                        <td>R$<?=$dadosCalculados->faleMais60['valorLigacao']?></td>
                        <th>R$<?=$dadosCalculados->faleMais60['valorTotal']?></th>
                    </tr>
                    <tr <?=($dadosCalculados->melhorPlano['nomePlano'] == 'FaleMais 120' ? "class='best-plan'" : "");?> >
                        <td>FaleMais 120</td> 
                        <td>R$<?=$dadosCalculados->faleMais120['valorLigacao']?></td>
                        <th>R$<?=$dadosCalculados->faleMais120['valorTotal']?></th>
                    </tr>
                </tbody>
            </table>
        </section>
        <?php if($dadosCalculados->melhorPlano['nomePlano']!='semPlano'):?>
            <section>
                <h1>Plano ideal para você</h1>
                <div class="plan-card best-plan-card">
                    <div class="card-header">
                        <h2><?=$dadosCalculados->melhorPlano['nomePlano']?></h2>
                    </div>
                    <div class="card-body">
                        <h2 class="bold">R$<?=$dadosCalculados->melhorPlano['valorPlano']?></h2>
                        <p><?=$dadosCalculados->melhorPlano['minutos']?>minutos</p>
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
    select(<?=(isset($_POST['origem'])?$_POST['origem']:'11')?>,document.querySelector("#origem"));
    select(<?=(isset($_POST['destino'])?$_POST['destino']:'11')?>,document.querySelector("#destino"));
</script>