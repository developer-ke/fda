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

{{-- modal add new user --}}
<div id="modalAddUSer" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize" id="exampleModalToggleLabel">
                    <i class="fa fa-plus-circle"></i>
                    new user
                </h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                    aria-label="Close">&times;</button>
            </div>
            <form id="formAddUser" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12  mb-2">
                            <label for="name" class="form-check-label text-capitalize">{{ __('Full Name') }}</label>
                            <div class="input-group input-group-outline">
                                <input id="name" type="text" class="form-control" name="name" required
                                    autocomplete="name" placeholder="your name here..." autofocus>
                            </div>
                            <span class="text-danger" role="alert" id="nameError">
                            </span>
                        </div>
                        <div class="col-12  mb-2">
                            <label for="email"
                                class="form-check-label text-capitalize">{{ __('Email Address') }}</label>
                            <div class="input-group input-group-outline">
                                <input id="email" type="email" class="form-control" name="email" required
                                    placeholder="your email here..." autocomplete="email">
                            </div>
                            <span class="text-danger" role="alert" id="emailError"></span>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn fda-bg text-white" id="subNewUserBtn">save</button>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- modal edit profile --}}
<div id="modalEditUSer" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize" id="exampleModalToggleLabel">
                    <i class="fa fa-pencil-square"></i>
                    edit user
                </h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                    aria-label="Close">&times;</button>
            </div>
            <form id="formEditUser">
                @csrf
                <input type="text" id="u_id" hidden>
                <div class="modal-body">
                    <div class="alert alert-danger" hidden id="alertErrorsUser" role="alert">
                        <ul id="formEditUserErrors"></ul>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6  mb-3">
                            <label for="name"
                                class="form-check-label text-capitalize">{{ __('Full Name') }}</label>
                            <div class="input-group input-group-outline">
                                <input type="text" id="userName" class="form-control" name="name" required
                                    autocomplete="name" placeholder="your name here..." autofocus>
                            </div>
                        </div>
                        <div class="col-12 col-md-6  mb-3">
                            <label for="email"
                                class="form-check-label text-capitalize">{{ __('Email Address') }}</label>
                            <div class="input-group input-group-outline">
                                <input type="email" class="form-control" id="userEmail" name="email" required
                                    placeholder="your email here..." autocomplete="email">
                            </div>
                        </div>
                        <div class="col-12 col-md-6  mb-3">
                            <label class="form-check-label text-capitalize">phone number <b
                                    class="text-danger">*</b></label>
                            <div class="input-group input-group-outline">
                                <input type="number" class="form-control" autofocus name="phoneNumber"
                                    placeholder="0712345678" id="userPhoneNumber" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6  mb-3">
                            <label class="form-check-label text-capitalize">alternative phone number</label>
                            <div class="input-group input-group-outline">
                                <input type="number" id='userAltPhoneNumber' class="form-control" autofocus
                                    name="altPhoneNumber" placeholder="0712345678">
                            </div>
                        </div>
                        <div class="col-12 col-md-6  mb-3">
                            <label class="form-check-label text-capitalize">country <b
                                    class="text-danger">*</b></label>
                            <div class="input-group input-group-outline">
                                <select name="country" id="userCountry" class='form-control' required></select>
                            </div>

                        </div>
                        <div class="col-12 col-md-6  mb-3">
                            <label class="form-check-label text-capitalize">gender <b
                                    class="text-danger">*</b></label>
                            <div class="input-group input-group-outline">
                                <select name="gender" class='form-control' required id="gender">
                                    <option value="" disabled class="text-center">-------select-------</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6  mb-3">
                            <label class="form-check-label text-capitalize">date of birth(DOB) <b
                                    class="text-danger">*</b></label>
                            <div class="input-group input-group-outline">
                                <input type="date" name="dob" id="dob" class="form-control" autofocus
                                    required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-check-label text-capitalize">Organization/institution <b
                                    class="text-danger">*</b>
                            </label>
                            <div class="input-group input-group-outline">
                                <input type="text" name="organization" class="form-control" autofocus
                                    id="userOrganization" placeholder="Bank or school" required>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-check-label text-capitalize">physical address/location <b
                                    class="text-danger">*</b>
                            </label>
                            <div class="input-group input-group-outline">
                                <input type="text" name="address" class="form-control" autofocus id="userAddress"
                                    placeholder="Ngahururu" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary text-capitalize"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn fda-bg text-white text-capitalize"
                        id="btnUpdateUser">update</button>
                </div>
            </form>
        </div>
    </div>
</div>
