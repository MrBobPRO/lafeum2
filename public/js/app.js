let csrfToken = document.querySelector('meta[name="csrf-token"]').content;
let scrollButtons = document.querySelector('.scroll-buttons');
let spinner = document.querySelector('.spinner');

let videoModal = document.querySelector('.video-modal');
let videoModalTitle = videoModal.querySelector('.modal__header-title');
let videoModalFrame = videoModal.querySelector('iframe');

let photoModal = document.querySelector('.photo-modal');
let photoModalImage = photoModal.querySelector('.photo-modal__image');
let photoModalDesc = photoModal.querySelector('.photo-modal__desc');


// ********** DOCUMENT ONCLICK LISTENER **********
// Hide active dropdown on outside of dropdown click
document.addEventListener('click', function (evt) {
    document.querySelectorAll('.dropdown--active').forEach((activeDropdown) => {
        // Check if event target is outside of active dropdown
        if (evt.target != activeDropdown && !activeDropdown.contains(evt.target)) {
            activeDropdown.classList.remove('dropdown--active');
        }
    });
});
// ********** /END DOCUMENT ONCLICK LISTENER **********


// ********** WINDOW ONSCROLL LISTENER **********
window.addEventListener('scroll', (evt) => {
    if (window.pageYOffset > 300) {
        scrollButtons.classList.add('scroll-buttons--visible');
    } else {
        scrollButtons.classList.remove('scroll-buttons--visible');
    }
});
// ********** /END WINDOW ONSCROLL LISTENER **********


// ********** EXPAND MORE **********
// Remove unnecessary Expand More buttons
document.querySelectorAll('.expand-more-container').forEach(function (item) {
    let postTxt = item.previousElementSibling;

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
// ********** /END EXPAND MORE **********


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
                activeCollapseButton.classList.remove('accordion__button--active');
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

// ************ VOCABULARY ************
function initializeVocabularyHoverListener() {
    let vocabularyList = document.querySelector('.vocabulary-list');

    if (vocabularyList) {
        // Load Vocabulary Term body on Vocabulary Item hover
        vocabularyList.addEventListener('mouseover', function (evt) {
            let targ = evt.target;

            if (targ.classList.contains('vocabulary-list__link')) {
                if (targ.dataset.bodyLoaded == 0) {
                    let popup = targ.nextElementSibling;
                    targ.dataset.bodyLoaded = 1;

                    const xhttp = new XMLHttpRequest();
                    xhttp.onloadend = function () {
                        if (xhttp.status == 200) {
                            popup.innerHTML = '<div class="vocabulary-list__popup-inner">' + this.responseText + '</div>';
                        } else {
                            targ.dataset.bodyLoaded = 0;
                        }
                    }

                    xhttp.open('GET', '/vocabulary/body/' + targ.dataset.id, true);
                    xhttp.send();
                }
            }
        });
    }
}

initializeVocabularyHoverListener()

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
            initializeVocabularyHoverListener();
        } else {
            xhttp.abort();
        }
    }

    xhttp.open('POST', '/vocabulary/search', true);
    xhttp.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    xhttp.setRequestHeader('Content-type', 'application/json');
    xhttp.send(JSON.stringify(params));
}
// ************ /END VOCABULARY ************


// ************ TERMS ************
document.querySelectorAll('.term-card').forEach((card) => {
    document.querySelectorAll('a').forEach((link) => {
        // IGNORE Subterm Links
        if (!link.closest('.term-card__subterms-container')) {
            if (link.href == '') return;

            let url = new URL(link.href);

            // Get ID from pathname https://lafeum.ru/term/{id}
            if (url.hostname == 'lafeum.ru') {
                let id = url.pathname.slice(6);
                link.dataset.targetId = 'subterm' + id;

                link.addEventListener('mouseover', function () {
                    showTermPopup(link);
                });

                link.addEventListener('mouseleave', function () {
                    hideTermPopup();
                });
            }
        }
    });
});

function showTermPopup(link) {
    let card = link.closest('.post-card__body');
    let popup = card.querySelector('.term-card__popup');
    let popupInner = card.querySelector('.term-card__popup-inner');

    // escape unneeded multiple change
    if (popupInner.dataset.subtermId != link.dataset.targetId) {
        popupInner.innerHTML = document.getElementById(link.dataset.targetId).innerHTML;
        popupInner.dataset.subtermId = link.dataset.targetId;
        popup.style.top = (link.offsetTop + 30) + 'px';
    }

    popup.classList.add('term-card__popup--visible');
}

function hideTermPopup() {
    document.querySelectorAll('.term-card__popup--visible').forEach((popup) => {
        popup.classList.remove('term-card__popup--visible');
        popup.querySelector('.term-card__popup-inner').dataset.subtermId = 0;
    });
}
// ************ /END TERMS ************


// ************ MODAL ************
// Modal Dismiss
document.querySelectorAll('.modal__background').forEach((item) => {
    item.addEventListener('click', (evt) => {
        let targ = evt.target;

        if (targ.classList.contains('modal__background') || targ.classList.contains('modal-dismiss')) {
            let modal = targ.closest('.modal');
            modal.classList.remove('modal--visible');

            // stop iframe video
            let iframe = modal.querySelector('iframe');
            if (iframe) {
                iframe.src = iframe.src;
            }

            // remove img src
            photoModalImage.src = '';
        }
    });
});

// RightBar Video Modal
let rightBarVideo = document.querySelector('.rightbar__video');
if (rightBarVideo) {
    rightBarVideo.querySelector('.video-thumb__image').addEventListener('click', (evt) => {
        videoModalFrame.src = evt.target.dataset.videoSrc;
        videoModalTitle.innerHTML = evt.target.dataset.videoTitle;
        videoModal.classList.add('modal--visible');
    });
}


// Video List Modals
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

// Mixed List Modals
let mixedList = document.querySelector('.mixed-list');

if (mixedList) {
    mixedList.querySelectorAll('.video-thumb__image, .video-card__title').forEach((item) => {
        item.addEventListener('click', (evt) => {
            let card = evt.target.closest('.video-card');

            videoModalFrame.src = card.dataset.videoSrc;
            videoModalTitle.innerHTML = card.dataset.videoTitle;
            videoModal.classList.add('modal--visible');
        });
    });
}


// Photos List Modals
let photosList = document.querySelector('.photos-list');

if (photosList) {
    photosList.querySelectorAll('.photo-card__image').forEach((item) => {
        item.addEventListener('click', (evt) => {
            let card = evt.target.closest('.photo-card');

            photoModalImage.src = card.dataset.imageSrc;
            cardDesc = card.querySelector('.photo-card__desc');
            photoModalDesc.innerHTML = cardDesc.innerHTML;
            photoModal.classList.add('modal--visible');
        });
    });
}
// ************ /END MODAL ************


// Toggle Favorite
document.querySelectorAll('[data-action="favorite"]').forEach((item) => {
    item.addEventListener('click', (evt) => {
        spinner.classList.add('spinner--visible');
        targ = evt.target;
        let dropdown = targ.closest('.favorite-dropdown');
        let favoriteIcon = dropdown.querySelector('.favorite-icon');

        // get all checked checkboxes values
        let form = targ.closest('.favorite-form');
        let chbList = [];

        form.querySelectorAll('input[type=checkbox]:checked').forEach((chb) => {
            chbList.push(chb.value);
        });

        const params = {
            model: targ.dataset.model,
            modelID: targ.dataset.id,
            folderIDs: chbList
        };

        const xhttp = new XMLHttpRequest();
        xhttp.onloadend = function () {
            // ON SUCCESS
            if (xhttp.status == 200) {
                if (xhttp.responseText == 'favorited') {
                    favoriteIcon.classList.add('favorite-icon--active');
                } else if (xhttp.responseText == 'unfavorited') {
                    favoriteIcon.classList.remove('favorite-icon--active');
                }
                spinner.classList.remove('spinner--visible');
            // ON ERROR
            } else {
                xhttp.abort();
                spinner.classList.remove('spinner--visible');
            }
        }

        xhttp.open('POST', '/favorites/toggle', true);
        xhttp.setRequestHeader('X-CSRF-TOKEN', csrfToken);
        xhttp.setRequestHeader('Content-type', 'application/json');
        xhttp.send(JSON.stringify(params));
    });
});


// Toggle Likes
document.querySelectorAll('[data-action="like"]').forEach((item) => {
    item.addEventListener('click', (evt) => {
        spinner.classList.add('spinner--visible');
        targ = evt.target;
        let counterElement = targ.nextElementSibling;
        let counter = counterElement.innerHTML == '' ? 0 : parseInt(counterElement.innerHTML);

        const params = {
            model: targ.dataset.model,
            modelID: targ.dataset.id,
        };

        const xhttp = new XMLHttpRequest();
        xhttp.onloadend = function () {
            // ON SUCCESS
            if (xhttp.status == 200) {
                if (xhttp.responseText == 'liked') {
                    targ.classList.add('like-icon--active');
                    counterElement.innerHTML = counter + 1;
                } else if (xhttp.responseText == 'unliked') {
                    targ.classList.remove('like-icon--active');
                    counter--;
                    counterElement.innerHTML = counter > 0 ? counter : '';
                }
                spinner.classList.remove('spinner--visible');
            // ON ERROR
            } else {
                xhttp.abort();
                spinner.classList.remove('spinner--visible');
            }
        }

        xhttp.open('POST', '/likes/toggle', true);
        xhttp.setRequestHeader('X-CSRF-TOKEN', csrfToken);
        xhttp.setRequestHeader('Content-type', 'application/json');
        xhttp.send(JSON.stringify(params));
    });
});


// Redirect Actions. Used while favoriting & liking for unathorized user
document.querySelectorAll('[data-action="redirect"]').forEach((item) => {
    item.addEventListener('click', (evt) => {
        window.location.href = evt.target.dataset.url;
    });
});


// Dropdown
document.querySelectorAll('.dropdown__button').forEach((item) => {
    item.addEventListener('click', (evt) => {
        evt.target.closest('.dropdown').classList.toggle('dropdown--active');
    });
});


// Scroll Buttons
document.querySelector('.scroll-buttons__top').addEventListener('click', (evt) => {
    window.scrollTo({
        top: 0,
        behavior: "smooth",
    });
});

document.querySelector('.scroll-buttons__bottom').addEventListener('click', (evt) => {
    window.scrollTo({
        top: document.body.scrollHeight,
        behavior: "smooth",
    });
});


// Profile Ava change
let avaInput = document.querySelector('#update-ava-input');
let imgTypes = ['image/jpeg', 'image/jpg', 'image/png'];
let imgTypesRegex = new RegExp('(' + imgTypes.join('|').replace(/\./g, '\\.') + ')$');

if (avaInput) {
    avaInput.addEventListener('change', (evt) => {
        spinner.classList.add('spinner--visible');
        let file = evt.target.files[0];

        if (imgTypesRegex.test(file.type)) {
            let formData = new FormData(document.querySelector('form.update-ava'));

            const xhttp = new XMLHttpRequest();
            xhttp.onloadend = function () {
                if (xhttp.status == 200) {
                    // replace all users avas
                    document.querySelector(`.update-ava__img`).src = xhttp.responseText;
                    document.querySelector(`.user-box__image`).src = xhttp.responseText;
                    document.querySelector(`.profile-dropdown__image`).src = xhttp.responseText;
                    // refresh input value
                    evt.target.value = '';
                    spinner.classList.remove('spinner--visible');
                } else {
                    xhttp.abort();
                    spinner.classList.remove('spinner--visible');
                }
            }

            xhttp.open('POST', '/profile/update-ava', true);
            xhttp.setRequestHeader('X-CSRF-TOKEN', csrfToken);
            xhttp.send(formData);
        } else {
            evt.target.value = '';
            spinner.classList.remove('spinner--visible');
            alert('Формат файла не поддерживается!');
        }
    });
}


// Show Spinner on Form Submit
document.querySelectorAll('[data-on-submit="show-spinner"]').forEach((item) => {
    item.addEventListener('submit', (evt) => {
        spinner.classList.add('spinner--visible');
    });
});
