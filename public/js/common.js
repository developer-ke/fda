const successDialog = (mess) => {
    Swal.fire({
        icon: "success",
        title: "Success",
        text: mess,
        showConfirmButton: false,
        timer: 1500
    });
}

const errorDialog = (mess) => {
    Swal.fire({
        icon: "error",
        title: "Error",
        text: mess,
        showConfirmButton: false,
        timer: 1500
    });
}

const confirmDialog = (text, btnText, route, callback, method) => {
    Swal.fire({
        title: "Are you sure?",
        text,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: btnText,
    }).then(async (result) => {
        if (result.isConfirmed) {
            const res = await fetch(route, {
                method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf
                }
            })
            const output = await res.json();
            if (output.success) {
                successDialog(output.message);
                callback();
            } else if (output.error) {
                console.log(output.message)
                errorDialog('An error occured');
            }
        }
    });
}


