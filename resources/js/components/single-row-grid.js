const singleRowGrids = document.querySelectorAll('.single-row-grid');
const singleRowMaxHeight = 460;

window.addEventListener('load', changeBtnVisibility);

function changeBtnVisibility() {
    singleRowGrids.forEach((singleRowGrid) => {
        const row = singleRowGrid.parentElement.querySelector('.row');
        const showMore = singleRowGrid.parentElement.querySelector('.show-more-btn');

        if(row.scrollHeight > singleRowMaxHeight) {
            showMore.parentElement.classList.remove('hidden');
        }
    });
}   