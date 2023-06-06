let csrfToken = document.querySelector('meta[name="csrf-token"]').content;
let spinner = document.querySelector('.spinner');

window.onload = function () {
    setupAccordionActiveCollapse()
    highlightNavbarLink();

    // Initialize Selectizes
    $('.selectize-singular').selectize({
        //options
    });

    $('.selectize-singular--linked').selectize({
        onChange(value) {
            window.location = value;
        }
    });

    $('.selectize-multiple').selectize({
        //options
    });

    $('.date-time-picker').datetimepicker({
        // mask: '9999/19/39 29:59',
        format: 'Y-m-d H:i:s',
        formatTime: 'H:i:s',
        formatDate: 'Y-m-d',
        value: getCurrentDateAndTime(),
        lang: 'ru',
    });
};


function getCurrentDateAndTime() {
    let currentdate = new Date();

    return currentdate.getFullYear() + '-'
        + String(currentdate.getMonth() + 1).padStart(2, '0') + '-'
        + String(currentdate.getDate()).padStart(2, '0') + ' '
        + String(currentdate.getHours()).padStart(2, '0') + ':'
        + String(currentdate.getMinutes()).padStart(2, '0') + ':'
        + String(currentdate.getSeconds()).padStart(2, '0');
}


// ************ Simditor WYSIWYG ************
Simditor.locale = 'ru-RU';
let wysiwygs = [];
let simditorTextareas = document.querySelectorAll('.wysiwyg-textarea');

for (let i = 0; i < simditorTextareas.length; i++) {
    wysiwygs.push(
        new Simditor({
            textarea: simditorTextareas[i],
            toolbarFloatOffset: '60px',
            imageButton: 'upload',
            toolbar: ['title', 'bold', 'italic', 'underline', 'color', '|', 'ol', 'ul', 'blockquote', 'code', 'table', '|', 'link', 'hr', '|', 'indent', 'outdent', 'alignment'] //image removed
            // cleanPaste: true, //clear all styles after pasting,
        })
    );
}

// let imagedWysiwygs = [];
// let simditorImagedTextareas = document.querySelectorAll('.simditor-wysiwyg--imaged');

// for (let i = 0; i < simditorImagedTextareas.length; i++) {
//     imagedWysiwygs.push(
//         new Simditor({
//             textarea: simditorImagedTextareas[i],
//             toolbarFloatOffset: '60px',
//             imageButton: 'upload',
//             toolbar: ['title', 'bold', 'italic', 'underline', 'color', '|', 'ol', 'ul', 'blockquote', 'code', 'table', '|', 'link', 'hr', '|', 'indent', 'outdent', 'alignment', 'image'],
//             upload: {
//                 url: '/upload-simditor-image',   // image upload url by server
//                 params: { // additional parameters for request
//                     folder: 'posts'
//                 },
//                 fileKey: 'image', // input name
//                 connectionCount: 10,
//                 leaveConfirm: 'Пожалуйста дождитесь окончания загрузки изображений на сервер! Вы уверены что хотите закрыть страницу?'
//             },
//             defaultImage: '/img/dashboard/default-image.png', // default image thumb while uploading
//         })
//     );
// }
// ************ /END Simditor WYSIWYG ************

// debounce function
function debounce(callback, timeoutDelay = 500) {
    let timeoutId;

    return (...rest) => {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => callback.apply(this, rest), timeoutDelay);
    };
}


// Accordion
document.querySelectorAll('.accordion__button').forEach((item) => {
    item.addEventListener('click', (evt) => {
        let button = evt.target;
        let accordion = button.closest('.accordion');
        let targetItem = button.closest('.accordion__item');
        let targetCollapse = targetItem.querySelector('.accordion__collapse');

        // close any other active items
        accordion.querySelectorAll('.accordion__item--active').forEach((activeItem) => {
            if (activeItem !== targetItem) {
                activeItem.querySelector('.accordion__collapse').style.height = null;
                activeItem.classList.remove('accordion__item--active');
            }
        });

        // toggle collapse hieght & item active class
        targetCollapse.style.height = targetCollapse.clientHeight ? null : targetCollapse.scrollHeight + 'px';
        targetItem.classList.toggle('accordion__item--active');
    });
});

// Setup accordion active collapse height for corret Transition
function setupAccordionActiveCollapse() {
    document.querySelectorAll('.accordion__item--active').forEach((item) => {
        let collapse = item.querySelector('.accordion__collapse');
        collapse.style.height = collapse.scrollHeight + 'px';
    });
}


// Auto highlight navbars current route link
function highlightNavbarLink() {
    let navbar = document.querySelector('.navbar');
    let currentUlr = window.location.origin + window.location.pathname;

    // Links
    navbar.querySelectorAll('.menu__link').forEach((link) => {
        if (link.href == currentUlr) {
            link.classList.add('menu__item--active');
        }
    });

    // Accordion links
    navbar.querySelectorAll('.accordion__collapse-link').forEach((link) => {
        if (link.href == currentUlr) {
            link.classList.add('accordion__collapse-link--active');
        }
    });
}


// Toggle Aside visibility
document.querySelector('.aside-toggler').addEventListener('click', () => {
    document.body.classList.toggle('body--asideless');
});


// Toggle table checkboxes
let selectAllBtn = document.querySelector('.header__action-select-all');

if (selectAllBtn) {
    selectAllBtn.addEventListener('click', () => {
        let table = document.querySelector('.table')
        let checkboxes = table.querySelectorAll('input[type="checkbox"]');

        // check if all checkboxes selected
        let checkedAll = true;

        for (let chb of checkboxes) {
            if (!chb.checked) {
                checkedAll = false;
                break;
            }
        }

        // toggle checkbox statements
        for (let chb of checkboxes) {
            chb.checked = !checkedAll;
        }
    });
}


// ************ MODAL ************
// Show modal
document.querySelectorAll('[data-action="show-modal"]').forEach((item) => {
    item.addEventListener('click', (evt) => {
        let modal = document.querySelector(evt.target.dataset.modalTarget);
        modal.classList.add('modal--visible');
    });
});

// Modal Dismiss
document.querySelectorAll('[data-action="hide-modal"]').forEach((item) => {
    item.addEventListener('click', (evt) => {
        let modal = evt.target.closest('.modal');
        modal.classList.remove('modal--visible');
    });
});

// Show modal on delete item click
document.querySelectorAll('.table__button--destroy').forEach((item) => {
    item.addEventListener('click', (evt) => {
        let modal = document.querySelector('.modal--single-destroy');
        let input = modal.querySelector('[name="id[]"]');

        // Change input value and show modal
        input.value = evt.target.dataset.itemId;
        modal.classList.add('modal--visible');
    });
});
// ************ /END MODAL ************


// Show Spinner on Forms Submit
document.querySelectorAll('[data-on-submit="show-spinner"]').forEach((item) => {
    item.addEventListener('submit', () => {
        spinner.classList.add('spinner--visible');
    });
});


// ************ SEARCH ************
document.querySelectorAll('.search__form').forEach((form) => {
    form.addEventListener('submit', (evt) => {
        evt.preventDefault();
        spinner.classList.add('spinner--visible');

        let action = evt.target.action;
        let keyword = form.querySelector('.search__input').value;
        let tableContainer = document.querySelector('.table-container__inner');

        const xhttp = new XMLHttpRequest();
        xhttp.onloadend = function () {
            if (xhttp.status == 200) {
                tableContainer.innerHTML = this.responseText;
                spinner.classList.remove('spinner--visible');
            } else {
                spinner.classList.remove('spinner--visible');
                alert('search error!');
            }
        }

        xhttp.open('GET', action + '?keyword=' + keyword, true);
        xhttp.send();
    });
});

// ************ /END SEARCH ************
