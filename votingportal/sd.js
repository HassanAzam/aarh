$('#validatecnic').hide();
		$('#e').hide();
		$('#prgif').hide();
		$('#castvote').hide();
		
		$('#v').click(function(){
			
			$('#startvoting').slideToggle(function(){
				$('#validatecnic').slideDown();
			});
			
		});
		
		function getVoterName(cnic)
		{
			$("select").imagepicker();
			$.ajax({
					   type: "POST",
					   url: '../admin/scripts/voter.php',
					   data: { action : 'getvotername', cnic : cnic},
					   success: function(data)
					   {
						   
						   $('#vname').text('Welcome, ' + data);
					   }
				 });
		}
		
		$('#vald').click(function(){
			
						
			var cnic = $('#cnic').val();
			var pollid = $('#pollid').text();
			alert('valid function');
			
			if(cnic == ''){
				$('#e').html('Please provide CNIC number');
				$('#e').show().delay(2000).fadeOut();
			}
			else{
				$('#prgif').show();
				$.ajax({
					   type: "POST",
					   url: '../admin/scripts/voter.php',
					   data: { action : 'cnicexist', cnic : cnic, pollid : pollid}, // serializes the form's elements.
					   success: function(data)
					   {
						   
						   $('#prgif').hide();
							if(data==0)
							{
								$('#e').html('CNIC number is not in VoterList!');
								$('#e').show().delay(2000).fadeOut();
							} 
							else if(data==1){
																
								$('#validatecnic').slideToggle(function(){
									$('#castvote').slideDown();
									getVoterName(cnic);
								});
							}
							else if(data==2){
																
								$('#e').html('You cannot vote in this pollingstation!');
								$('#e').show().delay(2000).fadeOut();
							}
							console.log(data);
					   }
				 });
			}
			
		});

	$('#castvote').click(function(){
			
			alert('cast vote fn');
			var cnic1 = $('#cnic').val();
			var pollid1 = $('#pollid').text();
			var partyid = $('#selectImage').val();

			$.ajax({
					   type: "POST",
					   url: '../admin/scripts/vote.php',
					   data: { action : 'addvote', cnic : cnic1, pollid : pollid1, partyid : partyid}, // serializes the form's elements.
					   success: function(data)
					   {
						   
						   
							if(data==1)
							{
								$('#e').html('Your Vote has been casted successfully!');
								$('#e').show().delay(2000).fadeOut();
								$('#castvote').slideToggle(function(){
									$('#validatecnic').slideDown();
								});
							} 
							else{
																
								$('#e').html('There's some error in casting your vote! Please try again');
								$('#e').show().delay(2000).fadeOut();
							}
							
					   }
				 });

		});

});