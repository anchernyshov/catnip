<div>
    <form wire:submit.prevent="submit">
        <div>
            <label for="login">Login</label>
            <input type="text" id="login" placeholder="Login" wire:model="login">
            @error('login') <span>{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" placeholder="Password" wire:model="password">
            @error('password') <span>{{ $message }}</span> @enderror
        </div>
        <button type="submit">Login</button>
        @error('result') <span>{{ $message }}</span> @enderror
    </form>
</div>
