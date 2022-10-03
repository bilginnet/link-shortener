<x-layouts.main>
    <div class="grid grid-cols-1 md:grid-cols-2">
        <div class="p-6">
            <form method="POST" action="/login">
                @csrf
                <div>
                    <label style="color: white">Email:</label>
                    <input type="text" name="email" aria-label="Email">
                </div>
                <div>
                    <label style="color: white">Password:</label>
                    <input type="password" name="password" aria-label="Password">
                </div>

                <button type="submit" style="padding: 8px">Login</button>
            </form>

            <hr>
            @if ($errors->any())
                <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            @endif
        </div>
    </div>
</x-layouts.main>
