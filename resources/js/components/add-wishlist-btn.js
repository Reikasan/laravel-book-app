const wishlistBtns = document.querySelectorAll('.wishlist-btn');
const bookId = document.querySelector('input[name=book_id]');
const wishlistIcons = document.querySelectorAll('.wishlist-icon');
const csrfToken = document.querySelector('input[name="_token"]');

wishlistBtns.forEach((btn) => {
    btn.addEventListener('click', (e) => manipulateWishlistItems(e));
});

wishlistIcons.forEach((icon) => {
    icon.addEventListener('click', (e) => manipulateWishlistItems(e));
});

function manipulateWishlistItems(e) {
    let item;
    if(e.target.classList.contains('wishlist-icon')) {
        item = 'icon';
    } else {
        item = 'btn';
    }

    if(e.target.classList.contains('wishlist-btn--add') || e.target.classList.contains('wishlist-icon--add')) {
        // If Book is not in DB yet and it is from book page, do not add to wishlist from JavaScript 
        if(!isBookInDB(bookId) && item === 'btn') {
            return;
        } 
        addToWishlist(e, item);
    } else {
        removeFromWishlist(e, item);
    }
}

function isBookInDB(bookId) {
    if(bookId === null) {
        return false;
    }
    return true;
}

function addToWishlist(e, item) {
    e.preventDefault();

    const formData = createFormData(e, item);

    fetch('/wishlist', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken.value
        },
        body: formData
    })
    .then(response => {
        if(!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        const id = data.wishlistId;
        changeSign(e.target, item, id);
    })
    .catch(error => {
        alert('Error: ' + error.message);
    });
}

function removeFromWishlist(e, item) {
    e.preventDefault();
    const wishlistId = e.target.dataset['wishlistId'];
    const bookId = e.target.dataset['bookId'];
    const refresh = e.target.dataset['refresh'];
    fetch(`/wishlist/${wishlistId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': csrfToken.value
        },
    })
    .then(response => {
        if(!response.ok) {
            throw new Error('Network response was not ok');
        }
        if(refresh === "true") {
            fadeout(e.target.closest('.book-card'));
            setInterval(refreshPage, 800);
        }
        changeSign(e.target, item, bookId);
    })
    .catch(error => {
        alert('Error: ' + error.message);
    });

}

function fadeout(element) {
    element.style.transition = 'opacity .5s';
    element.style.opacity = 0;
}

function refreshPage() {
    location.reload();
}

function createFormData(e, item) {
    const formData = new FormData();

    if(item === 'btn') {
        formData.append('book_id', bookId.value);
        return formData;
    } else if(item === 'icon') {
        if(e.target.dataset['bookId'] !== undefined) {
            formData.append('book_id', e.target.dataset['bookId']);
        } else {
            formData.append('isbn', e.target.dataset['bookIsbn']);
            formData.append('isbn13', e.target.dataset['bookIsbn13']);
        }
    }
    formData.append('asynchronous', true);
    return formData;
}

function changeSign(element, item, id = null) {
    if(item === 'btn') {
        changeWishlistBtnText(element, id);
    }
    if(item === 'icon') {
        changeWishlistIcon(element, id);
    }
}

function changeWishlistBtnText(element, id = null) {
   if(element.classList.contains('wishlist-btn--add')) {
        element.classList.remove('wishlist-btn--add');
        element.classList.add('wishlist-btn--remove');
        element.textContent = 'Remove from Wishlist';
        if(id !== null) {
            element.setAttribute('data-wishlist-id', id);
        }
   } else {
        element.classList.remove('wishlist-btn--remove');
        element.classList.add('wishlist-btn--add');
        element.textContent = 'Add to Wishlist';
        element.removeAttribute('data-wishlist-id');
   }
}

function changeWishlistIcon(element, id) {
    if(element.classList.contains('wishlist-icon--add')) {
        element.classList.remove('wishlist-icon--add');
        element.classList.remove('fa-regular');
        element.classList.add('wishlist-icon--remove');
        element.classList.add('fa-solid');
        element.setAttribute('data-wishlist-id', id);
        if(element.dataset['bookIsbn'] !== undefined) {
            element.removeAttribute('data-book-isbn');
        }
        if(element.dataset['bookIsbn13'] !== undefined) {
            element.removeAttribute('data-book-isbn13');
        }
    } else {
        element.classList.remove('wishlist-icon--remove');
        element.classList.remove('fa-solid');        
        element.classList.add('wishlist-icon--add');
        element.classList.add('fa-regular');
        element.removeAttribute('data-wishlist-id');
        element.setAttribute('data-book-id', id);
    }
}