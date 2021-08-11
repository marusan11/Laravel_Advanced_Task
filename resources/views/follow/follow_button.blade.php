<!--ユーザがログイン認証を通っている場合のみ、ボタンを表示させるようにしています。-->
@if(Auth::check())

    <!--ユーザが自分自身をフォローできないように、自分のIDと一致しないユーザIDに対してのみ、ボタンを表示させています。-->
    @if (Auth::id() != $user->id)

        @if (Auth::user()->is_following($user->id))
        
            {!! Form::open(['route' => ['unfollow', $user->id], 'method' => 'delete']) !!}
                {!! Form::submit('このユーザのフォローを外す', ['class' => "button btn btn-danger mt-1"]) !!}
            {!! Form::close() !!}
            
        @else
        
            {!! Form::open(['route' => ['follow', $user->id]]) !!}
                {!! Form::submit('このユーザをフォローする', ['class' => "button btn btn-primary mt-1"]) !!}
            {!! Form::close() !!}
            
        @endif
    
    @endif

@endif