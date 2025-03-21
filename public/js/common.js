let csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
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

const deleteDialog = (route, callback) => {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then(async (result) => {
        if (result.isConfirmed) {
            const res = await fetch(route, {
                Method: "DELETE",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': crsf
                }
            })
            const result = await res.json();
            if (result.success) {
                successDialog(result.message);
                callback();
            } else {
                errorDialog(result.error);
            }
        }
    });
}