// prevent button from multiple time submit
document.querySelectorAll('form').forEach((form) => {
    form.addEventListener('submit', function (evt) {
        evt.target.querySelector('.submit').disabled = true;

        return true;
    });
});


