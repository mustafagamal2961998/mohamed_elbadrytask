<x-Layout.Layout title="Home">
    @push('style')
        <link rel="stylesheet" href="{{asset('assets/css/home.css')}}">
    @endpush
    <div class="home-container">
        <div class="home-content">
            <div class="alert-error-message">
                @error('content')
                <div>{{$message}}</div>
                @enderror
                @error('post_id')
                <div>{{$message}}</div>
                @enderror
            </div>

                <div class="home-header">
                    <div class="profile-data">
                        {{auth()->user()->name}}
                    </div>
                    <div>
                        <a href="{{route('home.create')}}">
                            <button type="button">
                               Add Blog
                            </button>
                        </a>
                    </div>
                   
                </div> 


                <div class="wrap">
                    @foreach ($blogs as $blog)
                        
                        <div class="article" style="background-image: url({{$blog->getFirstMediaUrl('cover')}});   
                        background-size: cover;
                        background-position: center;
                        background-repeat: no-repeat;
                        width: 100%;
                        height: 300px;">

                     

                            
                            @if(auth()->id() == $blog->user_id)
                            <div class="delete-blog">
                                <form action="{{route('home.destroy',$blog->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">
                                        <i class="ri-delete-bin-6-line"></i>
                                    </button>
                                </form>
                            </div>
                            @endif
                            <div class="view-blog">
                                <a href="{{route('home.show',$blog->id)}}">
                                    <button type="button">
                                        View blog
                                    </button>
                                </a>
                            </div>

                            <a href="{{route('home.show',$blog->id)}}">
                                <div class="overlay"></div>
                            </a>
                            <div class="wrap-cat">
                                <span class="cat" data-hover="{{$blog->title}}">
                                    {{$blog->title}}
                                </span>
                            </div>
                                <h1>
                                    <div>
                                        <span>
                                            {!! $blog->content !!}
                                        </span>
                                    </div>
                                </h1>
                           
                        </div>
                  
                    @endforeach
                </div>
        </div>
    </div>
    @push('script')
        <script src="{{asset('assets/js/home.js')}}"></script>
        <script src="{{asset('assets/js/jquery/home.js')}}"></script>
    @endpush
</x-Layout.Layout>