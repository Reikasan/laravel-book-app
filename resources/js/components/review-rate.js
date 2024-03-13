const ratingStars = document.querySelectorAll('.form-group .fa-star');
const ratingInput = document.querySelector('input[name=review-rate]');


for(let i = 0; i < ratingStars.length; i++) {
    ratingStars[i].addEventListener('click', (e) => {
        toggleRatingStars(ratingStars[i]);
        changeSiblingElementsColor(i);
    });
}

function toggleRatingStars(star) {
    if(star.classList.contains('fa-solid')) {
        star.classList.remove('fa-solid');
        star.classList.add('fa-regular');
        ratingInput.value = parseInt(ratingInput.value) - 1;
    } else {
        star.classList.remove('fa-regular');
        star.classList.add('fa-solid');
        ratingInput.value = parseInt(ratingInput.value) + 1;
    }
}

/**
 * 
 * @param {number} index 
 * If the clicked star is middle of the stars, change the previous stars / next stars change style
 */
function changeSiblingElementsColor(index) {
    // If the clicked star is solid
    if(ratingStars[index].previousElementSibling && ratingStars[index].classList.contains('fa-solid')) {
        for(let j = 0; j < index; j++) {
            if(ratingStars[j].classList.contains('fa-regular')) {
                ratingStars[j].classList.remove('fa-regular');
                ratingStars[j].classList.add('fa-solid');
                ratingInput.value = parseInt(ratingInput.value) + 1;
            }
        }
    // If the clicked star is regular
    } else if(ratingStars[index].nextElementSibling && ratingStars[index].classList.contains('fa-regular')) {
        for(let j = index + 1; j < ratingStars.length; j++) {
            if(ratingStars[j].classList.contains('fa-solid')) {
                ratingStars[j].classList.remove('fa-solid');
                ratingStars[j].classList.add('fa-regular');
                ratingInput.value = parseInt(ratingInput.value) - 1;
            }
        }
        toggleRatingStars(ratingStars[index]);
    }
}