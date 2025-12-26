document.querySelectorAll('.main-1').forEach(carousel => {
     const track = carousel.querySelector('.danh-sach-sach'); 
     const dots = carousel.querySelectorAll('.dot'); 
     let current = 0; function moveTo(index) { 
        current = index; const slideWidth = carousel.clientWidth; 
        track.style.transform = `translateX(-${slideWidth * index}px)`; 
        dots.forEach(d => d.classList.remove('active')); dots[index].classList.add('active'); 
    } 
    dots.forEach(dot => { 
        dot.addEventListener('click', () => { 
            moveTo(parseInt(dot.dataset.index)); 
        }); 
    }); 
    window.addEventListener('resize', () => moveTo(current)); 
});