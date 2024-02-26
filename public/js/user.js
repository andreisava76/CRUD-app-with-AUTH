$(document).ready(() => {

    new DataTable('table[data-table]', {
        layout: {
            topStart: {
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
            }
        }
    });

    function validateInputs(inputs) {
        let error = false;
        let inputValues = {};
        inputs.each(function (index, input) {
            input = $(input);

            if (!input.val()) {
                input.addClass("error");
                error = true;
            } else {
                inputValues[input.attr('name')] = input.val();
                input.removeClass("error");
            }
        })

        return error ? false : inputValues;
    }

    $('[data-toggle="tooltip"]').tooltip();

    $(() => {
        $('a#delete').addDeleteEvent();
        $('a#edit').addEditEvent();
    });


    (($) => {
        $.fn.extend({
            addDeleteEvent: function () {
                this.on('click', (e) => {
                    const id = $(e.currentTarget).data('id')
                    Swal.fire({
                        title: 'Do you want to delete this item?',
                        showDenyButton: false,
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it',
                        cancelButtonText: `Cancel`,
                    })
                        .then((result) => {
                            if (result.isConfirmed) {
                                axios
                                    .delete(deleteRoute, {
                                        data: {id: id}
                                    })
                                    .then(() => {
                                        $(e.currentTarget).parents("tr").remove();
                                        createToast("Record deleted successfully", false);
                                    })
                                    .catch((error) => {
                                        createToast(error.response.data.message, true);
                                        console.log(error.response.data.message);
                                    })
                            }
                        })
                });
            },
            addEditEvent: function () {
                this.on('click', (e) => {
                    $('a#add').off('click');
                    let i = 0;
                    let SELECTED_ROW = $(e.currentTarget).parents("tr")
                    SELECTED_ROW.find("td:not(:last-child)").each(function () {
                        $(this).html('<input type="text" class="form-control" value="' + $(this).text() + '" name="' + inputs[i].name + '">');
                        i++;
                    });
                    SELECTED_ROW.find("#add, #edit").toggle();
                    $(e.currentTarget).siblings("#add").on("click", (e) => {
                        const inputs = SELECTED_ROW.find('input[type]');
                        const inputValues = validateInputs(inputs);

                        if (!inputValues) {
                            SELECTED_ROW.find(".error").first().focus();
                        } else {
                            inputValues['id'] = $(e.currentTarget).data('id')
                            axios.patch(updateRoute, inputValues)
                                .then(() => {
                                    inputs.each(function () {
                                        $(this).parent("td").html($(this).val());
                                    });
                                    SELECTED_ROW.find("#add, #edit").toggle();
                                    createToast("Record modified successfully", false);
                                })
                                .catch((error) => {
                                    createToast(error.response.data.message, true);
                                })
                        }
                    })
                })
            }
        });
    })(jQuery);

    let toastEl = null;

    function createToast(message, error) {
        if (!toastEl) {
            toastEl = $("#app").append(toast)
        }
        $(toastEl).find(".toast-body").html(message);
        if (error) {
            $(toastEl).find(".toast").removeClass("border-success-subtle");
            $(toastEl).find(".toast").addClass("border-danger-subtle");
        } else {
            $(toastEl).find(".toast").removeClass("border-danger-subtle");
            $(toastEl).find(".toast").addClass("border-success-subtle");
        }
        $('.toast').toast('show');
    }
})
