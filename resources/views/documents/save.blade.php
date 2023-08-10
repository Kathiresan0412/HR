<div class="mb-3">
<form action="empdocs-save">
<label for="image_1" class="form-label">Image 1 <strong style="color:red">*</strong></label>
<input type="file" class="form-control @error('image_1') is-invalid @enderror" name="image_1" id="image_1" accept="image/*" />
@error('image_1')
<span class="error invalid-feedback mb-2" role="alert">
    <strong>{{ $message }}</strong>

    <?php
    if ($request->hasFile('image_1')) {
        $image = $request->file('image_1');
        $fileName = time() . '.' . $image->getClientOriginalExtension();
        

        $img = Image::make($image->getRealPath());
        $img->resize(1500, null, function ($constraint) {
            $constraint->aspectRatio();                 
        });
        $img->stream();

       Storage::disk('local')->put('public/Projects'.'/'.$fileName, $img, 'public');
        $project->image_1 = $fileName;
     ?>   
    </form>
</div>