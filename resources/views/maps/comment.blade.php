<li id="li-comment-{{$item->id}}" class="one_comment">
    <div id="comment-{{ $item->id }}" class="comment_container">
        <div class="comment_author">
            <img alt="" src="https://www.gravatar.com/avatar/{{isset($item->email) ? md5($item->email) : md5($item->user->email)}}?d=mm&s=75" class="avatar" height="75" width="75" />
            <div class="author_name">{{ $item->user ? $item->user->name : $item->name }}</div>                 
        </div>
        <!-- .comment-author .vcard -->
        <div class="comment_data">
            <div class="comment_date">
                {{ is_object($item->created_at) ? $item->created_at->format('F d, Y \a\t H:i') : ''}}</a>                        
            </div>
            <div class="comment_body">
                <p>{{ $item->text }}</p>
            </div>
        </div>
    </div>
</li>
