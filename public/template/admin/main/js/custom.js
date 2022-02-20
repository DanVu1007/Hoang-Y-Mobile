
function changeStatus(url){
    $.get(url, function(data){
        // data = JSON.parse(data);
        console.log(data);
        var element = '#status-'+data['id'];

        var classRemove = 'btn-danger';
        var classAdd    = 'btn-success';
        var iconRemove  = 'fa-ban';
        var iconAdd     = 'fa-check-circle';
        if(data['status'] == 1){
            classRemove = 'btn-success';
            classAdd    = 'btn-danger';
            iconRemove  = 'fa-check-circle';
            iconAdd     = 'fa-ban';
        }
        $(element)[0].classList.remove(classAdd);
        $(element)[0].classList.add(classRemove);

        $(element+' .fas')[0].classList.remove(iconAdd);
        $(element+' .fas')[0].classList.add(iconRemove);

        $(element)[0].setAttribute('href', "javascript:changeStatus('"+data['link']+"')");
  
        $('#status-message')[0].classList.remove('display-none')
        $('#status-message')[0].classList.add('display-block')
        $('#status-message span.content')[0].textContent = 'Cập nhật trạng thái thành công cho id: '+ data['id']
    },'json')
}

function changeGroupACP(url){
    $.get(url, function(data){
        // data = JSON.parse(data);

        var element = '#group_acp-'+data['id'];

        var classRemove = 'btn-danger';
        var classAdd    = 'btn-success';
        var iconRemove  = 'fa-ban';
        var iconAdd     = 'fa-check-circle';
        if(data['group_acp'] == 1){
            classRemove = 'btn-success';
            classAdd    = 'btn-danger';
            iconRemove  = 'fa-check-circle';
            iconAdd     = 'fa-ban';
        }
        $(element)[0].classList.remove(classAdd);
        $(element)[0].classList.add(classRemove);

        $(element+' .fas')[0].classList.remove(iconAdd);
        $(element+' .fas')[0].classList.add(iconRemove);

        $(element)[0].setAttribute('href', "javascript:changeGroupACP('"+data['link']+"')");

        $('#status-message')[0].classList.remove('display-none')
        $('#status-message')[0].classList.add('display-block')
        $('#status-message span.content')[0].textContent = 'Cập nhật quyền thành công cho id: '+ data['id']
    },'json')
}

function changeSpecial(url){
    $.get(url, function(data){
        // data = JSON.parse(data);

        var element = '#special-'+data['id'];

        var classRemove = 'btn-danger';
        var classAdd    = 'btn-success';
        var iconRemove  = 'fa-ban';
        var iconAdd     = 'fa-check-circle';
        if(data['special'] == 1){
            classRemove = 'btn-success';
            classAdd    = 'btn-danger';
            iconRemove  = 'fa-check-circle';
            iconAdd     = 'fa-ban';
        }
        $(element)[0].classList.remove(classAdd);
        $(element)[0].classList.add(classRemove);

        $(element+' .fas')[0].classList.remove(iconAdd);
        $(element+' .fas')[0].classList.add(iconRemove);

        $(element)[0].setAttribute('href', "javascript:changeSpecial('"+data['link']+"')");

        $('#status-message')[0].classList.remove('display-none')
        $('#status-message')[0].classList.add('display-block')
        $('#status-message span.content')[0].textContent = 'Cập nhật quyền thành công cho id: '+ data['id']
    },'json')
}

function submitForm(url){
    $('#adminForm').attr('action',url);
    $('#adminForm').submit();
    // console.log(url)
}

$(document).ready(function(){
    $('input[name=checkall-tongle]').change(function(){
        var checkstatus = this.checked;
        $('#adminForm').find(':checkbox').each(function(){
            this.checked = checkstatus;
        })
    })

    $('#filter-bar button[name=submit-keyword]').click(function(){
        $('#adminForm').submit();
    })

    $('#filter-bar button[name=clear-keyword]').click(function(){
        if($('#filter-bar #filter-search')[0].value == ''){
            $('#filter-bar #filter-search')[0].value = '';
        }else{
            $('#filter-bar #filter-search')[0].value = '';
            $('#adminForm').submit();
        }
    })

    $('#adminForm .drop-down-filter-search select[name=filter-state]').change(function(){
        // alert(123)
        $('#adminForm').submit();
    })
    $('#adminForm .drop-down-filter-search select[name=filter-special]').change(function(){
        // alert(123);
        $('#adminForm').submit();
    })
    $('#adminForm .drop-down-filter-search select[name=filter-group_acp]').change(function(){
        // alert(123)
        $('#adminForm').submit();
    })
    $('#adminForm .drop-down-filter-search select[name=filter-group]').change(function(){
        // alert(123)
        $('#adminForm').submit();
    })
    $('#adminForm .drop-down-filter-search select[name=filter-category_id]').change(function(){
        // alert(123)
        $('#adminForm').submit();
    })
})

function sortList(column, order){
    $('input[name="filter_column"]')[0].value = column;
    $('input[name="filter_column_dir"]')[0].value = order;
    
    $('#adminForm').submit();
}

function changePage(page){
    $('input[name="filter_page"]')[0].value = page;
    $('#adminForm').submit();
}


// --------------------------------
$(document).ready(function(){
    //Tắt bật modal login
    var loginmodal = $('.modal-login')[0];
    $('.top-nav-list li:last').click(function(){
        loginmodal.classList.add('open')
    })

    $('#modal-close').click(function(){
        loginmodal.classList.remove('open')
    })

    var dangnhap = $('.modal-content')[0];
    var dangky = $('.modal-content')[1];
    var btndn = $('#dangnhap')[0];
    var btndk = $('#dangky')[0];

    //Click vào khoảng không để ẩn đi form
    $('.modal-login').click(function(){
        loginmodal.classList.remove('open')
    })
    /////Click vào khoảng không - nhưng khi vào form ngừng nổi bọt
    $('.modal-container').click(function(event){
        event.stopPropagation();
    })

    //Chuyển đổi 2 form đăng ký đăng nhập
    $('#dangnhap').click(function(){
        dangky.classList.remove('active')
        dangnhap.classList.remove('active')
        dangnhap.classList.add('active')

        btndk.classList.remove('active')
        btndn.classList.remove('active')
        btndn.classList.add('active')    
    })
    $('#dangky').click(function(){
        dangnhap.classList.remove('active')
        dangky.classList.remove('active')
        dangky.classList.add('active')

        btndn.classList.remove('active')
        btndk.classList.remove('active')
        btndk.classList.add('active')   
    })

    //SUBMIT FORM
    $('#login_submit').click(function(){
        $('#login-form').submit();
    })

    $('#register_submit').click(function(){
        $('#register-form').submit();
    })

    $('#main_login_submit').click(function(){
        $('#main_login').submit();
    })

    //Enter to submit
    $('.form-input input').on('keyup', function(e){
        if(e.key === 'Enter' || e.keyCode === 13){
            $('#login-form').submit();
        }
    })
})