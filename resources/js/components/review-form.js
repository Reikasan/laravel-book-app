const storeBtns = document.querySelectorAll('.store-btn');
const bookId = document.querySelector('input[name=book_id]');
const reviewRate = document.querySelector('input[name=review-rate]');
const reviewDate = document.querySelector('input[name=review-date]');
const reviewText = document.querySelector('textarea[name=review-text]');

storeBtns.forEach((storeBtn) => {
    storeBtn.addEventListener('click', (e) => storeReview(e));
});

function storeReview(e) {
    e.preventDefault();
    validateForm(e);
}

function validateForm(e) {
    if(isNaN(Number(bookId.value))) {
        alert('Something went wrong. Please try again.');
        return;
    }
    
    // Validation for draft
    if(e.target.classList.contains('store-btn--draft')) {
        if(reviewRate.value !== '') {
            validateRate();
        } 

        if(reviewDate.value !== '') {
            validateDate();
        }

        if(reviewText.value !== '') {
            validateReviewText();
        }
    }

    // Validation for store
    if(e.target.classList.contains('store-btn--review')) {
        validateRate();
        validateDate();
        validateReviewText();
    }
}

function validateRate() {
    const rate = Number(reviewRate.value);
    if(isNaN(rate) || rate < 1 || rate > 5 || rate !== Math.floor(rate)) {
        reviewRate.setCustomValidity('Please enter a number between 1 and 5');
    } else {
        reviewRate.setCustomValidity('');
    }
    toggleInvalidClass(reviewRate, reviewRate.validity.valid);
}

function validateDate() {
    const date = new Date(reviewDate.value);
    const today = new Date();
    let errorMessage = '';
    if(date > today) {
        errorMessage = 'Please enter a date in the past';
    } else if (date == 'Invalid Date') {
        errorMessage = 'Please enter a valid date';
    } else {
        errorMessage = '';
    }
    toggleInvalidClass(reviewDate, errorMessage === '');
    reviewDate.setCustomValidity(errorMessage);
    reviewDate.nextElementSibling.innerText = errorMessage;
}

function validateReviewText() {
    let errorMessage = '';
    if(reviewText.value === "") {
        errorMessage = 'Please enter a review';
    } else if(reviewText.value.length > 5000) {
        errorMessage = 'Please enter a review with less than 5000 characters';
    } else {
        errorMessage = '';
    }
    toggleInvalidClass(reviewText, errorMessage === '');
    reviewText.setCustomValidity(errorMessage);
    reviewText.nextElementSibling.innerText = errorMessage;
}

function toggleInvalidClass(input, isValid) {
    if(isValid) {
        removeInvalidClass(input);
    } else {
        addInvalidClass(input);
    }
}

function removeInvalidClass(input) {
    const formGroupElement = input.closest('.form-group');
    formGroupElement.classList.remove('is-invalid');
}
function addInvalidClass(input) {
    const formGroupElement = input.closest('.form-group');
    formGroupElement.classList.add('is-invalid');
}