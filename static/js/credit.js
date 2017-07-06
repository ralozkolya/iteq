$(function(){

	$('#choose_address').change(function(){
		var val = $(this).val();

		if(!isNaN(parseInt(val))) {
			$('#address-hidden').val(val);
			$('.submit-button').removeClass('disabled');
		}
	});

	$('#choose_address').change();

	$('#calculator-form').submit(function() {
		return false;
	});

	$('#period').change(function() {
		var max = price - participation > 500 ? 18 : 6;
		var value = $(this).val();
		value = parseInt(value) || 1;
		months = value > max ? max : (value < 1 ? 1 : value);
		$(this).val(months);
		calculate();
	});

	$('#participation').change(function() {
		var value = $(this).val();
		var max = price - 50 > 0 ? price - 50 : 0;
		value = parseFloat(value) || 0;
		participation = value > max ? max : (value < 1 ? 1 : value);
		$(this).val(participation.toFixed(2));
		calculate();
	});
});

function calculate() {
	var credit = price - participation;
	var percent = credit > 500 ? 3 : 5;
	var total = credit + credit * (percent / 100);
	var perMonth = total / months;
	$('#percent').val(percent);
	$('#amount').val(credit.toFixed(2));
	$('#per_month').val(perMonth.toFixed(2));
	$('#total').val(total.toFixed(2));
}
