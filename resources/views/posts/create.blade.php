
@extends('layouts.app')
<style>
    .image-preview{
        width:200;
        min-height: 200px;
        border: 2px solid #dddddd;
        margin-top: 15px;

        /*Default text */
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: #cccccc;
    }
    .image-preview__image{
        display: None;
        width: 100%;

    }
</style>
@section('content')
<div class="container">
<form method="post" action="/p" enctype="multipart/form-data">
@csrf
    <div class="col-8 offset-2">
        <div class="form-group row">

            <label for="caption" class="col-md-4 col-form-label">Post caption</label>

            <input id="caption" type="caption" class="form-control @error('caption') is-invalid @enderror" name="caption"  autocomplete="new-caption">

            @error('caption')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <label for="image" class="col-md-4 col-form-label">Post Image</label>

        <input type="file" class="form-control @error('image') is-invalid @enderror"  id="inpFile"  name="image">
        <div class="image-preview" id="imagePreview">
            <img src="" alt="Image Preview" class="image-preview__image" >        
            <span class="image-preview__default-text">Image Preview</span>
        </div>

        @error('image')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <div class="pt-4">
        <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    </div>
</form>
</div>
<script>
    const inpFile = document.getElementById("inpFile");
    const previewContainer = document.getElementById("imagePreview");
    const previewImage = previewContainer.querySelector(".image-preview__image");
    const previewDefaultText = previewContainer.querySelector(".image-preview__default-text");

    inpFile.addEventListener("change", function(){
        const file = this.files[0];

       if (file) {
           const reader = newFileReader();

           previewDefaultText.style.display = "none";
           previewImage.style.display = "block";

           reader.addEventListener("Load", function() {
               previewImage.setAttribute("src", this.result);

           });
           reader.readAsDataUrl(file);
       } else{
        previewDefaultText.style.display = "null";
           previewImage.style.display = "null";
           previewImage.setAttribute("src", "");
       }
    })
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection
