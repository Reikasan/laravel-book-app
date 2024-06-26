const storeBtns = document.querySelectorAll('.store-btn');
const editBtns = document.querySelectorAll('.edit-btn');
const bookId = document.querySelector('input[name=book_id]');
const reviewId = document.querySelector('input[name=review_id]');
const reviewRate = document.querySelector('input[name=review-rate]');
const reviewDate = document.querySelector('input[name=review-date]');
const reviewText = document.querySelector('textarea[name=review-text]');
const csrfToken = document.querySelector('input[name="_token"]');
let isSubmitting = false;

storeBtns.forEach((storeBtn) => {
    storeBtn.addEventListener('click', (e) => {
        isSubmitting = true;
        storeReview(e, 'store');
    });
});

editBtns.forEach((editBtn) => {
    editBtn.addEventListener('click', (e) => {
        isSubmitting = true;
        storeReview(e, 'edit');
    });
});

window.addEventListener('beforeunload', (e) => {
    if(!isSubmitting) {
        confirmPageLeave(e);
    }
});

function confirmPageLeave(e) {
    if(!document.querySelector('.review__form')) {
        return;
    }
    e.preventDefault();
    e.returnValue = '';
}

function storeReview(e, action) {
    e.preventDefault();
    if(!validateForm(e, action)) {
        return;
    }
    const formData = createFormData(e);

    let url = '/reviews';

    if(action === 'edit') {
        url = `/reviews/${reviewId.value}`;
        formData.append('_method', 'PUT');
    }

    fetch(url, {
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
       const reviewId = data.reviewId; 
       window.location.replace(`/reviews/${reviewId}`);
    })
    .catch(error => {
        alert('Error: ' + error.message);
    });
}

function validateForm(e, action) {
    if(action == 'store' && isNaN(Number(bookId.value))) {
        alert('Something went wrong. Please try again.');
        return;
    }
    
    let isValid = new Array();
    // Validation for draft
    if(e.target.classList.contains('store-btn--draft')) {
        if(reviewRate.value != 0) {
            isValid.push(validateRate());
        } 
        if(reviewDate.value !== '') {
            isValid.push(validateDate());
        }
        if(reviewText.value !== '') {
            isValid.push(validateReviewText());
        }
    }

    // Validation for store
    if(e.target.classList.contains('store-btn--review')) {
        isValid.push(validateRate());
        isValid.push(validateDate());
        isValid.push(validateReviewText());
    }
    return isValid.includes(false) ? false : true;
}

function validateRate() {
    const rate = Number(reviewRate.value);
    if(isNaN(rate) || rate < 1 || rate > 5 || rate !== Math.floor(rate)) {
        reviewRate.setCustomValidity('Please enter a number between 1 and 5');
    } else {
        reviewRate.setCustomValidity('');
    }
    toggleInvalidClass(reviewRate, reviewRate.validity.valid);
    return reviewRate.validity.valid ? true : false;
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
    return errorMessage === '' ? true : false; 
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
    return errorMessage === '' ? true : false;
}

function toggleInvalidClass(input, isValid) {
    const formGroupElement = input.closest('.form-group');

    if(isValid) {
        formGroupElement.classList.remove('is-invalid');
    } else {
        formGroupElement.classList.add('is-invalid');
    }
}

function createFormData(e) {
    const reviewRateValue = reviewRate.value == 0 ? '' : reviewRate.value;
    const formData = new FormData();
    formData.append('review-rate', reviewRateValue);
    formData.append('review-date', reviewDate.value);
    formData.append('review-text', reviewText.value);

    if(bookId !== null) {
        formData.append('book_id', bookId.value);
    }

    if(e.target.classList.contains('store-btn--draft') 
    || e.target.classList.contains('edit-btn--draft' )) {
        formData.append('is_draft', 1);
    } else {
        formData.append('is_draft', 0);
    }
    return formData;
}