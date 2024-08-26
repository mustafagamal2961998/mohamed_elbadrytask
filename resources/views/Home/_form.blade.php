<div class="form-input-container">
    <div class="form-input">
   
        <input type="text" name="title" id="title" placeholder="Title" value="{{old('title',$blog->title)}}">
        @error('title')
            <div>
                {{$message}}
            </div>
        @enderror
    </div>
    <div class="form-input">
        <label for="cover">
            @if($blog->hasMedia('cover'))
                    <img class="cover-preview" src="{{$blog->getFirstMediaUrl('cover')}}" alt="Image">
            @else
                    <img class="cover-preview" src="https://placehold.co/500x200">
            @endif

        </label>
        <input type="file" name="cover" id="cover">
        @error('cover')
            <div>
                {{$message}}
            </div>
        @enderror
    </div>
    <div class="form-input">
    
       <textarea name="content" id="content" placeholder="Content">{{old('content',$blog->content)}}</textarea>
       @error('content')
           <div>
               {{$message}}
           </div>
       @enderror
    </div>
    
    <div class="form-input">
       <button type="submit">{{$btn_text}}</button>
    </div>

</div>