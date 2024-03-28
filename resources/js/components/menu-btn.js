const menuBtns = document.querySelectorAll('.menu-btn');

menuBtns.forEach((menuBtn) => {
    menuBtn.addEventListener('click', (e) => toggleMenu(e, menuBtn));
});

function toggleMenu(e, menuBtn) {
    const menu = menuBtn.querySelector('.menu');
    menu.classList.toggle('hidden');
}