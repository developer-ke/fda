if ($('#modalAddUSer')) {
    const nameError = document.querySelector('#nameError');
    const emailError = document.querySelector('#emailError');
    const btn = document.querySelector('#subNewUserBtn');
    const formNewUser = document.querySelector('#formAddUser');
    nameError.textContent = '';
    emailError.textContent = '';
    btn.innerText = 'saving...';
    btn.disabled = true;
    try {
        formNewUser.addEventListener('submit', async e => {
            e.preventDefault();
            const data = {
                name: document.querySelector('#name').value,
                email: document.querySelector('#email').value
            }
            const res = await fetch('/admin/users/store', {
                method: 'POST',
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf,
                }
            });
            const output = await res.json();
            if (output.errors) {
                emailError.textContent = output.errors.email;
                nameError.textContent = output.errors.name;
            } else if (output.success) {
                formNewUser.reset();
                // refresh the users table
                reloadUsersTable();
                successDialog(output.message);
            } else {
                errorDialog(output.message);
                console.log(output.error);
            }
        })
    } catch (error) {
        errorDialog('error occured');
        console.log(error);
    } finally {
        btn.innerText = 'save';
        btn.disabled = false;
    }
}
const reloadUsersTable = () => {
    $('#usersTable').DataTable().ajax.reload(null,
        false);
}

// edit the user
const editUser = async id => {
    const url = `/admin/users/${id}/edit/profile`;
    try {
        const res = await fetch(url, {
            method: "GET",
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf
            }
        })
        const output = await res.json();
        if (output.success) {
            document.getElementById('userName').value = output.data.user.name;
            document.getElementById('userEmail').value = output.data.user.email;
            document.getElementById('userPhoneNumber').value = output.data.user.phoneNumber;
            document.getElementById('userAltPhoneNumber').value = output.data.user.altPhoneNumber;
            document.getElementById('gender').value = output.data.user.gender;
            document.getElementById('dob').value = output.data.user.dateOfBirth;
            document.getElementById('userOrganization').value = output.data.user.organization;
            document.getElementById('userAddress').value = output.data.user.physicalAddress;
            document.getElementById('u_id').value = output.data.user.id;
            let countriesOption = document.getElementById('userCountry');
            let options = '<option disabled>-------select-------</option>';

            output.data.countries.forEach(country => {
                options += `<option value="${country.id}" ${output.data.user.countryName == country.name ? 'selected' : ''}>${country.name}</option>`
            });
            countriesOption.innerHTML = options;
            $('#modalEditUSer').modal('show');
            // get the data info
        }

    } catch (error) {
        console.log(error);
        errorDialog();
    }


}


// toggle modal edit user
if (document.getElementById('modalEditUSer')) {
    let subBtn = document.getElementById('btnUpdateUser');
    let formUpdateUser = document.getElementById('formEditUser');
    let formErrors = document.getElementById('formEditUserErrors');
    let alertErrors = document.getElementById('alertErrorsUser');
    subBtn.disabled = true;
    subBtn.innerText = 'updating...';
    try {
        formUpdateUser.addEventListener('submit', async (e) => {
            e.preventDefault();
            alertErrors.hidden = true;
            // Get form data automatically
            let formData = new FormData(formUpdateUser);
            // Convert FormData to JSON
            let data = Object.fromEntries(formData.entries());
            let id = document.getElementById('u_id').value;
            const res = await fetch(`/admin/users/${id}/update/profile`, {
                method: "PUT",
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf
                }
            })
            const output = await res.json();
            if (output.errors) {
                alertErrors.hidden = false;
                let errors = '';
                for (let key in output.errors) {
                    errors += `<li class='text-white'>${output.errors[key]}</li>`;
                }
                formErrors.innerHTML = errors;
            } else if (output.success) {
                formUpdateUser.reset();
                $('#modalEditUSer').modal('hide');
                // reload the table
                reloadUsersTable();
                successDialog(output.message);
            } else {
                errorDialog();
            }
        })

    } catch (error) {
        console.log(error);
        errorDialog();
    } finally {
        subBtn.innerText = 'update';
        subBtn.disabled = false;
    }
}

// grant acces to all users
if (document.getElementById('formGrantAccessAll')) {
    var formGrantAccessAll = document.getElementById('formGrantAccessAll');
    formGrantAccessAll.addEventListener('submit', async e => {
        e.preventDefault();
        confirmDialog('You want to grant access to all users?', 'Yes, Grant Access', '/admin/users/all/grant/access', reloadUsersTable, 'PUT');
    })

}


// Deny acces to all users
if (document.getElementById('formDenyAccess')) {
    var formGrantAccessAll = document.getElementById('formDenyAccess');
    formGrantAccessAll.addEventListener('submit', async e => {
        e.preventDefault();
        confirmDialog('You want deny access to all users?', 'Yes, Deny Access', '/admin/users/all/deny/access', reloadUsersTable, 'PUT');
    })

}

// Delete all users
if (document.getElementById('deleteAllUsers')) {
    var formGrantAccessAll = document.getElementById('deleteAllUsers');
    formGrantAccessAll.addEventListener('submit', async e => {
        e.preventDefault();
        confirmDialog('You want to delete all users?', 'Yes, Delete', '/admin/users/delete/all', reloadUsersTable, 'DELETE');
    })

}

//get user profile
const showProfile = async id => {
    try {
        const route = `/admin/users/${id}/profile`;
        const res = await fetch(route, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf,
            }
        });
        const output = await res.json();
        if (output.incomplete_profile) {
            errorDialog(output.message);
        } else if (output.success) {
            // create the user object
            const user = output.user;
            console.log(user);
            var role = '';
            switch (user.role) {
                case 1:
                    role = 'Admin'
                    break;
                case 2:
                    role = 'Correspondent';
                    break;
                default:
                    role = 'Subscriber';
                    break;
            }

            var status = '';
            switch (user.status) {
                case 1:
                    status = '<b class="badge rounded-pill bg-success">Active</b>';
                    break;
                case 2:
                    status = '<b class="badge rounded-pill bg-danger">Deleted</b>';
                    break
                default:
                    status = '<b class="badge rounded-pill bg-warning">Inactive</b>';
                    break;
            }

            const options = {
                weekday: 'short',
                year: 'numeric',
                month: 'short',
                day: 'numeric'
            };
            document.getElementById('profilePicture').src = profile_source + "/" + user.image;
            document.getElementById('profileName').innerText = user.name;
            document.getElementById('profileEmail').innerText = user.email;
            document.getElementById('profileNames').innerText = user.name;
            document.getElementById('profileGender').innerText = user.gender;
            document.getElementById('profileDOB').innerText = user.dateOfBirth;
            document.getElementById('profileCountry').innerText = user.countryName;
            document.getElementById('profileNationality').innerText = user.nationality;
            document.getElementById('profileCity').innerText = user.city;
            document.getElementById('profileEmails').innerText = user.email;
            document.getElementById('profilePhoneNumber').innerText = user.code + user.phoneNumber;
            document.getElementById('profileAltPhoneNumber').innerText = user.code + user.altPhoneNumber;
            document.getElementById('profileAddress').innerText = user.physicalAddress;
            document.getElementById('profileOrganization').innerText = user.organization;
            document.getElementById('profileRole').innerText = role;
            document.getElementById('profileStatus').innerHTML = status;
            document.getElementById('profileDate').innerText = new Date(user.created_at).toLocaleDateString('en-US', options);
            document.getElementById('profileEmailVerifiedAt').innerText = new Date(user.email_verified_at).toLocaleDateString('en-US', options);
            $('#modalUserProfile').modal('show');

        } else {
            errorDialog('error occured');
            console.log(output.error);
        }

    } catch (error) {
        errorDialog('error occured');
        console.log(error);
    }

}