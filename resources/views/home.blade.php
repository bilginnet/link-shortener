<x-layouts.main>

    <div class="grid grid-cols-1 md:grid-cols-2">
        <div class="p-6">
            <form method="POST" action="{{ route('link.generate') }}">
                @csrf
                <div>
                    <label style="color: white">Please Enter Your URL</label>
                    <input type="text" name="url" aria-label="Url">
                </div>

                <button type="submit" style="padding: 8px">Generate Shorten Link</button>
            </form>
        </div>
    </div>

    @if (isset($links) && count($links))
        <div class="grid grid-cols-1 md:grid-cols-2">
            <div class="p-6">
                <h5>Your links in storage</h5>
                <table class="table table-bordered table-sm" style="color: white">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Short Link</th>
                        <th>Url</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($links as $link)
                        <tr>
                            <td>{{ $link->id }}</td>
                            <td><a href="{{ route('link.shorten', $link->code) }}" target="_blank">{{ route('link.shorten', $link->code) }}</a></td>
                            <td>{{ $link->url }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    @isset($last)
        <div class="grid grid-cols-1 md:grid-cols-2">
            <div class="p-6" style="color: white">
                <h5>Your link has been shortened</h5>
                <ul>
                    <li><a href="{{ route('link.shorten', $last['code'] ) }}" target="_blank">{{ route('link.shorten', $last['code']) }}</a></li>
                    <li>{{ $last['url'] }}</li>
                </ul>

            </div>
        </div>
    @endisset

</x-layouts.main>
