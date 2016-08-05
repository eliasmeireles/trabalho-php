<div class="table-opt cargos">
    <div class="deleta-cargo-opt">
        <div class="btn deletar"><img class="opt-ico" src="resources/img/delete-icon-5.png" title="Excluir esse Cargo">
        </div>
        <div class="deletar-table hidden">
            <div class="warm-deletar hidden">
                <div class="conf-excluir-opac">
                </div>
                <div class="conf-excluir">
                    <div class="form-deletar">
                        <span class="info-hidden-class">Excluir cargo: <?php echo $cg['nome']; ?></span>
                        <samp class="deletar-perg">Deseja excluir esse cargo?</samp>
                        <div class="deletar-form">
                            <form action="cargo-deletar.php" method="POST" class="delete-form-cont">
                                <input type="hidden" name="cargoId" value="<?php echo $cg['id'] ?>">
                                <div class="form-btn-opt">
                                    <div class="button">
                                        <button class="btn confirmar">Confirmar</button>
                                    </div>
                                    <div class="button">
                                        <span class="btn cancelar cancelar-delete">Cancelar</span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>