<html>
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<style>
	#file-image{
		height: 150px;
		width: 150px;
	}
	.hidden{
		display: none;
	}
	form{
		margin: auto;
		max-width: 1000px;
	}
	.row{
		margin-top: 20px;
		display: flex;align-items: center;justify-content: flex-start;
		
	}
	.inside-row{
		min-width: 50%;
	}
	input,select{
		margin-right: 20px;	
		min-height: 30px;		
		width: 90%;	
	}

	textarea{
		margin-right: 20px;	
		min-height: 30px;		
		width: 190%;	
		height: 300px;
	}
	.heading{
		padding:20px;

		font-size:20px;
	}
	button,h5{
		margin: 20px;
		margin-left: 40%;	
		padding: 10px;
		/*width: 100%;*/
	}
</style>
<body>
<form action="/submit" method="POST" enctype="multipart/form-data">
{{csrf_field()}}
@csrf

<h5 class="heading align-left mbr-fonts-style"><strong>Equipo Health</strong></h5>

<div class="row">
	<div class="inside-row">
		<label for="cname">Clinic Name</label>
		<!-- <input type="text" name="CName" id="cname" placeholder="Clinic Name" data-form-field="CName" required="required" class="form-control display-7" value="">		 -->
		<!-- <select id="cname" name="CName" class="form-control display-7" data-form-field="CName" required="required">
        	<option value="">--- Select Name ---</option>
        	@foreach ($LogoArray as $key => $value)
            <option value="{{ $key }}">{{ $value }}</option>
        	@endforeach
    	</select> -->
    	<input name="NameIdValue" id="NameIdValue" type="text">
    	<div style="position: relative;">
  		<select onchange="
  		var NameIdValue = this.options[this.selectedIndex].value;
  		$.ajax({    	
       type:'POST',
       url:'/getlogo',
       data: { 'NameIdValue': NameIdValue, _token: '{{csrf_token()}}' },
       success:function(data) {
       	console.log(data.logoname)
        $('#file-image').removeClass('hidden');
       	$('#file-image').attr('src', '/logo/'+data.logoname);
       }
    });document.getElementById('cname').value=this.options[this.selectedIndex].text; document.getElementById('NameIdValue').value=this.options[this.selectedIndex].value;" style="position:absolute;top:0px;left:0px; height:25px;line-height:20px;margin:0;padding:0;" data-form-field="CName" class="form-control display-7" id="selectoc" name="selectoc" value="">
  			<!-- style="position:absolute;top:0px;left:0px;width:200px; height:25px;line-height:20px;margin:0;padding:0;" 
  			style="position:absolute;top:0px;left:0px;width:183px;width:180px\9;#width:180px;height:23px; height:21px\9;#height:18px;border:1px solid #556;" 
  		 style="position:absolute;top:0px;left:0px;width:87%;height:23px; height:21px\9;#height:18px;"-->
        @foreach ($CNameArray as $key => $value)
        <option onclick="getMessage();" value="{{ $key }}">{{ $value }}</option>
        @endforeach
  		</select>
  		<input style="position:absolute;top:0px;left:0px;width:87%;height:23px; height:21px\9;#height:18px;" onchange="getMessage();" type="text" name="CName" id="cname" placeholder="Clinic Name" onfocus="this.select()" data-form-field="CName" class="form-control display-7" value="">
		</div>
	</div>
	<div class="inside-row">
		<label for="logo">Clinic Logo</label>
		<input id="logo" type="file" name="Logo" accept="image/*" onchange="readURL(this);" data-form-field="Logo" class="form-control display-7" required="required" value="">
        <img id="file-image" name="Logo" src="#" alt="Preview" class="hidden">
        <div id="start" >
            <i class="fa fa-download" aria-hidden="true"></i>
            <!-- <div>Select a file or drag here</div> -->
            <!-- <div id="notimage" class="hidden">Please select an image</div> -->
            <!-- <span id="file-upload-btn" class="btn btn-primary">Select a file</span> -->
            <!-- <br> -->
            <!-- <span class="text-danger">{{ $errors->first('fileUpload') }}</span> -->
        </div>
		<!-- <input type="text" name="Logo" id="logo" placeholder="Clinic Logo" data-form-field="Logo" class="form-control display-7" required="required" value="">		 -->
		<!-- <div style="position: relative;">
  		<select onchange="document.getElementById('logo').value=this.options[this.selectedIndex].text; document.getElementById('logoIdValue').value=this.options[this.selectedIndex].value;" style="position:absolute;top:0px;left:0px; height:25px;line-height:20px;margin:0;padding:0;" data-form-field="Logo" class="form-control display-7" value="">
        @foreach ($LogoArray as $key => $value)
        <option value="{{ $key }}">{{ $value }}</option>
        @endforeach
  		</select>
  		<input style="position:absolute;top:0px;left:0px;width:87%;height:23px; height:21px\9;#height:18px;" type="text" name="Logo" id="logo" placeholder="Clinic Logo" onfocus="this.select()" data-form-field="Logo" class="form-control display-7" value="">
  		<input name="logoIdValue" id="logoIdValue" type="text">
		</div> -->
	</div>
</div>	

<div class="row">
	<div class="inside-row">
		<label for="dname">Physician Name</label>
		<input type="text" name="DName" id="dname" placeholder="Physician Name" data-form-field="DName" class="form-control display-7" required="required" value="">
	</div>
	<div class="inside-row">
		<label for="dcontact">Physician Contact</label>
		<input type="tel" name="DContact" id="dcontact" placeholder="Physician Contact" data-form-field="DContact" required="required" class="form-control display-7" value="">
	</div>
</div>	

<div class="row">
	<div class="inside-row">
		<label for="pfname">Patient First Name</label>
		<input type="text" name="PFName" id="pfname" placeholder="Patient First Name" data-form-field="PFName" required="required" class="form-control display-7" value="">
	</div>
	<div class="inside-row">
		<label for="plname">Patient Last Name</label>
		<input type="text" name="PLName" id="plname" placeholder="Patient Last Name" data-form-field="PLName" class="form-control display-7" required="required" value="">	
	</div>
</div>	
<div class="row">
	<div class="inside-row">
		<label for="pdob">Patient DOB</label>
		<input type="date" name="PDOB" id="pdob" placeholder="Patient DOB" data-form-field="PDOB" class="form-control display-7" required="required" value="">
	</div>
	<div class="inside-row">
		<label for="pcontact">Patient Contact</label>
		<input type="tel" name="PContact" id="pcontact" placeholder="Patient Contact" data-form-field="PContact" class="form-control display-7" required="required" value="">
	</div>
</div>	
<div class="row">
	<div class="inside-row">
		<label for="complaint">Complaint</label>
		<textarea name="Complaint" id="complaint" placeholder="Complaint" data-form-field="Complaint" required="required" class="form-control display-7"></textarea>
	</div>
</div>	
<div class="row">
	<div class="inside-row">
		<label for="consultation">Consultation</label>
		<textarea name="Consultation" id="consultation" placeholder="Consultation" data-form-field="Consultation" required="required" class="form-control display-7"></textarea>
	</div>
</div>	

<button type="submit" name="button" onclick="myFunction()" class="btn btn-success display-4">Generate Report</button>
</form>

<a style="float:right;" href="{{ url('table') }}" target="_blank">View Previous Consultations</a> 
<br><br>
</body>

<script>
function myFunction() {
	setTimeout(function() {
    	window.location = "/index";
  }, 1000);
}

function readURL(input, id) {
	id = id || '#file-image';
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			$(id).attr('src', e.target.result);
		};
		reader.readAsDataURL(input.files[0]);
		$('#file-image').removeClass('hidden');
		$('#start').hide();
	}
} 
// $(document).ready(function(){
// $("#selectoc").onchange(getMessage);
selectoc.addEventListener('change', getMessage);
function getMessage() {
	alert("hhhhhhhh");
    $.ajax({
    	headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
       type:'POST',
       url:'/getlogo',
       data:'_token = <?php echo csrf_token() ?>',
       success:function(data) {
       	// console.log(data);
       	alert("hhhh");
          // $("#file-image").attr('src', data.target.result);
          // $('#file-image').removeClass('hidden');
       }
    });
}
// });
	// location.reload();
// 	$(document).on('submit', 'form', function() {
//   setTimeout(function() {
//     window.location = "/index.blade.php";
//   }, 1000);
// });
</script>
</html>