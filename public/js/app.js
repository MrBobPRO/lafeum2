let csrfToken = document.querySelector('meta[name="csrf-token"]').content;
let videoModal = document.querySelector('.video-modal');
let videoModalTitle = videoModal.querySelector('.modal__header-title');
let videoModalFrame = videoModal.querySelector('iframe');

// Remove unnecessary Expand More buttons
document.querySelectorAll('.expand-more-container').forEach(function (item) {
    let postTxt = item.previousElementSibling;

    console.log('clinetHeight = ' + postTxt.clientHeight + ' scrollHeight = ' + postTxt.scrollHeight);
    if (postTxt.clientHeight == postTxt.scrollHeight) {
        item.remove();
    }
});

// Add Expand More events
document.querySelectorAll('.expand-more').forEach((item) => {
    item.addEventListener('click', (evt) => {
        let btn = evt.target;
        let postTxt = btn.parentElement.previousElementSibling;

        btn.classList.toggle('expand-more--active');
        postTxt.style.maxHeight = postTxt.clientHeight < postTxt.scrollHeight ? (postTxt.scrollHeight + 'px') : '316px';
    });
});


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


// Load Vocabulary Term body on Term link hover
function addVocabularyLinkHoverListeners() {
    document.querySelectorAll('.vocabulary-list__link').forEach((item) => {
        item.addEventListener('mouseover', function (evt) {
            let link = evt.target;

            if (link.dataset.bodyLoaded == 0) {
                let popup = link.nextElementSibling;
                link.dataset.bodyLoaded = 1;

                const xhttp = new XMLHttpRequest();
                xhttp.onloadend = function () {
                    if (xhttp.status == 200) {
                        popup.innerHTML = '<div class="vocabulary-list__popup-inner">' + this.responseText + '</div>';
                    } else {
                        xhttp.abort();
                    }
                }

                xhttp.open('GET', '/vocabulary/body/' + link.dataset.id, true);
                xhttp.send();
            }
        });
    });
}
addVocabularyLinkHoverListeners();


// Vocabulary search on Vocabulary categories page
let vocabularySearch = document.querySelector('[data-action="vocabulary-search"]');
if (vocabularySearch) {
    vocabularySearch.addEventListener('input', debounce(function (evt) {
        let keyword = evt.target.value;
        let categoryId = document.querySelector('[name="category_id"]').value;

        searchVocabulary(keyword, categoryId);
    }));
}

function searchVocabulary(keyword, categoryId) {
    const params = {
        keyword: keyword,
        categoryId: categoryId
    };

    const xhttp = new XMLHttpRequest();
    xhttp.onloadend = function () {
        if (xhttp.status == 200) {
            document.querySelector('.vocabulary-list-container').innerHTML = xhttp.responseText;
            addVocabularyLinkHoverListeners();
        } else {
            xhttp.abort();
        }
    }

    xhttp.open('POST', '/vocabulary/search', true);
    xhttp.setRequestHeader('X-CSRF-TOKEN', csrfToken)
    xhttp.setRequestHeader('Content-type', 'application/json')
    xhttp.send(JSON.stringify(params));
}


// Modal
// Modal dismiss
document.querySelectorAll('.modal__background, modal__dismiss').forEach((item) => {
    item.addEventListener('click', (evt) => {
        let modal = evt.target.closest('.modal');
        modal.classList.remove('modal--visible');

        // stop iframe video
        let iframe = modal.querySelector('iframe');
        if (iframe) {
            iframe.src = iframe.src;
        }
    });
});

// RightBar Video Modal
let rightBarVideo = document.querySelector('.rightbar__video');
rightBarVideo.querySelector('.video-thumb__image').addEventListener('click', (evt) => {
    videoModalFrame.src = evt.target.dataset.videoSrc;
    videoModalTitle.innerHTML = evt.target.dataset.videoTitle;
    videoModal.classList.add('modal--visible');
})

// Vidoe List modals
let videosList = document.querySelector('.videos-list');

if (videosList) {
    videosList.querySelectorAll('.video-thumb__image, .video-card__title').forEach((item) => {
        item.addEventListener('click', (evt) => {
            let card = evt.target.closest('.video-card');

            videoModalFrame.src = card.dataset.videoSrc;
            videoModalTitle.innerHTML = card.dataset.videoTitle;
            videoModal.classList.add('modal--visible');
        });
    });
}

