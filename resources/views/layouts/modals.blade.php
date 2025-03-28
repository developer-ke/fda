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
<div id="viewCountryModal" data-bs-backdrop='static' class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="my-modal-title" aria-hidden="true">
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
<div id="modalAddUSer" data-bs-backdrop='static' class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
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
<div id="modalEditUSer" data-bs-backdrop='static' class="modal fade" tabindex="-1" role="dialog"
    aria-hidden="true">
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


{{-- modal user profile --}}
<div id="modalUserProfile" data-bs-backdrop='static' class="modal fade" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex">
                    <div class="me-2">
                        <img alt="" class="avatar rounded-3 avatar-md" id="profilePicture">
                    </div>
                    <div class="d-flex flex-column">
                        <h6 class="text-sm mb-0" id="profileName">
                        </h6>
                        <p id="profileEmail"></p>
                    </div>
                </div>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                    aria-label="Close">&times;</button>
                <br>

            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12  mb-3">
                        <div class="card shadow-none">
                            <div class="card-body">
                                <h6 class="text-sm text-capitalize ms-3  fda-color">
                                    Biometric info
                                </h6>
                                <ul class="list-group text-sm">
                                    <li class="list-group-item border-0 mb-0 pb-0">
                                        <b class="text-capitalize me-1">name:</b>
                                        <span id="profileNames"></span>
                                    </li>
                                    <li class="list-group-item border-0 text-capitalize mt-0 pb-0">
                                        <b class="text-capitalize me-1">gender:</b>
                                        <span id="profileGender"></span>
                                    </li>
                                    <li class="list-group-item border-0 text-capitalize mt-0 pb-0">
                                        <b class="text-capitalize me-1">date of birth:</b>
                                        <span id="profileDOB"></span>
                                    </li>
                                    <li class="list-group-item border-0 text-capitalize mt-0 pb-0">
                                        <b class="text-capitalize me-1">country:</b>
                                        <span id="profileCountry"></span>
                                    </li>
                                    <li class="list-group-item border-0 text-capitalize mt-0 pb-0">
                                        <b class="text-capitalize me-1">nationality:</b>
                                        <span id="profileNationality"></span>
                                    </li>
                                    <li class="list-group-item border-0 text-capitalize mt-0 pb-0">
                                        <b class="text-capitalize me-1">city:</b>
                                        <span id="profileCity"></span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="col-12  mb-3">
                        <div class="card shadow-none">
                            <div class="card-body">
                                <h6 class="text-sm text-capitalize ms-3  fda-color">
                                    contact info
                                </h6>
                                <ul class="list-group text-sm">
                                    <li class="list-group-item border-0 mb-0 pb-0">
                                        <b class="text-capitalize me-1">email:</b>
                                        <span id="profileEmails"></span>
                                    </li>
                                    <li class="list-group-item border-0 text-capitalize mt-0 pb-0">
                                        <b class="text-capitalize me-1">phone 1:</b>
                                        <span id="profilePhoneNumber"></span>
                                    </li>
                                    <li class="list-group-item border-0 text-capitalize mt-0 pb-0">
                                        <b class="text-capitalize me-1">phone 2:</b>
                                        <span id="profileAltPhoneNumber"></span>
                                    </li>
                                    <li class="list-group-item border-0 text-capitalize mt-0 pb-0">
                                        <b class="text-capitalize me-1">Address:</b>
                                        <span id="profileAddress"></span>
                                    </li>
                                    <li class="list-group-item border-0 mb-0 pb-0">
                                        <b class="text-capitalize me-1">organization:</b>
                                        <span id="profileOrganization"></span>
                                    </li>

                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="col-12  mb-3">
                        <div class="card shadow-none">
                            <div class="card-body">
                                <h6 class="text-sm text-capitalize ms-3 fda-color">
                                    Account info
                                </h6>
                                <ul class="list-group text-sm">
                                    <li class="list-group-item border-0 mb-0 pb-0">
                                        <b class="text-capitalize me-1">role:</b>
                                        <span id="profileRole"></span>
                                    </li>
                                    <li class="list-group-item border-0 mb-0 pb-0">
                                        <b class="text-capitalize me-1">status:</b>
                                        <span id="profileStatus"></span>
                                    </li>
                                    <li class="list-group-item border-0 text-capitalize mt-0 pb-0">
                                        <b class="text-capitalize me-1">registered on:</b>
                                        <span id="profileDate"></span>
                                    </li>
                                    <li class="list-group-item border-0 text-capitalize mt-0 pb-0">
                                        <b class="text-capitalize me-1">email verified on:</b>
                                        <span id="profileEmailVerifiedAt"></span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
