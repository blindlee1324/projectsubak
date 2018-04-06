<div class="dim-layer" id="anno-create">
    <div class="dimBg"></div>
        <div id="layer2" class="pop-layer">
            <div class="pop-container">
                <div class="pop-conts">
                    <label for="create-anno">{{ trans('forum.annotations.annotation_starting') }}</label>
                    <div class="btn-r">
                        <form action="{{ route('annotations.store') }}" method="POST">
                        <button type="submit" class="btn btn-primary create">{{ trans('forum.annotations.create') }}</button>
                        <a href="{{ url()-> current() }}" class="btn btn-default cancel">{{ trans('forum.annotations.cancel') }}</a>
                        </form> 
                </div>
            </div>
        </div>
    </div>
</div>


<!-- **** 내용 작성 **** -->
<div class="dim-layer" id="anno-edit">
    <div class="dimBg"></div>
    <div id="layer2" class="pop-layer">
        <div class="pop-container">
            <div class="pop-conts">
                <!--content //-->
                    <div class="form-group">
                        <label for="anno_content">{{ trans('forum.annotations.content') }}</label>
                      <textarea rows="10" cols="40" name="anno_content" class="form-control"></textarea>
                    </div>
                    <div class="btn-r">
                        <!--<button type="submit" class="btn btn-primary">
                            {{ trans('forum.annotations.store') }}
                        </button>-->
                        <button class="btn btn-primary update">{{ trans('forum.annotations.update') }}</button>
                        <a href="{{ url()->current() }}" class="btn btn-default cancels">{{ trans('forum.annotations.cancel') }}</a>
                    </div>
                <!--// content-->
            </div>
        </div>
    </div>
</div>

<div class="dim-layer" id="anno-show">
    <div class="dimBg"></div>
    <div id="layer2" class="pop-layer">
        <div class="pop-container">
            <div class="[ info-card-header ]">
                <h4 name="user_name"></h4>
                <h5 name="user_email"></h5>
            </div>
            <div class="pop-conts">
                <!--content //-->
                    <div class="form-group">
                        <label for="anno_show">{{ trans('forum.annotations.content') }}</label>
                        <div rows="10" cols="40" name="content__annotation" style="height:200px; overflow-y: scroll; border: 1px solid #cdcdcd; border-color: rgba(0,0,0,.15); border-radius: 10px;"></div>
                    </div>
                    <div class="btn-r">
                        <!--<button type="submit" class="btn btn-primary">
                            {{ trans('forum.annotations.store') }}
                        </button>-->
                        <button class="btn btn-primary edit">{{ trans('forum.annotations.edit') }}</button>
                        <button class="btn btn-default destroy">{{ trans('forum.annotations.destroy') }}</button>
                    </div>
                <!--// content-->
                 <h4>
                    {{ trans('forum.comments.title') }}
                  </h4>
                </div>
                <div class="form__new__comment">
                  @if($currentUser)
                    @include('comments.partial.create')
                  @else
                    @include('comments.partial.login')
                  @endif
                </div>
                <div class="list__comment">
                  @forelse($comments as $comment)
                    @include('comments.partial.comment', [
                      'parentId' => $comment->id,
                      'isReply' => false,
                      'hasChild' => $comment->replies->count(),
                      'isTrashed' => $comment->trashed(),
                    ])
                  @empty
                  @endforelse
                </div>
            </div>
        </div>
    </div>
</div>