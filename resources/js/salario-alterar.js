$('.cargo-salario').click(function () {
    var indexSelected = $(this).find(":selected").index();
    setaSalario(indexSelected);
});
$('.cargo-salario').ready(function () {
    var indexSelected = $(this).find(":selected").index();
    setaSalario(indexSelected);
});
function setaSalario(index) {
    var cargoSelecionado = $('.salarios .salario');
    var valorSalario = $(cargoSelecionado[index - 1]).attr('value');

    var cargoAlterar = $('.salarios .cargoAlterar');
    var cargoNome = $(cargoAlterar[index - 1]).attr('value');

    if (valorSalario) {
        $('.salario-atual').val("R$ " + valorSalario);
    }
    $('.armazena-valor').val(valorSalario);
    $('.salario-haAlter').val(valorSalario);
    $('.cargo-nome').val(cargoNome);
}

$('.valor-bonifica').on("change keyup paste click", function(){
    var valorBonus = 0;
    var valorAtual = 0;
    if ($('.valor-bonifica').val() != "") {
        if ($('.armazena-valor').val() != "") {
		var bonificaValor = $('.valor-bonifica').val() / 100 + 1;
            valorAtual = parseFloat($('.armazena-valor').val());
        }
    }
    var total = valorAtual * bonificaValor;
    if (total) {
		total = total.toFixed(2);
		
        $('.salario-calculado').val("R$: " + total);
    }
});