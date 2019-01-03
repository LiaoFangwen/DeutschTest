
    <div id="title" style="text-align: center;">
        <h1>Test Catalog</h1>
        <div style="padding: 5px; font-size: 16px;">Test Catalog</div>
    </div>
    <hr>
    <div id="content">
        <ul>
            @foreach ($tests as $test)
                <li style="margin: 50px 0;">
                    <div class="title">
                        <a href="{{ url('test/'.$test->id) }}">
                            <h4>{{ $test->testName }}</h4>
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>