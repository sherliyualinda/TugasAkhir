@include('nav_barMar')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


 
    <script src="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.js"></script>
    <link href="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.css" rel="stylesheet">

<div id="gantt_here" style='width:100%; height:100%;'></div>
<script type="text/javascript">
    gantt.config.date_format = "%Y-%m-%d %H:%i:%s";
    gantt.config.order_branch = true;
    gantt.config.order_branch_free = true;

    <?php if ($sewa->id_pemilik == Auth::user()->pengguna->id_pengguna){ ?>
        gantt.config.readonly =false;
    <?php }else{ ?>
        gantt.config.readonly =true;
    <?php } ?>

    gantt.init("gantt_here");
    
    gantt.load("/api/data");
    
    var dp = new gantt.dataProcessor("/api");
    dp.init(gantt);
    dp.setTransactionMode("REST");
</script>

<script type="text/javascript">
   
   jQuery(document).ready(function(){
       jQuery("#download").click(function(){
		   screenshot();
	   });
   });

   function screenshot(){
	   html2canvas(document.getElementById("gantt_here")).then(function(canvas){
          downloadImage(canvas.toDataURL(),"UsersInformation.png");
	   });
   }

   function downloadImage(uri, filename){
	 var link = document.createElement('a');
	 if(typeof link.download !== 'string'){
        window.open(uri);
	 }
	 else{
		 link.href = uri;
		 link.download = filename;
		 accountForFirefox(clickLink, link);
	 }
   }

   function clickLink(link){
	   link.click();
   }

   function accountForFirefox(click){
	   var link = arguments[1];
	   document.body.appendChild(link);
	   click(link);
	   document.body.removeChild(link);
   }


</script>

</body>
@endforeach