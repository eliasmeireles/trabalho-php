<?php 
include 'menu.php';
?>
<h6 class="text-center">Remover usúario</h6>
    <div class="cadastro-usuario">
        <form class="form" action="/remover-usuario.php" method="POST">
            <div class="form-container">
                <div class="input-conatiner">
                    <div class="cool-form">
                        <div class="input-half">
                            <div class="input">
                                    <label class="form-label">Cpf</label>
                                    <input type="text" name="cpf" required="required" data-mask="000.000.000-00" class="input-box input-mediun">
                            </div>
                            <div class="input">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" required="required" class="input-box">
                            </div>
                        </div>
                    </div>
                </div>	
                <div class="button background-secondary btn-primary">
                    <button class="btn">Deletar</button>
                </div>
            </div>
        </form>
    </div>
    <p class="msg-info">Insira o cpf e o email do funcionário a ser removido!</p>

<?php include 'footer.php'; ?>


