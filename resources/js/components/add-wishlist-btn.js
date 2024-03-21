const addWishlistBtns = document.querySelectorAll('.add-wishlist-btn');
const isbn = document.querySelector('input[name=book]');
const isbn13 = document.querySelector('input[name=isbn13]');
const bookId = document.querySelector('input[name=book_id]');
const csrfToken = document.querySelector('form.wishlist-form > input[name="_token"]');

addWishlistBtns.forEach((btn) => {
    btn.addEventListener('click', (e) => {
        e.preventDefault();
        const isbnValue = isbn.value !== '' ? isbn.value : isbn13.value;
        const bookIdValue = bookId !== null ? bookId.value : null;
        addWishlist(isbnValue, bookIdValue);
// console.log(csrfToken);
        console.log('Wishlist button clicked');
    });
});

function addWishlist(isbn, bookId = null) {
    const formData = new FormData();
    formData.append('isbn', isbn);
    formData.append('book_id', bookId);

    fetch('/wishlist', {
        method: 'POST',
        headers: {
            // 'Content-Type': 'application/json',
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
    .catch(error => {
        alert('Error: ' + error.message);
    });
}