
import '../styles/app.scss';

$(document).ready(function () {
    let breedOptions = {
        Dog: ["Pitbull", "Mastiff", "Bulldog", "German Shepherd", "Poodle", "Labrador", "Beagle", "Cant find it ?"],
        Cat: ["Maine Coon", "Siamese", "Ragdoll", "Persian", "Savannah", "Cant find it ?"]
    };

    $('input[name="dob"]').change(function() {
        if ($('#yes').is(':checked')) {
            $('#dob_field').removeClass('d-none');
            $('#dob_field').find('input').prop('required', true);
            $('#approx_age_field').addClass('d-none');
            $('#approx_age_field').find('input').prop('required', false);
        } else  {
            $('#dob_field').addClass('d-none')
            $('#dob_field').find('input').prop('required', false);
            $('#approx_age_field').removeClass('d-none');
            $('#approx_age_field').find('input').prop('required', true);
        }
    });

    $("#pet_type").change(function () {
        let selectedType = $(this).val();
        let $breedSelect = $("#pet_breed");

        $breedSelect.empty();
        $breedSelect.append('<option value="" disabled selected>Select a breed</option>');

        if (selectedType && breedOptions[selectedType]) {
            $.each(breedOptions[selectedType], function (index, breed) {
                $breedSelect.append(`<option value="${breed}">${breed}</option>`);
            });
        }
    });

    $("#pet_breed").change(function () {
        if ($(this).val() === "Cant find it ?") {
            $("#not_listed_options").removeClass('d-none');
            $("#dont_know").prop('required', true);
        } else {
            $("#not_listed_options").addClass('d-none');
            $("#dont_know").prop('required', false);
        }
    });
    
    $("input[name='unknown_breed']").change(function() {
        if ($("#its_a_mix").is(":checked")) {
            $("#mix_breed_field").removeClass("d-none");
            $("#mix_breed").prop('required', true);
        } else {
            $("#mix_breed_field").addClass("d-none");
            $("#mix_breed").prop('required', false);
        }
    });
    
    $('form').on('submit', function(event) {
        event.preventDefault();
        let breed;
        if ($('#pet_breed').val() === 'Cant find it ?') {
            if ($('input[name="unknown_breed"]:checked').val() === "It's a mix") {
                breed = $("#mix_breed").val();
            } else {
                breed = $('input[name="unknown_breed"]:checked').val();
            }
        } else {
            breed = $('#pet_breed').val();
        }
        let formData = {
            name: $('#pet_name').val(),
            type: $('#pet_type').val(),
            breed: breed,
            dateOfBirth: $('#pet_dateOfBirth').val(),
            gender: $('input[name="gender"]:checked').val(),
            isDangerous: $('#pet_isDangerous').val(),
            approximateAge: $('#approximate_age').val()
        };
        $.post({
            url: '/api/pet/create',
            contentType: 'application/json',
            data: JSON.stringify(formData)
        })
        .done(response => {
            window.location.href = `/pet/${response.id}`;
        })
        .fail(xhr => {
            $('#error-message').text(`Error: ${xhr.responseText}`).removeClass("d-none");
        });
    });
});
        
    

