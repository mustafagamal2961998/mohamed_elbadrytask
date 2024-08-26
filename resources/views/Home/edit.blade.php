<x-Layout.Layout title="{{$blog->title}}">
    @push('style')
        <link rel="stylesheet" href="{{asset('assets/css/home.css')}}">
    @endpush
    <div class="home-container">
        <div class="home-content">
                <div class="home-header">
                    <div class="profile-data">
                        {{auth()->user()->name}}
                    </div>
                    <div>
                        <a href="{{route('home.index')}}">
                            <button type="button">
                               Home 
                            </button>
                        </a>
                    </div>
                
                </div> 

    
                  <div class="create-blog">

                        <form action="{{route('home.update',$blog->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @include('Home._form',['btn_text'=>'Update','blog'=>$blog])
                        </form>
                        
                  </div>  

        </div>
    </div>
    @push('script')
        <script src="https://cdn.tiny.cloud/1/1zf7d3cm6ok7sf45uyk62f4412dwvzizt35nsk345a05ia93/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
        <script src="{{asset('assets/js/home.js')}}"></script>
        <script src="{{asset('assets/js/jquery/home.js')}}"></script>
    @endpush
</x-Layout.Layout>