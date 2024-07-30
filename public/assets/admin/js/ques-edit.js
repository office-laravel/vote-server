var urlval = "";

$(document).ready(function () {
	$('#btn_add_option').on('click', function () {
		var $divclon = $('#main-op').clone().prop('id', 'divoption_' + i).addClass('dynamicdiv').show();
		var inputsubid='op_content';
var inpid=inputsubid+'_' + i;	 
			$divclon.find('.num-span').html( i+'-');
	 
		$divclon.find(".inputtxt").attr("placeholder", "الخيار "+i).prop('id', inpid)
		.prop('name', inputsubid + '[' + i + ']')
		.prop('value', '');
	 
		$('#option-container').append($divclon);
		i++;
	});
 //with image
 $('#btn_img_add_option').on('click', function () {
	var $divclon = $('#img-main-op').clone().prop('id', 'divoption_' + im).addClass('dynamicdiv').show();
	var inputsubid='img_op_content';
var inpid=inputsubid+'_' + im;
 
		$divclon.find('.img-num-span').html( im+'-');
 
	$divclon.find(".inputimg").attr("placeholder", "الخيار "+im).prop('id', inpid)
	.prop('name', inputsubid + '[' + im + ']')
	.prop('value', '');
	$divclon.find(".imageicon").prop('id', 'imgshow-' + im);

	$divclon.find(".input-file-op").prop('id', 'image-op-' + im).prop('name', 'img_op' + '[' + im + ']');
 
	$('#image-div-container').append($divclon);
	im++;
});
	$('.btn-submit').on('click', function (e) {
		e.preventDefault();
		var formid = $(this).closest("form").attr('id');
		sendform('#' + formid);
	});
	//delet one answer
	$('.btn-del-ans').on('click', function (e) {
	 
		var ansid = $(this).attr('id');
		 var button=$(this);
		ansid = ansid.replace("ans-","");
		 
		senddelform(ansid,button);
	});
	
	$('#btn_reset').on('click', function (e) {
		e.preventDefault();
		var formid = $(this).closest("form").attr('id');
		resetForm(formid);
		ClearErrors();
	});
	function ClearErrors() {
		$("." + "error").html('').hide();
		$('.parsley-error').removeClass('parsley-error');
	}

	function sendform(formid) {
		ClearErrors();
		var form = $(formid)[0];
		var formData = new FormData(form);
		urlval = $(formid).attr("action");
		$.ajax({
			url: urlval,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,

			success: function (data) {
				if (data.length == 0) {
					noteError();
				} else if (data == "ok") {
					noteSuccess(); 	
				} else {
					noteError();
				}

			}, error: function (errorresult) {
				var response = $.parseJSON(errorresult.responseText);
				noteError();
				$.each(response.errors, function (key, val) {
					$("#" + "info-form-error").append('<li class="text-danger">' + val[0] + '</li>');
					$("#" + key + "-error").text(val[0]).show();
					$("#" + key).addClass('parsley-error');
				});

			}, finally: function () {		 

			}
		});
	}
	function senddelform(ansid,button) {
		//ClearErrors();
		var form = $("#del_form")[0];
		var formData = new FormData(form);

	var	ansurl = $("#del_form").attr("action");
	ansurl=	ansurl.replace("itemid",ansid);
		$.ajax({
			url: ansurl,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,

			success: function (data) {
				if (data.length == 0) {
					//noteError();
				} else if (data == "ok") {
					//noteSuccess(); 
delimg(button);
				} else {
					noteError();
				}

			}, error: function (errorresult) {
				var response = $.parseJSON(errorresult.responseText);
				noteError();
				 

			}, finally: function () {		 

			}
		});
	}

 
	   $(document).on('click', '.imageicon', function() {
         
        var inputFile = $(this).closest('.form-group').find('.input-file-op');
 
        inputFile.click();
    });

   
	$(document).on('change', '.input-file-op', function() {
 
         
        var file = this.files[0];
        var imgTag = $(this).closest('.form-group').find('img');

        
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                
                imgTag.attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        }
    });
	$('#type').on('change', function () {
		var option = $(this).find(":selected").val(); 
		 
		if (option == 'text') {		 
			$('#image-container').hide();	
			$('#text-container').show();	
		} else {
			$('#image-container').show();	
			$('#text-container').hide();		 
		}
	
	});

	function showByType() {
		var option = $('#type').find(":selected").val(); 
		 
		if (option == 'text') {		 
			$('#image-container').hide();	
			$('#text-container').show();	
		} else {
			$('#image-container').show();	
			$('#text-container').hide();		 
		}
	}
	showByType();
	function delimg(button) {
		$(button).parent().parent().remove();
		im--;
	   var j=1;
	   $('.img-num-span').each( function () {		
		  $(this).text(j+'-');
		  j++;
	  });
	   j=1;
	  $('.inputimg').each( function () {		
		  $(this).attr("placeholder", "الخيار "+j);
		  j++;
	  });
	
	  
	}
});
function delsort(button) {
	  button.parentNode.parentNode.remove();	 
	 i--;
	 var j=1;
	 $('.num-span').each( function () {		
		$(this).text(j+'-');
		j++;
	});
	 j=1;
	$('.inputtxt').each( function () {		
		$(this).attr("placeholder", "الخيار "+j);
		j++;
	});
 
	function delimg(button) {
		button.parentNode.parentNode.remove();	 
		im--;
	   var j=1;
	   $('.img-num-span').each( function () {		
		  $(this).text(j+'-');
		  j++;
	  });
	   j=1;
	  $('.inputimg').each( function () {		
		  $(this).attr("placeholder", "الخيار "+j);
		  j++;
	  });
	
	  
	}
	
}
function delimgsort(button) {
	button.parentNode.parentNode.remove();	 
	im--;
   var j=1;
   $('.img-num-span').each( function () {		
	  $(this).text(j+'-');
	  j++;
  });
   j=1;
  $('.inputimg').each( function () {		
	  $(this).attr("placeholder", "الخيار "+j);
	  j++;
  });

  
}
///////////////////////////////////////////////////////
function noteSuccess() {
	swal("تم الحفظ بنجاح");
}
function noteError() {
	swal("لم يتم الحفظ");
}
function resetForm(formid) {
	formid = "#" + formid;
	jQuery(formid)[0].reset();
	$('#image_label').text("Choose File");
	 
	$('#imgshow').attr("src", "");
 
}