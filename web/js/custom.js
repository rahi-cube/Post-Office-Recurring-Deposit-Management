Date.prototype.getMonthFormatted = function() {
    var month = this.getMonth();
    return month < 10 ? '0' + (parseInt(month) + 1) : (parseInt(month) + 1); // ('' + month) for string result
}

$(document).ready(function(e) {
	
	$("select").chosen({no_results_text: "Oops, nothing found!"}); 
	
    $('#customers-date_of_birth, #rdaccounts-start_date').datepicker({
		format: 'yyyy-mm-dd'
	});
	
	$('#misaccount-start_date, #misaccount-end_date, #misaccount-date_taken').datepicker({
		format: 'yyyy-mm-dd'
	});
	
	
	$("table.sieve").sieve();
	
	
	$("#input-month").datepicker({
		format: 'mm/yyyy'
	}).on('changeDate', function(e){
		
		var d = $('#schedule_num').val();
		var nd = new Date(e.date);
		nd = nd.getMonthFormatted() + "/" + nd.getFullYear();
		
	});
	
	$("#schedule-date").datepicker().on('changeDate', function(e){
		var d = $('#schedule_num').val();
		
		var nd = new Date(e.date);
		var newnum = (d.split("-"))[0];
		$('#schedule_num').val(newnum + "-" + ( nd.getMonthFormatted()) + "/" + nd.getFullYear());
	});
	
	$('#create-submit').hide();
	
	var c = 0;
	var sum = 0;
	var account = [];
	$(".add-to-right").click(function(e) {
		
        var t = JSON.parse($(this).attr('rel'));
		var tmp_schedule	=  "<tr id='rd-"+ t.account_no +"'><td><input type='hidden' name='account[]' value='"+t.account_no+"'>"+ t.account_no +"</td><td>"+ t.name +"</td><td>"+ t.deposit_amount +" Rs.</td><td><a href='javascript:void(0);' style='padding: 0px 12px;' class='btn btn-default btn-sm remove-data' rel='"+t.account_no+"' data='"+ t.deposit_amount +"'>&times;</a></td></tr>";
		
		
		if(sum >= 10000)
		{
			$('#create-submit').hide();
			alert("Schedule amount can not be larger then 10,000 Rs.");
			return; 
		}else
		{
			$('#create-submit').show();
		}
		
		var x = jQuery.inArray(t.account_no, account);
		
		if(x	< 	0){
			sum = sum + parseInt(t.deposit_amount);
			$(this).parent().parent().css("background-color","#FFC");
			account.push(t.account_no);
		}
		else
		{
			alert("Already Added")
			return false;
		}
		
		if(c == 0)
		{
			$('#schedule-pane').html(tmp_schedule);
		}
		else
		{
			$('#schedule-pane').append(tmp_schedule);
		}
		c++;
		$('#total').text(sum + " Rs.");
		$('#input-total').val(sum).change();	
		//$('#total-big').text(sum + " Rs.");
		count = 0;
		el = 0;
		$(".remove-data").click(function(e) {
		 	if(count == 0 || el != $(this).attr("rel"))
			{
             var acc = $(this).attr("rel");
			 el = acc;
			 var amt = $(this).attr("data");
			 		
			 $("#rd-" + acc).remove();
			 sum = sum - parseInt(amt);
			 $('#total').text(sum + " Rs.");
			 $('#input-total').val(sum).change();
			 count++;
			 
			 $('#left-' + acc).css("background-color", "#FFD2E9");
			 
			 account = jQuery.grep(account, function(value) {
			  	return value != acc;
			 });
			}
		});
    });
	
	$('#input-total').change(function(e) {
		
        var total 	 = $(this).val();
		var comm  	 = (total * 0.04).toFixed(2);
		var tendred  = (total - comm).toFixed(2);
		var tds  	 = (comm * 0.1).toFixed(2);
		
		$("#total").text( parseFloat( total ).toFixed(2) + " Rs." );
		$('#comm').text(comm + " Rs.");
		$('#tendered').text(tendred + " Rs.");
		$('#tds').text(tds + " Rs.");
		
    });
	
	
	$('#collection_date').datepicker({
		format: 'yyyy-mm-dd'
	}).on('changeDate', function(ev){
		$('#collection_date').datepicker('hide');
	});
	
	
	$('#rdaccounts-start_date').datepicker({
		format: 'yyyy-mm-yy'
		}).on('changeDate', function(ev){
			var t = new Date(ev.date);
			$(this).val(t.getFullYear() + "-" +  (t.getMonth() + 1) + "-" + t.getDate());			
			term = $("#rdaccounts-term option:selected").val();
			term = parseInt(term);
			var d = (( term + t.getFullYear() ) + "-" +  (t.getMonth() + 1) + "-" + t.getDate());
			$('#rdaccounts-end_date').val(d);
			$('#rdaccounts-start_date').datepicker('hide');
	});
	
	var template = '<tr id="record_##id##">\
						<th><input type="hidden" name="info[##id##][collection_account_no]" value="##acno##" /> ##acno##</th> \
                        <th><input type="hidden" name="info[##id##][collection_amount]" value="##amount##" /> ##amount## Rs.</th> \
                        <th><input type="text" name="info[##id##][collection_date]" value="##date##" class="date_input" data-date-viewmode="months" data-date-minviewmode="months" /></th> \
						<th><a href="javascript:void(0);" onclick="$(' + "record_##id##" + ').remove();">&times;</a></th> \
                    </tr>';
	var count = 0;
	
	var monthNames = ["January", "February", "March", "April", "May", "June",
	  "July", "August", "September", "October", "November", "December"
	];
	$('#submit_button').hide();
	$('#collect').click(function(e) {
		$('#submit_button').show();
		var text = $('#collections-account_id option:selected').text();		
		var val = $('#collections-account_id option:selected').attr('value');	
		var d = $('#collection_date').val();
		//alert(text +" "+ val);
		
		if(text == "Select Account")
		{
			return false;
		}
		
		d = new Date(d);
		
		d = d.getFullYear() + "-" + d.getMonthFormatted();
		
		var newT = template.replace("##id##", count);
		newT = newT.replace("##id##", count);
		newT = newT.replace("##id##", count);
		newT = newT.replace("##id##", count);
		newT = newT.replace("##id##", count);
		newT = newT.replace("##acno##", text);
		newT = newT.replace("##amount##", val);
		newT = newT.replace("##acno##", text);
		newT = newT.replace("##amount##", val);
		newT = newT.replace("##date##", d);
		
		if(count == 0)
		{
			$('#account-list').html(newT);
		}
		else
		{
			$('#account-list').append(newT);
		}
		
		$('.date_input').datepicker({
			format: 'yyyy-mm'
		}).on('changeDate', function(ev){
			var t = new Date(ev.date);
			$(this).val(t)
			$(this).datepicker('hide')
		});
		
		count++;
    });
	
	$('td').hover(function() {
		var t = parseInt($(this).index()) + 1;
		$('td:nth-child(' + t + ')').addClass('highlighted');
	},
	function() {
		var t = parseInt($(this).index()) + 1;
		$('td:nth-child(' + t + ')').removeClass('highlighted');
	});
});
