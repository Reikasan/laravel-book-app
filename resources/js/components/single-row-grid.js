const singleRowGrids = document.querySelectorAll('.single-row-grid');
const singleRowMaxHeight = 490;

window.addEventListener('load', changeBtnVisibility);

function changeBtnVisibility() {
    singleRowGrids.forEach((singleRowGrid) => {
        const row = singleRowGrid.parentElement.querySelector('.row');
        const showMore = singleRowGrid.parentElement.querySelector('.show-more-btn');

        if(showMore !== null && row.scrollHeight > singleRowMaxHeight) {
            showMore.parentElement.classList.remove('hidden');
        }
    });
}   