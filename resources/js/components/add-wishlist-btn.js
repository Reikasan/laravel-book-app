const wishlistBtns = document.querySelectorAll('.wishlist-btn');
const bookId = document.querySelector('input[name=book_id]');
const csrfToken = document.querySelector('form.wishlist-form > input[name="_token"]');

wishlistBtns.forEach((btn) => {
    btn.addEventListener('click', (e) => {
        // If Book is not in DB yet, do not add to wishlist from JavaScript
        if(!isBookInDB(bookId)) {
            return;
        } 

        if(btn.classList.contains('wishlist-btn--add')) {
            addToWishlist(e);
        } else {
            removeFromWishlist(e);
        }
    });
});

function isBookInDB(bookId) {
    if(bookId === null) {
        return false;
    }
    return true;
}

function addToWishlist(e) {
    e.preventDefault();

    const formData = new FormData();
    formData.append('book_id', bookId.value);
    formData.append('asynchronous', true);

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
        changeWishlistBtnText(e.target, id);
    })
    .catch(error => {
        alert('Error: ' + error.message);
    });
}

function removeFromWishlist(e) {
    e.preventDefault();
    const wishlistId = e.target.dataset['wishlistId'];
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
        changeWishlistBtnText(e.target);
    })
    .catch(error => {
        alert('Error: ' + error.message);
    });

}

function changeWishlistBtnText(item, id = null) {
   if(item.classList.contains('wishlist-btn--add')) {
        item.classList.remove('wishlist-btn--add');
        item.classList.add('wishlist-btn--remove');
        item.textContent = 'Remove from Wishlist';
        if(id !== null) {
            item.setAttribute('data-wishlist-id', id);
        }
   } else {
        item.classList.remove('wishlist-btn--remove');
        item.classList.add('wishlist-btn--add');
        item.textContent = 'Add to Wishlist';
        item.removeAttribute('data-wishlist-id');
   }
}