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

        // close any other active collapses
        accordion.querySelectorAll('.accordion__collapse--show').forEach((activeCollapse) => {
            if (activeCollapse !== targetCollapse) {
                activeCollapse.style.height = null;
                activeCollapse.classList.remove('accordion__collapse--show');

                // remove active button class
                let activeCollapseItem = activeCollapse.closest('.accordion__item');
                let activeCollapseButton = activeCollapseItem.querySelector('.accordion__button')
                activeCollapseButton.classList.remove('accordion__collapse--show');
            }
        });

        // toggle collapse visibility
        if (targetCollapse.clientHeight) {
            targetCollapse.style.height = null;
            targetCollapse.classList.remove('accordion__collapse--show');
            button.classList.remove('accordion__button--active');
        } else {
            targetCollapse.style.height = targetCollapse.scrollHeight + 'px';
            targetCollapse.classList.add('accordion__collapse--show');
            button.classList.add('accordion__button--active');
        }
    });
});


// Disable Form Submits
document.querySelectorAll('.submit-disabled').forEach((item) => {
    item.addEventListener('submit', () => {
        return false;
    });
});


// Local Search
document.querySelectorAll('[data-action="local-search"]').forEach((input) => {
    input.addEventListener('input', debounce(function (evt) {
        let keyword = evt.target.value.toLowerCase();
        let selector = evt.target.dataset.selector;

        // Hide & show elements
        document.querySelectorAll(selector).forEach((item) => {
            item.style.display = item.innerHTML.toLowerCase().includes(keyword) ? null : 'none'
        });
    }));
});
