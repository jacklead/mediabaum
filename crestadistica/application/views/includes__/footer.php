	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="<?php echo base_url().'js/bootstrap-datepicker.js'?>"></script>
	<script src="<?php echo base_url().'/js/locales/bootstrap-datepicker.es.js'?>" charset="UTF-8"></script>
	<script src="<?php echo base_url().'js/app.js'?>"></script>

	<script type="text/javascript" charset="utf-8">
		$('input').click(function(){
			$(this).select();	
		});

	    $("#datepicker").datepicker();
	   
	</script>


</body>
</html>