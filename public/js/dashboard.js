window.onload = function () {
    // Calculate active collapse height for corret Transition
    document.querySelectorAll('.accordion__item--active').forEach((item) => {
        let collapse = item.querySelector('.accordion__collapse');
        collapse.style.height = collapse.scrollHeight + 'px';
    });

    highlightNavbarLink();
};


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
