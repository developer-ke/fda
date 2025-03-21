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
                $('#usersTable').DataTable().ajax.reload(null,
                    false);
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
                $('#usersTable').DataTable().ajax.reload(null,
                    false);
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