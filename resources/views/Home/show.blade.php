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


                <div class="blog-container">
                    <div class="blog-content">
                        <div class="blog-header">
                            <div>
                                <img src="{{$blog->getFirstMediaUrl('cover')}}">
                            </div>
                            <div class="blog-title">
                             
                                <div>
                                    created at : {{$blog->created_at->format('Y-m-d')}}
                                </div>
                                <div>
                                    {{$blog->title}} 
                                </div>
                            </div>
                        </div>
                        <div class="blog-edit">
                            <a href="{{route('home.edit',$blog->id)}}">
                             <button type="button">
                                Edit blog   
                             </button>    
                            </a>    
                        </div>  
                        <div class="blog-content-text-editor">
                            {!! $blog->content !!}
                        </div>
                        
                    </div>
                </div>

                <div class="comments-container" data-id="{{$blog->id}}">
                    <div class="comments-content">
                        <ul class="comments-list-items">
                          
                            @forelse ($blog->comments as $comment)
                            <li class="comments-list-item">
                               
                                <div class="delete">
                                    <form action="" method="POST">
                                        <button type="submit">
                                            <i class="ri-delete-bin-6-line"></i>
                                        </button>
                                    </form>
                                </div>
                                <div>
                                    {{$comment->content}}
                                </div>
                            </li>
                            @empty
                            <li class="comments-list-item">
                                no comment
                            </li>
                            @endforelse
                           
                            <div class="comments-list-items-form">
                                <form action="{{route('comments.store')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="post_id" id="post_id" value="{{$blog->id}}">
                                    <div class="form-input">
                                        <input type="text" name="content" id="content" placeholder="Write comment...">
                                    </div>
                                    <div class="form-input">
                                        <button type="submit">
                                            <i class="ri-send-plane-2-line"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </ul>
                    </div>
                </div>
        </div>
    </div>
    @push('script')
        <script src="{{asset('assets/js/home.js')}}"></script>
        <script src="{{asset('assets/js/jquery/home.js')}}"></script>
    @endpush
</x-Layout.Layout>