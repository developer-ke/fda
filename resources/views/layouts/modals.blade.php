<div class="modal modal-md fade" data-bs-backdrop='static' id="confrim_password_modal" aria-hidden="true"
    aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize" id="exampleModalToggleLabel">
                    <i class="fa fa-lock"></i>
                    password
                </h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                    aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('profile.delete') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="password" class="form-check-label text-capitalize">password</label>
                            <div class="input-group input-group-outline">
                                <input id="password" type="password" class="form-control" name="password" required
                                    autocomplete="current-password">
                            </div>
                            @error('password')
                                <span class="text-danger" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn text-white w-100 mt-3 fda-bg">
                                {{ __('confirm your password') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



{{-- view country modal --}}
<div id="viewCountryModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize" id="my-modal-title">country info</h5>
                <button class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <ul class="list-group">
                                <li class="list-group-item border-0 text-sm">
                                    <b class="text-capitalize">country name</b>
                                    <span class="text-capitalize countryName"></span>
                                </li>
                                <li class="list-group-item border-0 text-sm">
                                    <b class="text-capitalize">nationality</b>
                                    <span class="text-capitalize nationality"></span>
                                </li>
                                <li class="list-group-item border-0 text-sm">
                                    <b class="text-capitalize">abbreviation</b>
                                    <span class="text-capitalize abbreviation"></span>
                                </li>
                                <li class="list-group-item border-0 text-sm">
                                    <b class="text-capitalize">country code</b>
                                    <span class="text-capitalize countryCode"></span>
                                </li>
                                <li class="list-group-item border-0 text-sm">
                                    <b class="text-capitalize">created on</b>
                                    <span class="text-capitalize createdAt"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
