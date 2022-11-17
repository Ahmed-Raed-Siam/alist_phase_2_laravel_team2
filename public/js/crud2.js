function confirmDestroy(url, id, reference) {
    console.log(id);
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
        reverseButtons: true,
    }).then(function (result) {
        if (result.value) {
            deleteItem(url, id, reference);
            // result.dismiss can be "cancel", "overlay",
            // "close", and "timer"
        } else if (result.dismiss === "cancel") {
        }
    });
}

function deleteItem(url, id, reference) {
    axios
        .delete(url + "/" + [id])
        .then(function (response) {
            // handle success 2xx
            console.log(response);
            showMessage(response.data.message);
            reference.closest("tr").remove();
        })
        .catch(function (error) {
            // handle error 4xx - 5xx
            console.log(error);
            showMessage(error.response.data.message, true);
        });
}

function confirmDestroyMany(url, ids) {
    Swal.fire({
        title: "هل انت متأكد?",
        text: "سيتم حذف العناصر المحددة !",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "نعم , تأكيد الحذف!",
        cancelButtonText: "لا , الغاء !",
        reverseButtons: true,
    }).then(function (result) {
        if (result.value) {
            deleteManyItem(url, ids);
            // result.dismiss can be "cancel", "overlay",
            // "close", and "timer"
        } else if (result.dismiss === "cancel") {
        }
    });
}

function deleteManyItem(url, ids) {
    axios
        .delete(url, {
            data: {
                ids: ids,
            },
        })
        .then(function (response) {
            // handle success 2xx
            $(".sub_chk:checked").each(function() {
                $(this).parents("tr").remove();
            });
            showMessage(response.data.message);

        })
        .catch(function (error) {
            // handle error 4xx - 5xx
            console.log(error);
            showMessage(error.response.data.message, true);
        });
}

function showMessage(message, error = false) {
    Swal.fire({
        position: "center",
        icon: !error ? "success" : "error",
        title: message,
        showConfirmButton: false,
        timer: 1500,
    });
}

function storeData(url, data, redirectRoute) {
    axios
        .post(url, data)
        .then(function (response) {
            console.log(response);
            console.log(redirectRoute);
            redirectRoute = response.data?.redirect || redirectRoute;
            if (redirectRoute != undefined) {
                window.location.href = redirectRoute;
            } else {
                toastr.success(response.data.message);
                document.getElementById("create-form").reset();
            }
        })
        .catch(function (error) {

            var errors = error.response.data.errors;
            if (errors) {

                Object.keys(errors).map(val => {
                    toastr.error(errors[val])

                })
            }

        });
}

function update(url, data, redirectRoute) {
    axios
        .put(url, data)
        .then(function (response) {
            // handle success 2xx
            console.log(response);
            redirectRoute = response.data?.redirect || redirectRoute;
            if (redirectRoute != undefined) {
                window.location.href = redirectRoute;

            } else {
                toastr.success(response.data.message);
            }

        })
        .catch(function (error) {

            var errors = error.response.data.errors

            if (errors) {
                console.log(errors);
                Object.keys(errors).map(val => {
                    toastr.error(errors[val])

                })
            }

        });
}

function updateMany(url, data, redirectRoute) {
    axios
        .put(url, data)
        .then(function (response) {
            // handle success 2xx
            console.log(response);
            redirectRoute = response.data?.redirect || redirectRoute;
            if (redirectRoute != undefined) {
                window.location.href = redirectRoute;
            } else {
                toastr.success(response.data.message);
            }
        })
        .catch(function (error) {

            var errors = error.response.data.errors

            if (errors) {
                console.log(errors);
                Object.keys(errors).map(val => {
                    toastr.error(errors[val])

                })
            }

        });
}

function showToaster(message, error = false) {
    toastr.options = {
        closeButton: true,
        debug: false,
        newestOnTop: false,
        progressBar: false,
        positionClass: "toast-top-right",
        preventDuplicates: false,
        onclick: null,
        showDuration: "300",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
    };
    if (error) toastr.error(message);
    else toastr.success(message);
}


function toggleItem(url, id , reference) {
    axios
        .get(url + "/" + id)
        .then(function (response) {
            // handle success 2xx
            toastr.success(response.data.message);
            location.reload();
        })
        .catch(function (error) {
            // handle error 4xx - 5xx
            console.log(error);
            showMessage(error.response.data.message, true);
        });
}
