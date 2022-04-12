var $modal = $('#modal');
// var $profile_image = $('#profile_image');
var image = document.getElementById('image');
var cropper;
$("body").on("change", ".image", function(e){
      var files = e.target.files;
      var done = function (url) {
        image.src = url;
        $modal.modal('show');
        };
      var reader;
      var file;
      var url;
      if (files && files.length > 0) {
        file = files[0];
        if (URL) {
        done(URL.createObjectURL(file));
        } else if (FileReader) {
        reader = new FileReader();
        reader.onload = function (e) {
        done(reader.result);
        };
        reader.readAsDataURL(file);
        }
      }
  });
    $modal.on('shown.bs.modal', function () {
      cropper = new Cropper(image, {
        aspectRatio: 1,
        viewMode: 3,
        preview: '.preview'
      });
    }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
    });


$("#crop").click(function(){
      canvas = cropper.getCroppedCanvas({
        width: 160,
        height: 160,
        type: 'circle'
      });
      canvas.toBlob(function(blob) {
      url = URL.createObjectURL(blob);
      var reader = new FileReader();
      reader.readAsDataURL(blob); 
      reader.onloadend = function() {
      var base64data = reader.result; 
          $.ajax({
          type: "POST",
          dataType: "json",
          url: upload_images,
          data: {'_token': $('meta[name="_token"]').attr('content'), 'image': base64data},
          success: function(data){
          // console.log(data);
          $modal.modal('hide');
          // $profile_image.modal('hide');
          alert("Crop image successfully uploaded");
          location.reload();
          }
        });
      }
  });
})