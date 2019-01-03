@extends('layouts.app')

@section('content')
<h1>Record</h1>
<h3>User{{$user->id-1}}</h3>
    <div>
        @for($i = 1; $i<11; $i++)
            <h4>Test{{$i}}</h4>
            @foreach (\App\UserRecord::where(['userId' => $user->id, 'testId' => $i])->cursor() as $record)
                <li style="margin: 50px 0;">
                    <div>
                        <h5>{{$record->attemptNumber}}</h5>
                        <h5>{{$record->score}}</h5>
                    </div>
                </li>
            @endforeach
        @endfor
    </div>
@endsection
