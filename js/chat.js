	var last_time=0;
		//листает вверх сообщения
		$(window).onload=function(){($('#messages').scrollTop($('#messages')[0].scrollHeight))};

		
		function sendText(){
			$('#writehere')[0].onkeydown=function(e){
				if (e.keyCode==13){
					e.preventDefault();
					if (this.value){
						var datatosend={"text":this.value};
						$.ajax({
							type:"POST",
							url:"chat.php",
							data:datatosend,
							datatype:"json",
							success:function(data){}
						})
						this.value='';
					}
				}
			}
		}
		
		function checkText(){
			$.ajax({
				type:"POST",
				url:"chat.php",
				data:{time:last_time},
				datatype:"json",
				success:function(data){
					if (data){
						data=JSON.parse(data);
						for (var i=0; i<data.length; i++){
							$('#messages').append('<p>'+ (setDateTime(data[i].TIME)) + ' ' + data[i].USER + ':'+ ' ' +data[i].MESSAGE +'</p>');
						}
						last_time=Date.now()/1000;
						$('#messages').scrollTop($('#messages')[0].scrollHeight);
					}
					checkText();
				}
			});					
		}	
		

		
		function setDateTime(timedate){
			var tempdate=new Date(timedate*1000),
			date=TwoDigits(tempdate.getDate()),
			month=TwoDigits(tempdate.getMonth()+1),
			year=tempdate.getFullYear(),
			hours=TwoDigits(tempdate.getHours()),
			mins=TwoDigits(tempdate.getMinutes()),
			sec=TwoDigits(tempdate.getSeconds());
			return (year+'-'+month+'-'+date+' '+hours+':'+mins+':'+sec );
		}
		
		function TwoDigits(number){
			return (number<10 ? '0' : '') + number;
		}

		
		sendText();
		checkText();
		
		