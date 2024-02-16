<div class="d-flex utama">
    <style>
        .utama {
            background-image: url('../file-image/BgLogin.png');

            /* Full height */
            height: 100vh;
            width: 100%;

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }


        .form:focus {
            outline: 0px;
            border-bottom: #197EC2 solid 2px;
        }

        .form {
            background-color: transparent;
            border-radius: 0%;
            width: 275px;
            height: 40px;
            border: none;
            border-bottom: 2px solid #121212;
        }

        .login-form {
            margin-left: 53px;
            margin-right: 43px;
            width: 20%;
        }

        .btn {
            width: 275px;
            height: 45px;
            background-color: #121212;
            outline: none;
            cursor: pointer;
            transition: color 0.3s;
            border-radius: 10px;
            font-weight: 600;
            color: #ffffff;
            margin-top: 20px;
        }

        .btn:hover {
            color: #ffffff;
            background-color: #197EC2;
        }

        .btn::before {
            /* content: ""; */
            position: absolute;
            border: 2px solid #fff;
            pointer-events: none;
            transition: ease-in-out 4.7s;
            opacity: 0;
        }

        .btn:hover::before {
            opacity: 1;
            /* Ubah opacity menjadi 1 saat dihover */
        }

        label {
            display: none;
        }

        .text-center a {
            color: #197EC2;
            font-weight: 500;
            text-decoration: none;
        }

        small {
            font-weight: 600;
        }

        .username {
            margin-top: 60px;
        }

        input::placeholder {
            padding-bottom: 10px;
            color: #121212;
        }
    </style>
    <div class="my-auto login-form">
        <form wire:submit="authenticate">
            @csrf
            <div class="username">
                <input type="text" wire:model="username" name="username" id="username"
                    class="form @error('username') is-invalid @enderror" placeholder="Username" required autofocus>
                <label for="username"></label>
                @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mt-4">
                <input type="email" wire:model="email" name="email" id="email"
                    class="form @error('email') is-invalid @enderror" placeholder="Email" required>
                <label for="Email"></label>
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mt-4">
                <input type="password" wire:model="password" name="password" id="password" class="form"
                    placeholder="Password" required>
                <label for="Password"></label>
            </div>

            <div class="mt-5">
                <button type="submit" class="btn">Login</button>
            </div>
            <div class="text-center mt-2">
                <small>Belum punya akun? <a href="/register" wire:navigate>Register</a></small>
            </div>
        </form>
    </div>
</div>

{{-- linear-gradient(150deg, rgba(0, 0, 0, 0.14) 0%, rgba(0, 0, 0, 0) 100%) --}}