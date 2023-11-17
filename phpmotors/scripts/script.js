const lastModified = document.lastModified
    document.querySelector("#last-updated").textContent = lastModified


const navMenuButton = document.querySelector('.navButton');
navMenuButton.addEventListener('click', dropdownNav);

function dropdownNav (){
    const navUl = document.querySelector('.nav-ul');
    navUl.classList.toggle('responsive');
}