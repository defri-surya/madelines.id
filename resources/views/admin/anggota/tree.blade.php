<ul>
    <li>
        <a href="#">
            <div class="member-view-box">
                <div class="member-image">
                    <img src="{{ asset('assets') }}/images/users.png" alt="Member">
                    <div class="member-details">
                        <h3>
                            <strong>{{ $node['user']['name'] }}</strong>
                            <br>
                            <strong>{{ $node['user']['referal'] }}</strong>
                            <br>
                            (<strong>Level {{ $node['user']['level'] }}</strong>)
                        </h3>
                    </div>
                </div>
            </div>
        </a>

        @if (isset($node['user']['children']) && is_array($node['user']['children']) && count($node['user']['children']) > 0)
            <ul class="active">
                @foreach ($node['user']['children'] as $child)
                    <li>
                        <a href="{{ url('member-detail/' . $child['user']['referal'] . '/?ref=' . request('ref')) }}">
                            <div class="member-view-box">
                                <div class="member-image">
                                    <img src="{{ asset('assets') }}/images/users.png" alt="Member">
                                    <div class="member-details">
                                        <h3>
                                            <strong>{{ $child['user']['name'] }}</strong>
                                            <br>
                                            <strong>{{ $child['user']['referal'] }}</strong>
                                            <br>
                                            (<strong>Level {{ $child['user']['level'] }}</strong>)
                                            @if (isset($child['user']['children']) && is_array($child['user']['children']) && count($child['user']['children']) > 0)
                                                <br>
                                                (<strong>{{ count($child['user']['children']) }} Anggota</strong>)
                                            @endif
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </li>
</ul>
