$(init);

function init() {
	var inputs = $('input[data-mask]');

	inputs.each(function() {
		var input = $(this);
		input.mask(input.attr('data-mask'));
	});
}