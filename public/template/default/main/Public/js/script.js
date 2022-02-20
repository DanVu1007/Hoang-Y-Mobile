const saleItems = document.querySelectorAll('.remote__item');

for(const saleItem of saleItems){
    saleItem.addEventListener('click', function(){
        var activeItem = document.querySelector('.remote__item.remote_active');
        if(activeItem){
            activeItem.classList.remove('remote_active')
        }
        this.classList.toggle('remote_active')
    });
}
