// TinyMce Editor
$(document).ready(function(){
	tinymce.init({
		selector: "textarea.editme"
	});

	// Hide preview pane of image
	$("#preview").hide();


	// Fadeout sometext after 5sec;
	setTimeout(fadeout,5000);
	function fadeout(){
		$(".alert").fadeOut(200);
	}

	// Show epaper image in modal
	$("#epaperimage-row td").on('click','img',function(){
		console.log('Hello');
	});

}); // End Document.Ready

// Preview Image
function readURL(input){
if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
        $('#preview').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
	}
}
$("#newsimg").change(function(){
    readURL(this);
    $("#preview").show();
});