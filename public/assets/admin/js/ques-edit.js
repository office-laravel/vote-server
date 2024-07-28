var urlval = "";

$(document).ready(function () {

	$('#btn_add_option').on('click', function () {

		var $divclon = $('#main-op').clone().prop('id', 'divoption_' + i).addClass('dynamicdiv').show();
		var inputsubid='op_content';
var inpid=inputsubid+'_' + i;
		// $divclon.children(':input').first().prop('id', inpid)
		// 	.prop('name', 'op_content' + '[' + i + ']')
		// 	.prop('value', '') ;
			$divclon.find('.num-span').html( i+'-');
		//	$divclon.children(':input').first().attr("placeholder","Placeholder text");
		$divclon.find(".inputtxt").attr("placeholder", "الخيار "+i).prop('id', inpid)
		.prop('name', inputsubid + '[' + i + ']')
		.prop('value', '');
		//$('#divoption').after( $divclon);
		$('#option-container').append($divclon);
		i++;
	});
 //with image
 $('#btn_img_add_option').on('click', function () {

	var $divclon = $('#img-main-op').clone().prop('id', 'divoption_' + im).addClass('dynamicdiv').show();
	var inputsubid='img_op_content';
var inpid=inputsubid+'_' + im;

	// $divclon.children(':input').first().prop('id', inpid)
	// 	.prop('name', 'op_content' + '[' + i + ']')
	// 	.prop('value', '') ;
		$divclon.find('.img-num-span').html( im+'-');
	//	$divclon.children(':input').first().attr("placeholder","Placeholder text");
	$divclon.find(".inputimg").attr("placeholder", "الخيار "+im).prop('id', inpid)
	.prop('name', inputsubid + '[' + im + ']')
	.prop('value', '');
	$divclon.find(".imageicon").prop('id', 'imgshow-' + im);

	$divclon.find(".input-file-op").prop('id', 'image-op-' + im).prop('name', 'img_op' + '[' + im + ']');
	 
	//$('#divoption').after( $divclon);
	$('#image-div-container').append($divclon);
	im++;
});
	$('.btn-submit').on('click', function (e) {
		e.preventDefault();
		var formid = $(this).closest("form").attr('id');
		sendform('#' + formid);
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

	// $('.imageicon').click(function() {
	// 	$('#image-op').click();
	//   });
// 	$(document).on('click', '.imageicon', function() {
// 		// This will work!
//   });
	   // عند النقر على أي صورة
	   $(document).on('click', '.imageicon', function() {
        // احصل على عنصر الإدخال الملف الأقرب إلى الصورة
        var inputFile = $(this).closest('.form-group').find('.input-file-op');

        // محاكاة النقر على عنصر الإدخال الملف
        inputFile.click();
    });

    // عندما يتم تغيير ملف الإدخال
	$(document).on('change', '.input-file-op', function() {
 
        // احصل على الملف المختار
        var file = this.files[0];
        var imgTag = $(this).closest('.form-group').find('img');

        // استخدم FileReader لعرض الصورة الجديدة
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                // عرض الصورة الجديدة
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