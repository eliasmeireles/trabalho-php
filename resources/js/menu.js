$('.func-menu').hover( function() {
	subMenu();
	var sub = $(this).find('.sub-menu');
	$(sub).addClass("active");
	$('.toggle-sub').addClass("active");
});

$('.func-menu').click( function() {
	var sub = $(this).find('.sub-menu');
	$(sub).addClass("active");
	$('.toggle-sub').toggleClass("active");
});
$('.toggle-sub').hover( function() {
	subMenu();
});
$('.toggle-sub').click( function() {
	subMenu();
});

function subMenu() {
	$('.sub-menu').removeClass("active");
	$('.toggle-sub').removeClass("active");
	$('.login-container').removeClass("active");
}
$('.navlink-login').click( function() {
	subMenu();
	$('.login-container').addClass("active");
	$('.toggle-login').addClass("active");
	$('.navbar-nav').removeClass("active");
	$('.toggle-menu').removeClass("active");
});
$('.toggle-login').click( function() {
	$('.toggle-login').removeClass("active");
	$('.login-container').removeClass("active");
});
$('.menu-responsiv').click( function() {
	$('.navbar-nav').toggleClass("active");
	$('.toggle-menu').toggleClass("active");
});
$('.toggle-menu').click( function() {
	subMenu();
	$('.navbar-nav').removeClass("active");
	$(this).removeClass("active");
});
$('.deletar').click( function () {
	deleteWarm();
});
$('.conf-excluir-opac').click(function () {
	deleteWarm();
});

$('.cancelar-delete').click( function () {
	$('.warm-deletar').addClass('hidden');
});
function deleteWarm() {
	var toShow = $('.warm-deletar').toggleClass('hidden');
}

$('.table-opt .deleta-cargo-opt').click(function() {
	$('.warm-deletar').addClass('hidden');
	$(this).find('.deletar-table').toggleClass('hidden');
	$(this).find('.warm-deletar').toggleClass('hidden');
});
$('.usuario-sistema .user-btn').click(function () {
	$('.usuario-sistema-form').removeClass('hidden');
	$('.add-user-system').removeClass('hidden');
});

$('.table-opt .user-data').click(function () {
	var funcNome = $(this).find('.func-nome').attr('value');
	var funcId = $(this).find('.func-id').attr('value');
	$('.info-hidden-class').html("Alterar senha: " + funcNome);
	$('.funcionario-id').val(funcId);
	$('.usuario-sistema-form').removeClass('hidden');
	$('.add-user-system').removeClass('hidden');
});

$('.form-btn-opt .cancelar-cad').click(function () {
	hiddeCad();
});
$('.usuario-sistema-form').click(function () {
	hiddeCad()
});

function hiddeCad() {
	$('.usuario-sistema-form').addClass('hidden');
	$('.add-user-system').addClass('hidden');
}



































