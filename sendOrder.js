const myForm = document.getElementById('form');
console.log(myForm);

function submitHandler(formData) {
    fetch('formRequest.php', {
        method: 'POST',
        body: formData,
    })
        .then(function(response) {
            return response.json();
        }).then(function(json) {
            let infoMessages = $('.info-messages');
            let btn = $('#btn-form');
            if (json.result === 'success') {
                $('.success-save-message').css('display', 'flex');
                btn.removeClass('progress-bar-striped progress-bar-animated');
                $('#my-form').trigger("reset");
                imagePreview.src = '';
                imagePreview.style.display = 'none';
            } else if (json.result === 'failed') {
                infoMessages.html('<div class="alert alert-danger popup">Сообщение не отправлено! (введён уже существующий e-mail или используется некорректный домен)</div>');
                btn.removeClass('progress-bar-striped progress-bar-animated');
            } else {
                infoMessages.html(`<div class="alert alert-danger popup">${json.result}</div>`);
                btn.removeClass('progress-bar-striped progress-bar-animated');
            }
        });
}

myForm.submit(function (event) {
    event.preventDefault();
    // let btn = $('#btn-form');
    // btn.addClass('progress-bar-striped progress-bar-animated');
    let formData = new FormData(myForm);

    // submitHandler(formData);
});