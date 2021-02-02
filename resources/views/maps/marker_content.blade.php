@if ($marker)
    <div class="marker_content">
        <h2 class="title">Info about marker</h2>
        <div class="marker_info">
            <ul>
                <div class="block_info_part">
                    <label for="lat" class="label_marker">Latitude: </label>
                    <li id="lat" class="marker_props">{{ $marker->lat }}</li>
                </div>
                <hr/>
                <div class="block_info_part">
                    <label for="long" class="label_marker">Longitude: </label>
                    <li id="long" class="marker_props">{{ $marker->lng }}</li>
                </div>
                <hr/>
                <div class="block_info_part">
                    <label for="creator_name" class="label_marker">Created by: </label>
                    <li id="creator_name" class="marker_props">{{ $marker->user->name }}</li>
                </div>
                <hr/>
                <div class="block_info_part descr_block">
                    <label for="descr" class="label_marker">Place description: </label>
                    <li id="descr" class="marker_props">{{ $marker->descr }}</li>
                </div>
                <hr/>
                @if ($marker->img)
                    <div class="block_info_part descr_block">
                        <label for="img" class="label_marker">Image of this place: </label>
                        <li id="img" class="marker_props">
                            <img src="{{ asset(config('settings.theme')) }}/images/markers/{{ $marker->img }}">
                        </li>
                    </div>
                @endif
            </ul>
        </div>

        <!-- Comments -->
        <div id="comments" class="{{($marker->img) ? 'comments_margin_top' : ''}}">
            <h3 id="comments-title">
                <span>{{ count($marker->comments) }}</span> {{ trans_choice('en.comments', count($marker->comments)) }}    
            </h3>
            <hr/>
            @if (count($marker->comments) > 0)
                <ol class="commentlist group">
                    @foreach ($comments as $comment)

                        @include(config('settings.theme').'.comment', ['item' => $comment])

                    @endforeach
                </ol>
            @endif
            <div id="comment_form">
                <h3>Post your comment</h3>
                <hr/>
                <form action="{{ route('comment') }}" method="post" id="commentform">
                    @csrf
                    <p class="comment-form-author"><label for="author">Name:</label> <input id="name" name="name" type="text" value="{{ isset(Auth::user()->name) ? Auth::user()->name : '' }}" size="30" aria-required="true" /></p>
                    <p class="comment-form-email"><label for="email">Email:</label> <input id="email" name="email" type="text" value="{{ isset(Auth::user()->email) ? Auth::user()->email : '' }}" size="30" aria-required="true" /></p>
                    <div class="comment-form-comment">
                        <label for="comment">Your comment</label>
                        <textarea id="comment" name="text" cols="45" rows="8"></textarea>
                    </div>
                    <input id="comment_post_ID" type="hidden" name="comment_post_ID" value="{{ $marker->id }}"/>
                    <input id="comment_user_ID" type="hidden" name="comment_user_ID" value="{{ isset(Auth::user()->id) ? Auth::user()->id : null }}"/>
                    <button name="submit" type="submit" id="submit" class="btn btn-primary">Post Comment</button>
                </form>
            </div>
        </div>
    </div> 
@endif
