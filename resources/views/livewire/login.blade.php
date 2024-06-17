<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5 mx-15">
                    <div class="card-body p-0">
                        <div class="row flex justify-center items-center">
                            <div class="col-lg-5 d-lg-block bg-login-image flex justify-center items-center">
                                <img class="flex-wrap flex" src="{{url('/img/login.png')}}" alt="login" loading="lazy">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-black font-semibold mb-4">Selamat Datang!</h1>
                                    </div>
                                    <form class="user" wire:submit="login">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user @error('username') is-invalid @enderror"
                                                   placeholder="Username" wire:model.blur="username">
                                            @error('username')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" placeholder="Password" wire:model.blur="password">
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block" type="submit">
                                            Login
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
